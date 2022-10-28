<?php

namespace App\DataFixtures;

use App\Entity\RecyclingCenter;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class RecyclingCenterFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $recyclingCenters = [
            [
                "name" => "Décheterie de CHÂTELAILLON-PLAGE",
                "localisationCityId" => "39704894",
                "latitude" => "46.0936336",
                'longitude' => "-1.099737",
                "businessHours" => "Le lundi de 9h à 12h et de 14h à 19h. Du mardi au samedi de 9h à 12h et de 14h à 18h"
            ],
            [
                "name" => "Décheterie de LAGORD",
                "localisationCityId" => "39704902",
                "latitude" => "46.1897065",
                "longitude" => "-1.1682282",
                "businessHours" => "Le lundi de 9h à 12h et de 14h à 19h. Du mardi au samedi de 9h à 12h et de 14h à 18h"
            ],
            [
                "name" => "Décheterie de SAINT-XANDRE",
                "localisationCityId" => "39705031",
                "latitude" => "46.2040993",
                "longitude" => "-1.0909796",
                "businessHours" => "Du mardi au samedi de 9h à 12h et de 14h à 18"
            ],
            [
                "name" => "Décheterie de SAINT-SOULLE",
                "localisationCityId" => "39704994",
                "latitude" => "46.199142",
                "longitude" => "-1.0537308",
                "businessHours" => "Du mardi au samedi de 9h à 12h et de 14h à 18"
            ],
            [
                "name" => "Décheterie de NIEUL-SUR-MER",
                "localisationCityId" => "39705027",
                "latitude" => "46.2043215",
                "longitude" => "-1.1717355",
                "businessHours" => "Du mardi au samedi de 9h à 12h et de 14h à 18"
            ],
            [
                "name" => "Décheterie de SALLES-SUR-MER",
                "localisationCityId" => "39705051",
                "latitude" => "46.1162367",
                "longitude" => "-1.0385367",
                "businessHours" => "Le lundi de 9h à 12h et de 14h à 19h. Du mercredi au samedi de 9h à 12h et de 14h à 18h"
            ],
            [
                "name" => "Décheterie de SAINT-MÉDARD-D’AUNIS",
                "localisationCityId" => "39704993",
                "latitude" => "46.1657944",
                "longitude" => "-0.9816374",
                "businessHours" => "Le lundi de 14h à 19h. Les mardis, mercredis, vendredis et samedis de 9h à 12h et de 14h à 18h"
            ],
            [
                "name" => "Décheterie de MARSILLY",
                "localisationCityId" => "39704904",
                "latitude" => "46.218658",
                "longitude" => "-1.1352701",
                "businessHours" => "Le lundi de 9h à 12h et de 14h à 19h. Les mercredis et samedis de 9h à 12h et de 14h à 18h"
            ],
            [
                "name" => "Décheterie de PERIGNY : CENTRE DE VALORISATION DES DÉCHETS – CENTRE",
                "localisationCityId" => "39704907",
                "latitude" => "46.2187591",
                "longitude" => "-1.2055501",
                "businessHours" => "Ouvert en journée continue. Le lundi de 9h30 à 19h. Du mercredi au samedi de 9h30 à 18h. Fermeture le mardi, le dimanche et les jours fériés."
            ],
        ];

        foreach ($recyclingCenters as $item) {
            $recyclingCenter = new RecyclingCenter();
            $recyclingCenter->setName($item['name']);
            $recyclingCenter->setComuneId($this->getReference('localisationCityId_' . $item['localisationCityId']));
            $recyclingCenter->setLatitude($item['latitude']);
            $recyclingCenter->setLongitude($item['longitude']);
            $recyclingCenter->setBusinessHours($item['businessHours']);
            $manager->persist($recyclingCenter);
            $this->addReference($item['name'], $recyclingCenter);
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
