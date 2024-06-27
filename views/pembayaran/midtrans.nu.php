@extends("layout.layout")

<?php $slot = 'kas';?>

<div class="header  pt-1 pt-lg-8 d-flex align-items-center" style="min-height: 600px;  background: linear-gradient(150deg, #39ef74, #4600f1 100%); background-size: cover; background-position: center top;">



    <!-- Page content -->
    <div class="container-fluid mb-3 mt-3">
        <div class="row">

           
<div class="col-xl-8 order-xl-1 mt-3">
    <div class="card bg-secondary shadow">
        <div class="card-header bg-white border-0">
            <div class="row align-items-center">
                <div class="col-8">
                    <h3 class="mb-0" style="text-transform: uppercase;">UBkas - Payment</h3>
                </div>
                <div class="col-4 text-right">

                  
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="pl-lg-4">

            </div>
            <form action="<?= getBaseUrl() . "midtrans/pembayaran/post_" . $slot . ($donid != null ? '/' . $donid : ''); ?>" method="post" id="formbayar">

                <div class="pl-lg-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="input-first-name">Nama</label>
                                <input type="text" id="input-first-name" class="form-control form-control-alternative" name="Nama" value="<?= member_login()->nama ?>" readonly required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="input-last-name">Noreg</label>
                                <input type="text" id="input-last-name" class="form-control form-control-alternative" name="Noreg" value="<?= member_login()->noreg ?>" readonly required>
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
                                <input id="input-jumlah" class="form-control form-control-alternative" type="text" value="Rp. 50.000" name="jumlah" required>
                            </div>
                        </div>
                        <?php if ($slot == 'kas') : ?>
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
                        <?php elseif ($slot == 'donasi') : ?>
                            <input type="hidden" name="jenis" readonly value="2">
                        <?php else : ?>
                            <input type="hidden" name="jenis" readonly value="<?= Carbon\Carbon::now()->format('Y') ?>">
                        <?php endif; ?>
                    </div>

                </div>
                <div class="pl-lg-4">
                    <div class="form-group">
                        <label>Keterangan</label>
                        <div class="grow-wrap">
                            <textarea rows="4" class="form-control form-control-alternative" placeholder="Keterangan" name="keterangan" onInput="this.parentNode.dataset.replicatedValue = this.value" required>pembayaran <?= date('F') . ' ' . date('Y') ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <input type="hidden" id="input-id" name="member_id" value="" class="form-control form-control-alternative">
                        <input type="hidden" id="input-csrf" name="csrf" value="<?= App\core\Csrf::get(); ?>">
                     
                        <input type="hidden" id="input-kride" name="type" value="<?= $type; ?>">
                    </div>
                </div>
                <div class="pl-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-payment-method">Metode Pembayaran</label>
                                    <select class="form-control form-control-alternative" id="input-payment-method" name="payment_method">
                                        <option value="gopay">GoPay</option>
                                        <option value="bank_transfer">Transfer Bank</option>
                                        <option value="debit_card">Kartu Debit</option>
                                    </select>
                                </div>
                            </div>
                <div class="row" id="submitbayar" style="display: block;">
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
                <nu-pro data='{"id":10}'>slot</nu-pro>

                <!-- <nu-bayar-addtype data='{"id":10}'></nu-bayar-addtype> -->

            </div>



        </div>
    </div>
</div>

<!-- Modal -->

<!-- Modal -->
    <div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="loadingModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="spinner-border text-primary" role="status">
  <span class="sr-only">Loading...</span>
</div>
                    </div>
                </div>
            </div>
        </div>
    </div>





<?= Components('confirmModal', ['id' => 'confirmModal2']); ?>


@section('scriptsfooter')

<script>
    $(document).ready(function() {
        $('#formbayar').on('submit', function(event) {
            event.preventDefault();
            $('#confirmModal2').modal('show');
        });
        $('#confirmModal2btn').on('click', function() {
          submit();
            $('#confirmModal2').modal('hide');
        });
    });

function submit() {
$("#submitbayar").hide();
 Swal.fire({
                title: 'Loading...',
                html: 'Please wait a moment.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                }
            });
        var form = document.getElementById('formbayar');
        var formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.snapToken) {
               Swal.close();
                snap.pay(data.snapToken, {
                    language: 'id',
                    onSuccess: function (result) {
                      //  document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                       
                    },
                    onPending: function (result) {
                      
                      //  document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    },
                    onError: function (result) {
                    
                      //  document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    }
                });
            } else {
                console.error('Failed to get Snap token:', data);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    };
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


@section('scriptsheader')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.all.min.js"></script>
<style>

    .grow-wrap {
        /* easy way to plop the elements on top of each other and have them both sized based on the tallest one's height */
        display: grid;
    }

    .grow-wrap::after {
        /* Note the weird space! Needed to preventy jumpy behavior */
        content: attr(data-replicated-value) " ";

        /* This is how textarea text behaves */
        white-space: pre-wrap;

        /* Hidden from view, clicks, and screen readers */
        visibility: hidden;
    }

    .grow-wrap>textarea {
        /* You could leave this, but after a user resizes, then it ruins the auto sizing */
        resize: none;

        /* Firefox shows scrollbar on growth, you can hide like this. */
        overflow: hidden;
    }

    .grow-wrap>textarea,
    .grow-wrap::after {
        /* Identical styling required!! */

        padding: 0.5rem;
        font: inherit;

        /* Place on top of each other */
        grid-area: 1 / 1 / 2 / 2;
    }
</style>
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ $clientKey }}"></script>
@endsection