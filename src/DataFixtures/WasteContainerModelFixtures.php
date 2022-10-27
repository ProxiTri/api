<?php

namespace App\DataFixtures;

use App\Entity\WasteContainerModel;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class WasteContainerModelFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $data = file_get_contents("https://www.agglo-larochelle.fr/dechets-api/-/dechets-data/pav/data.json");
        $dataJson = json_decode($data, true);

        $wasteContainerModels = [];
        foreach ($dataJson as $value) {
            $wasteContainerModels[] = [
                'model' => $value['wasteContainerModelFo']['model'],
                'manufacturer' => $value['wasteContainerModelFo']['manufacturer'],
                'usefulCapacity' => $value['wasteContainerModelFo']['usefulCapacity'],
                'type' => $value['wasteContainerModelFo']['type'],
            ];
        }

        $newArr = array();
        foreach ($wasteContainerModels as $val) {
            $newArr[$val['model']] = $val;
        }
        $array = array_values($newArr);

        foreach ($array as $value) {
            $wasteContainerModel = new WasteContainerModel();
            $wasteContainerModel->setModelName($value['model']);
            $wasteContainerModel->setModelManuFacturer($value['manufacturer']);
            $wasteContainerModel->setModelUsefulCapacity($value['usefulCapacity']);
            $wasteContainerModel->setModelType($value['type']);
            $this->addReference('wasteContainerModel_' . $value['model'], $wasteContainerModel);
            $manager->persist($wasteContainerModel);
            $manager->flush();
        }

    }
}
