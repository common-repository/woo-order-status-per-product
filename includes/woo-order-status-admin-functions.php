<?php
/**
 * @return array
 * function to return array of html for escaping
 */
function wocs_get_allow_html_in_escaping(){
	$allow_html_args = array(
		'input'      => array(
			'type'  => array(
				'checkbox' => true,
				'text'     => true,
				'submit'   => true,
				'button'   => true,
				'file'  => true,
			),
			'class' => true,
			'name' => true,
			'value' => true,
			'id'    => true,
			'style'    => true,
			'selected' => true,
			'checked' => true,
		),
		'select'     => array(
			'id' => true,
			'data-placeholder' => true,
			'name' => true,
			'multiple' => true,
			'class' => true,
			'style' => true
		),
		'a'          => array( 'href' => array(), 'title' => array(), 'target' => array() ),
		'b'          => array( 'class' => true ),
		'i'          => array( 'class' => true ),
		'p'          => array( 'class' => true ),
		'blockquote' => array( 'class' => true ),
		'h2'         => array( 'class' => true ),
		'h3'         => array( 'class' => true ),
		'ul'         => array( 'class' => true ),
		'ol'         => array( 'class' => true ),
		'li'         => array( 'class' => true ),
		'option'     => array( 'value' => true, 'selected' => true ),
		'table'      => array( 'class' => true ),
		'td'         => array( 'class' => true ),
		'th'         => array( 'class' => true, 'scope' => true ),
		'tr'         => array( 'class' => true ),
		'tbody'      => array( 'class' => true ),
		'label'      => array( 'for' => true ),
		'strong'     => true,
		'div'      => array(
			'id'    => true,
			'class'    => true,
			'title'    => true,
			'style'    => true,

		),
		'textarea'   => array(
			'id'    => true,
			'class' => true,
			'name'  => true,
			'style' => true
		),
	);
	return $allow_html_args;
}