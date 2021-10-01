<?php
  $banners = themeConfiguration(get_frontend_settings('theme'), 'banners');
  $forgot_password_banner = $banners['forgot_password_banner'];
 ?>
<aside>
  <figure>
    <a href="<?php echo site_url('home'); ?>"><img src="<?php echo base_url().'uploads/system/logo-light.png'; ?>" height="42" data-retina="true" alt=""></a>
  </figure>
  <form action="<?php echo site_url('login/forgot_password/frontend'); ?>" method="post">
    <div class="form-group">
      <span class="input">
        <input class="input_field" type="email" autocomplete="off" name="email" required>
        <label class="input_label">
          <span class="input__label-content"><?php echo get_phrase('provide_email'); ?></span>
        </label>
      </span>
      <small><a href="<?php echo site_url('home/login'); ?>"><?php echo get_phrase('back_to_login_page'); ?></a></small>
    </div>
    <button type="submit" class="btn_1 rounded full-width add_top_60"><?php echo get_phrase('reset_password'); ?></button>
  </form>
  <div class="copy">© <?php echo get_settings('system_name'); ?></div>
</aside>
<style media="screen">
#login_bg {
  background: url(<?php echo base_url($forgot_password_banner); ?>) center center no-repeat fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  min-height: 100vh;
  width: 100%;
}
</style>
