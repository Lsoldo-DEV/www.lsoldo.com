<?php

namespace App\DataFixtures;

use App\Entity\FAQ;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FAQFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faq1 = new FAQ;
        $faq1->setQuestion('Do you offer both on-site and remote IT support?');
        $faq1->setAnswer('Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsum ullam earum itaque, quas labore illo
							                            eligendi iure asperiores, modi veniam molestiae vero quasi. Ex, alias modi voluptates aspernatur
							                            consequuntur facere?');
        
        $faq2 = new FAQ;
        $faq2->setQuestion('what is techida ?');
        $faq2->setAnswer('Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsum ullam earum itaque, quas labore illo
							                            eligendi iure asperiores, modi veniam molestiae vero quasi. Ex, alias modi voluptates aspernatur
							                            consequuntur facere?');

        $faq3 = new FAQ;
        $faq3->setQuestion('Is There Any Updates In The Future ?');
        $faq3->setAnswer('Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsum ullam earum itaque, quas labore illo
							                            eligendi iure asperiores, modi veniam molestiae vero quasi. Ex, alias modi voluptates aspernatur
							                            consequuntur facere?');

        $faq4 = new FAQ;
        $faq4->setQuestion('How Much For The Service?');
        $faq4->setAnswer('Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsum ullam earum itaque, quas labore illo
							                            eligendi iure asperiores, modi veniam molestiae vero quasi. Ex, alias modi voluptates aspernatur
							                            consequuntur facere?');

        $manager->persist($faq1);
        $manager->persist($faq2);
        $manager->persist($faq3);
        $manager->persist($faq4);

        $manager->flush();
    }
}
