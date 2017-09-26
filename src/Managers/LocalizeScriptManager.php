<?php

namespace Cltvo\Chahuistle\Managers;

use Cltvo\Chahuistle\Contracts\LocalizeScriptContract;
use Cltvo\Chahuistle\Helpers\StringHelper;

abstract class LocalizeScriptManager implements LocalizeScriptContract{

    /**
     * path of the script relative to the js theme path
     * @var string
     */
    protected $name = "";

    /**
     * Array of registered script handles this script depends on
     * @var string
     */
    protected $data = [];

    /**
     * The name of the variable which will contain the dataThe name of the variable which will contain the data
     */
    public function getName()
    {
        return sanitize_title( $this->name );
    }

    /**
     * The data itself
     */
    public function getData()
    {
        return $this->data;
    }

}
