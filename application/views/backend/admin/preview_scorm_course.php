<?php
	$scorm_course_content_url = "";
	$user_id = $this->session->userdata('user_id');

	if($this->session->userdata('admin_login') == 1 || $this->crud_model->get_course_by_id($param2)->row('user_id') == $user_id){
         $scorm_curriculum = $this->db->get_where('scorm_curriculum', array('course_id' => $param2))->row_array();
    }else{
		$scorm_curriculum['scorm_provider'] = null;
	}

	if($scorm_curriculum['scorm_provider'] == 'ispring'):
		$ispring_xml = simplexml_load_file("uploads/scorm/courses/".$scorm_curriculum['identifier'].'/imsmanifest.xml') or die("Error: Cannot create object");
		$scorm_course_content_url = "uploads/scorm/courses/".$scorm_curriculum['identifier'].'/'.$ispring_xml[0]->resources->resource['href'];
	elseif($scorm_curriculum['scorm_provider'] == 'articulate'):
		$ispring_xml = simplexml_load_file("uploads/scorm/courses/".$scorm_curriculum['identifier'].'/imsmanifest.xml') or die("Error: Cannot create object");
		$scorm_course_content_url = "uploads/scorm/courses/".$scorm_curriculum['identifier'].'/'.$ispring_xml[0]->resources->resource['href'];
	elseif($scorm_curriculum['scorm_provider'] == 'adobe_captivate'):
		$scorm_course_content_url = "uploads/scorm/courses/".$scorm_curriculum['identifier'].'/index.html';
	endif;
?>
<iframe id="scorm_iframe" frameBorder="0" src="<?= base_url($scorm_course_content_url); ?>" width="100%" title="Scorm course"></iframe>
<script type="text/javascript">
	'use strict';
	//For Scorm course body
	$(document).ready(function(){
	  var width = $('#scorm_iframe').width();
	  $('#scorm_iframe').attr("height", width/2);
	  window.onresize = function(event) {
	    var width = $('#scorm_iframe').width();
	    $('#scorm_iframe').attr("height", width/2);
	  };
	});
	//End for Scorm course body
</script>