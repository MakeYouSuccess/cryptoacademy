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
<div class="tbv-bg">
	<!-- Description -->
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="tcourse-title">
					<strong><?php echo $course_details['title']; ?></strong>
				</div>
			</div>
			<div class="col-md-6">
				<div class="tcourse-description">
					<?php echo $course_details['description']; ?>
				</div>
			</div>
			<div class="col-md-6">
				<div class="tcourse-video box_detail">
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
				</div>
			</div>
			<div class="col-sm-2">
			</div>
			<div class="col-sm-4">
			</div>
			<div class="col-sm-12">
				<div class="tcourse-ficons">
					<div class="tcourse-ficon">
						<i class="fas fa-calendar-alt" aria-hidden="true"></i>
						<span><?php echo get_phrase('at_your_own_pace'); ?></span>
					</div>
					<div class="tcourse-ficon">
						<i class="fas fa-clock" aria-hidden="true"></i>
						<span><?php echo get_phrase('no_schedules'); ?></span>
					</div>
					<div class="tcourse-ficon">
						<i class="fas fa-users" aria-hidden="true"></i>
						<span><?php echo get_phrase('unlimited'); ?></span>
					</div>
					<div class="tcourse-ficon">
						<i class="fas fa-map-marker-alt" aria-hidden="true"></i>
						<span><?php echo get_phrase('on-line'); ?></span>
					</div>
					<div class="tcourse-ficon">
						<i class="fas fa-coins" aria-hidden="true"></i>
						<span><?php echo get_phrase('enroll'); ?></span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Course Nav -->
	<div class="container container-tcourse-nav">
		<div class="row">
			<div class="col-sm-12">
				<div class="tcourse-nav tcourse-secondary-nav sticky_horizontal">
					<a href="#teacher"> <?php echo get_phrase('teachers'); ?> </a>
					<a href="#temary"> <?php echo get_phrase('temary'); ?> </a>
					<a href="#methodology"> <?php echo get_phrase('methodology'); ?> </a>
					<a href="#doubts"> <?php echo get_phrase('doubts'); ?> </a>
					<a href="#enrollment"> <?php echo get_phrase('enrollment'); ?> </a>
				</div>
			</div>
		</div>
	</div>
	<!-- Teacher -->
	<div class="container" id="teacher">
		<div class="row tcourse-teacher">
			<div class="col-sm-10 tcourse-border-bottom tcourse-teacher-title">
				<?php echo get_phrase('teachers'); ?>
			</div>
			<div class="col-sm-2 tcourse-teacher-more">
				<a href="<?php echo site_url('home/instructor_page/'.$course_details['user_id']); ?>"><?php echo get_phrase('see_more'); ?></a>
			</div>
			<div class="col-sm-6 pt-10">
				<div class="tcourse-teacher-name">
					<?php echo $instructor_details['first_name'].' '.$instructor_details['last_name']; ?>
				</div>	
				<figure>
					<img src="<?php echo $this->user_model->get_user_image_url($instructor_details['id']); ?>" alt="<?php echo get_phrase('instructor'); ?>" class="tcourse-instructor-image">
				</figure>
			</div>
			<div class="col-sm-6 pt-10 tcourse-vcenter">
				<div class="tcourse-teacher-detail">
					<strong><?php echo get_phrase('reviews'); ?> : </strong> <?php echo $this->crud_model->get_instructor_wise_course_ratings($instructor_details['id'], 'course')->num_rows().' '.get_phrase('reviews'); ?>
				</div>
				<div class="tcourse-teacher-detail">
					<strong><?php echo get_phrase('student'); ?> : </strong>
					<?php
					$course_ids = $this->crud_model->get_instructor_wise_courses($instructor_details['id'], 'simple_array');
					$this->db->select('user_id');
					$this->db->distinct();
					$this->db->where_in('course_id', $course_ids);
					echo $this->db->get('enrol')->num_rows().' '.get_phrase('students');
					?>
				</div>
				<div class="tcourse-teacher-detail pb-40">
					<strong><?php echo get_phrase('courses'); ?> : </strong>
					<?php echo $this->crud_model->get_instructor_wise_courses($instructor_details['id'])->num_rows().' '.get_phrase('courses'); ?>
				</div>
				<div class="tcourse-teacher-biography">
					<?php echo $instructor_details['biography']; ?>
				</div>
			</div>
		</div>
	</div>
	<!-- Temary -->
	<div class="tcourse-mark-bg" id="temary">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="tcourse-border-bottom tcourse-doubts-title">
						<?php echo get_phrase('temary'); ?>
					</div>
				</div>
				<div class="col-md-9">
					<div class="row justify-content-center">
						<img class="adbanner_box" src="https://via.placeholder.com/855x388?text=855x388+Banner" alt="">
					</div>
				</div>
				<div class="col-md-3">
					<div>
						<div class="tcourse-temary">
							<figure style="display:flex; justify-content:center;">
								<a href="<?=base_url($course_details['temary_url'])?>" target="_blank" style="display:inline-block; max-width:100%;">
									<img width="212" height="300" src="<?=base_url($course_details['temary_thumbnail'])?>" style="width:100%; max-width:100%; height:auto;"/>
								</a>
							</figure>
						</div>
						<div class="tcourse-temary-download">
							<a href="<?=base_url($course_details['temary_url'])?>" target="_blank" style="display:inline-block; vertical-align:top; max-width:100%;">
								<i class="fas fa-download"></i>
								<?=get_phrase('download_the_agenda_in_pdf')?>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Methodology -->
	<div class="fluid-container" id="methodology">
		<div class="row">
			<div class="col-md-6">
				<div class="tcourse-methodology">
					<nav class="tcourse-methodology-nav">
						<ul class="nav nav-pills">
							<li class="active"><a class="active show" data-toggle="pill" href="#online_methodology"><?php echo get_phrase('online_methodology'); ?></a></li>
							<li><a data-toggle="pill" href="#technical_requirements"><?php echo get_phrase('technical_requirements'); ?></a></li>
						</ul>
					</nav>
					<div class="tab-content">
						<div id="online_methodology" class="tab-pane fade active show">
							<p>
								<i class="fas fa-check" aria-hidden="true"></i>
								<?php echo get_phrase('follow_the_course_chronologically'); ?>
							</p>
							<p>
								<i class="fas fa-check" aria-hidden="true"></i>
								<?php echo get_phrase('solve_your_doubts_in_the_forums_and_use_the_tests_as_support'); ?>
							</p>
							<p>
								<i class="fas fa-check" aria-hidden="true"></i>
								<?php echo get_phrase('practice_your_creativity_and_start_your_ideas'); ?>
							</p>
						</div>
						<div id="technical_requirements" class="tab-pane fade">
							<p>
								<i class="fas fa-check" aria-hidden="true"></i>
								<?php echo get_phrase('internet_connection'); ?>
							</p>
							<p>
								<i class="fas fa-check" aria-hidden="true"></i>
								<?php echo get_phrase('pc_or_mac_with_arturia_pigments_installed'); ?>
							</p>
							<p>
								<i class="fas fa-check" aria-hidden="true"></i>
								<?php echo get_phrase('headphones_or_Audio_Monitors'); ?>
							</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="tcourse-contents">
					<div>
						<?php echo get_phrase('course_contents'); ?>
					</div>
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
		</div>
	</div>
	<!-- Doubts -->
	<div class="tcourse-mark-bg" id="doubts">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="tcourse-border-bottom tcourse-doubts-title">
						<?php echo get_phrase('it\'s_your_course_if_...'); ?>
					</div>
					<div class="tcourse-valign">
						<a class="tcourse-faq-collapse" data-target="#object" aria-controls="object" data-toggle="collapse"><?php echo get_phrase('who_is_it_for?'); ?> -</a>
						<div class="collapse" id="object">
							<ul>
								<li>
									<?php echo $course_details['for_whom']; ?>
								</li>
							</ul>
						</div>
					</div>
					<div class="tcourse-valign">
						<a class="tcourse-faq-collapse" data-target="#outcome" aria-controls="outcome" data-toggle="collapse"><?php echo get_phrase('what_are_you_going_to_achieve_with_the_course?'); ?> -</a>
						<div class="collapse" id="outcome">
							<ul>
								<?php foreach (json_decode($course_details['outcomes']) as $outcome): ?>
									<?php if ($outcome != ""): ?>
										<li>
											<p><?php echo $outcome; ?></p>
										</li>
									<?php endif; ?>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>
					<div class="tcourse-valign">
						<a class="tcourse-faq-collapse" data-target="#requirements" aria-controls="requirements" data-toggle="collapse"><?php echo get_phrase('what_do_you_need_before_starting?'); ?> -</a>
						<div class="collapse" id="requirements">
							<ul class="bullets">
								<?php foreach (json_decode($course_details['requirements']) as $requirement): ?>
									<?php if ($requirement != ""): ?>
										<li><?php echo $requirement; ?></li>
									<?php endif; ?>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>
					<div class="tcourse-valign">
						<a class="tcourse-faq-collapse" data-target="#material" aria-controls="material" data-toggle="collapse"><?php echo get_phrase('material_needed_for_the_course'); ?> -</a>
						<div class="collapse" id="material">
							<ul class="bullets">
								<li><?php echo get_phrase('internet_connection'); ?></li>
								<li><?php echo get_phrase('windows_or_mac_computer'); ?></li>
								<li><?php echo get_phrase('headphones_or_audio_monitors'); ?></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- enrollment -->
	<div class="container" id="enrollment">
		<div class="row">
			<div class="col-sm-12 tcourse-enrollment">
				<div class="tcourse-enrollment-btn">
					<?php echo get_phrase('buy_your_course_for'); ?> 
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
				<div style="display:flex; flex-direction:row; justify-content:center;">
					<?php if (is_purchased($course_details['id'])): ?>
						<a href="<?php echo site_url('home/my_courses'); ?>" class="tcourse-add-cart"><i class="icon-check-1"></i> <?php echo get_phrase('purchased'); ?></a>
					<?php else: ?>
						<?php if ($course_details['is_free_course'] == 1):
							if($this->session->userdata('user_login') != 1) {
								$url = "javascript::";
							}else {
								$url = site_url('home/get_enrolled_to_free_course/'.$course_details['id']);
							}?>
							<a href="<?php echo $url; ?>" class="tcourse-add-cart" onclick="handleEnrolledButton()">
								<i class="fas fa-coins" aria-hidden="true"></i>
								<?php echo get_phrase('enrol'); ?>
							</a>
						<?php else: ?>
							<button class="tcourse-add-cart" onclick="handleBuyNow('<?php echo $course_details['id'];?>')">
								<?php echo get_phrase('buy_now'); ?>
							</button>
							<button id = "<?php echo $course_details['id']; ?>" class="tcourse-add-cart big-cart-button-<?php echo $course_details['id'];?> <?php if(in_array($course_details['id'], $cart_items)) echo 'addedToCart'; ?>" onclick="handleCartItems(this)">
								<i class="fas fa-headphones" aria-hidden="true"> </i>
								<?php
								if(in_array($course_details['id'], $cart_items))
									echo get_phrase('added_to_cart');
								else
									echo get_phrase('add_to_cart');
								?>
							</button>
						<?php endif; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="bg_color_1">
	<div class="container margin_60_35">
		<div class="row">
			<div class="col-lg-8">
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
									<a 
										data-toggle="collapse"
										href="#collapse-<?php echo $section['id']; ?>"
										aria-expanded="<?php if ($key == 0): ?> true <?php else: ?> false <?php endif; ?>"
										aria-controls="collapse-<?php echo $section['id']; ?>"
									>
										<?php if ($key == 0): ?> 
											<i class="indicator ti-minus"></i> 
										<?php else: ?> 
											<i class="indicator ti-plus"></i>
										<?php endif; ?>
										<?php echo $section['title']; ?>
									</a>
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
		<div class="row">
			<img class="adbanner_box" src="https://via.placeholder.com/1140x200?text=1140x200+Banner" alt="">
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