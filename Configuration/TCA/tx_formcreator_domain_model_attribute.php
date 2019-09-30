<?php
return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:formcreator/Resources/Private/Language/locallang_db.xlf:tx_formcreator_domain_model_attribute',
		'label' => 'fieldname',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'sortby' => 'sorting',
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'fieldname,fieldlabel,label1,label2,format,placeholder,type,text,validation,mandatory,uniquefield,sender_email,sender_name,size,height,error_message,error_message_unique,datefield,',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('formcreator') . 'Resources/Public/Icons/tx_formcreator_domain_model_attribute.gif'
	),
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, fieldname, fieldlabel, label1, label2,format, placeholder, type, text, validation, mandatory, uniquefield,sender_email, sender_name, size,height, error_message,error_message_unique, datefield',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, fieldname, fieldlabel, label1, label2,format, placeholder, type, text, validation, mandatory, uniquefield, sender_email, sender_name, size,height, error_message, error_message_unique, datefield, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
	
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_formcreator_domain_model_attribute',
				'foreign_table_where' => 'AND tx_formcreator_domain_model_attribute.pid=###CURRENT_PID### AND tx_formcreator_domain_model_attribute.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),

		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
	
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),

		'fieldname' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:formcreator/Resources/Private/Language/locallang_db.xlf:tx_formcreator_domain_model_attribute.fieldname',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'fieldlabel' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:formcreator/Resources/Private/Language/locallang_db.xlf:tx_formcreator_domain_model_attribute.fieldlabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'label1' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:formcreator/Resources/Private/Language/locallang_db.xlf:tx_formcreator_domain_model_attribute.label1',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'label2' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:formcreator/Resources/Private/Language/locallang_db.xlf:tx_formcreator_domain_model_attribute.label2',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'format' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:formcreator/Resources/Private/Language/locallang_db.xlf:tx_formcreator_domain_model_attribute.format',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'placeholder' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:formcreator/Resources/Private/Language/locallang_db.xlf:tx_formcreator_domain_model_attribute.placeholder',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'type' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:formcreator/Resources/Private/Language/locallang_db.xlf:tx_formcreator_domain_model_attribute.type',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('-- Label --', 0),
				),
				'size' => 1,
				'maxitems' => 1,
				'eval' => ''
			),
		),
		'text' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:formcreator/Resources/Private/Language/locallang_db.xlf:tx_formcreator_domain_model_attribute.text',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			)
		),
		'validation' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:formcreator/Resources/Private/Language/locallang_db.xlf:tx_formcreator_domain_model_attribute.validation',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'mandatory' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:formcreator/Resources/Private/Language/locallang_db.xlf:tx_formcreator_domain_model_attribute.mandatory',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'uniquefield' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:formcreator/Resources/Private/Language/locallang_db.xlf:tx_formcreator_domain_model_attribute.uniquefield',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'sender_email' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:formcreator/Resources/Private/Language/locallang_db.xlf:tx_formcreator_domain_model_attribute.sender_email',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'sender_name' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:formcreator/Resources/Private/Language/locallang_db.xlf:tx_formcreator_domain_model_attribute.sender_name',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'size' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:formcreator/Resources/Private/Language/locallang_db.xlf:tx_formcreator_domain_model_attribute.size',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		'height' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:formcreator/Resources/Private/Language/locallang_db.xlf:tx_formcreator_domain_model_attribute.height',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		'error_message' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:formcreator/Resources/Private/Language/locallang_db.xlf:tx_formcreator_domain_model_attribute.error_message',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'error_message_unique' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:formcreator/Resources/Private/Language/locallang_db.xlf:tx_formcreator_domain_model_attribute.error_message_unique',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'datefield' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:formcreator/Resources/Private/Language/locallang_db.xlf:tx_formcreator_domain_model_attribute.datefield',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		
		'form' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
	),
);