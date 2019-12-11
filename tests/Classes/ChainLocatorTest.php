<?php 

namespace Classes\Tests;

use PHPUnit\Framework\TestCase;
use Classes\Location;
use Classes\Locator;
use Classes\Ip;
use Classes\ChainLocator;

class ChainLocatorTest extends TestCase
{
  public function testSuccess(): void 
  {
    $locators = [
      $this->mockLocator(null),
      $this->mockLocator($expected = new Location('Excpected', 'Excpected', 'Excpected')),
      $this->mockLocator(null),
      $this->mockLocator(new Location('Other', 'Other', 'Other')),
      $this->mockLocator(null)
    ];

    $locator = new ChainLocator(...$locators);
    $actual = $locator->locate(new Ip('8.8.8.8'));

    self::assertNotNull($actual);
    self::assertEquals($expected, $actual);
  }

  private function mockLocator(?Location $location): Locator 
  {
    $mock = $this->createMock(Locator::class);
    $mock->method('locate')->willReturn($location);
    return $mock;
  }
}