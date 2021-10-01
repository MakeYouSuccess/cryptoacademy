<?php
$course_details = $this->crud_model->get_course_by_id($course_id)->row_array();
$instructor_details = $this->user_model->get_all_user($course_details['user_id'])->row_array();
$cart_items = $this->session->userdata('cart_items');
?>
<section id="hero_in" class="courses">

	<div style="background: url(<?php echo $this->crud_model->get_course_thumbnail_url($course_id, 'course_banner') ?>) center center no-repeat;" class="banner-img"></div>
	<div class="wrapper">
		<div class="container">
			<h1 class="fadeInUp"><span></span><?php echo $course_details['title']; ?></h1>
		</div>
	</div>
</section>
<!--/hero_in-->

<div class="bg_color_1">
	<nav class="secondary_nav sticky_horizontal">
		<div class="container">
			<ul class="clearfix">
				<li><a href="#description" class="active"><?php echo get_phrase('description'); ?></a></li>
				<li><a href="#lessons"><?php echo get_phrase('lessons'); ?></a></li>
				<li><a href="#about-instructor"><?php echo get_phrase('instructor'); ?></a></li>
				<li><a href="#reviews"><?php echo get_phrase('reviews'); ?></a></li>
			</ul>
		</div>
	</nav>
	<div class="container margin_60_35">
		<div class="row">
			<div class="col-lg-8">

				<section id="description">
					<h2><?php echo get_phrase('description'); ?></h2>
					<p class="course-description"><?php echo $course_details['description']; ?></p>
					<h5><?php echo get_phrase('what_will_you_learn'); ?></h5>
					<ul class="list_ok">
						<?php foreach (json_decode($course_details['outcomes']) as $outcome): ?>
							<?php if ($outcome != ""): ?>
								<li>
									<p><?php echo $outcome; ?></p>
								</li>
							<?php endif; ?>
						<?php endforeach; ?>

					</ul>
					<hr>
					<h5 class="mb-3"><?php echo get_phrase('requirements'); ?></h5>
					<div class="row">
						<?php foreach (json_decode($course_details['requirements']) as $requirement): ?>
							<?php if ($requirement != ""): ?>
								<div class="col-lg-6">
									<ul class="bullets">
										<li><?php echo $requirement; ?></li>
									</ul>
								</div>
							<?php endif; ?>
						<?php endforeach; ?>
					</div>
					<!-- /row -->
				</section>
				<!-- /section -->
				<section id="lessons">
					<div class="intro_title">
						<h2><?php echo get_phrase('lessons'); ?></h2>
						<ul>
							<li><?php echo $this->crud_model->get_lessons('lesson_count_in_course', $course_details['id'])->num_rows().' '.get_phrase('lessons'); ?></li>
							<li><?php echo $this->crud_model->get_total_duration_of_lesson_by_course_id($course_details['id']); ?></li>
						</ul>
					</div>
					<div id="accordion_lessons" role="tablist" class="add_bottom_45">
						<?php
						/// Sections
						$sections = $this->crud_model->get_section('course', $course_id)->result_array();
						$counter = 0;
						foreach ($sections as $key => $section): ?>
						<div class="card">
							<div class="card-header" role="tab" id="heading-<?php echo $section['id']; ?>">
								<h5 class="mb-0">
									<a data-toggle="collapse" href="#collapse-<?php echo $section['id']; ?>" aria-expanded="<?php if ($key == 0): ?> true <?php else: ?> false <?php endif; ?>" aria-controls="collapse-<?php echo $section['id']; ?>"><?php if ($key == 0): ?> <i class="indicator ti-minus"></i> <?php else: ?> <i class="indicator ti-plus"></i> <?php endif; ?><?php echo $section['title']; ?></a>
									</h5>
								</div>

								<div id="collapse-<?php echo $section['id']; ?>" class="collapse <?php if ($key == 0): ?> show <?php endif; ?>" role="tabpanel" aria-labelledby="heading-<?php echo $section['id']; ?>" data-parent="#accordion_lessons">
									<div class="card-body">
										<div class="list_lessons">
											<ul>
												<?php $lessons = $this->crud_model->get_lessons('section', $section['id'])->result_array();
												$term_counter = 0;
												foreach ($lessons as $lesson):?>
												<?php if ($lesson['lesson_type'] != 'term'): // Section lessons?>
													<?php if($lesson['lesson_type'] == 'video' || $lesson['lesson_type'] == '' || $lesson['lesson_type'] == NULL): ?>
														<li> <i class="icon-play-circled2"></i> <?php echo $lesson['title']; ?><span><?php echo $lesson['duration']; ?></span></li>
													<?php else: ?>
														<li> <i class="icon-newspaper"></i> <?php echo $lesson['title'] ?></li>
													<?php endif; ?>
												<?php else: // Terms?>
													<div id="accordion_lessons<?=$lesson['id']?>" role="tablist">
														<div class="card-header term-card-header" role="tab" id="heading-<?php echo $lesson['id']; ?>">
															<h5 class="mb-0">
																<a
																	data-toggle="collapse" href="#collapse-<?php echo $lesson['id']; ?>"
																	aria-controls="collapse-<?php echo $lesson['id']; ?>"
																>
																	<i class="indicator ti-plus"></i><?php echo $lesson['title']; ?>
																</a>
															</h5>
														</div>
														<div
															id="collapse-<?php echo $lesson['id']; ?>"
															class="collapse" role="tabpanel" aria-labelledby="heading-<?php echo $lesson['id']; ?>" data-parent="#accordion_lessons<?=$lesson['id']?>"
														>
															<div class="card-body subcard-body">
																<div class="list_lessons">
																	<ul>
																		<?php
																		$term_lessons = $this->crud_model->get_lessons('section', $lesson['id'], 'les')->result_array();
																		foreach ($term_lessons as $index => $term):?>
																		<?php if ($term['lesson_type'] != 'subterm'): // Section term_lessons?>
																			<?php if($term['lesson_type'] == 'video' || $term['lesson_type'] == '' || $term['lesson_type'] == NULL): ?>
																				<li> <i class="icon-play-circled2"></i> <?php echo $term['title']; ?><span><?php echo $term['duration']; ?></span></li>
																			<?php else: ?>
																				<li> <i class="icon-newspaper"></i> <?php echo $term['title'] ?></li>
																			<?php endif; ?>
																			<?php else: // Subterms?>
																				<div id="accordion_lessons<?=$term['id']?>" role="tablist">
																					<div class="card-header subterm-card-header" role="tab" id="heading-<?php echo $term['id']; ?>">
																						<h5 class="mb-0">
																							<a
																								data-toggle="collapse" href="#collapse-<?php echo $term['id']; ?>"
																								aria-controls="collapse-<?php echo $term['id']; ?>"
																							>
																								<i class="indicator ti-plus"></i><?php echo $term['title']; ?>
																							</a>
																						</h5>
																					</div>
																					<div
																						id="collapse-<?php echo $term['id']; ?>"
																						class="collapse" role="tabpanel" aria-labelledby="heading-<?php echo $term['id']; ?>" data-parent="#accordion_lessons<?=$term['id']?>"
																					>
																						<div class="card-body subcard-body">
																							<div class="list_lessons">
																								<ul>
																									<?php
																									$subterm_lessons = $this->crud_model->get_lessons('section', $term['id'], 'les')->result_array();
																									foreach ($subterm_lessons as $index => $subterm):?>
																										<?php if($subterm['lesson_type'] == 'video' || $subterm['lesson_type'] == '' || $subterm['lesson_type'] == NULL): ?>
																											<li> <i class="icon-play-circled2"></i> <?php echo $subterm['title']; ?><span><?php echo $subterm['duration']; ?></span></li>
																										<?php else: ?>
																											<li> <i class="icon-newspaper"></i> <?php echo $subterm['title'] ?></li>
																									<?php endif; ?>
																								<?php endforeach;?>
																							</ul>
																						</div>
																					</div>
																				</div>
																			<?php endif; ?>
																		<?php endforeach; ?>
																	</ul>
																</div>
															</div>
														</div>
													</div>
												<?php endif; ?>
											<?php endforeach; ?>
										</ul>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
				<!-- /accordion -->
			</section>
			<!-- /section -->

			<section id="about-instructor">
				<div class="intro_title">
					<h2><?php echo get_phrase('about_instructor'); ?></h2>
					<div class="row">
						<div class="col-lg-4 instructor-image">
							<figure><img src="<?php echo $this->user_model->get_user_image_url($instructor_details['id']); ?>" alt="<?php echo get_phrase('instructor'); ?>" class="rounded-circle instructor-image"></figure>
						</div>
						<div class="col-lg-8 instructor-summary">
							<div class="">
								<strong><?php echo get_phrase('name'); ?> : <?php echo $instructor_details['first_name'].' '.$instructor_details['last_name']; ?></strong>
							</div>
							<div class="">
								<strong><?php echo get_phrase('reviews'); ?> : </strong> <?php echo $this->crud_model->get_instructor_wise_course_ratings($instructor_details['id'], 'course')->num_rows().' '.get_phrase('reviews'); ?>
							</div>
							<div class="">
								<strong><?php echo get_phrase('student'); ?> : </strong>
								<?php
								$course_ids = $this->crud_model->get_instructor_wise_courses($instructor_details['id'], 'simple_array');
								$this->db->select('user_id');
								$this->db->distinct();
								$this->db->where_in('course_id', $course_ids);
								echo $this->db->get('enrol')->num_rows().' '.get_phrase('students');
								?>
							</div>
							<div class="">
								<strong><?php echo get_phrase('courses'); ?> : </strong>
								<?php echo $this->crud_model->get_instructor_wise_courses($instructor_details['id'])->num_rows().' '.get_phrase('courses'); ?>
							</div>
							<div class="mt-2">
								<a href="<?php echo site_url('home/instructor_page/'.$course_details['user_id']); ?>"><?php echo get_phrase('view_profile'); ?></a>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- /section -->

			<section id="reviews">
				<h2><?php echo get_phrase('reviews'); ?></h2>
				<div class="reviews-container">
					<div class="row">
						<div class="col-lg-3">
							<div id="review_summary">
								<strong>
									<?php
									$total_rating =  $this->crud_model->get_ratings('course', $course_details['id'], true)->row()->rating;
									$number_of_ratings = $this->crud_model->get_ratings('course', $course_details['id'])->num_rows();
									if ($number_of_ratings > 0) {
										$average_ceil_rating = ceil($total_rating / $number_of_ratings);
									}else {
										$average_ceil_rating = 0;
									}
									echo $average_ceil_rating;
									?>
								</strong>
								<div class="rating">
									<?php for($i = 1; $i < 6; $i++):?>
										<?php if ($i <= $average_ceil_rating): ?>
											<i class="icon_star voted"></i>
										<?php else: ?>
											<i class="icon_star"></i>
										<?php endif; ?>
									<?php endfor; ?>
								</div>
								<small><?php echo get_phrase('based_on').' '.$number_of_ratings.' '.get_phrase('reviews'); ?></small>
							</div>
						</div>
						<div class="col-lg-9">
							<?php for($i = 1; $i <= 5; $i++): ?>
								<?php $rating_wise_rating_percentage = $this->crud_model->get_percentage_of_specific_rating($i, 'course', $course_id); ?>
								<div class="row">
									<div class="col-lg-10 col-9">
										<div class="progress">
											<div class="progress-bar" role="progressbar" style="width: <?php echo $rating_wise_rating_percentage; ?>%" aria-valuenow="<?php echo $rating_wise_rating_percentage; ?>" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</div>
									<div class="col-lg-2 col-3"><small><strong><?php echo $i.' '.get_phrase('stars'); ?></strong></small></div>
								</div>
							<?php endfor; ?>
						</div>
					</div>
					<!-- /row -->
				</div>

				<hr>

				<div class="reviews-container">
					<?php
					$ratings = $this->crud_model->get_ratings('course', $course_id)->result_array();
					foreach($ratings as $rating): ?>
					<div class="review-box clearfix">
						<figure class="rev-thumb"><img src="<?php echo $this->user_model->get_user_image_url($rating['user_id']); ?>" alt="">
						</figure>
						<div class="rev-content">
							<div class="rating">
								<?php for($i = 1; $i < 6; $i++):?>
									<?php if ($i <= $rating['rating']): ?>
										<i class="icon_star voted"></i>
									<?php else: ?>
										<i class="icon_star"></i>
									<?php endif; ?>
								<?php endfor; ?>
							</div>
							<div class="rev-info">
								<?php
								$user_details = $this->user_model->get_user($rating['user_id'])->row_array();
								echo $user_details['first_name'].' '.$user_details['last_name'].' - '.date('D, d-M-Y', $rating['date_added']);
								?>
							</div>
							<div class="rev-text">
								<p>
									<?php echo $rating['review']; ?>
								</p>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			<!-- /review-container -->
		</section>
		<!-- /section -->
	</div>
	<!-- /col -->

	<aside class="col-lg-4" id="sidebar">
		<div class="box_detail">
			<?php if ($course_details['video_url'] != ""): ?>
				<?php if ($course_details['course_overview_provider'] == 'youtube'):
					$video_id = $this->video_model->get_youtube_video_id($course_details['video_url']); ?>
					<figure>
						<a href="https://www.youtube.com/watch?v=<?php echo $video_id; ?>" class="video"><i class="arrow_triangle-right"></i><img src="<?php echo $this->crud_model->get_course_thumbnail_url($course_details['id']); ?>" alt="" class="img-fluid"><span>View course preview</span></a>
					</figure>
				<?php else: ?>
					<figure>
						<a href="<?php echo $course_details['video_url']; ?>" class="video"><i class="arrow_triangle-right"></i><img src="<?php echo $this->crud_model->get_course_thumbnail_url($course_details['id']); ?>" alt="" class="img-fluid"><span>View course preview</span></a>
					</figure>
				<?php endif; ?>
			<?php endif; ?>

			<?php
			// if ($course_details['video_url'] != "") {
			// 	include 'course_overview.php';
			// }
			?>
			<div class="price">
				<?php if ($course_details['is_free_course'] == 1): ?>
					<?php echo get_phrase('free'); ?>
				<?php else: ?>
					<?php if ($course_details['discount_flag'] == 1): ?>
						<?php echo currency($course_details['discounted_price']); ?><span class="original_price"><em><?php echo currency($course_details['price']); ?></em><?php echo number_format((float)((($course_details['price'] - $course_details['discounted_price']) * 100))/$course_details['price'], 2, '.', '').'%'; ?> <?php echo get_phrase('discount'); ?></span>

					<?php else: ?>
						<?php echo currency($course_details['price']); ?>
					<?php endif; ?>
				<?php endif; ?>
			</div>


			<?php if (is_purchased($course_details['id'])): ?>
				<a href="<?php echo site_url('home/my_courses'); ?>" class="btn_1 full-width outline"><i class="icon-check-1"></i> <?php echo get_phrase('purchased'); ?></a>
			<?php else: ?>
				<?php if ($course_details['is_free_course'] == 1):
					if($this->session->userdata('user_login') != 1) {
						$url = "javascript::";
					}else {
						$url = site_url('home/get_enrolled_to_free_course/'.$course_details['id']);
					}?>
					<a href="<?php echo $url; ?>" class="btn_1 full-width" onclick="handleEnrolledButton()"><?php echo get_phrase('enrol'); ?></a>
				<?php else: ?>
					<a href="javascript::" class="btn_1 full-width" onclick="handleBuyNow('<?php echo $course_details['id'];?>')" ><?php echo get_phrase('buy_now'); ?></a>
					<a href="javascript::" class="btn_1 full-width outline big-cart-button-<?php echo $course_details['id'];?> <?php if(in_array($course_details['id'], $cart_items)) echo 'addedToCart'; ?>" id = "<?php echo $course_details['id']; ?>" onclick="handleCartItems(this)">
						<?php
						if(in_array($course_details['id'], $cart_items))
						echo get_phrase('added_to_cart');
						else
						echo get_phrase('add_to_cart');
						?>
					</a>
				<?php endif; ?>
			<?php endif; ?>
			<div id="list_feat">
				<h3><?php echo get_phrase('what_is_included'); ?></h3>
				<ul>
					<li><i class="far fa-file-video"></i>
						<?php
						echo $this->crud_model->get_total_duration_of_lesson_by_course_id($course_details['id']).' '.get_phrase('on_demand_videos');
						?>
					</li>
					<li><i class="far fa-file"></i><?php echo $this->crud_model->get_lessons('lesson_count_in_course', $course_details['id'])->num_rows().' '.get_phrase('lessons'); ?></li>
					<li><i class="far fa-compass"></i><?php echo get_phrase('full_lifetime_access'); ?></li>
					<li><i class="fas fa-mobile-alt"></i><?php echo get_phrase('access_on_mobile_and_tv'); ?></li>
				</ul>
			</div>

		</div>
	</aside>
</div>
<!-- /row -->
</div>
<!-- /container -->
</div>
<!-- /bg_color_1 -->

<style>
.term-card-header {
  padding: 0.5rem 1.25rem !important;
}
.subterm-card-header {
	padding: 0.25rem 1.25rem !important;
}
.subcard-body {
	padding: 0 1.25rem !important;
}
</style>