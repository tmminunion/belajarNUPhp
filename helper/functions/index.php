<?php

use App\Helper\Unsplash;

function tanggal_sekarang()
{
    return date('d-m-Y');
}

function getImage()
{
    $image_url = Unsplash::getRandomPhoto();
    return $image_url;
}

function getpic()
{

    $image_url = Unsplash::getRandomLink();
    return $image_url;
}
