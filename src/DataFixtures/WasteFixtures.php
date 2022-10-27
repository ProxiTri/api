<?php

namespace App\DataFixtures;

use App\Entity\Waste;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class WasteFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @throws \Exception
     */
    public function load(ObjectManager $manager): void
    {
        $data = file_get_contents("https://www.agglo-larochelle.fr/dechets-api/-/dechets-data/pav/data.json");
        $dataJson = json_decode($data, true);

        $wastes = [];
        foreach ($dataJson as $value) {
            $installFirstDate = new \DateTime();
            $installNewDate = new \DateTimeImmutable();
//            dd(gettype($installFirstDate->setTimestamp(intval($value['installationDates']['firstBox'] / 1000))));
            $wastes[] = [
                'name' => $value['name'],
                'serialNumber' => $value['serialNumber'],
                'wasteContainerModel' => $this->getReference('wasteContainerModel_' . $value['wasteContainerModelFo']['model']),
                'wasteType' => $this->getReference('wasteType_' . $value['wasteType']['designation']),
                'commune' => $this->getReference('localisationCityId_' . $value['localisationFo']['townId']),
                'localisationName' => $value['localisationFo']['name'],
                'localisationStreet' => $value['localisationFo']['street'],
                'localisationLatitude' => $value['localisationFo']['latitude'],
                'localisationLongitude' => $value['localisationFo']['longitude'],
                'installFirstDate' => $installFirstDate->setTimestamp(intval($value['installationDates']['firstBox'] / 1000)),
                'installNewDate' => $installNewDate->setTimestamp(intval($value['installationDates']['box'] / 1000)),
            ];
        }

        $newArr = array();
        foreach ($wastes as $val) {
            $newArr[$val['serialNumber']] = $val;
        }
        $array = array_values($newArr);

        foreach ($array as $value) {
            $waste = new Waste();
            $waste->setName($value['name']);
            $waste->setSerialNumber($value['serialNumber']);
            $waste->setWasteContainerModel($value['wasteContainerModel']);
            $waste->setWasteType($value['wasteType']);
            $waste->setCommune($value['commune']);
            $waste->setLocalisationName($value['localisationName']);
            $waste->setLocalisationStreet($value['localisationStreet']);
            $waste->setLocalisationLatitude($value['localisationLatitude']);
            $waste->setLocalisationLongitude($value['localisationLongitude']);
            $waste->setInstallFirstDate($value['installFirstDate']);
            $waste->setInstallNewDate($value['installNewDate']);
            $manager->persist($waste);
            $manager->flush();
        }

    }

    public function getDependencies()
    {
        return [
            WasteContainerModelFixtures::class,
            WasteTypeFixtures::class,
        ];
    }
}
