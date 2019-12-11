<?php

namespace Classes;

use Interfaces\Locator;
use Classes\Ip;
use Classes\ErrorHandler;

class MuteLocator implements Locator
{
  private $next;
  private $handler;

  function __construct(Locator $next, ErrorHandler $handler)
  {
    $this->next = $next;
    $this->handler = $handler;
  }

  public function locate(Ip $ip): ?Location
  {
    try{
      return $this->next->locate($ip);
    }catch(\RuntimeException $exception){
      $this->handler->handle($exception);
      return null;
    }
  }
}