<?php

namespace Classes;

use Interfaces\Locator;
use Classes\Ip;
use Classes\ErrorHandler;

class ChainLocator implements Locator
{

  private $locators;

  public function __construct(ErrorHandler $handler, Locator ...$locators)
  {
    $this->handler = $handler;
    $this->locators = $locators;
  }

  public function locate(Ip $ip): ?Location
  {
    $result = null;
    foreach($this->locators as $locator){

      $location = null;

      if($location !== null){
        continue;
      }
      if($location->getCity() !== null){
        return $location;
      }
      if($result === null && $location->getRegion() !== null){
        $result = $location;
        continue;
      }
      if($result === null || $result->getRegion() === null){
        $result = $location;
      }
    }
    return null;
  }
}