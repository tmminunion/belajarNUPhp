<?php

class terbilang
{
    public function index($data)
    {
        $data['hasil'] = $data;
        res(200, $data);
    }
}
