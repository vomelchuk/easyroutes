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
		<a {% if key == lid %} id="letter" {% endif %} href="stations.php?station=list&lid={{ key }}">{{ value }}</a>
	{% endfor %}
	</h2>
	<div id="stations">
	{% if sectionContent['total_stations'] != 0 %}
		<ul>
		{% for value in sectionContent['stations'] %}
			<li>{{ value['street_name'] }}{% if value['add_suffix']|length != 0 %} {{value['add_suffix']}}{% endif %} <a href="stations.php?station=single&lid={{ lid }}&sid={{ value['station_id'] }}">{{ value['station_name'] }}{% if value['near']|length != 0 %} ({{value['near']}}){% endif %}</a></li>
		{% endfor %}
		</ul>			
	{% else %}
		<p>Немає вулиці в базі даних</p>
	{% endif %}
	</div>	
{% endblock %}