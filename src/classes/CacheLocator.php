<?php

namespace Classes;

Use Interfaces\Locator;

class CacheLocator implements Locator
{
  private $next, $cache, $ttl;

  public function __construct(Locator $next, Cache $cache, int $ttl)
  {
    $this->next = $next;
    $this->cache = $cache;
    $this->ttl = $ttl;
  }

  public function Locate(Ip $ip): ?Location
  {
    $key = 'location-' . $ip->getValue();
    $location = $this->cache->get($key);

    if($location === null){
      $location = $this->next->locate($ip);
      $this->cache->set($key, $location, $this->ttl);
    }

    return $location;
  }
}