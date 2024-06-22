<div class="col-md-4 py-3">
    <a href="<?= getBaseUrl() ?>donasi/daftar/{{ link_url }}"> <!-- Add the link here -->
        <div class="card p-3 mb-2" style="background:#fcf2ff;">
            <div class="d-flex justify-content-between" style="min-height:400;">
                <div class="d-flex flex-row align-items-center">
                    <div class="icon p-3 m-1"><img src="https://ui-avatars.com/api/?background=random&name=<?= Illuminate\Support\Str::after($slot, 'Donasi') ?>" width="60" class="rounded-circle p-1 m-2"> </div>
                    <div class="ms-2 c-details">
                        <h6 class="mb-0">{{event_name}}</h6> <span>{{id}}</span>
                    </div>
                </div>
                <div class="badge"> <span>Design</span> </div>
            </div>
            <div class="mt-5">
                <h3 class="heading">{{slot}}</h3>
                <div class="mt-5">
                    <div class="mt-3"> <span class="text1">{{class}}</span> </div>
                </div>
            </div>
        </div>
    </a> <!-- Close the link tag -->
</div>