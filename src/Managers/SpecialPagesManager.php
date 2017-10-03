<?php

namespace Cltvo\Chahuistle\Managers;

use Cltvo\Chahuistle\Contracts\SpecialPageContract;

abstract class SpecialPagesManager implements SpecialPageContract{

    const POST_TITLE       = 'page_title';
    const POST_NAME        = 'page_slug';
    const POST_PARENT_SLUG = 'parent_slug';
    const CLTVO_TEST_PAGE  = false;

    // protected $title;
    // protected $name;
    // protected $parent_slug;

    // function __construct(array $page_args) {
    //     static::POST_TITLE        = ArrayHelper::issetAndIsString($page_args,static::POST_TITLE) ? $page_args[static::POST_TITLE] : ( is_string(reset($page_args)) ? reset($page_args) : ""  ) ;
    //     static::POST_NAME         = empty(static::POST_TITLE) ? "" : sanitize_title( ArrayHelper::issetAndIsString($page_args,static::POST_NAME) ? $page_args[static::POST_NAME] : static::POST_TITLE ) ;
    //     static::POST_PARENT_SLUG  = empty(static::POST_TITLE) ? "" : sanitize_title( ArrayHelper::issetAndIsString($page_args,static::POST_PARENT_SLUG) ? $page_args[static::POST_PARENT_SLUG] : "" ) ;
    // }

    public function isValidPage()
    {
        return !empty(static::POST_TITLE);
    }

    public function isTestPage()
    {
        return static::CLTVO_TEST_PAGE;
    }

    public function getSlug()
    {
        return static::POST_NAME;
    }

    public function getParentId(array $special_pages_id)
    {
        return !empty(static::POST_PARENT_SLUG) && isset($special_pages_id[static::POST_PARENT_SLUG]) ? $special_pages_id[static::POST_PARENT_SLUG] : 0;
    }

    public function toArray(array $special_pages_id)
    {
        return [
            'post_name'    => static::POST_NAME,
            'post_title'   => static::POST_TITLE,
            'post_parent'  => $this->getParentId($special_pages_id)
        ];
    }



}
