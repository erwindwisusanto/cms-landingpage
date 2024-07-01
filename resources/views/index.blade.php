<x-main-layout>
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        <h2>Welcome back, {{ auth()->user()->username }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
