<?php $this->extend("layout/layout.php");
$dataker = $this->modelna('KreditBulanan'); ?>



<!-- End Navbar -->
<!-- Header -->
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">SALDO</h5>
                                    <span class="h2 font-weight-bold mb-0"><?= 'Rp. ' . number_format($totals->saldo_akhir, 0, ',', '.') ?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                        <i class="fas fa-chart-bar"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-success mr-2"><?= 'Rp. ' . number_format($totalsbulan->saldo_akhir, 0, ',', '.') ?></span>
                                <span class="text-nowrap">Saldo bulan ini</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">KREDIT</h5>
                                    <span class="h2 font-weight-bold mb-0"><?= 'Rp. ' . number_format($totals->total_kredit, 0, ',', '.') ?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                        <i class="fas fa-chart-pie"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-success mr-2"><?= 'Rp. ' . number_format($totalsbulan->total_kredit, 0, ',', '.') ?></span>
                                <span class="text-nowrap">Kredit bulan ini</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">DEBIT</h5>
                                    <span class="h2 font-weight-bold mb-0"><?= 'Rp. ' . number_format($totals->total_debit, 0, ',', '.') ?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                        <i class="fas fa-minus"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-warning mr-2"><?= 'Rp. ' . number_format($totalsbulan->total_debit, 0, ',', '.') ?></span>
                                <span class="text-nowrap">Debit bulan ini</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Rata rata</h5>
                                    <span class="h2 font-weight-bold mb-0"><?= 'Rp. ' . number_format($saldo_per_anggota, 0, ',', '.') ?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                        <i class="fas fa-money-bill-wave"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-success mr-2"><?= 'Rp. ' . number_format($anggotabulan, 0, ',', '.') ?></span>
                                <span class="text-nowrap">Average Bulan ini</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-8 mb-5 mb-xl-0">
            <div class="card bg-gradient-default shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6>
                            <h2 class="text-white mb-0">SALDO BULANAN</h2>
                        </div>
                        <div class="col">

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Chart -->
                    <div class="chart">
                        <!-- Chart wrapper -->
                        <canvas id="chart-sales" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-muted ls-1 mb-1">Performance</h6>
                            <h2 class="mb-0">KAS BULANAN</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Chart -->
                    <div class="chart">
                        <canvas id="chart-orders" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-xl-8 mb-5 mb-xl-0">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Transaksi terakhir</h3>
                        </div>
                        <div class="col text-right">
                            <a href="<?= getBaseUrl(); ?>transaksi" class="btn btn-sm btn-primary">See all</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Transaksi</th>
                                <th scope="col">Nama</th>

                                <th scope="col">Tanggal</th>
                                <th scope="col">Status</th>
                                <th scope="col">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($latest as $nomor => $value) : ?>
                                <tr>
                                    <td>
                                        <?= $nomor + 1 ?>
                                    </td>
                                    <td>
                                        <?= $value["judul"] ?>
                                    </td>
                                    <td>
                                        <?= $value->member->nama; ?>
                                    </td>

                                    <td>
                                        <?= $value->date; ?>
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


                                    <td>
                                        <?= 'Rp. ' . number_format($value->jumlah, 0, ',', '.') . ' ,-'; ?>

                                    </td>



                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">BELUM BAYAR KAS BULANAN</h3>
                        </div>
                        <!-- <div class="col text-right">
                            <a href="#!" class="btn btn-sm btn-primary">See all</a>
                        </div> -->
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($membersWithoutKredit as $nomor => $value) : ?>
                                <tr>
                                    <td>
                                        <?= $nomor + 1 ?>
                                    </td>
                                    <th scope="row">
                                        <?= $value->nama ?>
                                    </th>
                                    <td>
                                        <i class="ni ni-ungroup"></i>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="m-5"></div>


<?php $this->block('scriptsfooter') ?>

