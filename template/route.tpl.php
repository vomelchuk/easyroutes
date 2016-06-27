<?php include TEMPLATE_PATH . "/header.tpl.php" ?>
<script src="http://maps.googleapis.com/maps/api/js"></script>
	<div class="row">
		<aside class="col-3 col-m-4">
			<h3>Автобуси</h3>
				<table>
					<tr>
					<?php $counter = 0; foreach($results['aside'][0] as $key => $value) { if($counter == COLUMN_TABLE) 
							{ echo '<tr>';} ?>
						<td>
							<a 
								<?php if($value['id'] == $id) echo 'id="bus"'; ?>
								href="routes.php?route=single&id=<?php echo $value['id']; ?>"><?php echo $value['name']; ?>
							</a>
						</td>
					<?php $counter++; if($counter == COLUMN_TABLE) { echo '</tr>'; $counter = 0; } } ?>
					</tr>
				</table>
			<h3>Трамваї</h3>
				<table>
					<tr>
					<?php $counter = 0; foreach($results['aside'][1] as $key => $value) { if($counter == COLUMN_TABLE) { echo '<tr>';} ?>
						<td><a <?php if($value['id'] == $id) echo 'id="bus"';; ?>href="routes.php?route=single&id=<?php echo $value['id']; ?>"><?php echo $value['name']; ?></a></td>
					<?php $counter++; if($counter == COLUMN_TABLE) { echo '</tr>'; $counter = 0; } } ?>
					</tr>
				</table>			
			<h3>Тролейбуси</h3>
				<table>
					<tr>
					<?php $counter = 0; foreach($results['aside'][2] as $key => $value) { if($counter == COLUMN_TABLE) { echo '<tr>';} ?>
						<td><a <?php if($value['id'] == $id) echo 'id="bus"';; ?>href="routes.php?route=single&id=<?php echo $value['id']; ?>"><?php echo $value['name']; ?></a></td>
					<?php $counter++; if($counter == COLUMN_TABLE) { echo '</tr>'; $counter = 0; } } ?>
					</tr>
				</table>		
		</aside>
		<section class="col-9 col-m-8">
			<div id="routevar">
				<ul>
					<li><a href="routes.php?route=single&id=<?php echo $_GET['id']; ?>">По зупинках</a></li>
					<li><a href="routes.php?route=streets&id=<?php echo $_GET['id']; ?>">По вулицях</a></li>
					<li><a href="#" onclick="showOnMap(<?php echo $id; ?>)">На мапі</a></li>
				</ul>
			</div>
			<div id="route">
				<?php if(count($results['section'][0])) { ?>
					<h4>Прямий напрямок</h4> 
					<?php foreach($results['section'][0] as $key => $value) { ?>
					<a href="stations.php?station=single&sid=<?php echo  $value['station_id']; ?>"><?php echo $value['name'] .(strlen(trim($value['near'])) != 0 ? ' ('.$value['near'].')' : '')?></a><?php echo ($key != (count($results['section'][0])-1)) ? ' &#8594; ' : ''; ?>
				<?php }} ?>
				<?php if(count($results['section'][1])) { ?>
					<h4>Зворотній напрямок</h4> 
					<?php foreach($results['section'][1] as $key => $value) { ?>
					<a href="stations.php?station=single&sid=<?php echo  $value['station_id']; ?>"><?php echo $value['name'] .(strlen(trim($value['near'])) != 0 ? ' ('.$value['near'].')' : '')?></a><?php echo ($key != (count($results['section'][1])-1)) ? ' &#8594; ' : ''; ?>
				<?php }} ?>
			</div>
			<div id="googleMap" style="width:800px;height:480px; display:none;"></div>
			<?php echo '<pre>'; print_r($results); echo '<pre>';  ?> <!-- -->
		</section>
	</div>

<?php include TEMPLATE_PATH . "/footer.tpl.php" ?>