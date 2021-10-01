<?php
  $banners = themeConfiguration(get_frontend_settings('theme'), 'banners');
  $signup_banner = $banners['sign_up_banner'];
 ?>
<aside>
	<figure>
		<a href="<?php echo site_url('home'); ?>"><img src="<?php echo base_url().'uploads/system/logo-light.png'; ?>" height="42" data-retina="true" alt=""></a>
	</figure>
	<form action="<?php echo site_url('login/register'); ?>" method="post" autocomplete="off">
		<div class="form-group">

			<span class="input">
				<input class="input_field" type="text" name="first_name" required>
				<label class="input_label">
					<span class="input__label-content"><?php echo get_phrase('first_name'); ?></span>
				</label>
			</span>

			<span class="input">
				<input class="input_field" type="text" name="last_name" required>
				<label class="input_label">
					<span class="input__label-content"><?php echo get_phrase('last_name'); ?></span>
				</label>
			</span>

			<span class="input">
				<input class="input_field" type="email" name="email" required>
				<label class="input_label">
					<span class="input__label-content"><?php echo get_phrase('email'); ?></span>
				</label>
			</span>

			<span class="input">
				<input class="input_field" type="password" id="password1" name="password" required>
				<label class="input_label">
					<span class="input__label-content"><?php echo get_phrase('password'); ?></span>
				</label>
			</span>

			<div id="pass-info" class="clearfix"></div>
		</div>
		<button type="submit" class="btn_1 rounded full-width add_top_30"><?php echo get_phrase('register'); ?></button>
		<div class="text-center add_top_10"><?php echo get_phrase('already_have_an_account'); ?>? <strong><a href="<?php echo site_url('home/login'); ?>"><?php echo get_phrase('sign_in'); ?></a></strong></div>
		<div class="text-center add_top_10"> <strong><a href="<?php echo site_url('home'); ?>"><?php echo get_phrase('back_to_home'); ?></a></strong> </div>
	</form>
	<div class="copy">© <?php echo get_settings('system_name'); ?></div>
</aside>

<style media="screen">
#login_bg {
  background: url(<?php echo base_url($signup_banner); ?>) center center no-repeat fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  min-height: 100vh;
  width: 100%;
}
</style>
