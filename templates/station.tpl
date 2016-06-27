{% extends "base.tpl" %}

{% block title %} {{title}} {% endblock %}

{% block aside %}
	<ul>
		{% for key,value in asideContent %}
			<li><a {% if value == 'stations.php' %} id="nav_main" {% endif %} href="{{ value }}">{{ key }}</a></li>
		{% endfor %}
	</ul>		
{% endblock %}

{% block section %}

	<h2 class="alphabet">
	{% for key,value in sectionContent['alphabet'] %}
		<a {% if key == lid %}id="letter"{% endif %} href="stations.php?station=list&lid={{key}}">{{value}}</a>	
	{% endfor %}
	</h2>		
	<h4>На зупинці<span{{sectionContent['stname']['station_name']}} ({{sectionContent['station'][0]['street_name']}} {{sectionContent['station'][0]['address_suffix']}} {{sectionContent['station'][0]['near']}})</span> проходять такі маршрути<h4>
	{% if sectionContent['station'][0]|length != 0 %}
		<h4>Автобуси:</h4>
		<p>
		{% for key,value in sectionContent['station'][0] %}
			<a href="routes.php?route=single&id={{value['route_id']}}">{{value['route_name']}}</a>
		{% endfor %}
		</p>
	{% endif %}
	{% if sectionContent['station'][1]|length != 0 %}
		<h4>Трамваї:</h4>
		<p>
		<p>
		{% for key,value in sectionContent['station'][1] %}
			<a href="routes.php?route=single&id={{value['route_id']}}">{{value['route_name']}}</a>
		{% endfor %}
		</p>
	{% endif %}
	{% if sectionContent['station'][2]|length != 0 %}
		<h4>Тролейбуси:</h4>
		<p>
		<p>
		{% for key,value in sectionContent['station'][2] %}
			<a href="routes.php?route=single&id={{value['route_id']}}">{{value['route_name']}}</a>
		{% endfor %}
		</p>
	{% endif %}
{% endblock %}