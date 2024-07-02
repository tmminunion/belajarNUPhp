@extends("layout.layout")

<div class="header pb-5 pt-1 pt-lg-8 d-flex align-items-center" style="min-height: 300px; background-size: cover; background-position: center top;">
    <span class="mask bg-gradient-default opacity-7"></span>
    <div class="container-fluid d-flex align-items-center mt--3">
        <div class="row">
            <div class="col-lg-7 col-md-10">
                <h1 class="display-2 text-white">Aktivitas </h1>
                <p class="text-white mt-0 mb-9">This is your profile page. You can see the progress you've made with your work and manage your projects or assigned tasks</p>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid mt--9">
    <div class="row">
        <div class="col-xl-8 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="donasi-tab" data-toggle="tab" href="#donasi" role="tab" aria-controls="donasi" aria-selected="true">DONASI</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="kas-tab" data-toggle="tab" href="#kas" role="tab" aria-controls="kas" aria-selected="false">KAS</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tabungan-tab" data-toggle="tab" href="#tabungan" role="tab" aria-controls="tabungan" aria-selected="false">TABUNGAN</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                
                        <div class="shadow" id="myTabContent">
                            <div class="tab-pane fade show active" id="donasi" role="tabpanel" aria-labelledby="donasi-tab"></div>
                            <div class="tab-pane fade" id="kas" role="tabpanel" aria-labelledby="kas-tab"></div>
                            <div class="tab-pane fade" id="tabungan" role="tabpanel" aria-labelledby="tabungan-tab"></div>
                        </div>
                    </div>
              
            </div>
        </div>
    </div>
    <div class="mb-5"></div>
</div>

@section('scriptsfooter')
<script>
    function loadTabContent(tabId, tabName) {
        if ($(tabId).is(':empty')) {
            $.ajax({
                url: '<?= get_url('account/activity/tab')?>',
                method: 'GET',
                data: { tab: tabName },
                success: function (data) {
                    $(tabId).html(data);
                }
            });
        }
    }

    $(document).ready(function () {
        $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
            var tabId = $(e.target).attr('href');
            var tabName = tabId.substring(1);
            loadTabContent(tabId, tabName);
        });

        // Load home content on page load
        loadTabContent('#kas', 'kas');
         loadTabContent('#donasi', 'donasi');
          loadTabContent('#tabungan', 'tabungan');
    });
</script>
@endsection

@section('scriptheader')
<style>
.tab-pane {
    margin-top: 0 !important;
    padding-top: 0 !important;
}
</style>
@endsection