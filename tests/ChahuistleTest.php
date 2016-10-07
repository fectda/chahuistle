<?php

use Cltvo\Chahuistle\FirstClass;

class ChahuistleTest extends PHPUnit_Framework_TestCase {

  public function testFirstClassIsAGoogDay()
  {
    $first_class = new FirstClass;
    $this->assertTrue($first_class->isAGoogDay());
  }

}
