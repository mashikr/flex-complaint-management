<!-- Footer -->
<footer class="bg-white iq-footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
                    <li class="list-inline-item"><a href="#">Terms of Use</a></li>
                </ul>
            </div>
            <div class="col-lg-6 text-right">
                Copyright {{ date("Y") }} <a href="#">{{ config('app.name', 'Metorik') }} </a> All Rights Reserved.
            </div>
        </div>
    </div>
</footer>
<!-- Footer END -->
<!-- Optional JavaScript -->
@include('partials._body_scripts')
@include('partials._dynamic_script')
@include('helper.app_mesage')
@yield('body_bottom')
