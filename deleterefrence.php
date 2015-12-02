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

	//change a active library form handler
	if(isset($_POST["deleteselectedrefrence"])){
		foreach($_POST['deleteid'] as $item){
		  // query to delete where item = $item
			$db->deleterefrence($item);
		}
		
	}



	//get all refrence for current user
	$allRefrenceResult = $db->getAllRefrence($_SESSION["user_login"]);
		//sortby form handler
	if(isset($_POST["sortby"])){
	    $db->getAllRefrence($_POST);
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

					?>
					<form role="form" action="deleterefrence.php" method="POST">
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
					</div>
					</form>
					<table class="table table-bordered">
						<tr>
						    <th>Author</th>
						    <th>Title</th> 
						    <th>year</th>
						    <th>Key</th>
						<td>
						 <form role="form" action="deleterefrence.php" method="POST">
						 	<fieldset>
							<div class="form-group">
						 <?php
						 for ($x = 0; $x <count($allRefrenceResult); $x++){?>
						 	<tr>
							  <td><?php echo $allRefrenceResult[$x]['author']; ?></td>
							  <td>
								  <li class="todo-list-item">
									  	<div class="checkbox">
											<input type="checkbox" id="deleteid[]" name="deleteid[]" value="<?php echo $allRefrenceResult[$x]['id']; ?>"/>
											<label for="checkbox"><?php echo $allRefrenceResult[$x]['title']; ?></label>
										</div>
									</li>
							  </td>
							  <td><?php echo $allRefrenceResult[$x]['year']; ?></td>
							  <td><?php echo $allRefrenceResult[$x]['keyword']; ?></td>
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