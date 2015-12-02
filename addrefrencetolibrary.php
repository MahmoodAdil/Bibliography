<?php
	include "core/header.php";
	include "core/lock.php";
	require_once "database.php";
	
	//connect to our db
	$db = new Db();
	
	include "core/topheader.php";//topheader bar
	include "core/sidenavigation.php";
	$LibraryOwnerResult = $db->getLibraryOwner($_SESSION["user_login"],$_SESSION["ActiveLibraryid"]);

	//add reference to library form handler
	if(isset($_POST["addRefLibrary"])){
	    $db->addRefToLibrary($_POST);
	}
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Welcome</div>
					<?php
					if (isset($_SESSION['ActiveLibraryName'])) {
						?><div class="alert alert-success" role="alert">Active Library :<?php echo $_SESSION['ActiveLibraryName'];
						?></div>
						<?php
					}
					if (isset($_SESSION['ref_added'])) {
						?><div class="alert alert-success" role="alert"><?php echo $_SESSION['ref_added'];
						unset($_SESSION['ref_added']);?></div>
						<?php
					}
					if ($LibraryOwnerResult =='1') {
						?>
						<div class="panel-body">
						<div class="col-md-6">
							<form role="form" action="addrefrencetolibrary.php" method="POST">
									<div class="form-group">
										<input class="form-control" type="hidden" name="idoflibrary" value="<?php echo $_SESSION["ActiveLibraryid"];?>" readonly required>
									</div>
									<div class="form-group">
										<label>Title</label>
										<input class="form-control" type="text" name="title" placeholder="Reference Title" required>
									</div>
																	
									<div class="form-group">
										<label>Author</label>
										<input class="form-control" type="text" name="author" placeholder="Author Name" required>
									</div>
									<div class="form-group">
										<label>Year</label>
										<input class="form-control" type="text" name="year" maxlength="4" size="4" placeholder="Published Year" required>
									</div>
									<div class="form-group">
										<label>Abstract</label>
										<textarea class="form-control" name="abstract" rows="4" required></textarea>
									</div>
									<button class="btn btn-lg btn-primary" name="addRefLibrary" type="submit">Submit</button>
							</form>
						</div>
						</div><!-- panel-body -->
						<?php
					}else{
						?><div class="alert alert-info" role="alert">you can not add ref into this library;</div>
					<?php
					}
					?>
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