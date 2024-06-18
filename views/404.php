<?php $this->extend('layout/layout.php'); ?>


<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">

            <!-- ******Header****** -->
            <header class="header text-center">
                <div class="container">
                    <div class="branding">
                        <h1 class="logo">
                            <span aria-hidden="true" class="fas fa-exclamation-circle" style="font-size: xxx-large;"></span>
                            <p>
                                <span class="text-highlight">Error </span>
                            </p>
                            <p>
                            <h1 class="text-bold">404</h1>
                            </p>
                        </h1>
                    </div>
                    <!--//branding-->
                    <div class="tagline">
                        <h1 class="logo text-warning">MAAF ...!! <br>HALAMAN TIDAK DITEMUKAN</h1>
                        <h2><?= tanggal_sekarang() ?></h2>
                    </div>



                </div>
                <!--//container-->
            </header>
            <!--//header-->

        </div>
    </div>
</div>