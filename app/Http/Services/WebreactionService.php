<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;

class WebreactionService
{
  protected $baseUrl;

  public function __construct()
  {
      $this->baseUrl = 'https://extranet.letselschadeclaimen.nl/api';
  }

  public function storeData(array $data)
  {
      // Make a POST request to the external API
      $response = Http::post($this->baseUrl, $data);

      // Handle the response as needed
      if ($response->successful()) {
          return $response->json();
      }

      // Handle errors appropriately
      throw new \Exception("API Request failed: " . $response->body());
  }
}