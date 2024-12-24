<?php

namespace App\Controller\Admin\CrudControllers;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Utils\Constant;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserCrudController extends AbstractCustomCrudController
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher,private UserRepository $repository
    ) {}
    public static function getEntityFqcn(): string
    {
        return User::class;
    }
    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('email')
            ->add('roles')
          //  ->add('createAt')
            ;
    }
    public function configureFields(string $pageName): iterable
    {
        switch ($pageName){
            case Crud::PAGE_DETAIL:
                yield IdField::new('id');
                yield  EmailField::new('email')->hideOnIndex();//->setPermission('ROLE_ADMIN');
                yield  BooleanField::new('isVerified');
                yield  TextField::new('password')->hideOnDetail()->hideOnForm()->hideOnIndex();//->setPermission('ROLE_ADMIN');
                yield  ArrayField::new('roles');
               // yield  DateTimeField::new('createAt')->hideOnIndex()->onlyOnDetail();
              //  yield  DateTimeField::new('updatedAt')->hideOnIndex()->onlyOnDetail();
                break;
            case Crud::PAGE_EDIT:
                yield  EmailField::new('email')->hideOnIndex();//->setPermission('ROLE_ADMIN');
                yield  BooleanField::new('isVerified');
                #yield  CountryField::new('country');
                yield  TextField::new('password')->hideOnDetail()->hideOnForm()->hideOnIndex();//->setPermission('ROLE_ADMIN');
                yield ChoiceField::new('roles')->setPermission( Constant::ROLE_ADMIN)
                    ->allowMultipleChoices()
                    ->renderAsBadges([
                        Constant::ROLE_USER => 'info',
                        Constant::ROLE_MANAGER => 'success',
                        Constant::ROLE_ADMIN => 'warning',
                        Constant::ROLE_SUPER_ADMIN =>'danger'
                    ])
                    ->setChoices([
                        'User'=> Constant::ROLE_USER,
                        'Manager' => Constant::ROLE_MANAGER,
                        'Administrator' => Constant::ROLE_ADMIN,
                    ]);
                //yield  DateTimeField::new('createAt')->hideOnIndex()->onlyOnDetail();
               // yield  DateTimeField::new('updatedAt')->hideOnIndex()->onlyOnDetail();
                break;
            case Crud::PAGE_NEW:
                yield  EmailField::new('email');
                yield  TextField::new('fullName');
                yield  TextField::new('password')->setFormType(PasswordType::class);
                yield ChoiceField::new('roles')
                    ->allowMultipleChoices()
                    ->renderAsBadges([
                        Constant::ROLE_USER=> 'success',
                        Constant::ROLE_MANAGER => 'warning',
                        Constant::ROLE_ADMIN => 'warning',
                    ])
                    ->setChoices([
                        'User'=>Constant::ROLE_USER,
                        'Manager' => Constant::ROLE_MANAGER,
                        'Administrator' => Constant::ROLE_ADMIN,
                    ]);

                break;
            default:
                yield IdField::new('id')->hideOnForm();
              //  yield  DateTimeField::new('createAt');
                #yield  CountryField::new('country');
                yield  TextField::new('fullName');//->setPermission('ROLE_ADMIN');
                yield  TextField::new('email')->setPermission(Constant::ROLE_MANAGER);


                break;
        }

    }
    private function blockAdminCountEdit(EntityManagerInterface $entityManager,User $entityInstance,bool $update){
        if($entityInstance->getEmail()!=="homawoojoseph@gmail.com"|| $this->isGranted(Constant::ROLE_SUPER_ADMIN)){
            if($update){
                parent::updateEntity($entityManager, $entityInstance);
            }else{
                foreach ( $this->repository->findBy(['author'=>$entityInstance]) as $comment){
                    $this->repository->remove($comment,true);
                }
                parent::deleteEntity($entityManager, $entityInstance);

            }
        }else{
            $this->addFlash("info","Write to admin");
        }
    }
    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {

        $this->blockAdminCountEdit($entityManager,$entityInstance,true);
    }

    public function deleteEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $this->blockAdminCountEdit($entityManager,$entityInstance,false);

    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        /** @var User $user */
        $user = $entityInstance;

        $plainPassword = $user->getPassword();
        $hashedPassword = $this->passwordHasher->hashPassword($user, $plainPassword);

        $user->setPassword($hashedPassword);

        parent::persistEntity($entityManager, $user);
    }

}
