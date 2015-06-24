<?php

	foreach ($names as $name) {
		echo '<h2>Hello! '. $name->getText().'</h2>';
	}

?>

<a href="<?=site_url('welcome/add')?>">Add</a>