<?php
$sections = $this->crud_model->get_section('course', $course_id)->result_array();
?>
<div class="row justify-content-center">
    <div class="col-xl-12 pb-4 text-center pt-3" id="float-course-editor">
        <a href="javascript::void(0)" class="btn btn-outline-primary btn-rounded btn-sm ml-1" onclick="showAjaxModal('<?php echo site_url('modal/popup/section_add/'.$course_id); ?>', '<?php echo get_phrase('add_new_section'); ?>')"><i class="mdi mdi-plus"></i> <?php echo get_phrase('add_section'); ?></a>
        <a href="javascript::void(0)" class="btn btn-outline-primary btn-rounded btn-sm ml-1" onclick="showAjaxModal('<?php echo site_url('modal/popup/term_add/'.$course_id); ?>', '<?php echo get_phrase('add_new_term'); ?>')"><i class="mdi mdi-plus"></i> <?php echo get_phrase('add_term'); ?></a>
        <a href="javascript::void(0)" class="btn btn-outline-primary btn-rounded btn-sm ml-1" onclick="showAjaxModal('<?php echo site_url('modal/popup/subterm_add/'.$course_id); ?>', '<?php echo get_phrase('add_new_subterm'); ?>')"><i class="mdi mdi-plus"></i> <?php echo get_phrase('add_subterm'); ?></a>
        <a href="javascript::void(0)" class="btn btn-outline-primary btn-rounded btn-sm ml-1" onclick="showAjaxModal('<?php echo site_url('modal/popup/lesson_types/'.$course_id); ?>', '<?php echo get_phrase('add_new_lesson'); ?>')"><i class="mdi mdi-plus"></i> <?php echo get_phrase('add_lesson'); ?></a>
        <?php if (count($sections) > 0): ?>
            <a href="javascript::void(0)" class="btn btn-outline-primary btn-rounded btn-sm ml-1" onclick="showAjaxModal('<?php echo site_url('modal/popup/quiz_add/'.$course_id); ?>', '<?php echo get_phrase('add_new_quiz'); ?>')"><i class="mdi mdi-plus"></i> <?php echo get_phrase('add_quiz'); ?></a>
            <a href="javascript::void(0)" class="btn btn-outline-primary btn-rounded btn-sm ml-1" onclick="showLargeModal('<?php echo site_url('modal/popup/sort_section/'.$course_id); ?>', '<?php echo get_phrase('sort_sections'); ?>')"><i class="mdi mdi-sort-variant"></i> <?php echo get_phrase('sort_sections'); ?></a>
        <?php endif; ?>
    </div>
    
    <div class="col-xl-8">
        <div class="row">
            <?php
            $lesson_counter = 0;
            $quiz_counter   = 0;
            foreach ($sections as $key => $section):?>
            <div class="col-xl-12">
                <div class="card bg-light text-seconday on-hover-action mb-5" id = "section-<?php echo $section['id']; ?>">
                    <div class="card-body">
                        <h5 class="card-title" class="mb-3" style="min-height: 45px;"><span class="font-weight-light"><?php echo get_phrase('section').' '.++$key; ?></span>: <?php echo $section['title']; ?>
                            <div class="row justify-content-center alignToTitle float-right display-none" id = "widgets-of-section-<?php echo $section['id']; ?>">
                                <button type="button" class="btn btn-outline-secondary btn-rounded btn-sm" name="button" onclick="showLargeModal('<?php echo site_url('modal/popup/sort_lesson/'.$section['id']); ?>', '<?php echo get_phrase('sort_lessons'); ?>')" ><i class="mdi mdi-sort-variant"></i> <?php echo get_phrase('sort_lesson'); ?></button>
                                <button type="button" class="btn btn-outline-secondary btn-rounded btn-sm ml-1" name="button" onclick="showAjaxModal('<?php echo site_url('modal/popup/section_edit/'.$section['id'].'/'.$course_id); ?>', '<?php echo get_phrase('update_section'); ?>')" ><i class="mdi mdi-pencil-outline"></i> <?php echo get_phrase('edit_section'); ?></button>
                                <button type="button" class="btn btn-outline-secondary btn-rounded btn-sm ml-1" name="button" onclick="confirm_modal('<?php echo site_url('admin/sections/'.$course_id.'/delete'.'/'.$section['id']); ?>');"><i class="mdi mdi-window-close"></i> <?php echo get_phrase('delete_section'); ?></button>
                            </div>
                        </h5>
                        <div class="clearfix"></div>
                        <?php
                        // TERM and LESSONS
                        $lessons = $this->crud_model->get_lessons('section', $section['id'])->result_array();
                        $term_counter   = 0;
                        foreach ($lessons as $index => $lesson):?>
                        <?php if ($lesson['lesson_type'] != 'term'): ?>
                            <div class="col-md-12">
                                <!-- Portlet card -->
                                <div class="card text-secondary on-hover-action mb-2" id = "<?php echo 'lesson-'.$lesson['id']; ?>">
                                    <div class="card-body lesson-card-body">
                                        <div class="card-widgets display-none" id = "widgets-of-lesson-<?php echo $lesson['id']; ?>">
                                            <?php if ($lesson['lesson_type'] == 'quiz'): ?>
                                                <a href="javascript::" onclick="showLargeModal('<?php echo site_url('modal/popup/quiz_questions/'.$lesson['id']); ?>', '<?php echo get_phrase('manage_quiz_questions'); ?>')"><i class="mdi mdi-comment-question-outline"></i></a>
                                                <a href="javascript::" onclick="showAjaxModal('<?php echo site_url('modal/popup/quiz_edit/'.$lesson['id'].'/'.$course_id); ?>', '<?php echo get_phrase('update_quiz_information'); ?>')"><i class="mdi mdi-pencil-outline"></i></a>
                                            <?php else: ?>
                                                <a href="javascript::"
                                                    onclick="<?php echo ($lesson['lesson_type'] == 'editable' || $lesson['lesson_type'] == 'video') ? 'showLargeModal': 'showAjaxModal';?>
                                                    ('<?php echo site_url('modal/popup/lesson_edit/'.$lesson['id'].'/'.$course_id); ?>', '<?php echo get_phrase('update_lesson'); ?>')">
                                                    <i class="mdi mdi-pencil-outline"></i>
                                                </a>
                                            <?php endif; ?>
                                            <a href="javascript::" onclick="showAjaxModal('<?php echo site_url('modal/popup/lesson_move/'.$course_id.'/'.$lesson['id']); ?>', '<?php echo get_phrase('move_lesson'); ?>');"><i class="mdi mdi-fountain-pen-tip"></i></a>
                                            <a href="javascript::" onclick="confirm_modal('<?php echo site_url('admin/lessons/'.$course_id.'/delete'.'/'.$lesson['id']); ?>');"><i class="mdi mdi-window-close"></i></a>
                                        </div>
                                        <h5 class="card-title mb-0">
                                            <span class="font-weight-light">
                                                <?php
                                                if ($lesson['lesson_type'] == 'quiz') {
                                                    $quiz_counter++; // Keeps track of number of quiz
                                                    $lesson_type = $lesson['lesson_type'];
                                                }else {
                                                    $lesson_counter++; // Keeps track of number of lesson
                                                    if ($lesson['attachment_type'] == 'txt' || $lesson['attachment_type'] == 'pdf' || $lesson['attachment_type'] == 'doc' || $lesson['attachment_type'] == 'img' || $lesson['attachment_type'] == 'editable') {
                                                        $lesson_type = $lesson['attachment_type'];
                                                    }else {
                                                        $lesson_type = 'video';
                                                    }
                                                }
                                                ?>
                                                <img src="<?php echo base_url('assets/backend/lesson_icon/'.$lesson_type.'.png'); ?>" alt="" height = "16">
                                                <?php echo $lesson['lesson_type'] == 'quiz' ? get_phrase('quiz').' '.$quiz_counter : get_phrase('lesson').' '.$lesson_counter; ?>
                                            </span>: <?php echo $lesson['title']; ?>
                                        </h5>
                                    </div>
                                </div> <!-- end card-->
                            </div>
                        <?php else: ?>
                            <div class="col-md-12">
                                <!-- Portlet card -->
                                <div class="card text-secondary on-hover-action mb-2" style="border-left: 4px solid #05ABF4;" id = "<?php echo 'lesson-'.$lesson['id']; ?>">
                                    <div class="card-body lesson-card-body">
                                        <div class="card-widgets display-none" id = "widgets-of-lesson-<?php echo $lesson['id']; ?>">
                                            <a href="javascript::" onclick="showLargeModal('<?php echo site_url('modal/popup/sort_sublesson/'.$lesson['id'].'/'.$course_id); ?>', '<?php echo get_phrase('sort_lessons'); ?>')"><i class="mdi mdi-sort-variant"></i></a>
                                            <a href="javascript::" onclick="showAjaxModal('<?php echo site_url('modal/popup/term_edit/'.$lesson['id'].'/'.$course_id); ?>', '<?php echo get_phrase('update_term'); ?>')"><i class="mdi mdi-pencil-outline"></i></a>
                                            <a href="javascript::" onclick="showAjaxModal('<?php echo site_url('modal/popup/term_move/'.$course_id.'/'.$lesson['id']); ?>', '<?php echo get_phrase('move_term'); ?>')"><i class="mdi mdi-fountain-pen-tip"></i></a>
                                            <a href="javascript::" onclick="confirm_modal('<?php echo site_url('admin/terms/'.$course_id.'/delete'.'/'.$lesson['id']); ?>');"><i class="mdi mdi-window-close"></i></a>
                                        </div>
                                        <h5 class="card-title mb-0">
                                            <span class="font-weight-light">
                                                <?php
                                                    $term_counter++; // Keeps track of number of quiz
                                                ?>
                                                <img src="<?php echo base_url('assets/backend/lesson_icon/term.png'); ?>" alt="" height = "16">
                                                <?php echo get_phrase('term').' '.$term_counter; ?>
                                            </span>: <?php echo $lesson['title']; ?>
                                        </h5>
                                    </div>
                                </div> <!-- end card-->
                            </div>
                            <?php
                            // SUBTERM and LESSONS
                            $subterm_lessons = $this->crud_model->get_lessons('section', $lesson['id'], 'les')->result_array();
                            $subterm_count = 0;
                            foreach ($subterm_lessons as $index => $lesson):?>
                            <?php if ($lesson['lesson_type'] != 'subterm'): ?>
                                <div class="col-md-12">
                                    <!-- Portlet card -->
                                    <div class="card text-secondary on-hover-action mb-2 ml-4" id = "<?php echo 'lesson-'.$lesson['id']; ?>">
                                        <div class="card-body lesson-card-body">
                                            <div class="card-widgets display-none" id = "widgets-of-lesson-<?php echo $lesson['id']; ?>">
                                                <?php if ($lesson['lesson_type'] == 'quiz'): ?>
                                                    <a href="javascript::" onclick="showLargeModal('<?php echo site_url('modal/popup/quiz_questions/'.$lesson['id']); ?>', '<?php echo get_phrase('manage_quiz_questions'); ?>')"><i class="mdi mdi-comment-question-outline"></i></a>
                                                    <a href="javascript::" onclick="showAjaxModal('<?php echo site_url('modal/popup/quiz_edit/'.$lesson['id'].'/'.$course_id); ?>', '<?php echo get_phrase('update_quiz_information'); ?>')"><i class="mdi mdi-pencil-outline"></i></a>
                                                <?php else: ?>
                                                    <a href="javascript::"
                                                        onclick="<?php echo ($lesson['lesson_type'] == 'editable' || $lesson['lesson_type'] == 'video') ? 'showLargeModal': 'showAjaxModal';?>
                                                        ('<?php echo site_url('modal/popup/lesson_edit/'.$lesson['id'].'/'.$course_id); ?>', '<?php echo get_phrase('update_lesson'); ?>')">
                                                        <i class="mdi mdi-pencil-outline"></i>
                                                    </a>
                                                <?php endif; ?>
                                                <a href="javascript::" onclick="showAjaxModal('<?php echo site_url('modal/popup/lesson_move/'.$course_id.'/'.$lesson['id']); ?>', '<?php echo get_phrase('move_lesson'); ?>');"><i class="mdi mdi-fountain-pen-tip"></i></a>
                                                <a href="javascript::" onclick="confirm_modal('<?php echo site_url('admin/lessons/'.$course_id.'/delete'.'/'.$lesson['id']); ?>');"><i class="mdi mdi-window-close"></i></a>
                                            </div>
                                            <h5 class="card-title mb-0">
                                                <span class="font-weight-light">
                                                    <?php
                                                    if ($lesson['lesson_type'] == 'quiz') {
                                                        $quiz_counter++; // Keeps track of number of quiz
                                                        $lesson_type = $lesson['lesson_type'];
                                                    }else {
                                                        $lesson_counter++; // Keeps track of number of lesson
                                                        if ($lesson['attachment_type'] == 'txt' || $lesson['attachment_type'] == 'pdf' || $lesson['attachment_type'] == 'doc' || $lesson['attachment_type'] == 'img' || $lesson['attachment_type'] == 'editable') {
                                                            $lesson_type = $lesson['attachment_type'];
                                                        }else {
                                                            $lesson_type = 'video';
                                                        }
                                                    }
                                                    ?>
                                                    <img src="<?php echo base_url('assets/backend/lesson_icon/'.$lesson_type.'.png'); ?>" alt="" height = "16">
                                                    <?php echo $lesson['lesson_type'] == 'quiz' ? get_phrase('quiz').' '.$quiz_counter : get_phrase('lesson').' '.$lesson_counter; ?>
                                                </span>: <?php echo $lesson['title']; ?>
                                            </h5>
                                        </div>
                                    </div> <!-- end card-->
                                </div>
                            <?php else: ?>
                                <div class="col-md-12">
                                    <!-- Portlet card -->
                                    <div class="card text-secondary on-hover-action mb-2 ml-4" style="border-left: 4px solid #A42037;" id = "<?php echo 'lesson-'.$lesson['id']; ?>">
                                        <div class="card-body lesson-card-body">
                                            <div class="card-widgets display-none" id = "widgets-of-lesson-<?php echo $lesson['id']; ?>">
                                                <a href="javascript::" onclick="showLargeModal('<?php echo site_url('modal/popup/sort_sublesson/'.$lesson['id'].'/'.$course_id); ?>', '<?php echo get_phrase('sort_lessons'); ?>')"><i class="mdi mdi-sort-variant"></i></a>
                                                <a href="javascript::" onclick="showAjaxModal('<?php echo site_url('modal/popup/subterm_edit/'.$lesson['id'].'/'.$course_id); ?>', '<?php echo get_phrase('update_subterm'); ?>')"><i class="mdi mdi-pencil-outline"></i></a>
                                                <a href="javascript::" onclick="showAjaxModal('<?php echo site_url('modal/popup/subterm_move/'.$course_id.'/'.$lesson['id']); ?>', '<?php echo get_phrase('move_subterm'); ?>')"><i class="mdi mdi-fountain-pen-tip"></i></a>
                                                <a href="javascript::" onclick="confirm_modal('<?php echo site_url('admin/subterms/'.$course_id.'/delete'.'/'.$lesson['id']); ?>');"><i class="mdi mdi-window-close"></i></a>
                                            </div>
                                            <h5 class="card-title mb-0">
                                                <span class="font-weight-light">
                                                    <?php
                                                        $subterm_count++; // Keeps track of number of quiz
                                                    ?>
                                                    <img src="<?php echo base_url('assets/backend/lesson_icon/subterm.png'); ?>" alt="" height = "16">
                                                    <?php echo get_phrase('subterm').' '.$subterm_count; ?>
                                                </span>: <?php echo $lesson['title']; ?>
                                            </h5>
                                        </div>
                                    </div> <!-- end card-->
                                </div>
                                <?php
                                // Subterm_lessons
                                $lessons = $this->crud_model->get_lessons('section', $lesson['id'], 'les')->result_array();
                                foreach ($lessons as $index => $lesson):?>
                                    <div class="col-md-12">
                                        <!-- Portlet card -->
                                        <div class="card text-secondary on-hover-action mb-2" style="margin-left: 5rem;" id ="<?php echo 'lesson-'.$lesson['id']; ?>">
                                            <div class="card-body lesson-card-body">
                                                <div class="card-widgets display-none" id = "widgets-of-lesson-<?php echo $lesson['id']; ?>">

                                                    <?php if ($lesson['lesson_type'] == 'quiz'): ?>
                                                        <a href="javascript::" onclick="showLargeModal('<?php echo site_url('modal/popup/quiz_questions/'.$lesson['id']); ?>', '<?php echo get_phrase('manage_quiz_questions'); ?>')"><i class="mdi mdi-comment-question-outline"></i></a>
                                                        <a href="javascript::" onclick="showAjaxModal('<?php echo site_url('modal/popup/quiz_edit/'.$lesson['id'].'/'.$course_id); ?>', '<?php echo get_phrase('update_quiz_information'); ?>')"><i class="mdi mdi-pencil-outline"></i></a>
                                                    <?php else: ?>
                                                        <a href="javascript::"
                                                            onclick="<?php echo ($lesson['lesson_type'] == 'editable' || $lesson['lesson_type'] == 'video') ? 'showLargeModal': 'showAjaxModal';?>
                                                            ('<?php echo site_url('modal/popup/lesson_edit/'.$lesson['id'].'/'.$course_id); ?>', '<?php echo get_phrase('update_lesson'); ?>')">
                                                            <i class="mdi mdi-pencil-outline"></i>
                                                        </a>
                                                    <?php endif; ?>
                                                    <a href="javascript::" onclick="showAjaxModal('<?php echo site_url('modal/popup/lesson_move/'.$course_id.'/'.$lesson['id']); ?>', '<?php echo get_phrase('move_lesson'); ?>');"><i class="mdi mdi-fountain-pen-tip"></i></a>
                                                    <a href="javascript::" onclick="confirm_modal('<?php echo site_url('admin/lessons/'.$course_id.'/delete'.'/'.$lesson['id']); ?>');"><i class="mdi mdi-window-close"></i></a>
                                                </div>
                                                <h5 class="card-title mb-0">
                                                    <span class="font-weight-light">
                                                        <?php
                                                        if ($lesson['lesson_type'] == 'quiz') {
                                                            $quiz_counter++; // Keeps track of number of quiz
                                                            $lesson_type = $lesson['lesson_type'];
                                                        }else {
                                                            $lesson_counter++; // Keeps track of number of lesson
                                                            if ($lesson['attachment_type'] == 'txt' || $lesson['attachment_type'] == 'pdf' || $lesson['attachment_type'] == 'doc' || $lesson['attachment_type'] == 'img' || $lesson['attachment_type'] == 'editable') {
                                                                $lesson_type = $lesson['attachment_type'];
                                                            }else {
                                                                $lesson_type = 'video';
                                                            }
                                                        }
                                                        ?>
                                                        <img src="<?php echo base_url('assets/backend/lesson_icon/'.$lesson_type.'.png'); ?>" alt="" height = "16">
                                                        <?php echo $lesson['lesson_type'] == 'quiz' ? get_phrase('quiz').' '.$quiz_counter : get_phrase('lesson').' '.$lesson_counter; ?>
                                                    </span>: <?php echo $lesson['title']; ?>
                                                </h5>
                                            </div>
                                        </div> <!-- end card-->
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>
    <?php endforeach; ?>
</div>
</div>
</div>

<script type="text/javascript">
$(document).ready(function () {
    var element = $("#float-course-editor");
    var topDist = -1;
    $(document).scroll(function () {
        var scroll = $(this).scrollTop();
        if (topDist < 0) {
            topDist = element.offset();
        }
        if (scroll > topDist.top) {
            element.addClass('float-course-editor-sticky');
            element.width(element.parent().width() - 30);
        } else {
            element.removeClass('float-course-editor-sticky');
        }
    });
});
</script>