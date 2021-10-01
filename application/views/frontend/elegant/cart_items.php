<?php
  $banners = themeConfiguration(get_frontend_settings('theme'), 'banners');
  $shopping_cart_banner = $banners['shopping_cart_banner'];
?>
<section id="hero_in" class="general">
  <div class="banner-img" style="background: url(<?php echo base_url($shopping_cart_banner); ?>) center center no-repeat;"></div>
  <div class="wrapper">
    <div class="container">
      <h1 class="fadeInUp"><span></span><?php echo get_phrase('shopping_cart'); ?></h1>
    </div>
  </div>
</section>

<div class="bg_color_1">
  <div class="container margin_60_35">
    <div class="row">
      <div class="col-lg-8">
        <div class="box_cart">
          <table class="table table-striped cart-list">
            <thead>
              <tr>
                <th>
                  <?php echo get_phrase('item'); ?>
                </th>
                <th>
                  <?php echo get_phrase('discount'); ?>
                </th>
                <th>
                  <?php echo get_phrase('price'); ?>
                </th>
                <th>
                  <?php echo get_phrase('actions'); ?>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php
              $amount_to_pay = 0;
              foreach ($this->session->userdata('cart_items') as $cart_item):
                $course_details = $this->crud_model->get_course_by_id($cart_item)->row_array();
                ?>
                <tr>
                  <td>
                    <div class="thumb_cart">
                      <img src="<?php echo $this->crud_model->get_course_thumbnail_url($course_details['id']); ?>" alt="Image">
                    </div>
                    <span class="item_cart"><a href="<?php echo site_url('home/course/'.slugify($course_details['title']).'/'.$course_details['id']); ?>"><?php echo ellipsis($course_details['title'], 30); ?></a></span>
                  </td>
                  <?php if ($course_details['is_free_course'] == 1): ?>
                    <td>
                      100%
                    </td>
                    <td>
                      <strong><?php echo get_phrase('free'); ?></strong>
                    </td>
                  <?php else: ?>
                    <?php if ($course_details['discount_flag'] == 1): ?>
                      <td>
                        <?php echo number_format((float)((($course_details['price'] - $course_details['discounted_price']) * 100))/$course_details['price'], 2, '.', '').' %'; ?>
                      </td>
                      <td>
                        <strong>
                          <?php
                            $amount_to_pay = $amount_to_pay + $course_details['discounted_price'];
                            echo currency($course_details['discounted_price']);
                          ?>
                        </strong>
                      </td>
                    <?php else: ?>
                      <td>
                        0%
                      </td>
                      <td>
                        <strong>
                          <?php
                            $amount_to_pay = $amount_to_pay + $course_details['price'];
                            echo currency($course_details['price']);
                          ?>
                        </strong>
                      </td>
                    <?php endif; ?>
                  <?php endif; ?>
                  <td class="options" style="width:5%; text-align:center;">
                    <a href="javascript::" id = "<?php echo $course_details['id']; ?>" onclick="removeFromCartList(this)"><i class="icon-trash"></i></a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          <!-- /cart-options -->
        </div>
      </div>
      <!-- /col -->

      <aside class="col-lg-4" id="sidebar">
        <div class="box_detail">
          <div id="total_cart">
            Total <span class="float-right"><?php echo currency($amount_to_pay); ?></span>
            <span id = "total_price_of_checking_out" hidden><?php echo $amount_to_pay; $this->session->set_userdata('total_price_of_checking_out', $amount_to_pay);?></span>
          </div>
          <div class="add_bottom_30"></div>
          <?php if ($amount_to_pay > 0): ?>
            <a href="javascript::" onclick="handleCheckOut()" class="btn_1 full-width"><?php echo get_phrase('checkout'); ?></a>
            <a href="<?php echo site_url('home/courses'); ?>" class="btn_1 full-width outline"><i class="icon-right"></i> <?php echo get_phrase('continue_shopping'); ?></a>
          <?php endif; ?>
        </div>
      </aside>
    </div>
    <!-- /row -->
  </div>
  <!-- /container -->
</div>
<!-- /bg_color_1 -->
