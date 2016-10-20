<?php

namespace Cltvo\Chahuistle\Managers;

use Cltvo\Chahuistle\Contracts\RegisterHookContract;

abstract class HooksManager implements RegisterHookContract
{
    /**
     * the name of the action to which the getCallback is hooked.
     * @var string
     */
    protected $tag = "init";

    /**
     * the specify order in which the functions associated with a particular action are executedthe specify order in which the functions associated with a particular action are executed
     * @var integer
     */
    protected $priority = 10;

    /**
     * The number of arguments the function accepts.
     * @var integer
     */
    protected $accepted_args = 1;

    /**
     * the name of the action to which the getCallback is hooked.
     * @return string
     */
    public function getTag(){
        return $this->tag;
    }

    /**
     *  function you wish to run
     * @param  array  $callback_args
     */
    abstract public function getCallback(array $callback_args);

    /**
     * the specify order in which the functions associated with a particular action are executed
     * @return int
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * The number of arguments the function accepts.
     * @return int
     */
    public function getAcceptedArgs()
    {
        return $this->accepted_args;
    }

}
