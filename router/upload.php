<?php
use App\Model\Imgclamp;
class upload
{
  public function index()
  {
  
    $imgClamp = Imgclamp::all();
   
    var_dump($imgClamp);

  
  }
    public function base()
  {
   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file = $_POST['file'];
    $mime = $_POST['mime'];

    $imgClamp = new ImgClamp;
    $imgClamp->member_id = 1; // Atur sesuai kebutuhan
    $imgClamp->type = 'image'; // Atur sesuai kebutuhan
    $imgClamp->mime = $mime;
    $imgClamp->cer_id =45;
    $imgClamp->base64 = $file;
    $imgClamp->save();

    echo 'Success';
    }
  }
}