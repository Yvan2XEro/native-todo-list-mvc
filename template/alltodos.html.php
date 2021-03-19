	<h2>TODO LIST</h2>
	<table class="table table-hover">
	<?php foreach($this->data as $todo): ?>
		<?php $completed = $todo->completed(); ?>
	    <tr>
	    	<td><a href="/todos/<?=$todo->getId(); ?>/statut"><i class="<?= $completed?'fas fa-check':'fas fa-spinner' ?>"></i></a></td>
	    	<td><span><?=$todo->getCreatedAt()?></span>
	    		<?=$todo->getTitle(); ?></td>
	    	<td><a class="btn btn-danger btn-sm" href="/todos/<?=$todo->getId(); ?>/delete"><i class="far fa-trash-alt"></i>
 Delete</a></a></td>
	    	<td><a class="btn btn-info btn-sm" href="/todos/<?=$todo->getId(); ?>"><i class="fas fa-info-circle"></i> Plus</a></td>
	    </tr>
	<?php endforeach; ?>

	</table>


	<!-- Button trigger modal -->
	<div class="fixed">
		<button type="button" class="btn btn-success" data-toggle="modal" data-target="#newTdoModalLong">
		  <i class="fas fa-plus-square"></i> new task
		</button>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="newTdoModalLong" tabindex="-1" role="dialog" aria-labelledby="newTdoModalLongTitle" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="newTdoModalLongTitle">New task</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
			<form action="/todos" method="post">
		      <div class="modal-body">
					    <input type="text" name="title" placeholder="New task...">
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button class="btn btn-success" type="submit">Add task</button>
		      </div>
			</form>
	    </div>
	  </div>
	</div>
	<style type="text/css">
		.fixed button{
			display: block;
			position: fixed;
			right: 20%;
			bottom: 15%;
			width: 80px;
			height: 80px;
			border-radius: 50%;
			font-size: 15px;
			box-shadow: -10px 1px  20px black;
		}
		td span{
			font-size: 10px;
			display: block;
		}
	</style>
	<!-- End Modal -->