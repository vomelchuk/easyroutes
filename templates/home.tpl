{% extends "base.tpl" %}

{% block title %} {{title}} {% endblock %}

{% block aside %}
	<ul>
		{% for key,value in asideContent %}
			<li><a href="{{ value }}">{{ key }}</a></li>
		{% endfor %}
	</ul>		
{% endblock %}

{% block section %}
	<p>{{ sectionContent }}</p>
{% endblock %}



