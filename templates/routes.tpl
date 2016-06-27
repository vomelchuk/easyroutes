{% extends "base.tpl" %}

{% block title %} {{title}} {% endblock %}

{% block aside %}
	<ul>
		{% for key,value in asideContent %}
			<li><a {% if value == 'routes.php' %} id="nav_main" {% endif %} href="{{ value }}">{{ key }}</a></li>
		{% endfor %}
	</ul>		
{% endblock %}

{% block section %}
	<h3>Автобуси</h3>
	<table>
		{% for routes in sectionContent[0]|batch(5, '') %}
		    <tr>
		        {% for route in routes %}
		            <td><a href="routes.php?route=single&id={{ route['id'] }}">{{ route['name'] }}</a></td>
		        {% endfor %}
		    </tr>
		{% endfor %}
	</table>
	<h3>Трамваї</h3>
	<table>
		{% for routes in sectionContent[1]|batch(5, '') %}
		    <tr>
		        {% for route in routes %}
		        	<td><a href="routes.php?route=single&id={{ route['id'] }}">{{ route['name'] }}</a></td>
		        {% endfor %}
		    </tr>
		{% endfor %}
	</table>
	<h3>Тролейбуси</h3>
	<table>
		{% for routes in sectionContent[2]|batch(5, '') %}
		    <tr>
		        {% for route in routes %}
		            <td><a href="routes.php?route=single&id={{ route['id'] }}">{{ route['name'] }}</a></td>
		        {% endfor %}
		    </tr>
		{% endfor %}
	</table>		
{% endblock %}