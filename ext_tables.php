<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'Nnn.' . $_EXTKEY,
	'Pi1',
	'Form creator'
);
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'Nnn.' . $_EXTKEY,
	'Pi2',
	'Show Form'
);

if (TYPO3_MODE === 'BE') {

	/**
	 * Registers a Backend Module
	 */
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
		'Nnn.' . $_EXTKEY,
		'web',	 // Make module a submodule of 'web'
		'export',	// Submodule key
		'',						// Position
		array(
			'Log' => 'list, export, show, logs',
		),
		array(
			'access' => 'user,group',
			'icon'   => 'EXT:' . $_EXTKEY . '/ext_icon.png',
			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_export.xlf',
		)
	);
}

$pluginSignature = 'formcreator_pi2';
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key,recursive';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:formcreator/Configuration/FlexForms/flexform_show.xml');


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Form creator');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_formcreator_domain_model_form', 'EXT:formcreator/Resources/Private/Language/locallang_csh_tx_formcreator_domain_model_form.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_formcreator_domain_model_form');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_formcreator_domain_model_attribute', 'EXT:formcreator/Resources/Private/Language/locallang_csh_tx_formcreator_domain_model_attribute.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_formcreator_domain_model_attribute');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_formcreator_domain_model_mail', 'EXT:formcreator/Resources/Private/Language/locallang_csh_tx_formcreator_domain_model_mail.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_formcreator_domain_model_mail');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_formcreator_domain_model_log', 'EXT:formcreator/Resources/Private/Language/locallang_csh_tx_formcreator_domain_model_log.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_formcreator_domain_model_log');
