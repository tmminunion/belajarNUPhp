<?php

use App\core\Csrf; ?>

@extends("layout.layout")



<div class="header  pt-1 pt-lg-8 d-flex align-items-center" style="min-height: 600px;  background: linear-gradient(150deg, #39ef74, #4600f1 100%); background-size: cover; background-position: center top;">



    <!-- Page content -->
    <div class="container-fluid mb-3 mt-3">
        <div class="row">



            <div class="col-xl-8 order-xl-1 mt-3">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">PEMBAYARAN</h3>
                            </div>
                            <div class="col-4 text-right">

                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#MemberMODAL">
                                    MEMBER
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="pl-lg-4">

                        </div>
                        <form action="<?= getBaseUrl() . "pembayaran/create"; ?>" method="post" id="formbayar">
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-first-name">Nama</label>
                                            <input type="text" id="input-first-name" class="form-control form-control-alternative" placeholder="Nama" name="Nama" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-last-name">Noreg</label>
                                            <input type="text" id="input-last-name" class="form-control form-control-alternative" placeholder="Noreg" name="Noreg" readonly required>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <hr class="my-4" />
                            <!-- Address -->
                            <h6 class="heading-small text-muted mb-4">PEMBAYARAN</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-jumlah">Jumlah Rupiah</label>
                                            <input id="input-jumlah" class="form-control form-control-alternative" type="text" placeholder="Rp. 0" name="jumlah" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-country">Type Transaksi</label>
                                            <select class="form-control form-control-alternative" name="jenis">
                                                <?php foreach ($paymentType as $jenis) : ?>
                                                    <option value="<?= $jenis['id'] ?>"><?= $jenis['name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea rows="4" class="form-control form-control-alternative" placeholder="Keterangan" name="keterangan" required></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="hidden" id="input-id" name="member_id" value="" class="form-control form-control-alternative">
                                    <input type="hidden" id="input-csrf" name="csrf" value="<?= Csrf::get(); ?>" class="form-control form-control-alternative">
                                </div>
                            </div>
                            <div class="row" id="submitbayar" style="display: none;">
                                <div class="col-6 text-right px-3">
                                    <a href="<?= getBaseUrl() . "pembayaran"; ?>" class="btn btn-secondary btn-lg btn-block mt-4" role="button" aria-pressed="true"><i class="fas fa-ban"></i> Clear</a>
                                </div>
                                <div class="col-6 text-left">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block mt-4" role="button" aria-pressed="true"><i class="fas fa-paper-plane"></i> Submit Pembayaran</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0 mt-3">
                <nu-pro data='{"id":10}'></nu-pro>
                <div class="card mt-2">
                    <div class="card-header">
                        <h5 class="mb-0">Add Type Transaksi</h5>
                    </div>
                    <div class="card-body mb-2 pb-2" style="">
                        <form action="<?= getBaseUrl() ?>pembayaran/addtype" method="post" id="form-type">
                            <div class="form-group">
                                <label for="input-type">Type Transaksi</label>
                                <input type="text" class="form-control" id="input-type" name="type" placeholder="Type Transaksi" required>
                            </div>
                            <div class="form-group">
                                <label for="input-desc">Keterangan Type</label>
                                <textarea class="form-control" id="input-desc" name="desc" placeholder="Keterangan Type" required></textarea>
                            </div>
                            <input type="hidden" id="input-csrf-form" name="csrf" value="<?= Csrf::get(); ?>">
                            <button type="submit" class="btn btn-primary">Submit Type</button>
                        </form>
                    </div>
                </div>

            </div>



        </div>
    </div>
</div>

<!-- Modal -->


<div class="modal fade" id="MemberMODAL" tabindex="-1" role="dialog" aria-labelledby="MemberMODALLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="MemberMODALLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="table-responsive">
                    <table class="table table-sm table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($member as $data) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $data['nama'] ?></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-primary" data-nama="<?= $data['nama'] ?>" data-noreg="<?= $data['noreg'] ?>" data-id="<?= $data['id'] ?>">Tambahkan</a>

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


<?= Components('confirmModal', ['id' => 'confirmModal']); ?>
<?= Components('confirmModal', ['id' => 'confirmModal2']); ?>


@section('scriptsfooter')

<script>
    $(document).ready(function() {
        $('#formbayar').on('submit', function(event) {
            event.preventDefault();
            $('#confirmModal2').modal('show');
        });
        $('#confirmModal2btn').on('click', function() {
            $('#formbayar').unbind('submit').submit();
            $('#confirmModal2').modal('hide');
        });

        $('#form-type').on('submit', function(event) {
            event.preventDefault();
            $('#confirmModal').modal('show');
        });
        $('#confirmModalbtn').on('click', function() {
            $('#form-type').unbind('submit').submit();
            $('#confirmModal').modal('hide');
        });


        $('#confirmModal').on('hidden.bs.modal', function() {
            $('#form-type')[0].reset();
        });
        $('#MemberMODAL').on('show.bs.modal', function(event) {
            $('#MemberMODAL .btn-primary').on('click', function() {
                var nama = $(this).data('nama');
                var noreg = $(this).data('noreg');
                var id = $(this).data('id');
                $('#input-first-name').val(nama);
                $('#input-last-name').val(noreg);
                $('#input-id').val(id);
                $("#submitbayar").show("slow");
                $('#MemberMODAL').modal('hide');
            });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var inputRupiah = document.getElementById('input-jumlah');
        inputRupiah.addEventListener('keyup', function(e) {
            this.value = formatRupiah(this.value, 'Rp. ');
        });

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                var separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? prefix + rupiah : '');
        }
    });
</script>

@endsection