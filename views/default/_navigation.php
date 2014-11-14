<?php
use yii\helpers\Html;
?>
<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Extended Rights</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li><?= Html::a('Berechtigungen', ['permissions/index']) ?></li>
				<li><?= Html::a('Rollen', ['roles/index']) ?></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" >Benutzer <span class="caret"></span> </a>
					<ul class="dropdown-menu" role="menu">
						<li><?= Html::a('Benutzer verwaltung', ['user/index']) ?></li>
						<li><?= Html::a('Profilfelder', ['profile/index']) ?></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" >Zuweisung <span class="caret"></span> </a>
					<ul class="dropdown-menu" role="menu">
						<li><?= Html::a('Berechtigungen', ['assignment/index']) ?></li>
						<li><?= Html::a('Benutzer', ['assignment/user']) ?></li>
					</ul>
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>