<?php

namespace Cltvo\Chahuistle\Managers\Traits\Theme;

use Cltvo\Chahuistle\Contracts\RegisterHookContract;

trait RegisterHooksTrait
{
    /**
     * list of action to be registered
     * @var array
     */
    protected $register_actions = [];

    /**
     * list of filters to be registered
     * @var array
     */
    protected $register_filters = [];


    /**
     * register al hooks
     */
    public static function registerHooks(){
        $theme = new static;
        $theme->addActions();
        $theme->addFilters();
    }

    /**
     * register all actions
     */
    public function addActions(){
        foreach ($this->getRegisteredActions() as $action) {
            $this->registerAction(new $action);
        }
    }

    /**
     * register all filters
     */
    public function addFilters(){
        foreach ($this->getRegisteredFilters() as $filter) {
            $this->registerFilter(new $filter);
        }
    }

    /**
     * return the actions to be registered
     * @return array
     */
    protected function getRegisteredActions(){
        return $this->register_actions;
    }

    /**
     * return the filters to be registered
     * @return array
     */
    protected function getRegisteredFilters(){
        return $this->register_filters;
    }

    /**
     * register a single actions
     */
    protected function registerAction(RegisterHookContract $hook)
    {
        add_action(
            $hook->getTag(),
            function() use ($hook) {
                return $hook->getCallback(func_get_args());
            },
            $hook->getPriority(),
            $hook->getAcceptedArgs()
        );
    }

    /**
     * register a single filters
     */
    protected function registerFilter(RegisterHookContract $hook)
    {
        add_filter(
            $hook->getTag(),
            function() use ($hook) {
                return $hook->getCallback(func_get_args());
            },
            $hook->getPriority(),
            $hook->getAcceptedArgs()
        );
    }
}
