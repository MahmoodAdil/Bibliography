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
	if(isset($_POST["unsharelist"])){
		foreach($_POST['libraryid'] as $item){
		  // query to delete where item = $item
			$db->unshareLibrarywith($item);
		}
		
	}



	//get all share list of current user
	$ShareListResult = $db->getShareList('Default');
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
					<table class="table table-bordered">
						<tr>
						    <th>Unshare</th>
						    <th>Display Name</th>
						    <th>Share with</th> 
						<td>
						 <form role="form" action="sharelist.php" method="POST">
						 	<fieldset>
							<div class="form-group">
						 <?php
						 for ($x = 0; $x <count($ShareListResult); $x++){?>
						 	<tr>
							  <td>
								  <li class="todo-list-item">
									  	<div class="checkbox">
											<input type="checkbox" id="libraryid[]" name="libraryid[]" value="<?php echo $ShareListResult[$x]['rowIndex']; ?>"/>
										</div>
									</li>
							  </td>
							  <td><?php echo $ShareListResult[$x]['displayname']; ?></td>
							  <td><?php echo $ShareListResult[$x]['sharewithemail']; ?></td>
							</tr>
						 <?php
						 }
						 ?>
							</div>

							<tr>
								<div class="form-group">
								<td>
								<button class="btn btn-lg btn-primary" name="unsharelist" id="unsharelist" type="submit">Unshare</button>
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