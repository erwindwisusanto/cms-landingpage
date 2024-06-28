<x-main-layout>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <ul class="nav nav-tabs px-4" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab"
                        aria-controls="overview" aria-selected="true">Campign List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="sales-tab" data-toggle="tab" href="#sales" role="tab"
                        aria-controls="sales" aria-selected="false">Campign Tracking Logs</a>
                </li>
            </ul>
            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                <div class="card-body">
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#modal-add-campaign">Add Campign</button>

                    <div class="table-responsive pt-3">
                        <table class="table table-bordered" id="campign">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Campign Name</th>
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

    <div class="modal fade" id="modal-add-campaign" tabindex="-1" role="dialog"
        aria-labelledby="modal-add-campaign" aria-hidden="true">
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
                        <div class="form-group">
                            <label for="exampleTextarea1">WhatsApp Wording</label>
                            <textarea class="form-control" name="wa_word" id="wa_word" rows="4" style="height: 100px"></textarea>
                        </div>
                        <input type="hidden" class="form-control" id="source" name="source"  value="{{ request()->query('website') }}">
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
                    $('#pengaduansTable').DataTable().ajax.reload(null, true);
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

    $(document).ready(function() {
        var website = '{{ request()->query('website') }}';
        var ajaxUrl = '{{ route('campaigns', ['source' => ':source']) }}';
        ajaxUrl = ajaxUrl.replace(':source', website);
        const table = $('#campign').DataTable({
            processing: true,
            serverSide: true,
            ajax: ajaxUrl,
            columns: [
                { data: 'row_number', name: 'row_number' },
                { data: 'name', name: 'name' },
                { data: 'wa_word', name: 'whatsapp_wording' },
                { data: 'created_by', name: 'created_by' },
                { data: 'created_at', name: 'created_at' },
                { data: 'created_at', name: 'created_at' },
            ],
        });
    });
</script>
