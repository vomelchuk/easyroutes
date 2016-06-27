{% extends "base.tpl" %}

{% block title %} {{title}} {% endblock %}

{% block aside %}
	<ul>
		{% for key,value in asideContent %}
			<li><a {% if value == 'about.php' %} id="nav_main" {% endif %} href="{{ value }}">{{ key }}</a></li>
		{% endfor %}
	</ul>	
{% endblock %}

{% block section %}
	<p>{{ sectionContent }}</p>
{% endblock %}



