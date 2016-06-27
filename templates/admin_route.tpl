{% extends "admin_base.tpl" %}

{% block title %} {{title}} {% endblock %}

{% block head %}
	{{ parent() }}
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
{% endblock %}

{% block section %}
	{{parent()}}
	<h4>{{typeOfRoute}}</a></h4>
	<p><a href="admin.php?action=addRoute&type={{type}}">Додати маршрут</a></p>
	<p><a href="admin.php?action=delRoute&type={{type}}">Видалити маршрут</a></p>
	<p>Редагувати маршрут</p>
	<table>
		{% for route in routes|batch(10, '') %}
		    <tr>
		        {% for value in route %}
		            <td><a href="admin.php?action=route&id={{ value['id'] }}">{{ value['name'] }}</a></td>
		        {% endfor %}
		    </tr>
		{% endfor %}
	</table>
{% endblock %}
