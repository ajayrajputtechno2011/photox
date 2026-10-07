<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<title>PhotoX | Work in Progress</title>
	<link href="https://fonts.googleapis.com" rel="preconnect">
	<link href="https://fonts.gstatic.com" rel="preconnect">
	<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
	<style>
		body {
			background: #0b111a;
			color: #ffffff;
			font-family: 'DM Sans', sans-serif;
			min-height: 100vh;
			display: flex;
			align-items: center;
			justify-content: center;
		}
		.wip-card {
			background: #151d2a;
			border: 1px solid rgba(255, 255, 255, 0.08);
			border-radius: 20px;
			padding: 48px 36px;
			text-align: center;
			max-width: 480px;
			box-shadow: 0 10px 40px rgba(0,0,0,0.5);
		}
		.wip-icon-box {
			width: 80px;
			height: 80px;
			border-radius: 50%;
			background: rgba(255, 138, 0, 0.12);
			display: inline-flex;
			align-items: center;
			justify-content: center;
			margin-bottom: 24px;
		}
	</style>
</head>
<body>
	<div class="container d-flex justify-content-center">
		<div class="wip-card">
			<div class="wip-icon-box">
				<i class="bi bi-cone-striped text-warning fs-1"></i>
			</div>
			<h1 class="h3 fw-bold mb-2">Work in Progress</h1>
			<p class="text-muted mb-4">This section is currently under development and testing. It will be released in an upcoming update.</p>
			<a href="/" class="btn btn-outline-light rounded-pill px-4">
				<i class="bi bi-arrow-left me-1"></i> Return to Homepage
			</a>
		</div>
	</div>
</body>
</html>
