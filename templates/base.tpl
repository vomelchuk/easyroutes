<!DOCTYPE html>
<html lang="ua">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<head>
		{% block head %}
			<link rel="stylesheet" href="style/style.css">
			<link href='https://fonts.googleapis.com/css?family=Ubuntu&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>
			<link href='https://fonts.googleapis.com/css?family=Architects+Daughter' rel='stylesheet' type='text/css'>
			<title>{% block title %}{% endblock %}</title>
		{% endblock %}
	<head>
	<body>
		<header class="row">
			<a class="col-2 col-m-4" href="index.php"><img class="logo" src="image/logo.png" alt="Логотип"></a>
			<h2 class="col-6 col-m-8 w3-animate-top">Спрощена схема руху маршруток</h2>
		</header>
		<div>
			{% block admin %}
				<a href="admin.php">Адмінка</a>
			{% endblock %}	
		</div>
		<nav class="row">
			<ul>
				<li><a href="routes.php">Маршрути</a></li>
				<li><a href="stations.php">Зупинки</a></li>
				<li><a href="search.php">Пошук</a></li>
				<li><a href="about.php">Про нас</a></li>
			</ul>
		</nav>
		<div class="row">
			<aside class="col-2 col-m-4">{% block aside %}{% endblock %}</aside>
			<section class="col-10 col-m-8">{% block section %}{% endblock %}</section>
		</div>
		<footer class="row">
			{% block footer %}
				<p>Copyright by the learning courses at ELEKS <span id="year"><span></p>
			{% endblock %}
		</footer>
	</body>
	<script src="script/script.js"></script>
</html>