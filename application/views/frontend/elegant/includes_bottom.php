<script src="<?php echo base_url('assets/frontend/elegant/js/jquery-2.2.4.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/frontend/elegant/js/common_scripts.js'); ?>"></script>
<script src="<?php echo base_url('assets/frontend/elegant/js/main.js'); ?>"></script>
<!-- MODERNIZR SLIDER -->
<script src="<?php echo base_url('assets/frontend/elegant/js/modernizr_slider.js'); ?>"></script>
<!-- FlexSlider -->
<script defer src="<?php echo base_url('assets/frontend/elegant/js/jquery.flexslider.js'); ?>"></script>
<script>
  $(window).load(function() {
    'use strict';
    $('#carousel_slider').flexslider({
      animation: "slide",
      controlNav: false,
      animationLoop: false,
      slideshow: false,
      itemWidth: 280,
      itemMargin: 25,
      asNavFor: '#slider'
    });
    $('#carousel_slider ul.slides li:not(:last-child)').on('mouseover', function() {
      $(this).trigger('click');
    });
    $('#slider').flexslider({
      animation: "fade",
      controlNav: false,
      animationLoop: false,
      slideshow: false,
      sync: "#carousel_slider",
      start: function(slider) {
        $('body').removeClass('loading');
      }
    });
    $('#blog_slider').flexslider({
      animation: "slide",
      easing:"swing",
      controlNav: false,
      animationLoop: true,
      slideshowSpeed: 2000,
      slideshow: true,
      pauseOnHover:true,
      itemWidth: 400,
      touch:true,
      itemMargin: 25,
    });
  });
</script>

<!-- TOASTR JS -->
<script src="<?php echo base_url().'assets/global/toastr/toastr.min.js'; ?>"></script>
<script src="<?php echo base_url('assets/frontend/elegant/js/validate.js'); ?>"></script>

<!-- JSPdf -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"
integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/"
crossorigin="anonymous"></script>

<script src="<?php echo base_url('assets/frontend/elegant/js/custom.js'); ?>"></script>
