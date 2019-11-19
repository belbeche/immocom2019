<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Annonce;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AnnoncesFix extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        // $product = new Product();
        // $manager->persist($product);
        for ($i=0; $i < 100; $i++) { 
            $annonce = new Annonce();
            $annonce
                ->setTitre($faker->words(3,true))
                ->setDescription($faker->sentences(3,true))
                ->setSurface($faker->numberBetween(20,350))
                ->setRooms($faker->numberBetween(2,10))
                ->setBedrooms($faker->numberBetween(3,true))
                ->setFloor($faker->numberBetween(0,15))
                ->setChauffage($faker->numberBetween(0,count(Annonce::CHAUFFAGE) - 1))
                ->setVille($faker->city)
                ->setAdresse($faker->address)
                ->setPrice($faker->numberBetween(100000,1000000))
                ->setCodePostale($faker->postcode)
                ->setSold(false)
                ->setUpdatedAt(new \DateTime('now'));
            $manager->persist($annonce);
        }
        $manager->flush();
    }
}




