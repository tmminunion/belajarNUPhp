<?php

use App\Core\Controller;
use App\Model\Cerit;

class daftar extends Controller
{
     public function index()
     {
          $page = 1;
          $perPage = 30;
          $offset = ($page - 1) * $perPage;
          $transactions = Cerit::orderBy('date', 'desc')
               ->skip($offset)
               ->take($perPage)
               ->get();

          return View('transaksi/index', [
               'transactions' => $transactions,
               'currentPage' => $page,
               'perPage' => $perPage,
          ]);
     }
}
