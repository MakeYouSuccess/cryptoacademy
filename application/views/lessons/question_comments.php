<div class="row justify-content-center">
	<div class="col-md-12 col-lg-8 pt-2 pb-3">
		<div class="row">
			<div class="col-md-6">
				<a class="btn-primary py-2 px-3 rounded-50" href="javascript:;" onclick="load_questions('<?= $question['course_id']; ?>')"><i class="fas fa-arrow-left"></i> <?= site_phrase('back_to_all_questions'); ?></a>
			</div>
		</div>
	</div>
	<div class="col-md-12 col-lg-8 border-top user-course-questions py-4">
		<div class="row">
			<div class="col-md-2 col-lg-2 col-xl-1">
				<img class="rounded-circle" src="<?php echo $this->user_model->get_user_image_url($question['user_id']); ?>" width="40" height="40">
			</div>
			<div class="col-md-8 col-lg-8 col-xl-10">
				<h6><?= $question['title']; ?></h6>
				<p class="text-14"><?= $question['description']; ?></p>
			</div>
		</div>
		<div class="row mt-3">
			<div class="col-md-2 col-lg-2 col-xl-1"></div>
			<div class="col-md-10 col-lg-10 col-xl-11 text-12">
				<a href="<?= site_url('home/instructor_page/').$question['user_id']; ?>" target="_blank">
					<?= $user_details['first_name'].' '.$user_details['last_name']; ?>
				</a>
				<span>
					- <?= date('d M Y', $question['date_added']); ?>
				</span>
			</div>
		</div>
	</div>

	<div class="col-md-12 col-lg-8">
		<div class="row mt-3">
			<div class="col-md-2 col-lg-2 col-xl-1"></div>
			<div class="col-md-8 col-lg-8 col-xl-10">
				<h5 class="mt-3"><?= count($question_comments).' '.site_phrase('reply'); ?></h5>
			</div>
		</div>
		<div class="row border-top mt-2">
			<div class="col-md-2 col-lg-2 col-xl-1"></div>
			<div class="col-md-8 col-lg-8 col-xl-10">
				<?php foreach($question_comments as $question_comment):
					$reply_user = $this->user_model->get_all_user($question_comment['user_id'])->row_array();
					?>
					<div class="row border-bottom mt-3 pb-2">
						<div class="col-md-2 col-lg-2 col-xl-1">
							<img class="rounded-circle" src="<?php echo $this->user_model->get_user_image_url($question_comment['user_id']); ?>" width="40" height="40">
						</div>
						<div class="col-md-8 col-lg-8 col-xl-10">
							<p class="mb-1">
								<a href="<?= site_url('home/instructor_page/').$question_comment['user_id']; ?>" target="_blank">
									<?= $reply_user['first_name'].' '.$reply_user['last_name']; ?>
								</a>
								<span class="text-12">
									- <?= date('d M Y', $question_comment['date_added']); ?>
								</span>
								<?php if($this->session->userdata('user_id') == $question_comment['user_id']): ?>
									<a class="float-right" href="javascript:;" onclick="delete_question('<?= $question_comment['id']; ?>', 'reply_question')"><i class="far fa-trash-alt"></i></a>
								<?php endif; ?>
							</p>
							<p class="text-14"><?= $question_comment['description']; ?></p>
						</div>
					</div>
				<?php endforeach; ?>

				<div class="row mt-4">
					<div class="col-md-12">
						<form class="add-question-form" action="<?= site_url('addons/course_forum/add_new_question'); ?>" method="post">
				    		<textarea class="form-control" placeholder="<?= site_phrase('write_a_reply'); ?>" name="description" id="questionCommentDescription" rows="4"></textarea>

				    		<a href="javascript:;" class="btn bg-info border-5-info mt-4 px-5 float-right" onclick="publish_question_comment('<?= $question['course_id']; ?>', '<?= $question['id']; ?>')"><?= site_phrase('publish_reply'); ?></a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
