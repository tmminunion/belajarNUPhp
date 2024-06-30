<?php

class check
{
    public function index()
    {
        $data = $_GET['order_id'];
        $status = $_GET['result'];
        $prefix = substr($data, 0, 3);
        if ($status == 'success') {
            switch ($prefix) {
                case 'KAS':
                    to_url('pembayaran/resume/kas/' . $data);
                case 'TAB':
                    to_url('pembayaran/resume/tabungan/' . $data);
                case 'DON':
                    to_url('pembayaran/resume/donasi/' . $data);
                default:
                    to_url('home/' . $data);
            }
        } else {
            to_url('home/' . $data);
        }
    }
}
