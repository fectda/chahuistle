<?php

namespace Cltvo\Chahuistle\Traits\SpecialPages;


trait HelpersTrait
{
    /**
     * returns special pages by slug
     * @param  string $slug slug of the special page
     * @return WP_Post|null       special pages
     */
    public static function getSpecialPage($slug)
    {
        if (!static::specialPageExists($slug) ) {
            return null;
        }
        return static::$special_pages[$slug];
    }

    /**
     * returns special page is by slug
     * @param  string $slug slug of the special page
     * @return int|null       id of special page
     */
    public static function getSpecialPageId($slug)
    {
        if (!static::specialPageExists($slug) ) {
            return null;
        }
        return static::$special_pages_ids[$slug];
    }

    /**
     * chacks if espcial exists
     * @param  string $slug slug of the special page
     * @return boolean
     */
    public static function specialPageExists($slug)
    {
        return isset(static::$special_pages_ids[$slug]);
    }

    /**
     * check if edited post y a specific special page
     * @param  string $slug slug of the special page
     * @return boolean
     */
    public static function inSpecialPage($slug)
    {
        if (!static::specialPageExists($slug)) {
            return false;
        }
        return isset($_GET['post']) && ($_GET['post'] == static::getSpecialPageId( $slug));
    }


    /**
     * retuns the permalink of a especial page
     * @param  string $slug [slug of the special page
     * @return string      permalink
     */
    public static function getSpecialPagePermalink($slug)
    {
        if (!static::specialPageExists($slug)) {
            return null;
        }
        return get_permalink( static::getSpecialPageId($slug) ) ;
    }

    /**
     * returns page by slug
     * @param string $slug slug de la pagina a buscar
     * @return wpPost|null      page
     */
    public function getPageBySlug($slug)
    {
        $posts = get_posts(array(
                'name' => $slug,
                'posts_per_page' => 1,
                'post_type' => 'page',
                'post_status' => 'any',
        ));

        return empty($posts) ? null :$posts[0];
    }

}
