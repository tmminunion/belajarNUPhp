<?php $this->extend("layout/layout.php"); ?>

<div class="header  pt-1 pt-lg-8 d-flex align-items-center" style="min-height: 600px; background-color: #f5f5f5; background-size: cover; background-position: center top;">



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

                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                    MEMBER
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="pl-lg-4">

                        </div>
                        <form action="<?= getBaseUrl() . "pembayaran/create"; ?>" method="post">
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
                                            <input type="text" id="input-last-name" class="form-control form-control-alternative" placeholder="Noreg" name="Noreg" readonly>
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
                                            <input id="input-jumlah" class="form-control form-control-alternative" type="text" placeholder="Rp. 0" name="jumlah">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-country">Jenis</label>
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
                                    <textarea rows="4" class="form-control form-control-alternative" placeholder="Keterangan" name="keterangan"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="hidden" id="input-id" name="member_id" value="" class="form-control form-control-alternative">
                                    <input type="hidden" id="input-csrf" name="csrf" value="<?= Csrf::get(); ?>" class="form-control form-control-alternative">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 text-right px-3">
                                    <a href="<?= getBaseUrl() . "pembayaran"; ?>" class="btn btn-secondary btn-lg btn-block mt-4" role="button" aria-pressed="true"><i class="fas fa-ban"></i> Clear</a>
                                </div>
                                <div class="col-6 text-left">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block mt-4" role="button" aria-pressed="true"><i class="fas fa-paper-plane"></i> Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0 mt-3">
                <div class="card card-profile shadow">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                                <a href="#">
                                    <img src="data:image/png;base64,<?= member_login()->gambar ?>" class="rounded-circle" height="150">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        <div class="d-flex justify-content-between">
                            <a href="#" class="btn btn-sm btn-info mr-4">Connect</a>
                            <a href="#" class="btn btn-sm btn-default float-right">Message</a>
                        </div>
                    </div>
                    <div class="card-body pt-0 pt-md-4">
                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                                    <div>
                                        <span class="heading">22</span>
                                        <span class="description">Friends</span>
                                    </div>
                                    <div>
                                        <span class="heading">10</span>
                                        <span class="description">Photos</span>
                                    </div>
                                    <div>
                                        <span class="heading">89</span>
                                        <span class="description">Comments</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <h3>
                                Jessica Jones<span class="font-weight-light">, 27</span>
                            </h3>
                            <div class="h5 font-weight-300">
                                <i class="ni location_pin mr-2"></i>Bucharest, Romania
                            </div>
                            <div class="h5 mt-4">
                                <i class="ni business_briefcase-24 mr-2"></i>Solution Manager - Creative Tim Officer
                            </div>
                            <div>
                                <i class="ni education_hat mr-2"></i>University of Computer Science
                            </div>
                            <hr class="my-4" />
                            <p>Ryan — the name taken by Melbourne-raised, Brooklyn-based Nick Murphy — writes, performs and records all of his own music.</p>
                            <a href="#">Show more</a>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<!-- Modal -->


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
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



<?php $this->block('scriptsfooter') ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var inputRupiah = document.getElementById('input-jumlah');
        inputRupiah.addEventListener('keyup', function(e) {
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            this.value = formatRupiah(this.value, 'Rp. ');
        });

        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                var separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? prefix + rupiah : '');
        }
    });
</script>

<script>
    $(document).ready(function() {
        $('#exampleModal').on('show.bs.modal', function(event) {
            // Event listener untuk tombol "Tambahkan" di dalam modal
            $('#exampleModal .btn-primary').on('click', function() {
                var nama = $(this).data('nama'); // Mendapatkan nilai nama dari atribut data-nama
                var noreg = $(this).data('noreg'); // Mendapatkan nilai noreg dari atribut data-noreg
                var id = $(this).data('id'); // Mendapatkan nilai id dari atribut data-id
                console.log(nama, noreg, id);
                // Update form input dengan nilai yang didapatkan
                $('#input-first-name').val(nama);
                $('#input-last-name').val(noreg);
                $('#input-id').val(id);

                // Tutup modal setelah mengisi form di halaman parent
                $('#exampleModal').modal('hide');
            });
        });
    });
</script>
<?php $this->endblock() ?>