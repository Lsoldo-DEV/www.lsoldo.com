<?php

namespace App\Utils;

use App\Repository\SettingsOptionRepository;
use Symfony\Component\HttpFoundation\Request;

class Constant
{
    const ROLE_USER = 'ROLE_USER';
    const ROLE_MANAGER = 'ROLE_MANAGER';
    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_SUPER_ADMIN = 'ROLE_SUPER_ADMIN';
    const MAIL_MAIL_SUBSCRIBE_FREQUENCY =["All","A few","Important"];

    public const  SITE_IS_INSTALLED = 'SITE IS INSTALLED';
    public const APP_NAME = 'app-name';
    public const APP_LABEL_HOME_SUBTITLE = 'home-title';
    public const APP_LABEL_HOME_TITLE = 'home-subtitle';
    public const APP_LABEL_USER_CREATION = 'user-creation';
    public const APP_LABEL_ABOUT = 'about';
    public const APP_LABEL_PRIVACY = 'privacy';
    public const APP_LABEL_CGU = 'cgu';
    public const APP_FALSE = "<div>FALSE</div>";
    public const APP_ABOUT_INFORMATION ="about-information";
    const APP_TRUE = "<div>TRUE</div>";

    const DEFAULT_DESCRIPTION_LANGUAGE = "fr";

    public static function getMailAndSenderName():array{
        return [$_ENV['SENDER_EMAIL'],$_ENV['SENDER_EMAIL_NAME']];
    }
    public static function getTitleAndSubTitle(SettingsOptionRepository $optionRepository,Request $request,array $labels){
        $locale = $request->get('_locale');
        $arrayReturn =[];

        foreach ($labels as $label){
            $arrayReturn[]=$optionRepository->getValueWithLabelAndLocal($label,$locale);
        }
        return array_reverse($arrayReturn);
    }
}