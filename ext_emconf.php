<?php


$EM_CONF[$_EXTKEY] = array(
	'title' => 'Form creator',
	'description' => 'This extension makes it possible to create input forms via an administration page in your website (not in the TYPO3 backend).
	 Editors can not or should not always edit forms via the TYPO3 backend. With this extension, an administration mask can be created on a front-end page with which forms on web pages can be easily created.
	 You can create easily your own validations without programming.',
	'category' => 'plugin',
	'author' => 'Stefan Westermayer',
	'author_email' => 'info@netnnet.de',
	'state' => 'alpha',
	'internal' => '',
	'uploadfolder' => '0',
	'createDirs' => '',
	'clearCacheOnLoad' => 0,
	'version' => '8.0.8',
	'constraints' => array(
		'depends' => array(
			'typo3' => '7.6.0-8.7.99',
			'vhs' => '',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
);