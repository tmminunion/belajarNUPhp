<?php
use App\Core\Controller;
use App\Model\transaction;
class tabungan extends Controller
{
   public function index()
     {
          $page = 1;
          $perPage = 30;
          $offset = ($page - 1) * $perPage;
          $transactions = Transaction::orderBy('date', 'desc')
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
