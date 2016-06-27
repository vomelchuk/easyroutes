<?php include TEMPLATE_PATH . "/header.tpl.php" ?>

	<div class="row">
		<aside class="col-2 col-m-4">
			<ul>
				<?php foreach($results['aside'] as $key => $value): ?>
					<li><a <?php if($value == 'routes.php') echo 'id="nav_main"'; ?> href="<?php echo htmlspecialchars($value) ?>"><?php echo htmlspecialchars($key) ?></a></li>
				<?php endforeach; ?>
			</ul>		
		</aside>
		<section class="col-10 col-m-8">
			<h3>Автобуси</h3>
				<table>
					<tr>
					<?php $counter = 0; foreach($results['section'][0] as $key => $value) { if($counter == COLUMN_TABLE) { echo '<tr>';} ?>
						<td><a href="routes.php?route=single&id=<?php echo $value['id']; ?>"><?php echo $value['name']; ?></a></td>
					<?php $counter++; if($counter == COLUMN_TABLE) { echo '</tr>'; $counter = 0; } } ?>
					</tr>
				</table>
			<h3>Трамваї</h3>
				<table>
					<tr>
					<?php $counter = 0; foreach($results['section'][1] as $key => $value) { if($counter == COLUMN_TABLE) { echo '<tr>';} ?>
						<td><a href="routes.php?route=single&id=<?php echo $value['id']; ?>"><?php echo $value['name']; ?></a></td>
					<?php $counter++; if($counter == COLUMN_TABLE) { echo '</tr>'; $counter = 0; } } ?>
					</tr>
				</table>			
			<h3>Тролейбуси</h3>
				<table>
					<tr>
					<?php $counter = 0; foreach($results['section'][2] as $key => $value) { if($counter == COLUMN_TABLE) { echo '<tr>';} ?>
						<td><a href="routes.php?route=single&id=<?php echo $value['id']; ?>"><?php echo $value['name']; ?></a></td>
					<?php $counter++; if($counter == COLUMN_TABLE) { echo '</tr>'; $counter = 0; } } ?>
					</tr>
				</table>
				<?php echo '<pre>'; print_r($results); echo '<pre>';  ?> <!-- -->			
		</section>

	</div>

<?php include TEMPLATE_PATH . "/footer.tpl.php" ?>