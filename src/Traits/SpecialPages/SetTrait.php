<?php

namespace Cltvo\Chahuistle\Traits\SpecialPages;

use Cltvo\Chahuistle\Contracts\SpecialPageContract as SpecialPage;

trait SetTrait
{

    /**
     * special pages filterec
     * @var array
     */
    protected $specialPagesFromRegister    = [];

    /**
     * special pages ids
     * @var array
     */
    static protected $special_pages_ids         = [];

    /**
     * special pages WP_Post
     * @var array
     */
    static protected $special_pages             = [];


    /**
     * generates a special page helper objetc fron confing
     * @return [type] [description]
     */
    protected function mapSpecialPages()
    {
        return array_map(function($page){
            return new $page;
        }, $this->register_special_pages );
    }


    /**
     * fither the onñly valid special pages
     * @return array valid special pages
     */
    protected function filterNotEmtyPages()
    {
        return array_filter($this->mapSpecialPages() ,function($page){
            return $page->isValidPage();
        });
    }


    /**
     * fither the test special pages
     * @return array valid special pages
     */
    protected function filterTestPages()
    {
        return array_filter($this->specialPagesFromRegister ,function($page) {
            return !$page->isTestPage();
        });
    }

    /**
     * load the special pages form database
     * @return array special pages ids
     */
    protected function loadOptionFromDatabase()
    {
        $special_pages_option = get_option(static::OPTION_KEY); // almacena los ids de las paginas especiales

        if ( !is_array($special_pages_option) )  { //crea la opccion si aun no esta creada
            add_option(static::OPTION_KEY);
            $special_pages_option=array();
        }

        return $special_pages_option;
    }

    /**
     * update option in the databas with the special pages
     */
    protected function updateOptionFromDatabase()
    {
        return update_option( static::OPTION_KEY, static::$special_pages_ids);
    }

    /**
     * create new especial page
     * @param  array  $page_args special page paramethers
     * @return int           page id
     */
    protected function createSpecialPage(array $page_args)
    {
        $args = [
            'post_author'  => 1,
            'post_status'  => 'publish',
            'post_type'    => 'page',
        ];
        return wp_insert_post( array_merge($args,$page_args), true );
    }

    /**
     * preserve a spoecial page
     * @param  SpecialPage $page
     * @param  WP_Post      $post objeto generado por wordpress
     * @return int          page id
     */
    protected function preservePage(SpecialPage $page, $post)
    {
        $slug = $page->getSlug();

        $updatePost = false;
        $post_sustitute = static::getPageBySlug($slug);

        if($post_sustitute){ // verifica que el slug no lo tenga otra pagina
            $post = ($post_sustitute->ID != $post->ID ) ? $post_sustitute : $post ;
        }

        $post_args = [
            'ID'           => $post->ID,
            'post_title'   => $post->post_title,
            'post_content' => $post->post_content,
            'post_status'  => 'publish', // evita que las paginas se coloquen en borador o se envien a la papelera.
            'post_parent'  => $page->getParentId(static::$special_pages_ids),  // evita que las paginas se cambien de padre
            'post_name'    => $slug, // evita que las paginas se cambien de slug
        ];

        return wp_update_post( $post_args );
    }

    /**
     * return the array with the special pages ids
     * @return array
     */
    static public  function getSpecialPagesIds()
    {
        return static::$special_pages_ids;
    }

    /**
     * return the array with the special pages WP_Post objects
     * @return array
     */
    static public  function getSpecialPages()
    {
        return static::$special_pages;
    }

    /**
     * generate de special pages
     */
    protected function genereteSpecialPages()
    {
        $new_special_pages_ids = [];
        foreach ($this->specialPagesFromRegister as $page) { // genera y revisa las paginas

            $create_post = true ;
            $slug = $page->getSlug();

            $page_id = isset(static::$special_pages_ids[$slug]) ? intval(static::$special_pages_ids[$slug] ) : 0 ;

            $post = $page_id != 0 ? get_post( $page_id ) : static::getPageBySlug( $slug );

            if ($post) { // si no borraron permanentemente la pagina o ya existia
                $create_post = false;
                $page_id = $this->preservePage($page,$post);
            }

            if($create_post){ // si no existe la pagina guarda
                $page_id = $this->createSpecialPage( $page->toArray($new_special_pages_ids) );
            }

            $new_special_pages_ids[$slug] = $page_id;
            static::$special_pages[$slug] = get_post($page_id);
        }

        static::$special_pages_ids = $new_special_pages_ids;

    }

}
