<?php
namespace Cltvo\Chahuistle;
use Cltvo\Chahuistle\Managers\HooksManager;
use Cltvo\Chahuistle\Contracts\SpecialPageContract;

use Cltvo\Chahuistle\Traits\SpecialPages\SetTrait as SetSpecialPagesTrait;
use Cltvo\Chahuistle\Traits\SpecialPages\HelpersTrait as SpecialPagesHelpersTrait;

class SpecialPagesHook extends HooksManager
{
    use SetSpecialPagesTrait;
    use SpecialPagesHelpersTrait;

    /**
     * name foy option in database
     * @var string
     */
    const OPTION_KEY = 'special_pages_ids';


    protected $tag = "init";


    function __construct() {
        static::$special_pages_ids = $this->loadOptionFromDatabase();
    }

    public function getCallback(array $callback_args){
        $this->specialPagesFromRegister = $this->filterNotEmtyPages(); // carga las clases de special pages del tema

        if (!(defined('CLTVO_ISLOCAL') && ( CLTVO_ISLOCAL == true ) )) {
            $this->specialPagesFromRegister = $this->filterTestPages();
        }

        $this->genereteSpecialPages();
        $this->updateOptionFromDatabase();
        //return static::getSpecialPagesIds();
    }


}
