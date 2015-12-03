<?php
	include "core/header.php";
	include "core/lock.php";
	require_once "database.php";
	
	//connect to our db
	$db = new Db();
	
	if (isset($_SESSION['signin_error']))
	{
		unset($_SESSION['signin_error']);
	}

	include "core/topheader.php";//topheader bar
	include "core/sidenavigation.php";

	//get all getTrashID of user
	$trashid = $db->getTrashID();
	$_SESSION['user_trashid']=$trashid;
	//change a active library form handler
	if(isset($_POST["deleteselectedrefrence"])){
		foreach($_POST['deleteid'] as $item){
		  // query to delete where item = $item
			$db->deletereTrash($item);
		}
		
	}



	//get all refrence for current user
	$TrashListResult = $db->getTrashRefrence('Default');
		//sortby form handler
	if(isset($_POST["sortby"])){
	    $db->getTrashRefrence($_POST);
	}
	if(isset($_POST["emptyTrash"])){
	    $db->emptyTrash($trashid);
	}
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Welcome</div>
					<?php
					if (isset($_SESSION['library_delete'])) {
						?><p class="bg-success"><?php echo $_SESSION['library_delete'];
						unset($_SESSION['library_delete']); ?></p>
						<?php
					}
					if (isset($_SESSION['ActiveLibraryName'])) {
						?><div class="alert alert-success" role="alert">Active Library :<?php echo $_SESSION['ActiveLibraryName'];
						?></div>
						<?php
					}
					if (isset($_SESSION['refrence_deleted'])) {
						?><p class="bg-success"><?php echo $_SESSION['refrence_deleted'];
						unset($_SESSION['refrence_deleted']); ?></p>
						<?php
					}

					?>
					<form role="form" action="trashfolder.php" method="POST">
					<div class="form-group form-inline">
									<label>Sort by:</label>
									<select class="form-control" name="columnname">
										<option value="title">Title</option>
										<option value="author">Author</option>
										<option value="year">Year</option>
										<option value="keyword">Key</option>
									</select>

									<select class="form-control" name="orderby">
										<option value="ASC">Asc</option>
										<option value="Desc">Des</option>
									</select>
									<button class="btn btn-sm btn-primary" name="sortby" type="submit">Sort</button>
									<button class="btn btn-sm btn-primary" name="emptyTrash" type="submit">Empty rash</button>
					</div>
					</form>

					<table class="table table-bordered">
						<tr>
						    <th>Author</th>
						    <th>Title</th> 
						    <th>year</th>
						    <th>Key</th>
						<td>
						 <form role="form" action="trashfolder.php" method="POST">
						 	<fieldset>
							<div class="form-group">
						 <?php
						 for ($x = 0; $x <count($TrashListResult); $x++){?>
						 	<tr>
							  <td><?php echo $TrashListResult[$x]['author']; ?></td>
							  <td>
								  <li class="todo-list-item">
									  	<div class="checkbox">
											<input type="checkbox" id="deleteid[]" name="deleteid[]" value="<?php echo $TrashListResult[$x]['id']; ?>"/>
											<label for="checkbox"><?php echo $TrashListResult[$x]['title']; ?></label>
										</div>
									</li>
							  </td>
							  <td><?php echo $TrashListResult[$x]['year']; ?></td>
							  <td><?php echo $TrashListResult[$x]['keyword']; ?></td>
							</tr>
						 <?php
						 }
						 ?>
							</div>

							<tr>
								<div class="form-group">
								<td>
								<button class="btn btn-lg btn-primary" name="deleteselectedrefrence" id="deleteselectedrefrence" type="submit">Delete Refrences</button>
								</td>
								</div>
							</tr>
						</fieldset>
						</form>
					</table>
				</div>
			</div>
		</div><!--/.row-->
		
		


<!-- include footer	 -->							
<?php include "core/footer.php";?>		
</div>	<!--/.main-->
<?php 
include "core/scriptsFiles.php";
// include "core/footer.php";
?>	