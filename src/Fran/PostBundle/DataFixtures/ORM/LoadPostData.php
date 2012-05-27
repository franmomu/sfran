<?php 

namespace Fran\PostBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Fran\PostBundle\Entity\Post;

class LoadPostData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
    	for ($i=1; $i <= 5; $i++) { 

			$post = new Post();
			$post->setTitle(sprintf('Post%s', $i));
			$numberOfTaxonomies = rand(1,20);
			for ($j=1; $j <= $numberOfTaxonomies; $j++) { 
				$taxonomy = $manager->merge($this->getReference(sprintf('taxonomy-%s', rand(1,20))));
				if (!$post->getTaxonomies()->contains($taxonomy)) {
					$post->addTaxonomy($taxonomy);
				}
			}

        	$manager->persist($post);   

        	$this->addReference(sprintf('post-%s', $i), $post);
    	}
        
        $manager->flush();
	}
        

    public function getOrder()
    {
        return 3; // the order in which fixtures will be loaded
    }
}