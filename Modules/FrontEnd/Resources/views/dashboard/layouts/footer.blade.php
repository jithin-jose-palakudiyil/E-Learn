
<!-- start scroll top -->
<div id="scroll-top">
    <i class="fa fa-angle-up" title="Go top"></i>
</div>
<!-- end scroll top -->

<!-- account-delete-modal -->
<div class="modal-form text-center">
    <div class="modal fade account-delete-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content p-4">
                <div class="modal-top border-0 mb-4 p-0">
                    <div class="alert-content">
                        <span class="la la-exclamation-circle warning-icon"></span>
                        <h4 class="widget-title font-size-20 mt-2 mb-1">Your account will be deleted permanently!</h4>
                        <p class="modal-sub">Are you sure to proceed.</p>
                    </div>
                </div>
                <div class="btn-box">
                    <button type="button" class="btn primary-color font-weight-bold mr-3" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="theme-btn bg-color-6 border-0 text-white" >Delete</button>
                </div>
            </div><!-- end modal-content -->
        </div><!-- end modal-dialog -->
    </div><!-- end modal -->
</div><!-- end modal-form -->

<!-- template js files -->
<script src="{{asset('public/js/popper.min.js')}}"></script>
<script src="{{asset('public/js/bootstrap.min.js')}}"></script>
<script src="{{asset('public/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('public/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('public/js/magnific-popup.min.js')}}"></script>
<script src="{{asset('public/js/isotope.js')}}"></script>
<script src="{{asset('public/js/jquery.counterup.min.js')}}"></script>
<script src="{{asset('public/js/fancybox.js')}}"></script>
<script src="{{asset('public/js/wow.js')}}"></script>
<script src="{{asset('public/js/chart.js')}}"></script>
<script src="{{asset('public/js/doughnut-chart.js')}}"></script>
<script src="{{asset('public/js/bar-chart.js')}}"></script>
<script src="{{asset('public/js/line-chart.js')}}"></script>
<script src="{{asset('public/js/smooth-scrolling.js')}}"></script>
<script src="{{asset('public/js/tooltipster.bundle.min.js')}}"></script>
<script src="{{asset('public/js/jquery.filer.min.js')}}"></script>
<script src="{{asset('public/js/jquery.vmap.js')}}"></script>
<script src="{{asset('public/js/jquery.vmap.world.js')}}"></script>
<script src="{{asset('public/js/jquery.vmap.sampledata.js')}}"></script>
<script src="{{asset('public/js/jquery.vmap-script.js')}}"></script>
<script src="{{asset('public/js/progress-bar.js')}}"></script>
<script src="{{asset('public/js/date-time-picker.js')}}"></script>
<script src="{{asset('public/js/emojionearea.min.js')}}"></script>
<script src="{{asset('public/js/animated-skills.js')}}"></script>
<script src="{{asset('public/js/main.js')}}"></script>

    <!-- custom JS files -->
    @yield('js') 
    <!-- /custom JS files -->
         
    <!-- custom script -->
    @stack('script')
    
</body>
</html>