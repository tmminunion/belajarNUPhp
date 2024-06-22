@extends("layout.layout")



<div class="header  pt-1 pt-lg-8 d-flex align-items-center" style="min-height: 600px;  background: linear-gradient(150deg, #39ef74, #4600f1 100%); background-size: cover; background-position: center top;">



    <!-- Page content -->
    <div class="container-fluid mb-3 mt-3">
        <div class="row">

            <nu-bayar-form data='{"id":10}'>{{jenis}}</nu-bayar-form>


            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0 mt-3">
                <nu-pro data='{"id":10}'>slot</nu-pro>

                <!-- <nu-bayar-addtype data='{"id":10}'></nu-bayar-addtype> -->

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