<?php

namespace App\DataFixtures;

use App\Entity\Comune;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CommuneFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $data = file_get_contents("https://www.agglo-larochelle.fr/dechets-api/-/dechets-data/pav/data.json");
        $dataJson = json_decode($data, true);

        $communes = [];
        foreach ($dataJson as $value) {
            $communes[] = [
                'name' => $value['localisationFo']['town'],
                'localisationPostalCode' => $value['localisationFo']['postalCode'],
                'localisationCountry' => $value['localisationFo']['country'],
                'localisationTownId' => $value['localisationFo']['townId'],
            ];
        }

        $newArr = array();
        foreach ($communes as $val) {
            $newArr[$val['localisationTownId']] = $val;
        }
        $array = array_values($newArr);

        foreach ($array as $value) {
            $commune = new Comune();
            $commune->setName($value['name']);
            $commune->setLocalisationPostalCode($value['localisationPostalCode']);
            $commune->setLocalisationCountry($value['localisationCountry']);
            $commune->setLocalisationTownId($value['localisationTownId']);
            $this->addReference('localisationCityId_' . $value['localisationTownId'], $commune);
            $manager->persist($commune);
            $manager->flush();
        }

    }
}
