<?php
$sections = $this->crud_model->get_section('course', $param2)->result_array();
$terms = count($sections) > 0 ? $this->api_model->terms_get($sections[0]['id']) : $this->api_model->terms_get(0);
?>
<form action="<?php echo site_url('admin/subterms/'.$param2.'/add'); ?>" method="post">
    <div class="form-group">
        <label for="title"><?php echo get_phrase('subterm_title'); ?></label>
        <input class="form-control" type="text" name="title" id="title" required>
    </div>
    <div class="form-group">
        <label for="section_id"><?php echo get_phrase('section'); ?></label>
        <select class="form-control select2" data-toggle="select2" name="section_id" id="section_id" required>
            <?php foreach ($sections as $section): ?>
                <option value="<?php echo $section['id']; ?>"><?php echo $section['title']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="term_id"><?php echo get_phrase('term'); ?></label>
        <select class="form-control select2" data-toggle="select2" name="term_id" id="term_id" required>
            <?php foreach ($terms as $term): ?>
                <option value="<?php echo $term['id']; ?>"><?php echo $term['title']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="text-center">
        <button class = "btn btn-success" type="submit" name="button"><?php echo get_phrase('submit'); ?></button>
    </div>
</form>
<script type="text/javascript">

function onSectionSelect(sectionId) {
    $.ajax({
        url: "<?php echo site_url('api/terms/'); ?>" + sectionId,
        type : 'POST',
        success: function(response)
        {
            $('#term_id').empty().trigger("change");
            for(var i = 0 ; i < response.length; i++) {
                var newOption = new Option(response[i].title, response[i].id, false, false);
                $('#term_id').append(newOption).trigger('change');
            }
        }
    });
}

$(document).ready(function() {
    initSelect2(['#section_id', '#term_id']);

    $('#section_id').on('select2:select', function (e) {
        onSectionSelect(e.params.data.id);
    });
});
</script>
