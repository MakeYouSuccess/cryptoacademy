<?php
    $blog_category = $this->crud_model->get_blog_category()->result_array();
?>
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('manage_blog_category') ?></h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">
                    <?php echo get_phrase('blog_category_list'); ?>
                </h4>

                <div class="row w-100">
                    <div class="col-xl-12">
                        <form class="required-form" action="<?php echo site_url('admin/blog_category_update'); ?>" method="post">
                            <div id="basicwizard">
                                <div class="row justify-content-center">
                                    <div class="col-xl-8">
                                        <div class="form-group row mb-3">
                                            <label class="col-md-2 col-form-label" for="categories"><?php echo get_phrase('blog_categories'); ?></label>
                                            <div class="col-md-10">
                                                <div id = "category_area">
                                                    <?php if (count($blog_category) > 0): ?>
                                                        <?php
                                                        $counter = 0;
                                                        foreach ($blog_category as $category):?>
                                                        <?php if ($counter == 0):
                                                            $counter++; ?>
                                                            <div class="d-flex mt-2">
                                                                <div class="flex-grow-1 px-3">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="categories[]" placeholder="<?php echo get_phrase('fill_category_name'); ?>" value="<?php echo $category['name']; ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="">
                                                                    <button type="button" class="btn btn-success btn-sm" style="" name="button" onclick="appendCategory()"> <i class="fa fa-plus"></i> </button>
                                                                </div>
                                                            </div>
                                                        <?php else: ?>
                                                            <div class="d-flex mt-2">
                                                                <div class="flex-grow-1 px-3">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="categories[]" placeholder="<?php echo get_phrase('fill_category_name'); ?>" value="<?php echo $category['name']; ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="">
                                                                    <button type="button" class="btn btn-danger btn-sm" style="margin-top: 0px;" name="button" onclick="removeCategory(this)"> <i class="fa fa-minus"></i> </button>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <div class="d-flex mt-2">
                                                        <div class="flex-grow-1 px-3">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" name="categories[]" placeholder="<?php echo get_phrase('fill_category_name'); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="">
                                                            <button type="button" class="btn btn-success btn-sm" style="" name="button" onclick="appendCategory()"> <i class="fa fa-plus"></i> </button>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>

                                                <div id = "blank_category_field">
                                                    <div class="d-flex mt-2">
                                                        <div class="flex-grow-1 px-3">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" name="categories[]" id="categories" placeholder="<?php echo get_phrase('fill_category_name'); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="">
                                                            <button type="button" class="btn btn-danger btn-sm" style="margin-top: 0px;" name="button" onclick="removeCategory(this)"> <i class="fa fa-minus"></i> </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="finish">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="text-center">
                                            <div class="mb-3 mt-3">
                                                <button type="button" class="btn btn-primary text-center" onclick="checkRequiredFields()"><?php echo get_phrase('update'); ?></button>
                                            </div>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                            </div>
                        </div> <!-- tab-content -->
                    </div> <!-- end #progressbarwizard-->
                </form>
            </div>
        </div><!-- end row-->
    </div> <!-- end card-body-->
</div> <!-- end card-->
</div>
</div>

<script type="text/javascript">
var blank_category = jQuery('#blank_category_field').html();
jQuery(document).ready(function() {
    jQuery('#blank_category_field').hide();
});
function appendCategory() {
    jQuery('#category_area').append(blank_category);
}
function removeCategory(categoryElem) {
    jQuery(categoryElem).parent().parent().remove();
}
</script>
