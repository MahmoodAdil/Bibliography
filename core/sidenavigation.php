<?php
	require_once "database.php";
	//connect to our db
	$db = new Db();
	$userAmandableLibrary = $db->getAmandableLibrary($_SESSION["user_login"]);
	
?>
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
<!-- ----------------------------------------------------------------------------------- -->
	<div class="panel-body">
		<div class="form-group">
			<form role="form" id="usersAccountForm" name="usersAccountForm" action="userindex.php" method="POST">
				<fieldset>
					<div class="form-group">
						<input class="form-control" type="hidden" name="email" value="<?php echo $_SESSION["user_login"];?>" readonly>
					</div>
					<div class="form-group">
						<label>Library Name</label>
						<input class="form-control" placeholder="Library Name" name="displayname" type="text" value="" required>
					</div>
					<button class="btn btn-sm btn-primary" name="createNewLibrary" id="createNewLibrary" type="submit">Create a new Library</button>
				</fieldset>
			</form>
		</div>
	</div><!-- panel-body -->

<!-- ----------------------------------------------------------------------------------- -->
	<div class="panel-body">
		<div class="form-group">
				<form role="form" id="usersAccountForm" name="usersAccountForm" action="userindex.php" method="POST">
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
						<button class="btn btn-sm btn-primary" name="editExistingLibrary" id="editExistingLibrary" type="submit">Change Name Library</button>
					</fieldset>
				</form>
			</div>
		</div><!-- panel-body -->
<!-- ----------------------------------------------------------------------------------- -->
<div class="panel-body divider">
	<div class="form-group">	
		<form role="form" id="usersAccountForm" name="usersAccountForm" action="userindex.php" method="POST">
			<fieldset>
				<div class="form-group">
					<label>Selects Library</label>
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
</div><!-- panel-body -->
<!-- ----------------------------------------------------------------------------------- -->
		<form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form>
		<ul class="nav menu">
			<li class="active"><a href="index.html"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
			<li><a href="widgets.html"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg> Widgets</a></li>
			<li><a href="charts.html"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg> Charts</a></li>
			<li><a href="tables.html"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> Tables</a></li>
			<li><a href="forms.html"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg> Forms</a></li>
			<li><a href="panels.html"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> Alerts &amp; Panels</a></li>
			<li><a href="icons.html"><svg class="glyph stroked star"><use xlink:href="#stroked-star"></use></svg> Icons</a></li>
			<li class="parent ">
				<a href="#">
					<span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> Dropdown 
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li>
						<a class="" href="#">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Sub Item 1
						</a>
					</li>
					<li>
						<a class="" href="#">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Sub Item 2
						</a>
					</li>
					<li>
						<a class="" href="#">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Sub Item 3
						</a>
					</li>
				</ul>
			</li>
			<li role="presentation" class="divider"></li>
			<li><a href="signin.php"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Login Page</a></li>
		</ul>

	</div><!--/.sidebar-->