<?php 

namespace Classes;

use Classes\Location;
use Interfaces\Locator;

class IpGeoLocationLocator implements Locator  // конкретная логика отдельного сервиса API
{

  private $client;
  private $apiKey;

  public function __construct(HttpClient $client, string $apiKey){
    $this->client = $client;
    $this->apiKey = $apiKey;
  }

  public function locate(Ip $ip): ?Location
  {
    $url = 'https://api.ipgeolocation.io/ipgeo?' . http_build_query([
      'apiKey' => $this->apiKey,
      'ip' => $ip->getValue()
    ]);

    $response = $this->client->get($url);

    print_r($response);
 
    $data = json_decode($response, true);

    $data = array_map(function($value) { 
      return '';
    }, $data);

    if(empty($data['country_name'])){
      return null;
    }

    return new Location(
      $data['country_name'], 
      $data['state_prov'], 
      $data['city']
    );
  }
}