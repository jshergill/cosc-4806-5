<?php require_once 'app/views/templates/headerPublic.php' ?>
<main class="container mt-5 mb-5" style="max-width: 500px;">
		<div class="text-center mb-4">
				<h2 class="fw-semibold"> You are not logged in</h2>
				<p class="text-muted">Please log in to continue</p>
		</div>

		<div class="p-4 shadow-sm rounded-4 bg-white border">
				<form action="/login/verify" method="post">
						<fieldset>
								<div class="mb-4">
										<label for="username" class="form-label fw-medium">Username</label>
										<input 
												required 
												type="text" 
												class="form-control rounded-pill px-4 py-2 border-light shadow-sm" 
												name="username" 
												placeholder="Enter your username">
								</div>

								<div class="mb-4">
										<label for="password" class="form-label fw-medium">Password</label>
										<input 
												required 
												type="password" 
												class="form-control rounded-pill px-4 py-2 border-light shadow-sm" 
												name="password" 
												placeholder="Enter your password">
								</div>

								<div class="d-grid">
										<button type="submit" class="btn btn-dark rounded-pill px-4 py-2">Login</button>
								</div>
						</fieldset>
				</form>
		</div>
</main>
<?php require_once 'app/views/templates/footer.php' ?>
