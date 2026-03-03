<!DOCTYPE html>
<html>
<head>
	<title>To-Do List</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
	<h2 class="mb-4">My To-Do List</h2>

	<form method="post" action="<?php echo site_url('todo/add'); ?>">
		<div class="form-group">
			<input type="text" name="action_title" class="form-control" placeholder="Enter new action..." required>
		</div>
		<button type="submit" class="btn btn-primary">Add To-Do</button>
	</form>

	<hr>

	<ul class="list-group mt-4">
		<?php if(!empty($todos)): ?>
			<?php foreach($todos as $todo): ?>
				<li class="list-group-item d-flex justify-content-between align-items-center">
					<div>
						<?php echo htmlspecialchars($todo->action_title); ?>
						<br>
						<small class="text-muted">
							<?php echo $todo->created_at; ?>
						</small>
					</div>
					<form method="post" action="<?php echo site_url('todo/delete/' . $todo->id); ?>" style="display:inline;">
						<button type="submit" class="btn btn-danger btn-sm">Delete</button>
					</form>
				</li>
			<?php endforeach; ?>
		<?php else: ?>
			<li class="list-group-item">No To-Do items yet.</li>
		<?php endif; ?>
	</ul>

</div>

</body>
</html>
