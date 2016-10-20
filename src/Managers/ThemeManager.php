<?php

namespace Cltvo\Chahuistle\Managers;

use Cltvo\Chahuistle\Managers\Traits\Theme\RegisterHooksTrait;

abstract class ThemeManager {

    use RegisterHooksTrait;

    /**
     * theme info
     */
    public static function getThemeInfo(){
        return wp_get_theme();
    }

    /**
     * public url of the theme
     * @return string
     */
    public static function getThemeUrl(){
        return get_bloginfo('template_url').'/';
    }

    /**
     * url of the sitio
     * @return string
     */
    public static function getBlogUrl(){
        return get_home_url('/');
    }

    /**
     * translation domain
     * @return string 
     */
    public static function getTranslationDomain(){
        return static::getThemeInfo()->template;
    }

}
