<?php

use App\Model\member;

class profil extends Controller
{
     public function index()
     {
          $data = [];
          View("profil/index", $data);
     }
     public function member($member)
     {

          $data['member'] = member::find($member);
          View("profil/index", $data);
     }
}
