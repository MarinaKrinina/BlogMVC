<?php
class View
{
	function generate($content_view, $template_view, $data = null)
	{
		include 'src/view/'.$template_view;
	}
}