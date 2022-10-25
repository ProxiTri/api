<?php

namespace App\DataFixtures;

use App\Entity\WasteType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class WasteTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $data = file_get_contents("https://www.agglo-larochelle.fr/dechets-api/-/dechets-data/pav/data.json");
        $dataJson = json_decode($data, true);

        $wasteTypes = [];
        foreach ($dataJson as $value) {
            $wasteTypes[] = [
                'designation' => $value['wasteType']['designation'],
                'density' => $value['wasteType']['density'],
                'customerDesignation' => $value['wasteType']['customerDesignation'],
            ];
        }

        $newArr = array();
        foreach ($wasteTypes as $val) {
            $newArr[$val['designation']] = $val;
        }
        $array = array_values($newArr);

        foreach ($array as $value) {
            $wasteType = new WasteType();
            $wasteType->setDesignation($value['designation']);
            $wasteType->setDensity($value['density']);
            $wasteType->setCustomerDesignation($value['customerDesignation']);
            $this->addReference('wasteType_' . $value['designation'], $wasteType);
            $manager->persist($wasteType);
            $manager->flush();
        }

    }
}
