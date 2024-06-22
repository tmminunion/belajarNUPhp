@extends("layout.layout")



<div class="header pt-1 pt-lg-8 d-flex align-items-center" style="min-height: 300px; background-image: url(<?= $gambar; ?>); background-size: cover; background-position: center top;">
    <!-- Mask -->
    <span class="mask bg-gradient-default opacity-7"></span>
    <!-- Header container -->
    <div class="container-fluid d-flex align-items-center mt--3">
        <div class="row">
            <div class="col-lg-7 col-md-10">
                <h1 class="display-2 text-white">List App Donasi</h1>
                <p class="text-white mt-0 mb-9">{{text}}</p>




            </div>
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--9">
    <div class="container mt-5">
        <div class="row">

            <div class="col-md-4 py-3">
                <div class="card p-3 mb-2 text-center" data-toggle="modal" data-target="#addEventModal">
                    <div class="d-flex justify-content-center align-items-center mt-3" style="min-height: 200px;">
                        <div class="icon m-1"> <i class="fas fa-plus" style="font-size: 50px;"></i> </div>
                    </div>
                    <div class="mt--5">
                        <h5 style="font-size:20px;">Add New</h5>
                    </div>
                </div>
            </div>

            <?php foreach ($events as $event) :
            ?>

                <nu-card-cardcip data='{"id":"<?= $event['created_at'] ?>", "event_name":"<?= $event['eventid'] ?>"}' class='<?= $event['deskripsi'] ?>' icon="{{$icon}}" link_url="<?= $event['slug'] ?>">
                    <?= $event['nama_acara'] ?>
                </nu-card-cardcip>
            <?php endforeach; ?>




        </div>
    </div>



</div>


<nu-modal-addevent></nu-modal-addevent>
<?= Components('confirmModal', ['id' => 'confirmModal']); ?>

@section('scriptsheader')
<style>
    .bg-gradient-primary-to-secondary {
        background: linear-gradient(45deg, #2937f0, #9f1ae2) !important;
    }

    .card {
        border: none;
        border-radius: 10px;
        min-height: 300px;
    }

    .c-details span {
        font-weight: 300;
        font-size: 13px
    }

    .heading {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        /* Menampilkan maksimal 3 baris */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .icon {
        width: 50px;
        height: 50px;
        background-color: #eee;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 39px
    }

    .badge span {
        background-color: #fffbec;
        width: 60px;
        height: 25px;
        padding-bottom: 3px;
        border-radius: 5px;
        display: flex;
        color: #fed85d;
        justify-content: center;
        align-items: center
    }

    .progress {
        height: 10px;
        border-radius: 10px
    }

    .progress div {
        background-color: red
    }

    .text1 {
        font-size: 14px;
        font-weight: 600
    }

    .text2 {
        color: #a5aec0
    }
</style>
@endsection



@section('scriptsfooter')

<script>
    $(document).ready(function() {

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

    });
</script>

@endsection