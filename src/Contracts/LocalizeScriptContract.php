<?php
namespace Cltvo\Chahuistle\Contracts;

interface LocalizeScriptContract{


    /**
     * The name of the variable which will contain the dataThe name of the variable which will contain the data
     */
    public function getName();

    /**
     * The data itself
     */
    public function getData();

}
