<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<base href="/public/../">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Todo List</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
</head>
<body class="container">
	<div class="nav-bar pb-2 mt-2">


	<?php if ($this->userLogged()): ?>
		<div class="nav-menu-item"><a href="/logout" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i>Logout</a></div>
		
	<?php else: ?>
		<div class="nav-menu-item"><a href="/login" class="btn btn-success"><i class="fas fa-sign-in-alt"></i>Login</a></div>
		
	<?php endif ?>
	</div>
	<?php foreach ($flashes as $flash): ?>
		<div class="alert alert-<?=$flash['type']?> alert-dismissible fade show" role="alert">
			<p><?=$flash['message']?></p>
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
	<?php endforeach ?>