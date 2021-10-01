<!-- Slider starts -->
<?php include 'slider.php'; ?>
<!-- Slider ends -->

<!-- The black banner content starts -->
<div class="features clearfix">
	<div class="container">
		<ul>
			<li><i class="pe-7s-study"></i>
				<h4>
					<?php
					$status_wise_courses = $this->crud_model->get_status_wise_courses();
					$number_of_courses = $status_wise_courses['active']->num_rows();
					echo $number_of_courses.' '.get_phrase('online_courses'); ?>
				</h4><span><?php echo get_phrase('explore_your_knowledge'); ?></span>
			</li>
			<li><i class="pe-7s-cup"></i>
				<h4><?php echo get_phrase('expert_instruction'); ?></h4>
				<span><?php echo get_phrase('find_the_right_course_for_you'); ?></span>
			</li>
			<li><i class="pe-7s-target"></i>
				<h4><?php echo get_phrase('lifetime_access'); ?></h4>
				<span><?php echo get_phrase('learn_on_your_schedule'); ?></span>
			</li>
		</ul>
	</div>
</div>
<!-- The black banner content ends -->

<!-- Top Course Portion Starts -->
<?php include 'top_courses.php' ?>
<!-- Top Course Portion Ends -->

<!-- Categories start -->
<div class="container margin_30_95">
	<div class="main_title_2">
		<span><em></em></span>
		<h2><?php echo get_phrase('categories'); ?></h2>
		<p><?php echo get_phrase('get_category_wise_different_courses'); ?></p>
	</div>
	<div class="row justify-content-center">
		<?php foreach ($this->crud_model->get_categories()->result_array() as $category):
			if($category['parent'] > 0)
			continue; ?>
			<!-- /grid_item -->
			<div class="col-lg-4 col-md-6 wow" data-wow-offset="150">
				<a href="<?php echo site_url('home/courses?category='.$category['slug']); ?>" class="grid_item">
					<figure class="block-reveal">
						<div class="block-horizzontal"></div>
						<img src="<?php echo base_url('uploads/thumbnails/category_thumbnails/'.$category['thumbnail']); ?>" class="img-fluid" alt="">
						<div class="info">
							<small><i class="ti-layers"></i>
								<?php echo $this->crud_model->get_category_wise_courses($category['id'])->num_rows().' '.get_phrase('courses'); ?>
							</small>
							<h3><?php echo $category['name']; ?></h3>
						</div>
					</figure>
				</a>
			</div>
			<!-- /grid_item -->
		<?php endforeach; ?>
	</div>
	<div class="row justify-content-center">
		<div class="col-sm-12">
			<img style="max-width: 100%" class="adbanner_box" src="https://via.placeholder.com/1110x240?text=1110x240+Banner" alt="">
		</div>
	</div>
</div>
<!-- Categories end -->

<!-- Blogs start -->
<div class="container margin_30_95">
	<div class="main_title_2">
		<span><em></em></span>
		<h2><?php echo get_phrase('blog'); ?></h2>
	</div>
	<div id="blog_slider" class="flexslider">
		<ul class="slides">
			<li>
				<a href="https://tbv30mblog.waddiwassi.com/ableton-11-hybrid-reverb">
					<img class="adbanner_box" src="https://thebassvalley.com/wp-media/uploads/2021/03/portada-blog-hybrid-reverb_opt-555x330.jpg" alt="">
					<div class="caption">
						<h3>Ableton 11. Hybrid reverb
						</h3>
					</div>
				</a>
			</li>
			<li>
				<a href="https://tbv30mblog.waddiwassi.com/befaco-kickall-the-hype">
					<img class="adbanner_box" src="https://thebassvalley.com/wp-media/uploads/2020/02/thebassvalley_befaco_blogg-555x330.jpg" alt="">
					<div class="caption">
						<h3>Befaco Kickall: The hype</h3>
					</div>
				</a>
			</li>
			<li>
				<a href="https://tbv30mblog.waddiwassi.com/las-3-claves-de-una-eq-perfecta-por-alan-lockwood">
					<img class="adbanner_box" src="https://tbv30mblog.waddiwassi.com/uploads/images/202103/image_650x433_60477b4d655fe.jpg" alt="">
					<div class="caption">
						<h3>Las 3 Claves de una EQ perfecta por Alan Lockwood</h3>
					</div>
				</a>
			</li>
		</ul>
	</div>
</div>
<!-- Blogs end -->
