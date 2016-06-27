<?php include TEMPLATE_PATH . "/header.tpl.php" ?>

	<div class="row">
		<aside class="col-2 col-m-4">
			<ul>
				<?php foreach($results['aside'] as $key => $value) { ?>
					<li><a <?php if($value == 'about.php') echo 'id="nav_main"'; ?> href="<?php echo htmlspecialchars($value) ?>"><?php echo htmlspecialchars($key) ?></a></li>
				<?php } ?>
			</ul>		
		</aside>
		<section class="col-10 col-m-8">
			<p><?php echo htmlspecialchars($results['section']) ?></p>
		</section>
	</div>

<?php include TEMPLATE_PATH . "/footer.tpl.php" ?>