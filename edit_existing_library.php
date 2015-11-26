<?php
	include "core/header.php";

	require_once "database.php";
	include "core/lock.php";
	include "core/topheader.php";//topheader bar
	include "core/sidenavigation.php";//side menue
	//connect to our db
	$db = new Db();
	$userAmandableLibrary = $db->getAmandableLibrary($_SESSION["user_login"]);
	if(isset($_POST["editExistingLibrary"])){
	    $db->changeLibraryName($_POST);
	}
?>


	
	
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Edit a library</div>
						<?php
						if (isset($_SESSION['library_changed'])) {
							?><p class="bg-success"><?php echo $_SESSION['library_changed'];
							unset($_SESSION['library_changed']); ?></p>
							<?php
						}
						?>
						<div class="panel-body">
						<div class="form-group">
								<form role="form" id="usersAccountForm" name="usersAccountForm" action="edit_existing_library.php" method="POST">
									<fieldset>
										<div class="form-group">
											<label>Selects Library</label>
												<select class="form-control" name="Libraryid">
												<?php
												foreach ($userAmandableLibrary as  $key=>$value) {
													?><option value=<?php echo $value[0]?>><?php echo $value[1] ?></option>;
												<?php
												}
												?>
												</select>
										</div>
										<div class="form-group">
											<label>Library New Name</label>
											<input class="form-control" placeholder="Library New Name" name="newdisplayname" type="text" value="" required>
										</div>
										<button class="btn btn-lg btn-primary" name="editExistingLibrary" id="editExistingLibrary" type="submit">Change Name</button>
									</fieldset>
								</form>
						</div><!-- panel-body -->
				</div>
			</div>
		</div><!--/.row-->
</div>
		
		


<!-- include footer	 -->							
<?php include "core/footer.php";?>		
</div>	<!--/.main-->
<?php 
include "core/scriptsFiles.php";
// include "core/footer.php";
?>	