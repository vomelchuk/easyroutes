<?php
class Route {
	
	private $leftNav = array('Маршрути'=>'routes.php', 'Зупинки'=>'stations.php', 'Пошук'=>'search.php', 'Про наc'=>'about.php');	
	private $ua = array('А','Б','В','Г','Ґ','Д','Е','Є','Ж','З','И','І','Ї','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ь','Ю','Я');

	public function getAsidebar() {
		return $this->leftNav;
	}
	
	public function getAlphabet() {
		return $this->ua;
	}

	public function getResultByQuery($sql) {
		$connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
		if(!$connection) die('Помилка під`єднання до бази даних: '.mysql_error());
		$result = mysqli_query($connection, $sql);
		if (!$result) echo "Error number: " . mysqli_errno($connection) . "<br>Error execution query: " . mysqli_error($connection);
		mysqli_close($connection);
		return $result;
	}

	public function getRoutes() {
		$query = "select `id`, `name`, `type` as typeOfRoute from `routes`";
		$result = $this->getResultByQuery($query);
		$list = array();
		while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
			$list[$row[typeOfRoute]][] = array('id' => $row['id'], 'name' => $row['name']);
		}
		mysqli_free_result($result);
		return array('routes' => $list, 'asidebar' => $this->getAsidebar());
	}
	
	public function getRouteByStations($id) {
		$query = "select s.id station_id, s.name name, si.near near, con.direction from `connections` con INNER JOIN  `routes` r ON r.id = con.route_id INNER JOIN  `stations` s ON s.id = con.station_id INNER JOIN  `streets` str ON str.id = s.street_id left join `station_info` si on si.station_id = s.id where r.id = {$id} order by con.direction, con.order";
		$result = $this->getResultByQuery($query);
		$list = array();
		while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
			if($row['direction'] == 0) {
				$list[0][] = $row;
			} else {
				$list[1][] = $row;
			}
		}
		mysqli_free_result($result);
		return $list;
	}	

	public function getRouteByStreets($id) {
		$query = "select distinct str.id, str.name street_name, con.direction from `connections` con INNER JOIN  `routes` r ON r.id = con.route_id INNER JOIN  `stations` s ON s.id = con.station_id INNER JOIN  `streets` str ON str.id = s.street_id where r.id = {$id} order by con.direction, con.order";
		$result = $this->getResultByQuery($query);
		$list = array();
		while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
			if($row['direction'] == 0) {
				$list[0][] = $row;
			} else {
				$list[1][] = $row;
			}
		}
		mysqli_free_result($result);
		return $list;
	}
	
	public function getStationsByStreet($id) {
		$query = "select s.id station_id, s.name station_name, si.near near, s.address_suffix add_suffix, str.name street_name from `stations` s inner join `streets` str on str.id = s.street_id left join `station_info` si on si.station_id = s.id where s.street_id in (SELECT `id`  FROM `streets` WHERE substring(name, locate(char(32),name)+1,1) = '{$this->ua[$id]}') order by str.name";
		$result = $this->getResultByQuery($query);
		$total_stations = mysqli_num_rows($result);
		$list = array();
		while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
			$list[] = $row;
		}
		mysqli_free_result($result);
		return array('alphabet' => $this->getAlphabet(),'stations' => $list, 'total_stations' => $total_stations, 'asidebar' => $this->getAsidebar());
	}
	
	public function getStation($id) {
		$query = "select distinct s.id station_id, s.name station_name, case when si.near is null then '' else si.near end near, case when s.address_suffix is null then '' else s.address_suffix end address_suffix, str.name street_name, r.id route_id, r.name route_name, r.type route_type from `connections` con inner join `stations` s on s.id = con.station_id inner join `routes` r on r.id = con.route_id inner join `streets` str on str.id = s.street_id left join `station_info` si on si.station_id = s.id where s.id = {$id}";
		$result = $this->getResultByQuery($query);
		$list = array();
		$st = array();
		while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
			$st = $row['station_id'];
			switch($row['route_type']) {
				case 0:
					$list[0][] = $row;
					break;
				case 1:
					$list[1][] = $row;
					break;
				case 2:
					$list[2][] = $row;
					break;
			}
		}
		mysqli_free_result($result);
		return array('station' => $list, 'stname' => $st,'alphabet' => $this->getAlphabet());
	}

	public function getStationBySearch($val) {
		$cont = array();
		if(strlen($val) > 3) {
			$query = "select s.id sid, s.name sname, case when si.near is null then '' else si.near end near, concat(str.name, ' ', case when s.address_suffix is null then '' else s.address_suffix end) saddress from `stations` s inner join `streets` str on str.id = s.street_id left join `station_info` si on si.station_id = s.id where s.name like lower('%{$val}%') or str.name like lower('%{$val}%') or si.near like lower('%{$val}%') order by s.name";
			$result = $this->getResultByQuery($query);
			$list = array();
			while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
				$list[] = $row;
			}
			mysqli_free_result($result);
			foreach($list as $key => $name) {				
				if (!strpos(strtolower($name['sname']), strtolower($val))) 
					$cont[] = array($name['sname'], $name['sid'], $name['near'], $name['saddress']);
			}
		}
		return $cont;	
	}

	public function getResultSearch($sid1, $sid2) {
		$query = "select con1.route_id, con1.station_id station1, con2.station_id station2, r.name name from `connections` con1 inner join `connections` con2 on con1.route_id = con2.route_id inner join `routes` r on r.id = con1.route_id where con1.direction = con2.direction and con1.station_id = {$sid1} and con2.station_id = {$sid2} and con1.order < con2.order";
		$result = $this->getResultByQuery($query);
		$straight = array();
		while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
			$straight[] = $row;
		}
		mysqli_free_result($result);
		if(count($straight) > 0) return array('straight' => $straight);

		$query = "select rs1.r1 route1,rn1.name rname1, rs2.r1 route2,rn2.name rname2,rs1.s2 station_mid, (rs1.d2-rs1.d1 + rs2.d2-rs2.d1) distance, concat(s.name,' ', case when si.near is null then '' else si.near end,' (', str.name,' ', case when s.address_suffix is null then '' else s.address_suffix end, ')') address from route_station rs1 inner join route_station rs2 on rs1.s2=rs2.s1 and rs1.r1<>rs2.r1 inner join stations s on s.id=rs1.s2 inner join streets str on str.id=s.street_id left join station_info si on si.station_id=s.id inner join routes rn1 on rn1.id=rs1.r1 inner join routes rn2 on rn2.id=rs2.r2 where rs1.s1={$sid1} and rs2.s2={$sid2} order by route1, route2, distance";
		$result = $this->getResultByQuery($query);
		$unstraight = array();
		while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
			$unstraight[] = $row;
		}
		$unstraight1 = array();
		$unstraight1[] = $unstraight[0];
		for($i = 1; $i < count($unstraight); $i++) {
			if($unstraight[$i]['route1'] == $unstraight[$i-1]['route1'] 
				&& $unstraight[$i]['route2'] == $unstraight[$i-1]['route2']) {
				continue;
			};
			$unstraight1[] = $unstraight[$i];
		}
				
		mysqli_free_result($result);
		return array('unstraight' => $unstraight1);
	}
	
	public function getStationsCoord($rid) {
		$query = "select con.station_id, s.lat, s.lon, s.name, concat(str.name, case when s.address_suffix is null then '' else concat(' ', s.address_suffix) end) street, si.near from `stations` s inner join `connections` con on con.station_id = s.id inner join `streets` str on str.id = s.street_id left join `station_info` si on si.station_id = s.id where con.route_id = {$rid} order by con.direction, con.order";
		$result = $this->getResultByQuery($query);
		$list = array();
		while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
			$list[] = $row;
		}
		mysqli_free_result($result);

		$query = "select rw.route_id, rw.direction, rw.lat, rw.lon from `route_waypoints` rw  where rw.route_id = {$rid} order by rw.direction, rw.number";
		$result = $this->getResultByQuery($query);
		$list1 = array();
		while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
			$list1[] = $row;
		}
		mysqli_free_result($result);
		return array('stations' => $list, 'route' => $list1);

	}

	public function isLogin($user, $pass) {
		$query = "select `user`, `pass` from `users` where `user`='".$user."' and `pass`='".$pass."'";
		$result = $this->getResultByQuery($query);
		$num_rows = mysqli_num_rows($result);
		mysqli_free_result($result);
		if(!$num_rows) return false;
		return true;
	}

	public function addNewRoute($name, $type) {
		$query = "insert into `routes` (`name`, `type`) values ('".$name."', ".(int)$type.")";
		$result = $this->getResultByQuery($query);
		//return true;
	}

	public function deleteRoutes($arr) {
		$query = "delete from `routes` where id in ({$arr})";
		$result = $this->getResultByQuery($query);
		//echo $query;
		return true;
	}	

	function getRouteEdit($id) {

		$query = "select `id`, `name` from `routes` where `id`=".$id;
		$result = $this->getResultByQuery($query);
		$list = array();
		while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
			$list[] = $row['name'];
		}
		mysqli_free_result($result);

		$query = "select s.id station_id, s.name name, si.near near from `connections` con INNER JOIN  `routes` r ON r.id = con.route_id INNER JOIN  `stations` s ON s.id = con.station_id INNER JOIN  `streets` str ON str.id = s.street_id left join `station_info` si on si.station_id = s.id where r.id = {$id} and con.direction = 0 order by con.direction, con.order";
		$result = $this->getResultByQuery($query);
		$list1 = array();
		while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
			$list1[] = $row;
		}
		mysqli_free_result($result);

		$query = "select s.id station_id, s.name name, si.near near from `connections` con INNER JOIN  `routes` r ON r.id = con.route_id INNER JOIN  `stations` s ON s.id = con.station_id INNER JOIN  `streets` str ON str.id = s.street_id left join `station_info` si on si.station_id = s.id where r.id = {$id} and con.direction = 1 order by con.direction, con.order";
		$result = $this->getResultByQuery($query);
		$list2 = array();
		while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
			$list2[] = $row;
		}

		mysqli_free_result($result);

		$query = "select s.id station_id, s.name name, si.near near from `stations` s INNER JOIN  `streets` str ON str.id = s.street_id left join `station_info` si on si.station_id = s.id where s.id not in (select con.station_id from `connections` con where con.route_id = {$id}) order by s.name";
		$result = $this->getResultByQuery($query);
		$list3 = array();
		while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
			$list3[] = $row;
		}
		mysqli_free_result($result);

		$result = array('nameOfRoute' => $list, 'straightRoute' => $list1, 'unstraightRoute' => $list2, 'stops' => $list3);
		/*echo '<pre>';
		print_r($result);
		echo '</pre>';
		*/
		return $result;
	}

	function getMenu($id) {
		$query = "select `id`, `name`, `type`, `link` from `menu` where `type`=".$id;
		$result = $this->getResultByQuery($query);
		//print_r($result);
		$list = array();
		while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
			$list[] = $row;
		}
		mysqli_free_result($result);
		//print_r($list);
		return $list;


	}

	function getTypeOfRoutes($id = '') {
		$where = '';
		if(strlen($id)) $where = ' where `id` = ' . $id;
		$query = "select `id`, `name` from `type_of_routes`" . $where;
		//echo $query;
		$result = $this->getResultByQuery($query);
		//print_r($result);
		$list = array();
		while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
			$list[$row['id']] = $row['name'];
		}
		mysqli_free_result($result);
		//print_r($list);
		return $list;


	}	
}


?>