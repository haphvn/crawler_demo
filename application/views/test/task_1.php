<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="/crawler-demo/public/assets/css/style.css">
<title>Geniee PHP Developer Test - Task 1</title>
</head>
<body>
	<div id="container">
		<h1>Geniee PHP Developer Test</h1>

		<div id="body">
			<a href="/crawler-demo/">GO BACK</a>
			<h3>Task 1: Scrape the information in the table below, grouping by date.</h3>
			<?php if(isset($message)):?>
				<p><?=$message?></p>
			<?php endif;?>
			<div id="data-table">
			<?php if(isset($header) && isset($data) && count($header) > 0 && count($data) > 0): //BEGIN: Check data exist ?>
			<table class="table table-striped table-bordered ">
					<tr>
			<?php foreach($header AS $th):?>
				<th><?=$th?></th>
			<?php endforeach;?>
			</tr>
			<?php foreach ( $data AS $group): //BEGIN: foreach data?>
				<?php foreach ($group AS $key =>$row)://BEGIN: foreach group?>
				<tr>
					<?php foreach($row AS $col => $value): //BEGIN: foreach row?>
						<?php if($col == 'date' && $key == 0): ?>
							<td rowspan='<?=count($group)?>'><?=$value?></td>	
							
						<?php elseif($col == 'date' && $key != 0):?>
							<?php continue;?>
						<?php else: ?>
							<td><?=$value?></td>
						<?php endif; //END: Check data exist?>
					<?php endforeach;//END: foreach row?>
				</tr>
			
				<?php endforeach; //END foreach group?>
			<?php endforeach; //END: foreach data?>
			</table>
			<?php endif; //END: Check data exist?>
		</div>
			<!-- End div #data-table -->
		</div>
		<p class="footer">Geniee PHP Developer Test</p>
	</div>
</body>
</html>