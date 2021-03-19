<section class="m-2 p-2">
	<div class="card">
		<div class="m-3"><a href="/todos">Tasks list</a></div>
		<h1><i class="m-2 <?= $this->data->completed()?'fas fa-check':'fas fa-spinner' ?>"></i><?=$this->data->getTitle()?></h1>
		<div class=""><span><?=$this->data->getCreatedAt()?></span></div>
		<div class="m-1">
		<a class="btn btn-danger btn-sm" href="/todos/<?=$this->data->getId() ?>/delete"><i class="far fa-trash-alt"></i> Delete</a></a></div>
	</div>
	<form class="mt-2 form border p-2" action="/todos/<?=$this->data->getId()?>" method="post">
		<h4>Update</h4>
		<input type="text" value="<?=$this->data->getTitle()?>" name="title" id="title"><br>
		<label for="finished-check">
			Finished 
		</label>&nbsp;<input id="finished-check" type="checkbox" name="statut" value="FINISHED" <?= $this->data->completed()?"checked":""?>><br>
		<input class="btn btn-success" type="submit" value="Update">
	</form>
</section>