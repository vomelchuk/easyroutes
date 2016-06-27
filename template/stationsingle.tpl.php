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
			<h4><?php echo 'На зупинці ' ?><span><?php echo $results['section']['station'][0]['station_name'].' ('.$results['section']['station'][0]['street_name']. ' '.$results['section']['station'][0]['address_suffix']. ' '.$results['section']['station'][0]['near'].')' ?></span><?php echo ' проходять такі маршрути' ?><h4>
			<?php if($results['section']['total_types'][0] != 0) { ?>
				<h4>Автобуси:</h4>
				<p>
				<?php foreach($results['section']['station'] as $key => $value) { ?>
					<?php if($value['route_type'] != 0) continue; ?>
					<a href="routes.php?route=single&id=<?php echo $value['route_id']; ?>"><?php echo $value['route_name'] . ' ' ?></a>
				<?php } ?>
				</p>
			<?php } ?>

			<?php if($results['section']['total_types'][1] != 0) { ?>
				<h4>Трамваї:</h4>
				<p>
				<?php foreach($results['section']['station'] as $key => $value) { ?>
					<?php if($value['route_type'] != 1) continue; ?>
					<a href="routes.php?route=single&id=<?php echo $value['route_id']; ?>"><?php echo $value['route_name'] . ' ' ?></a>
				<?php } ?>
				</p>
			<?php } ?>

			<?php if($results['section']['total_types'][2] != 0) { ?>
				<h4>Тролейбуси:</h4>
				<p>
				<?php foreach($results['section']['station'] as $key => $value) { ?>
					<?php if($value['route_type'] != 2) continue; ?>
					<a href="routes.php?route=single&id=<?php echo $value['route_id']; ?>"><?php echo $value['route_name'] . ' ' ?></a>
				<?php } ?>
				</p>
			<?php } ?>
			
		</section>
	</div>

<?php include TEMPLATE_PATH . "/footer.tpl.php" ?>