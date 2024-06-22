@extends("layout.layout")

<div class="header bg-gradient-primary pb-5 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <div class="container-fluid mt-1">
                <div class="row">
                    <div class="col">
                        <div class="card shadow">
                            <div class="card-header border-0">
                                <h3 class="mb-0">Data Transaksi Kas</h3>
                            </div>
                            <div class="table-responsive">
                                <div class="table-responsive">
                                    <table class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Transaksi</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">Noreg</th>
                                                <th scope="col">Status</th>
                                                <th scope="col" style="width: 2%;"></th>
                                                <th scope="col">Jumlah</th>
                                                <th scope="col">Tanggal</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            foreach ($transactions as $nomor => $value) { ?>

                                                <tr>
                                                    <td>
                                                        <?= $nomor + 1 ?>
                                                    </td>
                                                    <td>
                                                        <?= $value["judul"] ?>
                                                    </td>
                                                    <td>
                                                        <?= strnama($value->member->nama); ?>
                                                    </td>
                                                    <td>
                                                        <?= $value->member->noreg; ?>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-dot mr-4">
                                                            <?php if ($value->type == 'debit') { ?>
                                                                <i class="bg-danger"></i>
                                                            <?php } else { ?>
                                                                <i class="bg-success"></i>
                                                            <?php } ?>
                                                            <?= $value->type; ?>
                                                        </span>
                                                    </td>

                                                    <td>Rp.</td>
                                                    <td style="text-align:right;font-weight:bold;font-size:16px;">
                                                        <?= number_format($value->jumlah, 0, ',', '.') . ' ,-'; ?>

                                                    </td>
                                                    <td>
                                                        <?= $value->date; ?>
                                                    </td>


                                                    <td class="text-right">
                                                        <div class="dropdown">
                                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fas fa-ellipsis-v"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                                <a class="dropdown-item" href="#">Action</a>
                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                <a class="dropdown-item" href="#">Something else here</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php $nomor++;
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer py-4">
                                    <div class="d-flex justify-content-between">
                                        <?php if ($currentPage > 1) : ?>
                                            <a href="<?php echo getBaseUrl() . "transaksi/data/" . $currentPage - 1; ?>" class="btn btn-primary">Previous</a>
                                        <?php endif; ?>
                                        <?php if (count($transactions) == $perPage) : ?>
                                            <a href="<?php echo getBaseUrl() . "transaksi/data/" . $currentPage + 1; ?>" class="btn btn-primary">Next</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>