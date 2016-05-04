<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="/crawler-demo/public/assets/css/style.css">


<title>Geniee PHP Developer Test - Task 2</title>
</head>
<body>
	<div id="container">
		<h1>Geniee PHP Developer Test</h1>

		<div id="body">
			<a href="/crawler-demo/">GO BACK</a>
			<h3>Task 2: Get data in the table, grouping by date, but AFTER clicking Update button</h3>
		<?php if(isset($message)):?>
			<p><?=$message?></p>
		<?php endif;?>
		<div id="btn-control">
			<p>Click button <button id="btn-update" class="btn btn-primary" type="button">Update</button> to group data by date</p>
		</div>
		<div id="data-table">
			<?php if(isset($header) && isset($data) && count($header) > 0 && count($data) > 0): //BEGIN: Check data exist ?>
			<table id="main-table" class="table table-striped table-bordered ">
					<tr>
			<?php foreach($header AS $th):?>
				<th><?=$th?></th>
			<?php endforeach;?>
			</tr>
			<?php foreach ( $data AS $key=>$row): //BEGIN: foreach data?>
				<tr>
				<?php foreach($row AS $col => $value): //BEGIN: foreach row?>
					<td><?=$value?></td>
				<?php endforeach;//END: foreach row?>
				</tr>
			<?php endforeach; //END: foreach data?>
			</table>
			<?php endif; //END: Check data exist?>
		</div>
			<!-- End div #data-table -->
		</div>

		<p class="footer">
			Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
	</div>
	<!-- <script src="/crawler-demo/public/assets/js/crawler.js"></script> -->
	 <script src="/crawler-demo/public/assets/js/jquery-1.11.3.min.js"></script>
	<script src="/crawler-demo/public/assets/js/jquery.tabletojson.min.js"></script>
	<script src="/crawler-demo/public/assets/js/crawler.js"></script>
	<script>
	
	</script>
</body>
</html>