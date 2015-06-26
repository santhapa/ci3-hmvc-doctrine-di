<!DOCTYPE html>
<html>
<head>
	<title>Blog Posts</title>
</head>
<body>
	<p><a href="<?=site_url('blog/post/add')?>">Add</a></p>

	<h2>All Posts</h2>
	<table>
		<tr>
			<th>S.N</th>
			<th>Title</th>
			<th>Action</th>
		</tr>
		<?php 
			$i = 1;
			foreach ($posts as $post) { ?>
			<tr>
				<td><?=$i?></td>
				<td><?=$post->getTitle()?></td>
				<td>
					<a href="<?=site_url('blog/post/edit/'.$post->getId())?>">Edit</a>/
					<a href="<?=site_url('blog/post/delete/'.$post->getId())?>">Delete</a>
				</td>
			</tr>
		<?php $i++;	}
		?>
	</table>
</body>
</html>
