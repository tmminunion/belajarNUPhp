<?php

use App\Model\member as memberModel;

class member extends Controller
{
     public function index()
     {

          $data["data"] = memberModel::all();

          View("member/index", $data);
     }
}
