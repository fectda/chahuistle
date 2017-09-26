<?php

namespace Cltvo\Chahuistle;

use Cltvo\Chahuistle\Managers\HooksManager;
use Cltvo\Chahuistle\Contracts\RegisterScriptContract;
use Cltvo\Chahuistle\Contracts\LocalizeScriptContract;

abstract class RegisterScriptsHook extends HooksManager {

    protected $tag = "wp_enqueue_scripts";

    protected $register_scripts = [];

    protected $enqueue_scripts = [];

    public function getCallback(array $callback_args){

        foreach ($this->register_scripts as $script_class) {

            $script = new  $script_class;
            $this->registerScript($script);

            foreach ($script->getLocalizeScripts() as $localize_script) {
                $this->localizeScript($script->getHandle(), new  $localize_script);
            }
        }

        foreach ($this->enqueue_scripts as $script_class) {
            $this->enqueueScript(new  $script_class);
        }

    }

    /**
     * js directory path
     */
    protected function getJSPath(){
        return  get_template_directory_uri() . '/js/' ;
    }

    protected function registerScript(RegisterScriptContract $script)
    {

        wp_register_script(
            $script->getHandle(),
            $this->getJSPath().$script->getFilename(),
            $script->getDependencies(),
            $script->getVersion(),
            $script->inFooter()
        );

    }

    protected function localizeScript($handle,LocalizeScriptContract $script)
    {
        wp_localize_script(
            $handle,
            $script->getName(),
            $script->getData()
        );
    }

    protected function enqueueScript(RegisterScriptContract $script)
    {
        wp_enqueue_script($script->getHandle());
    }




}
