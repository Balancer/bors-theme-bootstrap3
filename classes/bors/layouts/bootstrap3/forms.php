<?php

/*
	Параметры для форм по умолчанию
*/

class bors_layouts_bootstrap3_forms extends bors_forms_templates_default
{
	function _form_table_css_def() { return 'table'; }
	function _form_table_left_th_css_def() { return 'span4'; }

	function _input_css_def() { return 'form-control'; }
	function _input_css_error_def() { return 'alert'; }
	function _textarea_css_def() { return 'form-control'; }

	function _dropdown_css_def() { return 'span8'; }

	function _submit_css_def() { return 'btn'; }

	function _form_container_html_def() { return "<div class=\"well container\">\n%s</div>\n"; }
	function _form_row_html_def() { return "\t<div class=\"form-group\">\n\t\t%s\n\t\t%s\n\t</div>\n"; }
	function _form_element_label_html_def() { return "\t\t<label>\t\t\t%s\t\t</label>\n"; }
	function _form_element_html_def() { return "\t\t%s\n"; }
}
