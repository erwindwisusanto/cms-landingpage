<x-main-layout>
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Campaign {{ request()->query('website') }}</p>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-campaign">Add
                        Campign</button>
                    <div class="table-responsive mt-4">
                        <table class="table table-bordered" id="campign" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Campign Name</th>
                                    <th class="text-center">Locale</th>
                                    <th class="text-center">WhatsApp Wording</th>
                                    <th class="text-center">Creted By</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Campaign Logs {{ request()->query('website') }}</p>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="campign-logs" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Campaign Name</th>
                                    <th class="text-center">Visit Landing Page Total</th>
                                    <th class="text-center">WhatsApp Hit</th>
                                    <th class="text-center">Telegram Hit</th>
                                    <th class="text-center">Source</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-add-campaign" tabindex="-1" role="dialog" aria-labelledby="modal-add-campaign"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Campign</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="pt-3" id="add-campign" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleTextarea1">Campign Name</label>
                            <input type="text" class="form-control form-control-lg" name="name" id="name">
                        </div>
                        @php
                            $website = request()->query('website');
                        @endphp

                        @if (
                            $website === 'pharmacy_bali_v2' ||
                                $website === 'pharmacy_jakarta' ||
                                $website === 'apotek_jakarta' ||
                                $website === 'balihomelab' ||
                                $website === 'whitening_clinic_v2' ||
                                $website === 'dengue_v2' ||
                                $website === 'whitening_dot_clinic_v2' ||
                                $website === 'jakartahomelab'
                            )
                            <div class="form-group">
                                <label for="locale">Locale <span style="color: red"> *Locale work only for campaign
                                        "organic"</span></label>
                                <select class="form-control" id="locale" name="locale">
                                    <option value=""></option>
                                    <option value="id">ID (Indonesia)</option>
                                    <option value="en">EN (English)</option>
                                </select>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="exampleTextarea1">WhatsApp Wording</label>
                            <textarea class="form-control" name="wa_word" id="wa_word" rows="4" style="height: 100px"></textarea>
                        </div>
                        <input type="hidden" class="form-control" id="source" name="source"
                            value="{{ request()->query('website') }}">
                        <div class="mt-3">
                            <button type="button"
                                class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                id="btn-add-campign">SAVE</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-update-campaign" tabindex="-1" role="dialog"
        aria-labelledby="modal-update-campaign" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Update Campign</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="pt-3" id="update-campign" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleTextarea1">Campign Name</label>
                            <input type="text" class="form-control form-control-lg" name="update-name"
                                id="update-name">
                        </div>
                        <div class="form-group">
                            <label for="exampleTextarea1">Wording</label>
                            <textarea class="form-control" name="update-wa_word" id="update-wa_word" rows="4" style="height: 100px"></textarea>
                        </div>
                        <input type="hidden" class="form-control" id="campaign-id" name="campaign-id"
                            value="">
                        <div class="mt-3">
                            <button type="button"
                                class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                id="btn-update-campign">SAVE</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-main-layout>

<script>
    $('#btn-add-campign').on('click', function() {
        $.ajax({
            type: "POST",
            url: "{{ route('add-campign') }}",
            data: $('#add-campign').serialize(),
            success: function(response) {
                if (response.status === true) {
                    $("#modal-add-campaign").modal('hide');
                    $('#campign').DataTable().ajax.reload(null, true);
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });

                    Toast.fire({
                        icon: "success",
                        title: "Campaign added successfully"
                    });
                }
            },
            error: function(xhr) {
                console.error(xhr);
                $("#modal-add-campaign").modal('hide');
            },
            complete: function() {}
        });
    });

    const campaigns = () => {
        var website = '{{ request()->query('website') }}';
        var ajaxUrl = '{{ route('campaigns', ['source' => ':source']) }}';
        ajaxUrl = ajaxUrl.replace(':source', website);
        const table = $('#campign').DataTable({
            processing: true,
            serverSide: true,
            ajax: ajaxUrl,
            columns: [{
                    data: 'row_number',
                    name: 'row_number'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'locale',
                    name: 'locale'
                },
                {
                    data: 'wa_word',
                    name: 'whatsapp_wording'
                },
                {
                    data: 'created_by',
                    name: 'created_by'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
            ],
            columnDefs: [{
                targets: 5,
                className: `text-center align-middle`,
                render: function(data, type, full, row) {
                    console.log(full['id']);
                    const button =
                        `<button class="btn btn-inverse-primary" onclick="modalUpdateCampaign('${full['name']}', '${full['wa_word']}', '${full['id']}')">Edit</button>&nbsp;<button class="btn btn-inverse-danger" onclick="deleteLaporan('${full['id']}')">Delete</button>`;
                    return button;
                }
            }, ],
        });
    }

    const deleteLaporan = (campaignId) => {
        $.ajax({
            type: "POST",
            url: "{{ route('delete-campaign') }}",
            data: {
                _token: '{{ csrf_token() }}',
                campaign_id: campaignId
            },
            success: function(response) {
                if (response.status === true) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });

                    Toast.fire({
                        icon: "success",
                        title: "delete campaign successfully"
                    });

                    $('#campign').DataTable().ajax.reload(null, true);
                }
            },
            error: function(xhr) {
                console.error(xhr);
            },
            complete: function() {
                console.log("success delete campaign");
            }
        });
    }

    const modalUpdateCampaign = (name, waWord, campId) => {
        $('#modal-update-campaign').modal('show');
        $(`#update-name`).val(name);
        $(`#update-wa_word`).val(waWord);
        $(`#campaign-id`).val(campId);
    }

    $('#btn-update-campign').on('click', function() {
        $.ajax({
            type: "POST",
            url: "{{ route('update-campaign') }}",
            data: $('#update-campign').serialize(),
            success: function(response) {
                if (response.status === true) {
                    $("#modal-update-campaign").modal('hide');
                    $('#campign').DataTable().ajax.reload(null, true);
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });

                    Toast.fire({
                        icon: "success",
                        title: "Campaign update successfully"
                    });
                }
            },
            error: function(xhr) {
                console.error(xhr);
                $("#modal-update-campaign").modal('hide');
            },
            complete: function() {}
        });
    });

    const campaignsLogs = () => {
        var website = '{{ request()->query('website') }}';
        var ajaxUrl = '{{ route('campaignslogs', ['source' => ':source']) }}';
        ajaxUrl = ajaxUrl.replace(':source', website);
        const table = $('#campign-logs').DataTable({
            processing: true,
            serverSide: true,
            ajax: ajaxUrl,
            columns: [{
                    data: 'row_number',
                    name: 'row_number'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'campaign_name',
                    name: 'campaign_name'
                },
                {
                    data: 'visit_landingpage',
                    name: 'visit_landingpage'
                },
                {
                    data: 'whatsapp_hit',
                    name: 'whatsapp_hit'
                },
                {
                    data: 'telegram_hit',
                    name: 'telegram_hit'
                },
                {
                    data: 'source_url',
                    name: 'source_url'
                }
            ],
        });
    }

    $(document).ready(function() {
        campaigns();
        campaignsLogs();
    });
</script>
