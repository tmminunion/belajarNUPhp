<?php

use App\Core\Controller;

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

        View("index", $data);
    }
    public function authya()
    {
        // Mengambil nilai dari header Authorization
        $authHeader = isset($_SERVER['HTTP_AUTHORIZATION']) ? $_SERVER['HTTP_AUTHORIZATION'] : null;

        if ($authHeader) {
            $data['dodo'] = 'Authorization Header: ' . $authHeader;
            response(200, $data);
        } else {

            response(404, 'Authorization Header tidak ditemukan.');
        }
    }
}
