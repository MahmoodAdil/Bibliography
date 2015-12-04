<?php
require_once "database.php";
	//connect to our db
	$db = new Db();
	$userOwnLibrary = $db->getUserOwnLibrary($_SESSION["user_login"]);
	$userAmandableLibrary = $db->getUserLibrary($_SESSION["user_login"],'1');
	
?>
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
	<ul class="nav menu">
		<li><a href="userindex.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"/></use></svg> Home</a></li>
		<li><a href="trashfolder.php"><svg class="glyph stroked folder"><use xlink:href="#stroked-folder"/></use></svg> Trash</a>
		<li><a href="sharelist.php"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/>
		</use></svg> Share List</a>
		</li>
		<li><a href="deleterefrence.php"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"/></use></svg> Delete Refrence</a></li>
	</ul>
<!-- ----------------------------------------------------------------------------------- -->
<!-- 	<div class="panel-body divider"> -->
		<div class="form-group">
				<form role="form" id="usersAccountForm" name="usersAccountForm" action="userindex.php" method="POST">
					<fieldset>
						<div class="form-group">
							<label>Change Active Library</label>
								<select class="form-control" name="ActiveLibraryid">
								<?php
								foreach ($userOwnLibrary as  $key=>$value) {
									?><option value=<?php echo $value[0]?>><?php echo $value[1] ?></option>;
								<?php
								}
								?>
								</select>
						</div>
						<button class="btn btn-sm btn-primary" name="changeActiveLibrary" id="changeActiveLibrary" type="submit">Change ActiveLibrary</button>
					</fieldset>
				</form>
			</div>
		<!-- </div>panel-body -->
<!-- ----------------------------------------------------------------------------------- -->
	<div class="panel-body divider">
		<div class="form-group">
			<fieldset>
				<div class="form-group">
					<label>Add Ref. to active library</label>
				</div><a href="addrefrencetolibrary.php">
				<button class="btn btn-sm btn-primary">Add Reference</button></a>
			</fieldset>
		</div>
	</div>
<!-- ----------------------------------------------------------------------------------- -->
<!-- 	<div class="panel-body divider"> -->
		<div class="form-group">
			<form role="form" id="usersAccountForm" name="usersAccountForm" action="userindex.php" method="POST">
				<fieldset>
					<div class="form-group">
						<input class="form-control" type="hidden" name="email" value="<?php echo $_SESSION["user_login"];?>" readonly>
					</div>
					<div class="form-group">
						<label>Create New Library</label>
						<input class="form-control" placeholder="Library Name" pattern="^(?!Trash).*$" name="displayname" type="text" value="" required>
					</div>
					<button class="btn btn-sm btn-primary" name="createNewLibrary" id="createNewLibrary" type="submit">Create a new Library</button>
				</fieldset>
			</form>
		</div>
<!-- 	</div>panel-body -->
	<!-- ----------------------------------------------------------------------------------- -->
	<!-- <div class="panel-body divider"> -->
		<div class="form-group">
			<form role="form" id="usersAccountForm" name="usersAccountForm" action="userindex.php" method="POST">
				<fieldset>
					<div class="form-group">
					<input class="form-control" type="hidden" name="activelibraryid" value="<?php echo $_SESSION["ActiveLibraryid"];?>" readonly>
					</div>
					<div class="form-group">
						<label>Active Library Share With</label>
						<input class="form-control" placeholder="Enter Email" name="sharewithemail" type="text" value="" required>
					</div>
					<button class="btn btn-sm btn-primary" name="ShareLibrary" id="ShareLibrary" type="submit">Share Library</button>
				</fieldset>
			</form>
		</div>
	<!-- </div> --><!-- panel-body -->

<!-- ----------------------------------------------------------------------------------- -->
	<!-- <div class="panel-body divider"> -->
		<div class="form-group">
				<form role="form" id="usersAccountForm" name="usersAccountForm" action="userindex.php" method="POST">
					<fieldset>
						<div class="form-group">
							<label>Change Library Name</label>
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
						<button class="btn btn-sm btn-primary" name="editExistingLibrary" id="editExistingLibrary" type="submit">Change Name Library</button>
					</fieldset>
				</form>
			</div>
		<!-- </div> --><!-- panel-body -->
<!-- ----------------------------------------------------------------------------------- -->
<!-- <div class="panel-body divider"> -->
	<div class="form-group">	
		<form role="form" id="usersAccountForm" name="usersAccountForm" action="userindex.php" method="POST">
			<fieldset>
				<div class="form-group">
					<label>Delete Library</label>
						<select class="form-control" name="libraryid">
						<?php
						foreach ($userAmandableLibrary as  $key=>$value) {
							?><option value=<?php echo $value[0]?>><?php echo $value[1] ?></option>;
						<?php
						}
						?>
						</select>
				</div>
				<button class="btn btn-sm btn-primary" name="deleteExistingLibrary" id="deleteExistingLibrary" type="submit">Delete Library</button>
			</fieldset>
		</form>
	</div>
<!-- </div> --><!-- panel-body -->
<!-- ----------------------------------------------------------------------------------- -->
	<div class="form-group">
		<form role="search" id="SearchLibraries" name="SearchLibraries" action="SearchLibrariesResult.php" method="POST">
		<label>Search Libraries</label>
			<div class="form-group divider">
				<label>Author Name</label>
				<input type="text" class="form-control" name="searchauthor" placeholder="Author Name">
				<label>Title</label>
				<input type="text" class="form-control" name="searchtitle" placeholder="Title">
				<label>Year</label>
				<input type="text" class="form-control" name="searchyear" placeholder="Title">
			</div>
			<div class="form-group">
				<label>Libraries to Search</label>
				<select multiple class="form-control" name="selectedLibraries[]" required>
					<?php
					foreach ($userOwnLibrary as  $key=>$value) {
						?><option value=<?php echo $value[0]?>><?php echo $value[1] ?></option>;
					<?php
					}
					?>
				</select>
			</div>
			<button class="btn btn-sm btn-primary" name="SearchLibraries" id="SearchLibraries" type="submit">Search</button>
		</form>
	</div>
</div><!--/.sidebar-->