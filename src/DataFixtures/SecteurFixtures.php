<?php

namespace App\DataFixtures;

use App\Entity\Secteur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SecteurFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $secteurs = [
            'Secteur 1',
            'Secteur 2',
            'Secteur 3',
            'Secteur 4'
        ];

        foreach ($secteurs as $item) {
            $secteur = new Secteur();
            $secteur->setName($item);
            $secteur->setComuneId($this->getReference('localisationCityId_39704901'));
            $manager->persist($secteur);
            $this->addReference($item, $secteur);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CommuneFixtures::class
        ];
    }
}
