<?php

use App\Core\Controller;

class home extends Controller
{
     private $faker;

     public function index()
     {

          $this->faker = \Faker\Factory::create();
          $dataanak = [
               'name' => $this->faker->name,
               'email' => $this->faker->email,
               'phone' => $this->faker->phoneNumber,
               'address' => $this->faker->address,
               'company' => $this->faker->company
          ];
          $data = [
               'name' => $this->faker->name,
               'email' => $this->faker->email,
               'phone' => $this->faker->phoneNumber,
               'address' => $this->faker->address,
               'company' => $this->faker->company,
               'dataanak' => $dataanak
          ];
          View("index", $data);
     }
}
