<div class="container-fluid margin_120_0">
  <div class="main_title_2">
    <span><em></em></span>
    <h2><?php echo get_phrase('top_courses'); ?></h2>
    <p><?php echo get_phrase('pick_according_to_your_choice'); ?>.</p>
  </div>
  <div class="owl-carousel-div owl-carousel owl-theme">
    <?php $top_courses = $this->crud_model->get_top_courses()->result_array();
    $cart_items = $this->session->userdata('cart_items');
    foreach ($top_courses as $top_course):?>
    <!-- Each Top Course Starts -->
    <div class="item">
      <div class="box_grid">
        <figure>
          <a href="javascript::" class="wishlist-btn wishlist-btn-<?php echo $top_course['id']; ?> <?php if($this->crud_model->is_added_to_wishlist($top_course['id'])):?> active <?php endif; ?> tooltip" onclick="handleWishList(this)" id = "<?php echo $top_course['id']; ?>">
            <i class="fas fa-heart"></i>
            <span class="tooltiptext" id = "tooltiptext-<?php echo $top_course['id']; ?>">
              <?php if($this->crud_model->is_added_to_wishlist($top_course['id'])):?>
                <?php echo get_phrase('remove_from_wishlist'); ?>
              <?php else: ?>
                <?php echo get_phrase('add_to_wishlist'); ?>
              <?php endif; ?>
            </span>
          </a>
          <a href="<?php echo site_url('home/course/'.slugify($top_course['title']).'/'.$top_course['id']); ?>">
            <div class="preview"><span><?php echo get_phrase('preview_course'); ?></span></div><img src="<?php echo $this->crud_model->get_course_thumbnail_url($top_course['id']); ?>" class="img-fluid" alt=""></a>
            <?php if ($top_course['is_free_course'] == 1): ?>
              <div class="price"><?php echo get_phrase('free'); ?></div>
            <?php else: ?>
              <?php if ($top_course['discount_flag'] == 1): ?>
                <div class="price"><?php echo currency($top_course['discounted_price']); ?></div>
              <?php else: ?>
                <div class="price"><?php echo currency($top_course['price']); ?></div>
              <?php endif; ?>
            <?php endif; ?>
          </figure>
          <div class="wrapper">
            <small>
              <?php
              $sub_category_details = $this->crud_model->get_category_details_by_id($top_course['sub_category_id'])->row_array();
              echo $sub_category_details['name'];
              ?>
            </small>
            <h3><?php echo $top_course['title'] ?></h3>
            <p><?php echo ellipsis($top_course['short_description'], 150); ?></p>
            <div class="rating">
              <?php
              $total_rating =  $this->crud_model->get_ratings('course', $top_course['id'], true)->row()->rating;
              $number_of_ratings = $this->crud_model->get_ratings('course', $top_course['id'])->num_rows();
              if ($number_of_ratings > 0) {
                $average_ceil_rating = ceil($total_rating / $number_of_ratings);
              }else {
                $average_ceil_rating = 0;
              }
              for($i = 1; $i < 6; $i++):?>
              <?php if ($i <= $average_ceil_rating): ?>
                <i class="icon_star voted"></i>
              <?php else: ?>
                <i class="icon_star"></i>
              <?php endif; ?>
            <?php endfor; ?>
            <small>(<?php echo $number_of_ratings; ?>)</small>
          </div>
        </div>
        <ul>
          <li>
            <i class="icon-play-circled2"></i><?php echo $this->crud_model->get_lessons('lesson_count_in_course', $top_course['id'])->num_rows().' '.get_phrase('lessons'); ?>
          </li>
          <li>
            <!-- <i class="icon_clock_alt"></i> -->
            <?php
            $total_duration = 0;
            $lessons = $this->crud_model->get_lessons('course', $top_course['id'])->result_array();
            foreach ($lessons as $lesson) {
              if ($lesson['lesson_type'] != "other") {
                $time_array = explode(':', $lesson['duration']);
                $hour_to_seconds = $time_array[0] * 60 * 60;
                $minute_to_seconds = $time_array[1] * 60;
                $seconds = $time_array[2];
                $total_duration += $hour_to_seconds + $minute_to_seconds + $seconds;
              }
            }
            // echo gmdate("H:i:s", $total_duration);
            // echo readable_time_for_humans(gmdate("H:i:s", $total_duration));
            ?>
          </li>
          <li>
            <?php if (is_purchased($top_course['id'])): ?>
              <a href="<?php echo site_url('home/my_courses'); ?>"><i class="icon-check-1"></i> <?php echo get_phrase('purchased'); ?></a>
            <?php else: ?>
              <?php if ($top_course['is_free_course'] == 1):
                if($this->session->userdata('user_login') != 1) {
                  $url = "javascript::";
                }else {
                  $url = site_url('home/get_enrolled_to_free_course/'.$top_course['id']);
                }?>
                <a href="<?php echo $url; ?>" class="" onclick="handleEnrolledButton()"><?php echo get_phrase('enrol'); ?></a>
              <?php else: ?>
                <a href="javascript::" class="big-cart-button-<?php echo $top_course['id'];?> <?php if(in_array($top_course['id'], $cart_items)) echo 'addedToCart'; ?>" id = "<?php echo $top_course['id']; ?>" onclick="handleCartItems(this)">
                  <?php
                  if(in_array($top_course['id'], $cart_items))
                  echo get_phrase('added_to_cart');
                  else
                  echo get_phrase('add_to_cart');
                  ?>
                </a>
              <?php endif; ?>
            <?php endif; ?>
          </li>
        </ul>
      </div>
    </div>
    <!-- Each Top Course Ends -->
  <?php endforeach; ?>
  <div class="item">
    <div class="box_grid" style="width: 70%; margin-left: auto; margin-right: auto;">
      <div>
        <img class="adbanner_box" src="https://via.placeholder.com/280x476?text=280x476+Banner" alt="">
      </div>
    </div>
  </div>        
</div>
<!-- /carousel -->
<div class="container">
  <p class="btn_home_align"><a href="<?php echo site_url('home/courses'); ?>" class="btn_1 rounded"><?php echo get_phrase('view_all_courses'); ?></a></p>
</div>
<!-- /container -->
<hr>
</div>
