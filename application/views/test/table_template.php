<?php if(isset($data) && count($data) > 0): //BEGIN: Check data exist ?>
	<table class="table table-striped table-bordered ">
		<tr>
			<th>partner</th>
			<th>placement_id</th>
			<th>impression</th>
			<th>click</th>
			<th>revenue</th>
			<th>date</th>
		</tr>
	<?php foreach ( $data AS $group): //BEGIN: foreach data?>
		<?php foreach ($group AS $key =>$row)://BEGIN: foreach group?>
		<tr>
			<td><?=$row->partner?></td>
			<td><?=$row->placement_id?></td>
			<td><?=$row->impression?></td>
			<td><?=$row->click?></td>
			<td><?=$row->revenue?></td>
			<?php if($key == 0): ?>
				<td rowspan='<?=count($group)?>'><?=$row->date?></td>
			<?php endif; //END: Check data exist?>
		</tr>
		<?php endforeach; //END foreach group?>
	<?php endforeach; //END: foreach data?>
	</table>
<?php endif; //END: Check data exist?>