<?php
$user_details = $user_details->row_array();
$social_links = json_decode($user_details['social_links'], true);
$banners = themeConfiguration(get_frontend_settings('theme'), 'banners');
$profile_banner = $banners['profile_banner'];
?>
<section id="hero_in" class="general">
	<div class="banner-img" style="background: url(<?php echo base_url($profile_banner); ?>) center center no-repeat;"></div>
	<div class="wrapper">
		<div class="container">
			<h1 class="fadeInUp"><span></span><?php echo get_phrase('user_profile'); ?></h1>
		</div>
	</div>
</section>
<!--/hero_in-->
<div class="container margin_60_35">
	<div class="row">
		<aside class="col-lg-3" id="sidebar">
			<div class="profile">
				<figure><img src="<?php echo $this->user_model->get_user_image_url($user_details['id']); ?>" alt="<?php echo get_phrase('user'); ?>" class="rounded-circle instructor-image"></figure>
				<ul class="social_teacher">
					<li><a href="<?php echo $social_links['facebook']; ?>"><i class="icon-facebook"></i></a></li>
					<li><a href="<?php echo $social_links['twitter']; ?>"><i class="icon-twitter"></i></a></li>
					<li><a href="<?php echo $social_links['linkedin']; ?>"><i class="icon-linkedin"></i></a></li>
				</ul>
			</div>
		</aside>
		<!--/aside -->

		<div class="col-lg-9">
			<div class="box_cart">
				<div class="form_title">
					<h3><strong><i class="icon-user"></i></strong><?php echo get_phrase('basic_info'); ?></h3>
				</div>
				<div class="step">
					<form class="" action="<?php echo site_url('home/update_profile/update_basics'); ?>" method="post">
						<div class="row">
							<div class="col-sm-6">
								<span class="input">
									<input class="input_field" name="first_name" type="text" value="<?php echo $user_details['first_name']; ?>" required>
									<label class="input_label">
										<span class="input__label-content"><?php echo get_phrase('first_name'); ?></span>
									</label>
								</span>
							</div>
							<div class="col-sm-6">
								<span class="input">
									<input class="input_field" type="text" name="last_name" value="<?php echo $user_details['last_name']; ?>" required>
									<label class="input_label">
										<span class="input__label-content"><?php echo get_phrase('last_name'); ?></span>
									</label>
								</span>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<span class="input">
									<input class="input_field" name="facebook_link" type="text" value="<?php echo $social_links['facebook']; ?>">
									<label class="input_label">
										<span class="input__label-content"><?php echo get_phrase('facebook_link'); ?></span>
									</label>
								</span>
							</div>
							<div class="col-sm-6">
								<span class="input">
									<input class="input_field" name="twitter_link" type="text" value="<?php echo $social_links['twitter']; ?>">
									<label class="input_label">
										<span class="input__label-content"><?php echo get_phrase('twitter_link'); ?></span>
									</label>
								</span>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<span class="input">
									<input class="input_field" name="linkedin_link" type="text" value="<?php echo $social_links['linkedin']; ?>">
									<label class="input_label">
										<span class="input__label-content"><?php echo get_phrase('linkedin_link'); ?></span>
									</label>
								</span>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<span class="input">
									<textarea name="biography" class="input_field" rows="2"><?php echo $user_details['biography']; ?></textarea>
									<label class="input_label">
										<span class="input__label-content"><?php echo get_phrase('biography'); ?></span>
									</label>
								</span>
							</div>
						</div>
						<div class="row justify-content-center">
							<button type="submit" class="btn_1 rounded" name="button"><?php echo get_phrase('update_basic_info'); ?></button>
						</div>
					</form>
				</div>
				<hr>
				<!--End step -->

				<div class="form_title">
					<h3><strong><i class="icon-lock-open"></i></strong><?php echo get_phrase('login_credentials'); ?></h3>
				</div>
				<div class="step">
					<form class="" action="<?php echo site_url('home/update_profile/update_credentials'); ?>" method="post">
						<div class="row">
							<div class="col-sm-6">
								<span class="input">
									<input class="input_field" name="email" type="email" value="<?php echo $user_details['email']; ?>" required>
									<label class="input_label">
										<span class="input__label-content"><?php echo get_phrase('email'); ?></span>
									</label>
								</span>
							</div>
							<div class="col-sm-6">
								<span class="input">
									<input class="input_field" name="current_password" type="password">
									<label class="input_label">
										<span class="input__label-content"><?php echo get_phrase('current_password'); ?></span>
									</label>
								</span>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-6">
								<span class="input">
									<input class="input_field" name="new_password" type="password">
									<label class="input_label">
										<span class="input__label-content"><?php echo get_phrase('new_password'); ?></span>
									</label>
								</span>
							</div>
							<div class="col-sm-6">
								<span class="input">
									<input class="input_field" type="password" name="confirm_password">
									<label class="input_label">
										<span class="input__label-content"><?php echo get_phrase('confirm_password'); ?></span>
									</label>
								</span>
							</div>
						</div>
						<div class="row justify-content-center">
							<button type="submit" class="btn_1 rounded" name="button"><?php echo get_phrase('update_login_credentials'); ?></button>
						</div>
					</form>
				</div>
				<hr>
				<!--End step -->

				<div class="form_title">
					<h3><strong><i class="icon-smiley"></i></strong><?php echo get_phrase('user_photo'); ?></h3>
				</div>
				<div class="step form">
					<form class="" action="<?php echo site_url('home/update_profile/update_photo'); ?>" enctype="multipart/form-data" method="post">
						<div class="row">
							<div class="col-sm-8">
								<div class="form-group">
									<div class="file-upload">
										<div class="file-select">
											<div class="file-select-button" id="fileName"><?php echo get_phrase('choose_file'); ?></div>
											<div class="file-select-name" id="noFile"><?php echo get_phrase('no_file_chosen'); ?>...</div>
											<input type="file" name="user_image" id="chooseFile">
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row justify-content-center">
							<button type="submit" class="btn_1 rounded" name="button"><?php echo get_phrase('update_profile_photo'); ?></button>
						</div>
					</form>
				</div>
				<hr>

			</div>
		</div>
		<!-- /col -->
	</div>
	<!-- /row -->
</div>
<!-- /container -->
