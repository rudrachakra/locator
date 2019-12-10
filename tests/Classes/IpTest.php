<?php

namespace Classes\Tests;

use PHPUnit\Framework\TestCase;
use Classes\Ip;

class IpTest extends TestCase
{
  public function testIp4(): void
  {
    $ip = new Ip($value = '8.8.8.8');
    self::assertEquals($value, $ip->getValue());
  }

  public function testIp6(): void
  {
    $ip = new Ip($value = '8:8:8:8:8:8');
    self::assertEquals($value, $ip->getValue());
  }

  public function testInvalid(): void
  {
    $this->expectException(\InvalidArgumentException::class);
    new Ip('incorrect');
  }

  public function testEmpty(): void
  {
    $this->expectException(\InvalidArgumentException::class);
    new Ip('');
  }
}