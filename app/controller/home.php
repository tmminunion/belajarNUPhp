<?php

use App\Core\Controller;
use App\Model\Don;
use App\Helper\Unsplash;


class home extends Controller
{
    private $faker;

    public function index()
    {
        $this->faker = \Faker\Factory::create('id_ID');
        $events = Don::all();
        $text = $this->faker->realText($maxNbChars = 200, $indexSize = 2);
        $data = [
            'events' => $events,
            'text' => $text,
            'gambar' => Unsplash::getimg()
        ];

        View("index", $data);
    }
}
