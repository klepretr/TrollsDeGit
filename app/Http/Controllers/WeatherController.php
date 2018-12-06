<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class WeatherController extends Controller
{
    public function get($lattitude, $longitude)
    {
      $url = config('provider.weather.baseurl');
      $key = config('provider.weather.key');


      $client = new Client();
      $result = $client->get($url . '/' . $key . '/' . $lattitude . ',' . $longitude);


      return response($result->getBody())->header('Content-Type', 'application/json');
    }
}
