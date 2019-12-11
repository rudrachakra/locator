<?php

namespace Classes\Tests;

use PHPUnit\Framework\TestCase;
use Classes\Locator;
use Classes\Ip;

class LocatorTest extends TestCase
{
  public function testSuccess(): void 
  {

    $client = $this->createMock(\Classes\HttpClient::class);

    $client->method('get')->willReturn(json_encode([
      'country_name' => 'United States',
      'state_prov' => 'California',
      'city' => 'Mountain View'
    ]));

    $locator = new Locator($client, 'key');
    $location = $locator->locate(new Ip('8.8.8.8'));


    self::assertNotNull($location);
    self::assertEquals('United States', $location->getCountry());
    self::assertEquals('California', $location->getRegion());
    self::assertEquals('Mountain View', $location->getCity());
  }

  public function testNotFound(): void
  {

    $client = $this->createMock(\Classes\HttpClient::class);

    $client->method('get')->willReturn(json_encode([
      'country_name' => '-',
      'state_prov' => '-',
      'city' => '-'
    ]));

    $locator = new Locator($client, 'key');
    $location = $locator->locate(new Ip('8.8.8.8'));
    self::assertNull($location);
  }
}