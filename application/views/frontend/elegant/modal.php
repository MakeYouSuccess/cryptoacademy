<?php
		$paypal_info = json_decode(get_settings('paypal'), true);
		$stripe_info = json_decode(get_settings('stripe_keys'), true);
		if ($paypal_info[0]['active'] == 0) {
				$paypal_status = 'disabled';
		}else {
				$paypal_status = '';
		}
		if ($stripe_info[0]['active'] == 0) {
				$stripe_status = 'disabled';
		}else {
				$stripe_status = '';
		}
 ?>
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
				<div class="modal-content payment-in-modal">
						<div class="modal-header">
								<h5 class="modal-title"><?php echo get_phrase('checkout'); ?>!</h5>
								<button type="button" class="close" data-dismiss="modal">
										<span aria-hidden="true">&times;</span>
								</button>
						</div>
						<div class="modal-body">
								<div class="row">
										<div class="col-md-6">
												<form action="<?php echo site_url('home/paypal_checkout'); ?>" method="post">
														<input type="hidden" class = "total_price_of_checking_out" name="total_price_of_checking_out" value="">
														<button type="submit" class="btn_1 full-width paypal" <?php echo $paypal_status; ?>><?php echo get_phrase('paypal'); ?></button>
												</form>
										</div>
										<div class="col-md-6">
												<form action="<?php echo site_url('home/stripe_checkout'); ?>" method="post">
														<input type="hidden" class = "total_price_of_checking_out" name="total_price_of_checking_out" value="">
														<button type="submit" class="btn_1 full-width stripe" <?php echo $stripe_status; ?>><?php echo get_phrase('stripe'); ?></button>
												</form>
										</div>
								</div>
						</div>
				</div>
		</div>
</div><!-- Modal -->
