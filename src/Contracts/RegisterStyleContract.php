<?php
namespace Cltvo\Chahuistle\Contracts;

interface RegisterStyleContract{

    public function getHandle();

    public function getFilename();

    public function getDependencies();

    public function getVersion();

    public function getMedia();

}
