<?php

use App\Model\member;

class profil extends Controller
{
     public function index()
     {
          $this->auth(true);
          $member = mylogin();
          $data['member'] = member::find($member);
          View("profil/index", $data);
     }
     public function member($member)
     {

          $data['member'] = member::find($member);
          View("profil/index", $data);
     }
}
