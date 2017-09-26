<?php
namespace Cltvo\Chahuistle\Contracts;

interface RegisterScriptContract{

    public function getFilename();

    public function getDependencies();

    public function getVersion();

    public function inFooter();

    public function getHandle();

    public function getLocalizeScripts();
}
