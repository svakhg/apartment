<?php
class Model_Lang {
    public $defLang = 'rus';
    public static function get(){
        $request = $_SERVER['REQUEST_URI'];
        if (preg_match('{^/admin/}is', $request))
            $module = 'admin';
        else
            $module = 'default';

        if ($module == 'admin'){
            $lang = 'rus';
            if (isset($_COOKIE['lang']))
                $lang = $_COOKIE['lang'];
            return $lang;
        }else{
            $domain = $_SERVER['SERVER_NAME'];
            if ($domain == 'www.apartment-kharkov.com.ua')
               return 'rus';
           // return 'eng';
            return 'rus';
        }
    }

    public static function langUrl($lang = 'rus'){
        $uri = $_SERVER['REQUEST_URI'];
        if ($lang == 'rus')
            $url = 'http://www.apartment-kharkov.com.ua' . $uri;
        else
            $url = 'http://www.apartment-kharkov.com' . $uri;
        return $url;
    }

    public static function getAdminLangUrl($lang = 'rus'){
        $url = '/admin/index/lang/lang/' . $lang . '/backUrl/';
        $backUrl = str_replace('/', '|', $_SERVER['REQUEST_URI']);
        $url = $url . $backUrl;
        return $url;
    }
}