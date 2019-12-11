<?php

use Classes\HttpClient;
use Classes\IpGeoLocationLocator;
use Classes\IpInfoLocator;
use Classes\ChainLocator;
use Classes\MuteLocator;
use Classes\ErrorHandler;

$client = new HttpClient();
$handler = new ErrorHandler(new Logger());

$locator = new ChainLocator(
  new MuteLocator(
    new IpGeoLocationLocator($client, 'sX8d'),
    $handler
  ), 
  new MuteLocator(
    new IpInfoLocator($client, 'hXgF'),
    $handler
  )
);
