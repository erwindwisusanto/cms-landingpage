<x-main-layout>
    <style>
        #file-readme-md-readme {
            padding: 10px 0px 10px 0px !important;
        }
    </style>
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        <h2>Welcome back, {{ auth()->user()->username }}</h2>
                    </div>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-body">
                    <div id="gist-content">
                        <script src="https://gist.github.com/erwindwisusanto/3b5b57fe7249eb67d0256b8930812c8c.js"></script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
