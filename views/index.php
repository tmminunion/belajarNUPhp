<?php $this->extend("layout/layout.php"); ?>



<!-- End Navbar -->
<!-- Header -->
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <section class="pt-4">
                <div class="container px-lg-5">
                    <!-- Page Features-->
                    <div class="row gx-lg-5">

                        <nu-test data='{"id": "confirmModal1"}'>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Reiciendis debitis sequi perferendis culpa doloremque esse labore, praesentium fugit omnis magni tenetur voluptate possimus nisi hic dolorum illum, beatae doloribus eum.</nu-test>
                        <nu-home-index data='{"id": "confirmModal2"}'></nu-home-index>

                        <div class="col-lg-6 col-xxl-4 mb-5">
                            <div class="card bg-light border-0 h-100">
                                <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="fas fa-check-circle"></i></div>
                                    <h2 class="fs-4 fw-bold">{{$dataanak.name}}</h2>
                                    <p class="mb-0">{{$dataanak.address}}</p>
                                    <h2 class="fs-4 fw-bold">{{ $dataanak.phone}}</h2>

                                    <p class="mb-0">{{name}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>


<?php $this->block('scriptsheader') ?>
<style>
    .bg-gradient-primary-to-secondary {
        background: linear-gradient(45deg, #2937f0, #9f1ae2) !important;
    }
</style>
<?php $this->endblock() ?>