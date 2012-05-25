<?php 

namespace Fran\PostBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Fran\PostBundle\Entity\Taxonomy;

class LoadTaxonomyData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
    	for ($i=1; $i <= 20; $i++) { 

			$taxonomy = new Taxonomy();
			$taxonomy->setName(sprintf('Taxonomy%s', $i));
			if(rand(0,1)) {
				$taxonomy->setType(Taxonomy::CATEGORY);
			} else {
				$taxonomy->setType(Taxonomy::TAG);
			}
        	$manager->persist($taxonomy);   

        	$this->addReference(sprintf('taxonomy-%s', $i), $taxonomy);
    	}
        
        $manager->flush();
	}
        

    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}