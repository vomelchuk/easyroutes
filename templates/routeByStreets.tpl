{% extends "base.tpl" %}

{% block title %} {{title}} {% endblock %}

{% block aside %}
	<script src="http://maps.googleapis.com/maps/api/js"></script>
	<h3>Автобуси</h3>
	<table>
		{% for routes in asideContent[0]|batch(5, '') %}
		    <tr>
		        {% for route in routes %}
		            <td><a {% if route['id'] == id %} id="bus" {% endif %} href="routes.php?route=single&id={{ route['id'] }}">{{ route['name'] }}</a></td>
		        {% endfor %}
		    </tr>
		{% endfor %}
	</table>
	<h3>Трамваї</h3>
	<table>
		{% for routes in asideContent[1]|batch(5, '') %}
		    <tr>
		        {% for route in routes %}
		        	<td><a {% if route['id'] == id %} id="bus" {% endif %} href="routes.php?route=single&id={{ route['id'] }}">{{ route['name'] }}</a></td>
		        {% endfor %}
		    </tr>
		{% endfor %}
	</table>
	<h3>Тролейбуси</h3>
	<table>
		{% for routes in asideContent[2]|batch(5, '') %}
		    <tr>
		        {% for route in routes %}
		            <td><a {% if route['id'] == id %} id="bus" {% endif %} href="routes.php?route=single&id={{ route['id'] }}">{{ route['name'] }}</a></td>
		        {% endfor %}
		    </tr>
		{% endfor %}
	</table>
{% endblock %}

{% block section %}
			<div id="routevar">
				<ul>
					<li><a href="routes.php?route=single&id={{ id }}">По зупинках</a></li>
					<li><a href="routes.php?route=streets&id={{ id }}">По вулицях</a></li>
					<li><a href="#" onclick="showOnMap({{ id }})">На мапі</a></li>
				</ul>
			</div>
			<div id="route">
				{% if sectionContent[0]|length > 0 %}
					<h4>Прямий напрямок</h4> 
					{% for key,value in sectionContent[0] %}
						<span>{{ value['street_name'] }}</span><span>{% if key != (sectionContent[0]|length - 1) %} &#8594; {% endif %}</span>
					{% endfor %}
				{% endif %}
				{% if sectionContent[1]|length > 0 %}
					<h4>Зворотній напрямок</h4> 
					{% for key,value in sectionContent[1] %}
						<span>{{ value['street_name'] }}</span><span>{% if key != (sectionContent[1]|length - 1) %} &#8594; {% endif %}</span>
					{% endfor %}
				{% endif %}				
			</div>
			<div id="googleMap" style="width:800px;height:480px; display:none;"></div>
{% endblock %}