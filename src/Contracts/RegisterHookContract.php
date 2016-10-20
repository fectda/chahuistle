<?php
namespace Cltvo\Chahuistle\Contracts;

interface RegisterHookContract{

    /**
     * the name of the action to which the getCallback is hooked.
     * @return string
     */
    public function getTag();

    /**
     *  function you wish to run
     * @param  array  $callback_args
     */
    public function getCallback(array $callback_args);

    /**
     * the specify order in which the functions associated with a particular action are executed
     * @return int
     */
    public function getPriority();

    /**
     * The number of arguments the function accepts.
     * @return int
     */
    public function getAcceptedArgs();
}
