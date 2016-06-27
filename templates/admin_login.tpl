
{% extends "admin_base.tpl" %}

{% block title %} {{title}} {% endblock %}

{% block admin %}
	<form action="admin.php?action=login" method="post">
		<h2>Авторизація</h2>
		{% if noLogin|length > 0 %}
			<p>{{ noLogin }}</p>
		{% endif %}
		<div class="row">
			<label for="username">Користувач</label>
			<input type="text" name="username" placeholder="Введіть користувача"/>
		</div>
		<div class="row">
			<label for="password">Пароль</label>
			<input type="password" name="password" placeholder="Введіть пароль"/>
		</div>
		<div class="row button">
			<input type="checkbox" name="rememberMe">Запам`ятати мене
		</div>
		<div class="row button">
			<input type="submit" name="login" value="Увійти"/>
		</div>
	</form>
{% endblock %}

{% block navigation %}
{% endblock %}

{% block aside %}
{% endblock %}

{% block section %}
{% endblock %}