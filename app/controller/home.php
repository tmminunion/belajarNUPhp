<?php

use App\Core\Controller;
use App\Helper\NuRequest;
class home extends Controller
{
    private $faker;

    public function index()
    {
        $this->faker = \Faker\Factory::create();

        $events = [];
        for ($i = 0; $i < 12; $i++) {
            $events[] = [
                'event_name' => $this->faker->sentence(3), // Generates a 3-word event name
                'event_date' => $this->faker->date(), // Generates a random date
                'event_location' => $this->faker->address, // Generates a random address
                'organizer' => $this->faker->company, // Generates a random company name
                'contact_person' => $this->faker->name, // Generates a random name
                'contact_email' => $this->faker->email // Generates a random email
            ];
        }

        $data = [
            'name' => $this->faker->name,
            'id' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'company' => $this->faker->company,
            'events' => $events
        ];
$lastRequest = $_COOKIE["last_image_request"] ?? null;
$waktu = date("H:i:s");
$diff = $lastRequest ? abs(strtotime($waktu) - strtotime($lastRequest)) : 0;
$minute = 60;
$fifteenMinutes = 15 * $minute;

if ($diff > $fifteenMinutes) {
    $gambar = getImage();
    setcookie("last_image_request", $waktu, time() + 15 * $minute);
} else {
    $gambar = getPic();
}
$data["gambar"]=$gambar;
        View("index", $data);
    }
    public function authya()
    {
        // Mengambil nilai dari header Authorization
  


// Initialize Laravel components
$laravelSetup = new NuRequest();

// Make an HTTP request
$response = $laravelSetup->Http('https://bungtemin.net/news/wp-json/wp');

// Output the response body
echo $response->body();
       
    }
}
