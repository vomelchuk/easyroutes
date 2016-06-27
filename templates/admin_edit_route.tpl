{% extends "admin_base.tpl" %}

{% block title %} {{title}} {% endblock %}

{% block head %}
	{{ parent() }}
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="script/editRoute.js"></script>

{% endblock %}

{% block aside %}
	<ul>
		<li><a href="admin.php?action=routes">Маршрути</a></li>
		<li><a href="admin.php?action=stops">Зупинки</a></li>
	</ul>
{% endblock %}

{% block section %}
	{{ parent() }}
	<h3>{{ nameOfRoute[0] }}</h3>
	<div class="row forward" id="straight">
		<h4>Прямий напрямок</h4>
		<div class="col-5 col-m-12 selectStops">
			<h5>Вибрані зупинки</h5>
			<select size="7">
			{% for value in straightRoute %}
				<option value="{{ value['station_id'] }}">{{ value['name'] }}{% if value['near']|length != 0 %} (орієнтир: {{ value['near'] }}) {% endif %}</option>
			{% endfor %}
			</select>
		</div>
		<div class="col-1 col-m-12">
			<button>Туди</button>
			<button>Назад</button>
		</div>
		<div class="col-5 col-m-12 allStops">
			<h5>Всі зупинки</h5>
			<select size="7">
				{% for value in stops %}
					<option value="{{ value['station_id'] }}">{{ value['name'] }}{% if value['near']|length != 0 %} (орієнтир: {{ value['near'] }}) {% endif %}</option>
				{% endfor %}
			</select>
		</div>			
	</div>
	<div class="row backward" id="unstraight">
		<h4>Зворотній напрямок</h4>
			<div class="col-5 col-m-12 selectStops">
				<h5>Вибрані зупинки</h5>
				<select size="7">
				{% for value in ustraightRoute %}
					<option value="{{ value['station_id'] }}">{{ value['name'] }}{% if value['near']|length != 0 %} (орієнтир: {{ value['near'] }}) {% endif %}</option>
				{% endfor %}
				</select>
			</div>
			<div class="col-1 col-m-12">
				<button>Туди</button>
				<button>Назад</button>
			</div>
			<div class="col-5 col-m-12 allStops">
				<h5>Всі зупинки</h5>
				<select size="7">
				{% for value in stops %}
					<option value="{{ value['station_id'] }}">{{ value['name'] }}{% if value['near']|length != 0 %} (орієнтир: {{ value['near'] }}) {% endif %}</option>
				{% endfor %}
				</select>
			</div>			
	</div>
	<div class="row">
		<button id="save">Записати</button>
	</div>	

{% endblock %}
