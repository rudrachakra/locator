<?php

namespace Interfaces;
use Classes\Ip;
use Classes\Location;

interface Locator
{
  public function locate(Ip $ip): ?Location;
}