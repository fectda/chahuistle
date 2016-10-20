<?php

namespace Cltvo\Chahuistle\Managers\Traits\Theme;

trait RegisterHooksTrait
{
    protected $register_actions = [];

    protected $register_filters = [];

    public static function registerHooks(){
        $theme = new static;
        $theme->addActions();
        $theme->addFilters();
    }

    public function addActions(){
        foreach ($this->getRegisteredActions() as $action) {
            $hook = new $action;
            add_action( $hook->getTag(), function() use ($hook) {
                return $hook->getCallback(func_get_args());
            },$hook->getPriority(),$hook->getAcceptedArgs() );
        }
    }

    public function addFilters(){
        foreach ($this->getRegisteredFilters() as $action) {
            $hook = new $action;
            add_filter( $hook->getTag(), function() use ($hook) {
                return $hook->getCallback(func_get_args());
            },$hook->getPriority(),$hook->getAcceptedArgs() );
        }
    }

    protected function getRegisteredActions(){
        return $this->register_actions;
    }

    protected function getRegisteredFilters(){
        return $this->register_filters;
    }
}
