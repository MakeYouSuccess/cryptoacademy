<?php
$banners = themeConfiguration(get_frontend_settings('theme'), 'banners');
$login_banner = $banners['login_banner'];
?>
<aside>
  <figure>
    <a href="<?php echo site_url('home'); ?>"><img src="<?php echo base_url().'uploads/system/logo-light.png'; ?>" height="42" data-retina="true" alt=""></a>
  </figure>
  <form action="<?php echo site_url('login/validate_login/user'); ?>" method="post">
    <div class="form-group">
      <span class="input">
        <input class="input_field" type="email" autocomplete="off" name="email" required>
        <label class="input_label">
          <span class="input__label-content"><?php echo get_phrase('your_email'); ?></span>
        </label>
      </span>

      <span class="input">
        <input class="input_field" type="password" autocomplete="new-password" name="password" required>
        <label class="input_label">
          <span class="input__label-content"><?php echo get_phrase('your_password'); ?></span>
        </label>
      </span>
      <small><a href="<?php echo site_url('home/forgot_password'); ?>"><?php echo get_phrase('forgot_password'); ?>?</a></small>
    </div>
    <button type="submit" class="btn_1 rounded full-width add_top_60"><?php echo get_phrase('login'); ?></button>
    <div class="text-center add_top_10"><?php echo get_phrase('new_to').' <strong>'.get_settings('system_name').'</strong>'; ?>? <strong><a href="<?php echo site_url('home/sign_up'); ?>"><?php echo get_phrase('sign_up'); ?>!</a></strong></div>
    <div class="text-center add_top_10"> <strong><a href="<?php echo site_url('home'); ?>"><?php echo get_phrase('back_to_home'); ?></a></strong> </div>
  </form>
  <div class="copy">© <?php echo get_settings('system_name'); ?></div>
</aside>

<style media="screen">
#login_bg {
  background: url(<?php echo base_url($login_banner); ?>) center center no-repeat fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  min-height: 100vh;
  width: 100%;
}
</style>
