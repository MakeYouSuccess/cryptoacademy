<?php
// $param2 IS FOR COURSE ID AND $param3 IS FOR LESSON TYPE
$sections = $this->crud_model->get_section('course', $param2)->result_array();
$terms = count($sections) > 0 ? $this->api_model->terms_get($sections[0]['id']) : $this->api_model->terms_get(0);
?>
<!-- ACTUAL LESSON ADDING FORM -->
<form action="<?php echo site_url('admin/lessons/'.$param2.'/move'.'/'.$param3); ?>" method="post" enctype="multipart/form-data">    
    <div class="form-group">
        <label><?php echo get_phrase('section'); ?></label>
        <select class="form-control select2" data-toggle="select2" name="section_id" id="section_id" required>
            <?php foreach ($sections as $section): ?>
                <option value="<?php echo $section['id']; ?>"><?php echo $section['title']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label><?php echo get_phrase('term'); ?></label>
        <select class="form-control select2" data-toggle="select2" name="term_id" id="term_id" required>
            <option value="-1"><?php echo get_phrase('select...'); ?></option>
            <?php foreach ($terms as $term): ?>
                <option value="<?php echo $term['id']; ?>"><?php echo $term['title']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label><?php echo get_phrase('subterm'); ?></label>
        <select class="form-control select2" data-toggle="select2" name="subterm_id" id="subterm_id" required>
            <option value="-1"><?php echo get_phrase('select...'); ?></option>
        </select>
    </div>

    <div class="text-center">
        <button class = "btn btn-success" type="submit" name="button"><?php echo get_phrase('move_lesson'); ?></button>
    </div>
</form>

<script type="text/javascript">
$(document).ready(function() {
    initSelect2(['#section_id', 'term_id', 'subterm_id', '#lesson_type', '#lesson_provider', '#lesson_provider_for_mobile_application']);
    initTimepicker();

    // HIDING THE SEARCHBOX FROM SELECT2
    $('select').select2({
        minimumResultsForSearch: -1
    });

    $('#section_id').on('select2:select', function (e) {
        onSectionSelect(e.params.data.id, 'terms');
    });
    $('#term_id').on('select2:select', function (e) {
        onSectionSelect(e.params.data.id, 'subterms');
    });
});
function onSectionSelect(sectionId, type) {
    $.ajax({
        url: "<?php echo site_url('api/'); ?>" + type + '/' + sectionId,
        type : 'POST',
        success: function(response)
        {
            if (type == 'terms') {
                $('#term_id').empty().trigger("change");
                var newOption = new Option("<?php echo get_phrase('select...'); ?>", -1, false, false);
                $('#term_id').append(newOption).trigger('change');

                for(var i = 0 ; i < response.length; i++) {
                    var newOption = new Option(response[i].title, response[i].id, false, false);
                    $('#term_id').append(newOption).trigger('change');
                }

                $('#subterm_id').empty().trigger("change");
                var newOption = new Option("<?php echo get_phrase('select...'); ?>", -1, false, false);
                $('#subterm_id').append(newOption).trigger('change');

            } else if (type == 'subterms') {
                $('#subterm_id').empty().trigger("change");
                var newOption = new Option("<?php echo get_phrase('select...'); ?>", -1, false, false);
                $('#subterm_id').append(newOption).trigger('change');
                
                for(var i = 0 ; i < response.length; i++) {
                    var newOption = new Option(response[i].title, response[i].id, false, false);
                    $('#subterm_id').append(newOption).trigger('change');
                }
            }
        }
    });
}
