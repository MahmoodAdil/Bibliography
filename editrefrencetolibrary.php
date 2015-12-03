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
	if(isset($_POST["selectRefLibrary"])){
	    $refrenceResult = $db->getRefrence($_POST['editrefid']);
	}
	//add reference to library form handler
	if(isset($_POST["editRefLibrary"])){
	    $db->editRefToLibrary($_POST);
	}
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Welcome</div>
					<div class="panel-body">
						<div class="col-md-6">
							<form role="form" action="editrefrencetolibrary.php" method="POST">
									<div class="form-group">
										<input class="form-control" type="hidden" name="editid" value="<?php echo $refrenceResult[0]['id']; ?>" required>
									</div>
									<div class="form-group">
										<label>Title</label>
										<input class="form-control" type="text" name="title" value="<?php echo $refrenceResult[0]['title']; ?>" required>
									</div>
																	
									<div class="form-group">
										<label>Author</label>
										<input class="form-control" type="text" name="author" value="<?php echo $refrenceResult[0]['author']; ?>" required>
									</div>
									<div class="form-group">
										<label>Year</label>
										<input class="form-control" type="text" name="year" maxlength="4" size="4" value="<?php echo $refrenceResult[0]['year']; ?>" required>
									</div>
									<div class="form-group">
										<label>Key</label>
										<input class="form-control" type="text" name="keyword"  value="<?php echo $refrenceResult[0]['keyword']; ?>" required>
									</div>
									<div class="form-group">
										<label>Abstract</label>
										<textarea class="form-control" name="abstract" rows="4" required><?php echo $refrenceResult[0]['abstract']; ?></textarea>
									</div>
									<button class="btn btn-lg btn-primary" name="editRefLibrary" type="submit">Save</button>
							</form>
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