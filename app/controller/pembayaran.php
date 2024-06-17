<?php
class pembayaran extends Controller
{
     public function index()
     {
          $data["tret"] = "";
          View("pembayaran/index", $data);
     }
}
