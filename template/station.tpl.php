<?php include TEMPLATE_PATH . "//header.tpl.php" ?>

	<div class="row">
		<aside class="col-2 col-m-4">
			<ul>
				<?php foreach($results['aside'] as $key => $value) { ?>
					<li><a <?php if($value == 'stations.php') echo 'id="nav_main"'; ?> href="<?php echo htmlspecialchars($value) ?>"><?php echo htmlspecialchars($key) ?></a></li>
				<?php } ?>
			</ul>		
		</aside>
		<section class="col-10 col-m-8">
			<h2 class="alphabet">
				<?php foreach($results['section']['alphabet'] as $key => $value) { ?>
					<a <?php if($key == $lid) echo 'id="letter"'; ?> href="stations.php?station=list&lid=<?php echo $key; ?>"><?php echo $value; ?></a>
				<?php } ?>
			</h2>
			<div id="stations">
				<?php if((int)$results['section']['total_stations'] == 0) { ?>
					<p><?php echo 'Немає вулиці в базі даних'; ?></p>
				<?php } ?>
				<?php if($results['section']['total_stations'] != 0) ?>
					<ul>
					<?php foreach($results['section']['stations'] as $value) { ?>
					<li><?php echo $value['street_name'].(strlen($value['add_suffix']) == 0 ? '' : ' '.$value['add_suffix']); ?> <a href="stations.php?station=single&lid=<?php echo $lid; ?>&sid=<?php echo $value['station_id']; ?>"><?php echo $value['station_name'].(strlen($value['near']) == 0 ? '' : ' ('.$value['near'].')'); ?></a></li>
				<?php } ?>
				</ul>
			</div>	
		</section>
	</div>

<?php include TEMPLATE_PATH . "/footer.tpl.php" ?>