<!--   Optional JS   -->
<script src="<?= getBaseUrl(); ?>assets/js/plugins/chart.js/dist/Chart.min.js"></script>
<script src="<?= getBaseUrl(); ?>assets/js/plugins/chart.js/dist/Chart.extension.js"></script>
<!--   Argon JS   -->
<script src="<?= getBaseUrl(); ?>assets/js/argon-dashboard.js"></script>
<script>
    var OrdersChart = (function() {
        //
        // Variables
        //

        var $chart = $("#chart-orders");
        var $ordersSelect = $('[name="ordersSelect"]');

        //
        // Methods
        //

        // Init chart
        function initChart($chart) {
            // Create chart
            var ordersChart = new Chart($chart, {
                type: "bar",
                options: {
                    scales: {
                        yAxes: [{
                            gridLines: {
                                lineWidth: 1,
                                color: "#dfe2e6",
                                zeroLineColor: "#dfe2e6",
                            },
                            ticks: {
                                callback: function(value) {
                                    if (!(value % 10)) {
                                        var formattedValue = (value / 1000).toLocaleString('id-ID') + "K";
                                        return formattedValue;
                                    }
                                },
                            },
                        }, ],
                    },
                    tooltips: {
                        callbacks: {
                            label: function(item, data) {
                                var label = data.datasets[item.datasetIndex].label || "";
                                var yLabel = item.yLabel;
                                var formattedValue = "Rp. " + (yLabel).toLocaleString('id-ID');

                                var content = "";

                                if (data.datasets.length > 1) {
                                    content +=
                                        '<span class="popover-body-label mr-auto">' +
                                        label +
                                        "</span>";
                                }

                                content +=
                                    '<span class="popover-body-value">' + formattedValue + ",-</span>";

                                return content;
                            },
                        },
                    },
                },
                data: {
                    labels: <?= json_encode($dataker->getLabels()); ?>,
                    datasets: [{
                        label: "Kredit",
                        data: <?= json_encode($dataker->getkredit()); ?>,
                        backgroundColor: 'rgba(75, 192, 192, 0.5)'
                    }, {
                        label: "Debit",
                        data: <?= json_encode($this->modelna('DebitBulanan')->getdebit()); ?>,
                        backgroundColor: 'rgba(255, 99, 132, 0.5)'
                    }],
                },
            });

            // Save to jQuery object
            $chart.data("chart", ordersChart);
        }

        // Init chart
        if ($chart.length) {
            initChart($chart);
        }
    })();



    var SalesChart = (function() {
        // Variables

        var $chart = $("#chart-sales");

        // Methods

        function init($chart) {
            var salesChart = new Chart($chart, {
                type: "line",
                options: {
                    scales: {
                        yAxes: [{
                            gridLines: {
                                lineWidth: 1,
                                color: Charts.colors.gray[900],
                                zeroLineColor: Charts.colors.gray[900],
                            },
                            ticks: {
                                callback: function(value) {
                                    if (!(value % 10)) {
                                        var formattedValue = "IDR" + (value / 1000).toLocaleString('id-ID') + "K";
                                        return formattedValue;

                                    }
                                },
                            },
                        }, ],
                    },
                    tooltips: {
                        callbacks: {
                            label: function(item, data) {
                                var label = data.datasets[item.datasetIndex].label || "";
                                var yLabel = item.yLabel;
                                var formattedValue = "Rp. " + (yLabel).toLocaleString('id-ID');
                                var content = "";

                                if (data.datasets.length > 1) {
                                    content +=
                                        '<span class="popover-body-label mr-auto">' +
                                        label +
                                        "</span>";
                                }

                                content +=
                                    '<span class="popover-body-value">' + formattedValue + ",-</span>";
                                return content;
                            },
                        },
                    },
                },
                data: {
                    labels: <?= json_encode($this->modelna('SaldoBulanan')->labelsaldo) ?>,
                    datasets: [{
                        label: "Performance",
                        data: <?= json_encode($this->modelna('SaldoBulanan')->saldoPerBulan); ?>,
                    }, ],
                },
            });

            // Save to jQuery object

            $chart.data("chart", salesChart);
        }

        // Events

        if ($chart.length) {
            init($chart);
        }
    })();
</script>


<?php $this->endblock() ?>