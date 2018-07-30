<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?= htmlspecialchars($self->browser_description());/*"*/?>">
	<meta name="author" content="">
<?php /*	<link rel="icon" href="../../favicon.ico"> */?>

	<title><?= htmlspecialchars($self->browser_title()); ?></title>


<?php
	if(!empty($css_list))
		foreach($css_list as $css)
			echo "\t<link rel=\"stylesheet\" href=\"{$css}\" />\n";
?>

	<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
	<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
<?php
//	<script src="../../assets/js/ie-emulation-modes-warning.js"></script>
?>
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

<?php
	if(!empty($style))
		echo bors_pages_helper::style($style);

	if(!empty($javascript))
	{
		echo "<script><!--\n";
		foreach($javascript as $s)
			echo $s,"\n";
		echo "--></script>\n";
	}
?>

</head>

<body role="document">

	<!-- Fixed navbar -->
<?php
if(empty($navbar_classes))
	echo "<div class=\"navbar navbar-inverse xnavbar-fixed-top\" role=\"navigation\">";
else
	echo "<div class=\"{$navbar_classes}\" role=\"navigation\">";
?>
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

<?php
if(empty($brand_logo))
	echo "<a class=\"navbar-brand\" href=\"{$self->project()->url()}\">".htmlspecialchars($self->project()->title())."</a>";
else
	echo "<a class=\"navbar-brand\" href=\"{$self->project()->url()}\">{$brand_logo}</a>";
?>
			</div>
<?php
	$navbar = $self->get('navbar');
	if(!$navbar)
		$navbar = object_property($self->app(), 'navbar');

	if($navbar)
	{
?>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">

<?php

		foreach($navbar as $title => $submenu)
		{
			if(is_array($submenu))
			{

				if($fa = popval($submenu, 'fa'))
					$icon = 'fa fa-'.$fa;
				else
				{
					$icon = popval($submenu, 'i_class');

					if(!$icon)
						$icon = 'fa fa-circle-o';
				}

				if(count($submenu) == 1)
					$submenu = array_pop($submenu);
			}

			if(is_array($submenu))
			{
?>
					<li class="dropdown">
<!--					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>-->
<?php
			bors_layouts_bootstrap3_dropdown::show(['menu' => [$title => $submenu], 'icon_css' => $icon]);
?>
					</li>
<?php
			}
			else
			{
				if(preg_match('/^\w+$/', $submenu))
					$url = "/$submenu/";
				else
					$url = $submenu;
				echo "<li class=\"active2\"><a href=\"{$url}\">".($icon?"<i class=\"$icon\"></i> ":'').htmlspecialchars($title)."</a></li>\n";
			}
		}
?>
				</ul>

<?php

		if(!$me)
		{
			// http://mifsud.me/adding-dropdown-login-form-bootstraps-navbar/
?>
				<ul class="nav navbar-nav navbar-right">
<?php
			if($self->app()->get('register_url'))
			{
?>
					<li><a href="<?= $self->app()->register_url()?>"><?=_('Register')?></a></li>
<?php
			}

			if($self->app()->get('login_url'))
			{
?>
					<li class="dropdown" id="menuLogin">
						<a class="dropdown-toggle" href="#" data-toggle="dropdown" id="navLogin"><?=_('Login')?></a>
						<div class="dropdown-menu" style="padding:17px;">
							<form class="form" id="formLogin" action="<?=$self->app()->get('login_url')?>" method="post">
								<input name="username" id="username" type="text" class="form-control" placeholder="<?=_('Username')?>">
								<input name="password" id="password" type="password" class="form-control" placeholder="<?=_('Password')?>"><br>
								<button type="button" id="btnLogin" class="btn"><?=_('Login')?></button>
					  		</form>
						</div>
					</li>

<?php
			}
?>
				</ul>
<?php
		}
		else
		{
			if(empty($user_bar))
				$user_bar = $self->get('user_bar');

			if($user_bar)
			{
?>
				<ul class="nav pull-right">
					<li class="divider-vertical"></li>
					<li class="dropdown">
						<a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="icon-user icon-white"></i> <?=$me->title()?> <strong class="caret"></strong></a>
						<ul class="dropdown-menu">
<?php
				foreach($user_bar as $title => $url)
				{
?>
							<li><a href="<?=$url?>"><?=$title?></a></li>
<?php
				}
?>
						</ul>
					</li>
				</ul>
<?php
			}
		}
?>

			</div><!--/.nav-collapse -->
<?php
	}
?>

		</div>
	</div>

	<?= $self->body() ?>

<?php

	if(!empty($js_include))
		foreach($js_include as $s)
			echo "\t<script src=\"{$s}\"></script>\n";

	if(!empty($js_include_post))
		foreach($js_include_post as $s)
			echo Element::script()->type("text/javascript")->src($s);

	if(!empty($javascript_post) || !empty($jquery_document_ready))
	{
		echo "<script><!--\n";
		if(!empty($javascript_post))
		{
			foreach($javascript_post as $js)
				echo $js;
		}

		if(!empty($jquery_document_ready))
		{
//			echo "\$(document).ready(function() {\n";
			echo "\$(function() {\n";
			foreach($jquery_document_ready as $js)
				echo $js, "\n";
			echo "})\n";
		}

		echo "--></script>\n";
	}

	if($append_html = $self->get('append_html'))
		echo $append_html;
?>

</body>
</html>
