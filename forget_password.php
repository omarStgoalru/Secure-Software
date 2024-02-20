<?php
	include("includes/header.php");
	include("includes/connection.php");
	include("functions/notification.php");

	display_notification_messages();
?>

		<!-- Forget Password Modal -->
		<div class="modal modal-sheet position-static d-block bg-body-secondary p-4 py-md-5" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content rounded-4 shadow">
					<!-- Modal Header -->
					<div class="modal-header p-5 pb-4 border-bottom-0">
						<h1 class="fw-bold mb-0 fs-2">Forget Password</h1>
					</div>

					<!-- Modal Body -->
					<div class="modal-body p-5 pt-0">
						<!-- Forget Password Form -->
						<form action="functions/send_reset_link.php" method="POST">
							<!-- Email Input -->
							<div class="form-floating mb-3">
								<input name="email" type="email" class="form-control rounded-3" placeholder="name@example.com">
								<label>Email</label>
							</div>

							<!-- Submit Button -->
							<input type="submit" class="w-100 mb-2 btn btn-sm rounded-3 btn-outline-info" value="Send Reset Link">
							
						</form>
					</div>
				</div>
			</div>
		</div>

<?php
	include("includes/footer.php");
?>
