<?php

use Classes\HttpClient;
use Classes\IpGeoLocationLocator;
use Classes\IpInfoLocator;
use Classes\ChainLocator;
use Classes\MuteLocator;
use Classes\ErrorHandler;
use Classes\CacheLocator;

$client = new HttpClient();
$handler = new ErrorHandler(new Logger());
$cache = new Cache();


$locator = new ChainLocator(
  new CacheLocator(
    new MuteLocator(
      new IpGeoLocationLocator($client, 'sX8d'),
      $hanler
    ),
    $cache,
    'cache_1',
    3600
  ),
  new CacheLocator(
    new MuteLocator(
      new IpInfoLocator($client, 'hXgF'),
      $hanler
    ),
    $cache,
    'cache_2',
    3600
  )
);

$location = $locator->locate(new Ip($ip));
