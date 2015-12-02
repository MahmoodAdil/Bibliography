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
	if(isset($_POST["changeActiveLibrary"])){
	    $ActiveLibraryid=$_POST['ActiveLibraryid'];
	    $_SESSION['ActiveLibraryid']=$ActiveLibraryid;
	    $ActiveLibraryName = $db->getActiceLibraryName($_SESSION["ActiveLibraryid"]);
	    $_SESSION['ActiveLibraryName']=$ActiveLibraryName;
	}
	//create a new library form handler
	if(isset($_POST["createNewLibrary"])){
	    $db->createNewLibrary($_POST);
	}
	//edit library form handler
	if(isset($_POST["editExistingLibrary"])){
	    $db->changeLibraryName($_POST);
	}
	//delete library form handler
	if(isset($_POST["deleteExistingLibrary"])){
	    $db->deleteLibrary($_POST);
	}
	//Share library form handler
	if(isset($_POST["ShareLibrary"])){
	    $db->ShareActiveLibrary($_POST);
	}
	//get all refrence for current user
	$allRefrenceResult = $db->getAllRefrence('default');

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
					//print_r($allRefrenceResult);
					
					if (isset($_SESSION['library_created'])) {
						?><p class="bg-success"><?php echo $_SESSION['library_created'];
						unset($_SESSION['library_created']); ?></p>
						<?php
					}
					if (isset($_SESSION['library_changed'])) {
						?><p class="bg-success"><?php echo $_SESSION['library_changed'];
						unset($_SESSION['library_changed']); ?></p>
						<?php
					}
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
					if (isset($_SESSION['library_shere_success'])) {
						?><div class="alert alert-success" role="alert"><?php echo $_SESSION['library_shere_success'];
						unset($_SESSION['library_shere_success']); ?></div>
						<?php
					}
					if (isset($_SESSION['library_shere_error'])) {
						?><div class="alert alert-warning" role="alert"><?php echo $_SESSION['library_shere_error'];
						unset($_SESSION['library_shere_error']); ?></div>
						<?php
					}
					?>
					<form role="form" action="userindex.php" method="POST">
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
						    <th>Edit</th>
						 <form role="form" action="editrefrencetolibrary.php" method="POST">
						 <?php
						 for ($x = 0; $x <count($allRefrenceResult); $x++){?>
						 	<tr>
							  <td><?php echo $allRefrenceResult[$x]['author']; ?>
							  	<input type="hidden" name="editrefid" value="<?php echo $allRefrenceResult[$x]['id']; ?>">
							  </td>
							  <td><?php echo $allRefrenceResult[$x]['title']; ?></td>
							  <td><?php echo $allRefrenceResult[$x]['year']; ?></td>
							  <td><?php echo $allRefrenceResult[$x]['keyword']; ?></td>
							  <td>
							  <button class="btn btn-sm btn-primary" name="selectRefLibrary" type="submit">Edit</button></td>
							</tr>
						 <?php
						 }
						 ?>
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