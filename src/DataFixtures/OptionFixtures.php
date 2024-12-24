<?php

namespace App\DataFixtures;

use App\Entity\SettingsOption;
use App\Utils\Constant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OptionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $options[] = (new SettingsOption())->setLang('fr')->setLabel(Constant::APP_LABEL_PRIVACY)->setValue("EDIT");
        $options[] = (new SettingsOption())->setLang('en')->setLabel(Constant::APP_LABEL_PRIVACY)->setValue("EDIT");

        $options[] = (new SettingsOption())->setLang('fr')->setLabel(Constant::APP_LABEL_CGU)->setValue("EDIT");
        $options[] = (new SettingsOption())->setLang('en')->setLabel(Constant::APP_LABEL_CGU)->setValue("EDIT");




        $options[] = (new SettingsOption())->setLang('fr')->setLabel(Constant::APP_LABEL_HOME_SUBTITLE)->setValue("EDIT");
        $options[] = (new SettingsOption())->setLang('en')->setLabel(Constant::APP_LABEL_HOME_SUBTITLE)->setValue("EDIT");



        $options[] = (new SettingsOption())->setLang('fr')->setLabel(Constant::APP_LABEL_HOME_TITLE)->setValue("EDIT");
        $options[] = (new SettingsOption())->setLang('en')->setLabel(Constant::APP_LABEL_HOME_TITLE)->setValue("EDIT");


        $options[] = (new SettingsOption())->setLang('en')->setLabel(Constant::APP_LABEL_HOME_TITLE1)->setValue("EDIT");
        $options[] = (new SettingsOption())->setLang('fr')->setLabel(Constant::APP_LABEL_HOME_TITLE1)->setValue("EDIT");

        $options[] = (new SettingsOption())->setLang('en')->setLabel(Constant::APP_LABEL_HOME_TITLE2)->setValue("EDIT");
        $options[] = (new SettingsOption())->setLang('fr')->setLabel(Constant::APP_LABEL_HOME_TITLE2)->setValue("EDIT");


        $options[] = (new SettingsOption())->setLang('en')->setLabel(Constant::APP_LABEL_SERVICE_TITLE)->setValue("EDIT");
        $options[] = (new SettingsOption())->setLang('fr')->setLabel(Constant::APP_LABEL_SERVICE_TITLE)->setValue("EDIT");
        $options[] = (new SettingsOption())->setLang('fr')->setLabel(Constant::APP_LABEL_SERVICE_SUBTITLE)->setValue("EDIT");
        $options[] = (new SettingsOption())->setLang('en')->setLabel(Constant::APP_LABEL_SERVICE_SUBTITLE)->setValue("EDIT");





        $options[] = (new SettingsOption())->setLang('fr')->setLabel(Constant::APP_LABEL_HOME_TITLE_PHASE)->setValue("EDIT");
        $options[] = (new SettingsOption())->setLang('en')->setLabel(Constant::APP_LABEL_HOME_TITLE_PHASE)->setValue("EDIT");






        $options[] = (new SettingsOption())->setLang('en')->setLabel(Constant::APP_LABEL_USER_CREATION)->setValue(Constant::APP_TRUE);
        $options[] = (new SettingsOption())->setLang('en')->setLabel(Constant::SITE_IS_INSTALLED)->setValue(Constant::APP_FALSE);





        foreach ($options as $option) {
            $manager->persist($option);
        }

        $manager->flush();
    }
}