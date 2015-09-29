<?php
class Kh_Application_Resource_Translate extends Zend_Application_Resource_ResourceAbstract{
    public function init(){
        $config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', 'production');
        $adapter = $config->resources->translate->adapter;
        $defaultTranslation = $config->resources->translate->default->file;
        $defaultLocale = $config->resources->translate->default->locale;
        $translate = new Zend_Translate($adapter, $defaultTranslation, $defaultLocale);
        foreach ($config->resources->translate->translation as $locale => $translation){
            $translate->addTranslation($translation, $locale);
        }
        $lang = Model_Lang::get();
        if ($lang == 'rus')
            $lcl = 'ru_RU';
        else 
            $lcl = 'en_EN';
        $translate->setLocale($lcl);
        Zend_Registry::set('Zend_Translate', $translate);
        Zend_Form::setDefaultTranslator($translate);
        Zend_Validate_Abstract::setDefaultTranslator($translate);
        return $translate;
    }
}