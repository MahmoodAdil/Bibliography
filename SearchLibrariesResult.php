<?php
	include "core/header.php";
	include "core/lock.php";
	require_once "database.php";
	
	//connect to our db
	$db = new Db();
	
	include "core/topheader.php";//topheader bar
	include "core/sidenavigation.php";

	// $refrenceResult = $db->getRefrence('2');

	// //POST from useindex page
	// if(isset($_POST["selectRefLibrary"])){
	//     //$refrenceResult = $db->getRefrence($_POST['editrefid']);
	//     echo "<h1> string".$_POST['editrefid']."</h1>";
	// }
	// //add reference to library form handler
	// if(isset($_POST["editRefLibrary"])){
	//     $db->editRefToLibrary($_POST);
	// }
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Search Result</div>
					<?php
					//temprery code remove after success from userindex page
					//there is no problem in commented from remove comment after success
					//POST from useindex page
						if(isset($_POST["SearchLibraries"])){
						    //$refrenceResult = $db->getRefrence($_POST['editrefid']);
						    //editrefid =>edit refrence id
						    $searchResult=$db->searchLibraries($_POST);
						}

					?>
					<div class="panel-body">
						<div class="col-md-6">
							<table class="table table-bordered">
						<tr>
						    <th>Author</th>
						    <th>Title</th> 
						    <th>year</th>
						    <th>Key</th>
						 <?php
						 for ($x = 0; $x <count($searchResult); $x++){?>
						 	<tr>
							  <td><?php echo $searchResult[$x]['author']; ?></td>
							  <td><?php echo $searchResult[$x]['title']; ?></td>
							  <td><?php echo $searchResult[$x]['year']; ?></td>
							  <td><?php echo $searchResult[$x]['keyword']; ?></td>
							</tr>
						 <?php
						 }
						 ?>
					</table>
						</div>
						</div><!-- panel-body -->
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