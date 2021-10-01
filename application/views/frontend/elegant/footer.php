<footer class="d-print-none">
  <div class="container margin_120_95">
    <div class="row">
      <div class="col-lg-5 col-md-12 p-r-5">
        <p><img src="<?php echo base_url().'uploads/system/logo-light.png'; ?>" height="42" data-retina="true" alt=""></p>
        <p><?php echo get_settings('slogan').'<br/>'.get_settings('address'); ?></p>
        <!-- <div class="follow_us">
          <ul>
            <li>Follow us</li>
            <li><a href="#0"><i class="ti-facebook"></i></a></li>
            <li><a href="#0"><i class="ti-twitter-alt"></i></a></li>
            <li><a href="#0"><i class="ti-google"></i></a></li>
            <li><a href="#0"><i class="ti-pinterest"></i></a></li>
            <li><a href="#0"><i class="ti-instagram"></i></a></li>
          </ul>
        </div> -->
      </div>
      <div class="col-lg-3 col-md-6 ml-lg-auto">
        <h5><?php echo get_phrase('useful_links'); ?></h5>
        <ul class="links">
          <li><a href="<?php echo site_url('home/courses'); ?>"><?php echo get_phrase('courses'); ?></a></li>
          <li><a href="<?php echo site_url('home/login'); ?>"><?php echo get_phrase('login'); ?></a></li>
          <li><a href="<?php echo site_url('home/sign_up'); ?>"><?php echo get_phrase('register'); ?></a></li>
        </ul>
      </div>
      <div class="col-lg-3 col-md-6">
        <h5><?php echo get_phrase('contact_with_us'); ?></h5>
        <ul class="contacts">
          <li><a href="tel://<?php echo get_settings('phone'); ?>"><i class="ti-mobile"></i> <?php echo get_settings('phone'); ?></a></li>
          <li><a href="mailto:<?php echo get_settings('system_email'); ?>"><i class="ti-email"></i> <?php echo get_settings('system_email'); ?></a></li>
        </ul>
        <!-- <div id="newsletter">
          <h6>Newsletter</h6>
          <div id="message-newsletter"></div>
          <form method="post" action="assets/newsletter.php" name="newsletter_form" id="newsletter_form">
            <div class="form-group">
              <input type="email" name="email_newsletter" id="email_newsletter" class="form-control" placeholder="Your email">
              <input type="submit" value="Submit" id="submit-newsletter">
            </div>
          </form>
        </div> -->
      </div>
    </div>
    <!--/row-->
    <hr>
    <div class="row">
      <div class="col-md-8">
        <ul id="additional_links">
          <li><a href="<?php echo site_url('home/terms_and_condition'); ?>"><?php echo get_phrase('terms_&_conditions'); ?></a></li>
          <li><a href="<?php echo site_url('home/privacy_policy'); ?>"><?php echo get_phrase('privacy_policy'); ?></a></li>
          <li><a href="<?php echo site_url('home/about_us'); ?>"><?php echo get_phrase('about_us'); ?></a></li>
        </ul>
      </div>
      <div class="col-md-4">
        <div id="copy">© <a href="<?php echo get_settings('footer_link'); ?>" style="color: unset;"><?php echo get_settings('system_name').' | '.get_phrase('version').' : '.get_settings('version'); ?></a> </div>
      </div>
    </div>
  </div>
</footer>
