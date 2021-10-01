<?php
// $param2 = lesson id and $param3 = course id
$subterm_details = $this->crud_model->get_lessons('lesson', $param2)->row_array();
?>
<!-- ACTUAL LESSON ADDING FORM -->
<form action="<?php echo site_url('admin/subterms/'.$param3.'/edit'.'/'.$param2); ?>" method="post">

    <div class="form-group">
        <label><?php echo get_phrase('title'); ?></label>
        <input type="text" name = "title" class="form-control" required value="<?php echo $subterm_details['title']; ?>">
    </div>

    <input type="hidden" name="course_id" value="<?php echo $param3; ?>">

    <div class="text-center">
        <button class = "btn btn-success" type="submit" name="button"><?php echo get_phrase('update_term'); ?></button>
    </div>
</form>
