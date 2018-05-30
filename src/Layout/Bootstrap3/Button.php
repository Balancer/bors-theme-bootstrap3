<?php

namespace B2\Layout\Bootstrap3;

class Button extends \B2\Layout\Module
{
	var $title = NULL;
	var $icon_class = NULL;

	function html_code()
	{
		$url = $this->arg('url');
		$label = $this->arg('label');

		if($fa = $this->arg('fa'))
			$label = "<i class=\"fa fa-$fa\"></i> $label";

		if($icon_class = $this->arg('icon-class'))
			$label = "<i class=\"{$icon_class}\"></i> $label";

		$this->url   = $url;
		$this->label = $label;

		return $this;
	}

	function button_class($class = NULL)
	{
		if(is_null($class))
			return $this->button_class ?: $this->arg('button-class', 'btn btn-default');

		$this->button_class = $class;
		return $this;
	}

	function icon_class($class = NULL)
	{
		if(is_null($class))
			return $this->icon_class ?: $this->arg('icon-class');

		$this->icon_class = $class;
		return $this;
	}

	function title($title = NULL)
	{
		if(is_null($title))
			return $this->title ?: $this->arg('title');

		$this->title = $title;
		return $this;
	}

	function url($url = false)
	{
		if($url === false)
			return $this->url;

		$this->url = $url;
		return $this;
	}

	function small()
	{
		$cs = explode(' ', $this->button_class());
		$cs[] = 'btn-sm';
		$this->button_class = join(' ', array_unique($cs));
		return $this;
	}

	function __toString()
	{
		$label = $this->label();
		if($this->icon_class())
			$label = "<i class=\"{$this->icon_class()}\"></i> $label";

		if($this->title())
			$title = " title=\"".htmlspecialchars($this->title())."\"";
		else
			$title = "";

		return "<a href=\"{$this->url()}\" class=\"{$this->button_class()}\"{$title}>{$label}</a>";
	}
}
