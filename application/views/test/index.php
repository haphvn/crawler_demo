<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="/crawler-demo/public/assets/css/style.css">
	<title>Geniee PHP Developer Test</title>
</head>
<body>

<div id="container">
	<h1>Geniee PHP Developer Test</h1>

	<div id="body">
	<p>Please click the links bellow to go to demo.</p>
		<ul>
			<li><a href="/crawler-demo/index.php/test/task_1" alt="click to open demo of task 1">Task 1</a>: Scrape the information in the table below, grouping by date.</li>
			<li><a href="/crawler-demo/index.php/test/task_2" alt="click to open demo of task 2">Task 2</a>: Get data in the table, grouping by date, but AFTER clicking Update button </li>
		</ul>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

</body>
</html>