<header class="header menu_2 d-print-none">
  <div id="preloader"><div data-loader="circle-side"></div></div><!-- /Preload -->
  <div id="logo">
    <a href="<?php echo site_url('home'); ?>"><img src="<?php echo base_url().'uploads/system/logo-light.png'; ?>" height="42" data-retina="true" alt=""></a>
  </div>
  <ul id="top_menu">
    <li class="desktop_show"><a href="<?php echo site_url('home/shopping_cart'); ?>" class="shopping_cart"><?php echo get_phrase('shopping_cart'); ?></a></li>
    <li class="desktop_show"><a href="#0" class="search-overlay-menu-btn"><?php echo get_phrase('search'); ?></a></li>
    <?php if ($this->session->userdata('user_login') == 1 || $this->session->userdata('admin_login') == 1): ?>
      <li class=""><a href="<?php echo site_url('login/logout'); ?>" class="btn_1 rounded"><?php echo get_phrase('log_out'); ?></a></li>
    <?php else: ?>
      <li class=""><a href="<?php echo site_url('home/login'); ?>" class="btn_1 rounded"><?php echo get_phrase('login'); ?></a></li>
    <?php endif; ?>
  </ul>
  <!-- /top_menu -->
  <div id="top_menu">
    <a href="#menu" class="btn_mobile">
      <div class="hamburger hamburger--spin" id="hamburger">
        <div class="hamburger-box">
          <div class="hamburger-inner"></div>
        </div>
      </div>
    </a>
  </div>
  <nav id="menu" class="main-menu">
    <ul>
      <li><span><a href="<?php echo site_url('home'); ?>"><?php echo get_phrase('home'); ?></a></span></li>
      <li>
        <span><a href="javascript::"><?php echo get_phrase('courses'); ?></a></span>
        <ul>
          <?php
            $parent_categories = $this->crud_model->get_categories()->result_array();
            foreach ($parent_categories as $key => $parent_category): ?>
            <li><a href="<?php echo site_url('home/courses?category='.$parent_category['slug']); ?>"><?php echo $parent_category['name']; ?></a></li>
          <?php endforeach; ?>
          <li class="highlighter-menu"><a href="<?php echo site_url('home/courses'); ?>"><?php echo get_phrase('all_courses'); ?></a></li>
        </ul>
      </li>
      <li><span><a href="https://tbv30mblog.waddiwassi.com"><?php echo get_phrase('blog'); ?></a></span></li>
      <li class="mobile_show"><span><a href="<?php echo site_url('home/shopping_cart'); ?>"><?php echo get_phrase('shopping_cart'); ?></a></span></li>
      <?php if ($this->session->userdata('admin_login') == 1): ?>
        <li><span><a href="<?php echo site_url('admin'); ?>"><?php echo get_phrase('administrator'); ?></a></span></li>
      <?php elseif ($this->session->userdata('user_login') == 1 && get_settings('allow_instructor') == 1): ?>
        <li><span><a href="<?php echo site_url('user'); ?>"><?php echo get_phrase('instructor'); ?></a></span></li>
      <?php endif; ?>

    <!-- Show an onrdinary students options -->
    <?php if ($this->session->userdata('user_login') == 1): ?>
      <li>
        <span><a href="javascript::"><?php echo get_phrase('manage_account'); ?></a></span>
        <ul>
          <li><a href="<?php echo site_url('home/my_courses'); ?>"><?php echo get_phrase('my_courses'); ?></a></li>
          <li><a href="<?php echo site_url('home/my_wishlist'); ?>"><?php echo get_phrase('my_wishlist'); ?></a></li>
          <li><a href="<?php echo site_url('home/my_messages'); ?>"><?php echo get_phrase('my_messages'); ?></a></li>
          <li><a href="<?php echo site_url('home/purchase_history'); ?>"><?php echo get_phrase('purchase_history'); ?></a></li>
          <li><a href="<?php echo site_url('home/profile/user_profile'); ?>"><?php echo get_phrase('user_profile'); ?></a></li>
        </ul>
      </li>
    <?php endif; ?>
  </ul>
</nav>
<!-- Search Menu -->
<div class="search-overlay-menu">
  <span class="search-overlay-close"><span class="closebt"><i class="ti-close"></i></span></span>
  <form action="<?php echo site_url('home/search'); ?>" role="search" id="searchform" method="get">
    <input value="" name="query" type="search" placeholder="<?php echo get_phrase('search'); ?>..." />
    <button type="submit"><i class="icon_search"></i>
    </button>
  </form>
</div><!-- End Search Menu -->
</header>
