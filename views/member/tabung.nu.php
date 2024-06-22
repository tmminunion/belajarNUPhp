@extends("layout.layout")
<div class="header bg-gradient-primary pb-5 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <div class="container-fluid mt-1">
                <!-- Table -->
                <div class="row">
                    <div class="col">
                        <div class="card bg-default shadow">
                            <div class="card-header bg-transparent border-0">
                                <h2 class="text-white mb-0">Data Tabungan Member UB Assy</h2>
                            </div>
                            <div class="table-responsive">
                                <table class="table align-items-center table-dark table-flush">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col" style="width: 5%">No</th>
                                            <th scope="col" style="width: 25%">Nama</th>
                                            <th scope="col" style="width: 5%">Noreg</th>
                                            <th scope="col" style="width: 2%"></th>
                                            <th scope="col" style="width: 15%">Saldo</th>
                                            <th scope="col" style="width: 5%">Action</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php foreach ($data as $no => $value) { ?>
                                            <tr>
                                                <td>
                                                    <?= $no + 1 ?>
                                                </td>
                                                <td scope="row">
                                                    <div class="media align-items-center">
                                                        <a href="#" class="avatar rounded-circle mr-3">
                                                            <img alt="Image placeholder" src="data:image/png;base64,<?= $value["gambar"] ?>" height="45">
                                                        </a>
                                                        <div class="media-body">
                                                            <span class="mb-0 text-sm"><a href="<?= getBaseUrl() ?>profil/member/<?= $value["id"] ?>"><?= $value["nama"] ?></a></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <?= $value["noreg"] ?>
                                                </td>
                                                <td>
                                                    Rp.
                                                </td>
                                                <td style="text-align:right;font-weight:bold;font-size:18px;">
                                                    <?= number_format($value["saldo"], 0, ',', '.') ?>,-
                                                </td>
                                                <td><a class="btn btn-sm btn-primary" href="<?= getBaseUrl() ?>transaksi/member/<?= $value["id"] ?>/1">Lihat Transaksi</a></td>

                                                <td class="text-right">
                                                    <div class="dropdown">
                                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                            <a class="dropdown-item" href="<?= getBaseUrl() ?>transaksi/member/<?= $value["id"] ?>/1">Transaksi</a>
                                                            <a class="dropdown-item" href="<?= getBaseUrl() ?>profil/member/<?= $value["id"] ?>/1">Frofil</a>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th scope="col" style="width: 5%"></th>
                                            <th scope="col" colspan="2" style="text-align:right;font-size:18px;font-weight:bold;">Saldo Total</th>
                                            <th scope="col" style="width: 2%">Rp.</th>
                                            <th style="text-align:right;font-weight:bold;font-size:18px;">
                                                <?= number_format($totalSaldo, 0, ',', '.') ?>,-
                                            </th>
                                            <th></th>
                                            <th scope="col"></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="card-footer py-4 bg-default">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>