<?php
    $blog_category = $this->crud_model->get_blog_category()->result_array();
?>
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('blogs') ?></h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">
                    <?php echo get_phrase('blog_list'); ?>
                </h4>

                <div class="row w-100">
                    <div class="col-xl-12">
                        <form class="required-form" action="<?php echo site_url('admin/blog_category_update'); ?>" method="post">
                            <div id="basicwizard">
                                <div class="row justify-content-center">
                                    <div class="col-xl-8">
                                        <div class="form-group row mb-3">
                                            <label class="col-md-2 col-form-label" for="blog_title"><?php echo get_phrase('blog_title'); ?><span class="required">*</span></label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" id="blog_title" name = "title" placeholder="<?php echo get_phrase('enter_blog_title'); ?>" value="<?php echo $course_details['title']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-md-2 col-form-label" for="blog_category"><?php echo get_phrase('category'); ?><span class="required">*</span></label>
                                            <div class="col-md-10">
                                                <select class="form-control select2" data-toggle="select2" name="blog_categories[]" id="blog_category" required multiple="multiple">
                                                    <?php foreach($blog_category as $key => $category): ?>
                                                        <option value="<?=$category['id']?>" <?php if($key == 0) echo 'selected'; ?>>
                                                            <?=$category['name']?>
                                                        </option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-md-2 col-form-label" for="content"><?php echo get_phrase('content'); ?><span class="required">*</span></label>
                                            <div class="col-md-10">
                                                <textarea name="content" id = "content" class="form-control" required>abc</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end row -->
                            </div>
                            <div class="tab-pane" id="finish">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="text-center">
                                            <div class="mb-3 mt-3">
                                                <button type="button" class="btn btn-primary text-center" onclick="checkRequiredFields()"><?php echo get_phrase('add'); ?></button>
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
$(document).ready(function () {
    initSummerNoteEx(['#content']);
});
</script>