<?php require_once 'mysql_connect.inc.php'; ?>
<!doctype html>
<html lang="zh-Hant-TW">
<main>
	<form action="searchdb.php" method="post">
		<input
			type="text"
			placeholder="Enter your search term"
			name="search"
			required>
		<button type="submit" name="submit">Search</button>
	</form>
</main>
