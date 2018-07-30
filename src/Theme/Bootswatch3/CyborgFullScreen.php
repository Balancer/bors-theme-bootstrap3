<?php

namespace B2\Theme\Bootswatch3;

class CyborgFullScreen extends \B2\Theme\Bootstrap3FullScreen
{
	var $__skip_pure_bootstrap_load = true;

	function pre_show()
	{
		\B2\jQuery::load();

		bors_use('https://bootswatch.com/3/cyborg/bootstrap.min.css');
		bors_use('//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js');

		return parent::pre_show();
	}
}
