<?php

namespace App\Helper;

use GuzzleHttp\Client;
use App\Model\Image;

class Unsplash
{

    private static $endpoint = "https://api.unsplash.com/photos/random?orientation=landscape&client_id=D1xpT-cDTFRsqeOtLavioxwXNCP8rwxQKjh3KCywc0M";
    private static $client;

    public static function init()
    {
        self::$client = new Client();
    }

    public static function getRandomPhoto()
    {
        self::init(); // Initialize the Guzzle client

        try {
            $response = self::$client->request('GET', self::$endpoint);

            $body = $response->getBody();
            $image_data = json_decode($body, true);

            if (isset($image_data['urls']['full'])) {
                Image::create(['link' => $image_data['urls']['full']]);
                return $image_data['urls']['full'];
            } else {
                // Call the static method getRandomLink
                return self::getRandomLink();
            }
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Handle Guzzle error in more detail or as needed
            return "Error: " . $e->getMessage();
        }
    }

    public static function getRandomLink()
    {
        $images = Image::all();
        $random_index = array_rand($images->toArray());
        return $images[$random_index]->link;
    }
}
