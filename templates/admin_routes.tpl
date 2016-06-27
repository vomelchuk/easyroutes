{% extends "admin_base.tpl" %}

{% block title %} {{title}} {% endblock %}

{% block head %}
	{{ parent() }}
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
{% endblock %}

{% block section %}
	{{ parent() }}
	{% for key,value in typeOfRoute %}
		<h4><a href="admin.php?action=routes&type={{key}}">{{value}}</a></h4>
	{% endfor %}		
{% endblock %}
