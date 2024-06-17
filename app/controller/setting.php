<?php
class setting extends Controller
{
     public function index()
     {
          $data = [];
          View("setting/index", $data);
     }
}
