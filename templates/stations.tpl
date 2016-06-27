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
		{% for key,value in sectionContent %}
			<a href="stations.php?station=list&lid={{ key }}">{{ value }}</a>
		{% endfor %}
	</h2>
	<p id="station">Виберіть вулицю для перегляду списку зупинок по ній<p>	
{% endblock %}