<?php

namespace Cltvo\Chahuistle;

use Cltvo\Chahuistle\Managers\HooksManager;
use Cltvo\Chahuistle\Contracts\RegisterStyleContract;


abstract class RegisterStylesHook extends HooksManager {

    protected $register_styles = [];

    public function getCallback(array $callback_args){
        foreach ($this->register_styles as $style_class) {
            $this->registerStyle(new  $style_class);
        }
    }

    /**
     * js directory path
     */
    protected function getCSSPath(){
        return  get_template_directory_uri() . '/css/' ;
    }

    protected function registerStyle(RegisterStyleContract $style)
    {
        wp_enqueue_style(
            $style->getHandle(),
            $style->getSource($this->getCSSPath()),
            $style->getDependencies(),
            $style->getVersion(),
            $style->getMedia()
        );

    }




}
