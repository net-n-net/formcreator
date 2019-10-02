<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Nnn.' . $_EXTKEY,
	'Pi1',
	array(
		'Form' => 'list,getInput,getSelect,getCheckbox,getHtml,copy, show, preview, new, create, edit, update, delete',
		'Attribute' => 'list, show, new, create, edit, update, delete',
		'Log' => 'list, new, create',
		
	),
	// non-cacheable actions
	array(
		'Form' => 'list, getInput,getSelect,getCheckbox,getHtml,copy, show,preview, new, create, update, delete,edit',
		'Attribute' => 'new, create, update, delete',
		'Log' => 'create',
		
	)
);
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Nnn.' . $_EXTKEY,
	'Pi2',
	array(
		'Form' => 'show,submit,showAjax',
		'Attribute' => '',
		'Log' => 'list, new, create',
		
	),
	// non-cacheable actions
	array(
		'Form' => 'show,submit,showAjax',
		'Attribute' => '',
		'Log' => 'create',
		
	)
);

