<div class="panel-body divider">
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
</div><!-- panel-body -->