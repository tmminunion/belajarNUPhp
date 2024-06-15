<?php
class dashboard extends Controller
{
     public function index()
     {

          View("dashboard/index", $data = []);
     }
}
