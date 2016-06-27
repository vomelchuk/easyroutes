{% extends "admin_base.tpl" %}

{% block title %} {{title}} {% endblock %}

{% block head %}
	{{ parent() }}
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="script/deleteRoute.js"></script>	
{% endblock %}

{% block section %}
	{{parent()}}
	<div class="row">
		<div class="col-5 col-m-12">
			<h5>Маршрути</h5>
			<select class="routes" size="7">
			{% for value in routes %}
				<option value="{{ value['id'] }}">{{ value['name'] }}</option>
			{% endfor %}			
			</select>
		</div>
		<div class="col-1 col-m-12">
			<button id="forward">-></button>
			<button id="backward"><-</button>
		</div>
		<div class="col-5 col-m-12">
			<h5>До видалення</h5>
			<select class="deletes" size="7">
			</select>
		</div>			
	</div>

	<button id="remove">Видалити</button>
{% endblock %}
