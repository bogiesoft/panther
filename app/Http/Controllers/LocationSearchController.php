<?php

namespace App\Http\Controllers;
use Request;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class LocationSearchController extends ApiController
{
    public function AutoComplete(Request $request)
    {
        $input = Request::input('input');

        if(is_null($input))
        {
            return $this->respondFailedValidation();
        }

        $data = array(
            'key'=>getenv('GOOGLE_PLACES_API_KEY'),
            'input'=> $input);

        $url = 'https://maps.googleapis.com/maps/api/place/autocomplete/json?' . http_build_query($data);
        
        return $this->Get($url);
    }

    public function Search(Request $request)
    {
        $input = Request::input('input');

        if(is_null($input))
        {
            return $this->respondFailedValidation();
        }

        $data = array(
            'key'=>getenv('GOOGLE_PLACES_API_KEY'),
            'query'=> $input);

        $url = 'https://maps.googleapis.com/maps/api/place/textsearch/json?' . http_build_query($data);

        return $this->Get($url);
    }

    private function Get($url)
    {
        $client = new Client();
     
        $response = $client->get($url);

        return $this->respond(json_decode($response->getBody()->getContents()));   
    }
}
