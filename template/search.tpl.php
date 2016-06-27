<?php include TEMPLATE_PATH . "//header.tpl.php" ?>

</script>

	<div class="row">
		<aside class="col-2 col-m-4">
			<ul>
				<?php foreach($results['aside'] as $key => $value) { ?>
					<li><a <?php if($value == 'search.php') echo 'id="nav_main"'; ?> href="<?php echo htmlspecialchars($value) ?>"><?php echo htmlspecialchars($key) ?></a></li>
				<?php } ?>
			</ul>		
		</aside>
		<section class="col-10 col-m-8">
			<h2>Пошук маршрутів від зупинки до зупинки</h2>
			<p id="test" style="display:none"></p>
			<form action="search.php" method="get" id="searchForm">
				<div class="search_main">
					<div class="search_field">
						<label for="s1">Початкова зупинка:</label>
						<input type="text" name="station_1" value="<?php echo $_GET['station_1']; ?>" id="s1" size="50" autocomplete="off" onkeyup="showStation(event, 's1')">
						<input type="text" id="sid1" name="sid1" value="<?php echo $_GET['sid1']; ?>">
						<div id="search1"></div>
					</div>
					<div class="search_field">
						<label for="s2">Кінцева зупинка:</label>
						<input type="text" name="station_2" value="<?php echo $_GET['station_2']; ?>" id="s2" size="50" autocomplete="off" onkeyup="showStation(event, 's2')">
						<input type="text" id="sid2" name="sid2" value="<?php echo $_GET['sid2']; ?>">
						<div id="search2"></div>
					</div>
					<div class="search_field">
					<input type="button" value="Очистити" onclick="resetForm()">
						<input type="hidden" name="station" value="result">
						<input type="submit" value="Знайти">
					</div>
				</div>
			</form>
			<div id="res">
				<?php if($results['isResult'] == 1) { ?>
					<?php
						if (count($results['section']['straight']) > 0 || count($results['section']['unstraight']) > 0 ) {
							if(count($results['section']['straight']) > 0) { ?>
							<h5>Прямі маршрути:</h5>
							<?php foreach($results['section']['straight'] as $key => $value) { ?>
							<a href="routes.php?route=single&id=<?php echo $value['route_id']; ?>"><?php echo $value['name']; ?></a>
							<?php	}}
						if(count($results['section']['unstraight']) > 0) { ?>
							<h5>Непрямі маршрути:</h5>
							<?php foreach($results['section']['unstraight'] as $key => $value) { ?>
							<a href="routes.php?route=single&id=<?php echo $value['route1']; ?>"><?php echo $value['rname1']; ?></a>
							<span> &#8594;<a href="stations.php?station=single&sid=<?php echo  $value['station_mid']; ?>"><?php echo $value['address']; ?></a> &#8594;</span>
							<a href="routes.php?route=single&id=<?php echo $value['route2']; ?>"><?php echo $value['rname2']; ?></a>
							<br/>
							<?php	}
							}	
							
						}else {
							echo 'Немає сполучення між зупинками';
						}

					?>
					
				
				<?php } ?>
			 <!--<?php echo '<pre>'; print_r($results); echo '<pre>'; echo count($results['section']['straight']); echo ' '.count($results['section']['unstraight']);?>  --> 
			 
			</div>
		</section>
	</div>

<?php include TEMPLATE_PATH . "/footer.tpl.php" ?>