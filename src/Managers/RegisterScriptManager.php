<?php

namespace Cltvo\Chahuistle\Managers;

use Cltvo\Chahuistle\Contracts\RegisterScriptContract;
use Cltvo\Chahuistle\Helpers\StringHelper;

abstract class RegisterScriptManager implements RegisterScriptContract{

    /**
     * path of the script relative to the js theme path
     * @var string
     */
    protected $filename = "";

    /**
     * Array of registered script handles this script depends on
     * @var string
     */
    protected $dependencies = [];

    /**
     * String specifying script version number
     * @var boolean
     */
    protected $version = false;

    /**
     * Whether to enqueue the script before </body>
     * @var boolean
     */
    protected $in_footer = true;


    /**
     * Localizes a registered scripts with data for a JavaScript variable.
     * @var boolean
     */
    protected $register_variables = [];


    public function getFilename()
    {
        return $this->filename;
    }

    public function getDependencies()
    {
        return $this->dependencies;
    }

    public function getVersion()
    {
        return $this->version;
    }

    public function inFooter()
    {
        return $this->in_footer;
    }

    public function getLocalizeScripts()
    {
        return $this->register_variables;
    }

    public function getHandle()
    {
        if (isset($this->handle)) {
            return $this->handle;
        }

        return sanitize_title( StringHelper::generateSnakeCase(get_class($this)) );
    }



}
