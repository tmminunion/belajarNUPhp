<?php

use App\Model\Cerit;
use App\Model\Tabung;
use App\Model\transaction;

class kredit
{
    public function donasi($id)
    {
        $data["mod"] = Cerit::with(['member', 'inputBy', 'donasi'])->find($id);
        $data["title"] = "Kredit";
        $data["urlcurrent"] = getCurrentUrl();
        $data["title"] = 'Setoran Donasi Underbody';
        View('invoice/simple', $data);
    }
    public function tabungan($id)
    {
        $data["mod"] = Tabung::with(['member', 'inputBy'])->find($id);
        $data["title"] = "Kredit";
        $data["urlcurrent"] = getCurrentUrl();
        $data["title"] = 'Setoran Tabungan Underbody';
        View('invoice/tabung', $data);
    }
    public function kas($id)
    {
        $data["mod"] = transaction::with(['member', 'inputBy'])->find($id);
        $data["title"] = "Kredit";
        $data["urlcurrent"] = getCurrentUrl();
        $data["title"] = 'Setoran Kas Bulanan Underbody';
        View('invoice/tabung', $data);
    }
}
