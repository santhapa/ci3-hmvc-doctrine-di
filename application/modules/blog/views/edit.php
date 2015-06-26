<!DOCTYPE html>
<html>
<head>
	<title>Edit Post</title>
</head>
<body>
	<h3>Add Post</h3>
	<form method="POST" action="">
		<p>
			<label>Title</label>
			<input type="text" name="title" value="<?=$post->getTitle()?>">
		</p>
		<p>
			<input type="submit" name="editPost" value="Add">
		</p>
	</form>

</body>
</html>