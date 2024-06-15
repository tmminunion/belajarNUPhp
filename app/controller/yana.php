<?php
class yana extends Controller
{
     public function index()
     {
          $data["yana"] = "yana";
          View("yana/index", $data);
     }
}
