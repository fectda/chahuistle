<?php

namespace Cltvo\Chahuistle\Managers;

use Cltvo\Chahuistle\Managers\Traits\Theme\RegisterHooksTrait;

abstract class ThemeManager {

    use RegisterHooksTrait;

    public static function getThemeInfo(){
        return wp_get_theme();
    }

    public static function getThemeUrl(){
        return get_bloginfo('template_url').'/';
    }

    public static function getBlogUrl(){
        return get_home_url('/');
    }

    public static function getTranslationDomain(){
        return static::getThemeInfo()->template;
    }

}
