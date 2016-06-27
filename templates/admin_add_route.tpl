{% extends "admin_base.tpl" %}

{% block title %} {{title}} {% endblock %}

{% block head %}
	{{ parent() }}
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
{% endblock %}

{% block section %}
	{{parent()}}
	<h3>Додавання нового маршруту</h3>

	<form action="admin.php" method="get">
		<fieldset>
			<legend>{{typeOfRoute}}</legend>
			<div>
				<input type="hidden" name="action" value="addRoute" />
				<input type="hidden" name="type" value="{{type}}" />
			</div>
			<div>
				<label for="name"></label>
				<input type="text" name="name" />
			</div>
			<div>
				<input type="submit" value="Додати" />
			</div>
			
		</fieldset>
	</form>
		{% if result == 1 %}
			<p>Запис зроблено успішно</p>
		{% endif %}

{% endblock %}
