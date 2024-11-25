<?php

namespace App\DataFixtures;

use App\Entity\SettingsOption;
use App\Utils\Constant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OptionFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $options[] = (new SettingsOption())->setLang('fr')->setLabel(Constant::APP_LABEL_PRIVACY)->setValue("EDIT");
        $options[] = (new SettingsOption())->setLang('en')->setLabel(Constant::APP_LABEL_PRIVACY)->setValue("EDIT");

        $options[] = (new SettingsOption())->setLang('fr')->setLabel(Constant::APP_LABEL_CGU)->setValue("EDIT");
        $options[] = (new SettingsOption())->setLang('en')->setLabel(Constant::APP_LABEL_CGU)->setValue("EDIT");


        $options[] = (new SettingsOption())->setLang('fr')->setLabel(Constant::APP_LABEL_ABOUT)->setValue("EDIT");
        $options[] = (new SettingsOption())->setLang('en')->setLabel(Constant::APP_LABEL_ABOUT)->setValue("EDIT");
        $options[] = (new SettingsOption())->setLang('ar')->setLabel(Constant::APP_LABEL_ABOUT)->setValue("EDIT");


        $options[] = (new SettingsOption())->setLang('fr')->setLabel(Constant::APP_LABEL_HOME_SUBTITLE)->setValue("EDIT");
        $options[] = (new SettingsOption())->setLang('en')->setLabel(Constant::APP_LABEL_HOME_SUBTITLE)->setValue("EDIT");
        $options[] = (new SettingsOption())->setLang('ar')->setLabel(Constant::APP_LABEL_HOME_SUBTITLE)->setValue("EDIT");

        $options[] = (new SettingsOption())->setLang('fr')->setLabel(Constant::APP_LABEL_HOME_TITLE)->setValue("EDIT");
        $options[] = (new SettingsOption())->setLang('en')->setLabel(Constant::APP_LABEL_HOME_TITLE)->setValue("EDIT");
        $options[] = (new SettingsOption())->setLang('ar')->setLabel(Constant::APP_LABEL_HOME_TITLE)->setValue("EDIT");


        $options[] = (new SettingsOption())->setLang('fr')->setLabel(Constant::APP_ABOUT_INFORMATION)->setValue("EDIT");
        $options[] = (new SettingsOption())->setLang('en')->setLabel(Constant::APP_ABOUT_INFORMATION)->setValue("EDIT");
        $options[] = (new SettingsOption())->setLang('ar')->setLabel(Constant::APP_ABOUT_INFORMATION)->setValue("EDIT");




        $options[] = (new SettingsOption())->setLang('en')->setLabel(Constant::APP_LABEL_USER_CREATION)->setValue(Constant::APP_TRUE);
        $options[] = (new SettingsOption())->setLang('en')->setLabel(Constant::SITE_IS_INSTALLED)->setValue(Constant::APP_FALSE);





        foreach ($options as $option) {
            $manager->persist($option);
        }

        $manager->flush();
    }
}