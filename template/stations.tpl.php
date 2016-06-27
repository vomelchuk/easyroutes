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
				<?php foreach($results['section'] as $key => $value) { ?>
					<a href="stations.php?station=list&lid=<?php echo $key; ?>"><?php echo $value; ?></a>
				<?php } ?>
			</h2>
			<p id="station">Виберіть вулицю для перегляду списку зупинок по ній<p>	
		</section>
	</div>

<?php include TEMPLATE_PATH . "/footer.tpl.php" ?>