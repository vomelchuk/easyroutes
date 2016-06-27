{% extends "base.tpl" %}

{% block title %} {{title}} {% endblock %}

{% block aside %}
	<ul>
		{% for key,value in asideContent %}
			<li><a {% if value == 'search.php' %} id="nav_main" {% endif %} href="{{ value }}">{{ key }}</a></li>
		{% endfor %}
	</ul>		
{% endblock %}

{% block section %}
	<h2>Пошук маршрутів від зупинки до зупинки</h2>
	<form action="search.php" method="get" id="searchForm">
		<div class="search_main">
			<div class="search_field">
				<label for="s1">Початкова зупинка:</label>
				<input type="disabled" name="station_1" value="{{ station_1 }}" id="s1" size="50" autocomplete="off" onkeyup="showStation(event, 's1')">
				<input type="text" id="sid1" name="sid1" value="{{ sid1 }}">
				<div id="search1"></div>
			</div>
			<div class="search_field">
				<label for="s2">Кінцева зупинка:</label>
				<input type="text" name="station_2" value="{{ station_2 }}" id="s2" size="50" autocomplete="off" onkeyup="showStation(event, 's2')">
				<input type="text" id="sid2" name="sid2" value="{{ sid2 }}">
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
		{% if isResult == 1 %}
			{% if sectionContent['straight']|length == 0 and sectionContent['unstraight']|length == 0 %}
    			<p>Немає сполучення між зупинками</p>
			{% else %}
				{% if sectionContent['straight']|length > 0 %}
					<h5>Прямі маршрути:</h5>
					{% for key,value in sectionContent['straight'] %}
						<a href="routes.php?route=single&id={{ value['route_id'] }}">{{ value['name'] }}</a>
					{% endfor %}
				{% else %}
					<h5>Непрямі маршрути:</h5>
					{% for key,value in sectionContent['unstraight'] %}
						<a href="routes.php?route=single&id={{ value['route1'] }}">{{ value['rname1'] }}</a>
					<span> &#8594;<a href="stations.php?station=single&sid={{ value['station_mid'] }}">{{ value['address'] }}</a> &#8594;</span>
					<a href="routes.php?route=single&id={{ value['route2'] }}">{{ value['rname2'] }}</a>
					<br/>
					{% endfor %}
				{% endif %}
			{% endif %}
		{% endif %}
	<pre>
	    {{ sectionContent }}
	</pre>
{% endblock %}