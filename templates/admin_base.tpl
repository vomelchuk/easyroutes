<!DOCTYPE html>
<html lang="ua">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<head>
		{% block head %}
			<link rel="stylesheet" href="style/adminstyle.css">
			<link href='https://fonts.googleapis.com/css?family=Ubuntu&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>
			<link href='https://fonts.googleapis.com/css?family=Architects+Daughter' rel='stylesheet' type='text/css'>
			<title>{% block title %}{% endblock %}</title>
		{% endblock %}
	<head>
	<body>
		<div class="container">
			<div class="row header">
				<header>
					<a class="col-2 col-m-4" href="index.php"><img class="logo" src="image/logo.png" alt="Логотип"></a>
					<h2 class="col-10 col-m-8">Спрощена схема руху маршруток</h2>
				</header>
			</div>
			<div class="row navigation">
				<nav>
					{% block admin %}
					<div class="login">
							<p>Ви ввійшли як {{ user }} <a href="admin.php?action=logout">Вийти</a></p>
					</div>
					{% endblock %}
				</nav>
			</div>
			<div class="row main">
				<main>
					<div class="col-2 col-m-4 aside">
						<aside>
							{% block aside %}
							<ul>
								{% for key,value in menu %}
								<li><a href="admin.php?action={{value['link']}}">{{value['name']}}</a></li>		
								{% endfor %}
							</ul>
							{% endblock %}
						</aside>
					</div>
					<div class="col-10 col-m-8 section">
						<section>
							{% block section %}
								{% for key,value in submenu %}
								<a href="admin.php">{{key}}</a>
								{% endfor %}
							{% endblock %}
						</section>
					</div>
				</main>
			</div>
			<div class="row footer">
				<footer>
						<p>Copyright by the learning courses at ELEKS <span id="year"><span></p>
				</footer>
			</div>
		</div>	
	</body>
	<script src="script/ascript.js"></script>
</html>