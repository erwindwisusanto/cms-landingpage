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
                    <h4 class="card-title">Bordered table</h4>
                    <p class="card-description">
                        Add class <code>.table-bordered</code>
                    </p>
                    <div class="table-responsive pt-3">
                        <table class="table table-bordered" id="campign">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Campign Name</th>
                                    <th class="text-center" >WhatsApp Wording</th>
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
</x-main-layout>

<script>
    $(document).ready(function() {
        const table = $('#campign').DataTable({

        });
    });
</script>
