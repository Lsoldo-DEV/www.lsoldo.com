<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Repository;

use App\Entity\Post;
use App\Entity\Tag;
use App\Pagination\Paginator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

use function Symfony\Component\String\u;


class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, private PaginatorInterface $paginator)
    {
        parent::__construct($registry, Post::class);
    }


    /**
     * @return Post[]
     */
    public function findBySearchQuery(string $query, int $limit = Paginator::PAGE_SIZE): array
    {
        $searchTerms = $this->extractSearchTerms($query);

        if (0 === \count($searchTerms)) {
            return [];
        }

        $queryBuilder = $this->createQueryBuilder('p');

        foreach ($searchTerms as $key => $term) {
            $queryBuilder
                ->orWhere('p.title LIKE :t_' . $key)
                ->setParameter('t_' . $key, '%' . $term . '%')
            ;
        }

        /** @var Post[] $result */
        $result = $queryBuilder
            ->orderBy('p.publishedAt', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();

        return $result;
    }

    /**
     * Transforms the search string into an array of search terms.
     *
     * @return string[]
     */
    private function extractSearchTerms(string $searchQuery): array
    {
        $terms = array_unique(u($searchQuery)->replaceMatches('/[[:space:]]+/', ' ')->trim()->split(' '));

        // ignore the search terms that are too short
        return array_filter($terms, static function ($term) {
            return 2 <= $term->length();
        });
    }

    public function paginatePost(int $page, string $locale): PaginationInterface  {

        return $this->paginator->paginate(
            $this->findAllOrderedByLang($locale),
            $page,
            3
        );
    }

    public function findAllOrderedByLang(string $locale): Query
    {
        return $this->createQueryBuilder('p')
            ->leftJoin('p.description', 'd')
            ->addSelect('d')
            ->leftJoin('d.tags', 't')
            ->addSelect('t')
            ->andWhere('d.lang = :locale')
            ->setParameter('locale', $locale)
            ->orderBy('p.publishedAt', 'DESC')
            ->getQuery();
    }



    public function findLatestPosts(string $locale, int $limit = 2, ?int $currentId = null): array
    {
        $queryBuilder = $this->createQueryBuilder('p')
            ->leftJoin('p.description', 'd')
            ->addSelect('d')
            ->leftJoin('d.tags', 't')
            ->addSelect('t')
            ->andWhere('d.lang = :locale')
            ->setParameter('locale', $locale)
            ->orderBy('p.publishedAt', 'DESC')
            ->setMaxResults($limit);

        if ($currentId !== null) {
            $queryBuilder->andWhere('p.id != :currentId')
                ->setParameter('currentId', $currentId);
        }

        return $queryBuilder->getQuery()->getResult();
    }
}
