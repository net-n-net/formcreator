<?php
namespace Nnn\Formcreator\Controller;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2019
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
 
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * FormController
 */
class FormController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * formRepository
	 *
	 * @var \Nnn\Formcreator\Domain\Repository\FormRepository
	 * @inject
	 */
	protected $formRepository = NULL;
	
	/**
	 * attributeRepository
	 *
	 * @var \Nnn\Formcreator\Domain\Repository\AttributeRepository
	 * @inject
	 */
	protected $attributeRepository = NULL;
	
	/**
	 * logRepository
	 *
	 * @var \Nnn\Formcreator\Domain\Repository\LogRepository
	 * @inject
	 */
	protected $logRepository = NULL;

	/**
	 * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
	 * @inject
	 */
	protected $persistenceManager;	


	/**
	 * @var array
	 */
	 protected $validations = array();
	
	
	/**
	 * Injects the configuration manager, retrieves the plugin settings from it, saves
	 * the plugin settings in $this->settings, merges / overrides the Typoscript settings
	 * with FlexForm settings and saves the result in $this->settings['merged']
	 *
	 * @param \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface $configurationManager
	 * @return void
	 * @override \TYPO3\CMS\Extbase\Mvc\Controller\AbstractController
	 **/
	public function injectConfigurationManager(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface $configurationManager) {
		$this->configurationManager = $configurationManager;

		$flexform = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS);
		$extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);
		$settings = $extbaseFrameworkConfiguration['plugin.']['tx_formcreator_pi1.']['settings.'];
		
		if (isset($flexform['override']) && is_array($flexform['override'])) {
			
			$overrides = $flexform['override'];
			$overrides = array_filter($overrides);
			unset($flexform['override']);
			$settings = array_merge($settings, $overrides);
		}
		$this->settings = $settings;
		$this->validations = $settings['validations.'];
	}

	
	/**
	 * action list
	 *
	 * @return void
	 */
	public function submitAction() {
		$args = $this->request->getArguments();
		 
		// check for unique fields
		if ($uniqueFields = $args['uniquefields']){
			$uniqueFieldsArray = explode(',',$uniqueFields);
			
			foreach ($uniqueFieldsArray as $uniqueField){
				$duplicate = $this->logRepository->findByArguments($args['formId'],$uniqueField,$args[$uniqueField]);
				
				if($duplicate){
					$attribute = $this->attributeRepository->findAttributesByNameAndForm($uniqueField,$args['formId']); 
					$this->view->assign('warning',$attribute[0]['error_message_unique']);
					return;
				}
			}
		}

		if(count($args) && $args['submit']){
			unset($args['submit']);
			unset($args['action']);
			unset($args['controller']);
			unset($args['uniquefields']);
			
			$log = new \Nnn\Formcreator\Domain\Model\Log;
			$log->setParams(serialize($args));
			$log->setIp($_SERVER['REMOTE_ADDR']);
			$log->setForm($args['formId']);
			$log->setPid($GLOBALS['TSFE']->id);
			$this->logRepository->add($log);
		
			$form = $this->formRepository->findByUid($args['formId']);
			unset($args['formId']);
		
			$username = $this->settings['name'];
			$useremail = $this->settings['email'];
			
			$sendername = $this->settings['sender-name'];
			$senderemail = $this->settings['sender-email'];
			
			if ($username && $useremail){
				$send = $this->sendTemplateEmail(
						array( $useremail => $username), array($this->settings['sender-email'] => $this->settings['sender-name']),  $this->settings['subject'], 'Submit', array(
							'data' => $args,
							'form' => $form,
						)
				);	
			}
			
			if($redirectPage = $this->settings['redirect']){
				$uri = $this->uriBuilder
				  ->setTargetPageUid($redirectPage)
				  ->build();
				$this->redirectToUri($uri, 0, 302);
			}
		}
	}

	
	/**
	 * action list
	 *
	 * @param Nnn\Formcreator\Domain\Model\Form
	 * @return void
	 */
	public function listAction() {
		$forms = $this->formRepository->findAll();
		$this->view->assign('forms', $forms);
	}

	/**
	 * action showAjax
	 *
	 * @return void
	 */
	public function showAjaxAction() {
		
	}

	/**
	 * action show
	 *
	 * @param Nnn\Formcreator\Domain\Model\Form
	 * @return void
	 */
	public function showAction(\Nnn\Formcreator\Domain\Model\Form $form = null) {
		
		if($this->settings['js-required']){
			$this->redirect('showAjax'); 
		}
		
		if($formId = $this->settings['form']){
			$form = $this->formRepository->findByUid($formId);
		}else{
			return;
		}
		
		$attributes = $form->getAttributes();
		
		if (count($attributes)){
			foreach ($attributes->toArray() as $attribute){
				// if attribute is select or radiobutton
				if ($attribute->getType() == 3 || $attribute->getType() == 5 ){
					$text = $attribute->getText();
					
					$options = explode(PHP_EOL,$text );
					if ($options){
						foreach ($options as $option){
							$optionsArr = explode(',',$option);
							$formOptions[$attribute->getUid()][$optionsArr[0]] = $optionsArr[1];
						}                 
					}
					
					$this->view->assign('options', $formOptions);
				}
				// check for unique attribute
				if($attribute->isUniquefield()){
					$uniqueField[] = $attribute->getFieldname();
				}
			}
		}
		if ($uniqueField){
			$this->view->assign('uniqueFields', implode(',',$uniqueField));
		}
		$this->view->assign('validations', $this->validations);
		$this->view->assign('form', $form);
	}
	
	/**
	 * action copy
	 *
	 * @param Nnn\Formcreator\Domain\Model\Form
	 * @return void
	 */
	public function copyAction(\Nnn\Formcreator\Domain\Model\Form $form) {
		$newForm = new \Nnn\Formcreator\Domain\Model\Form;
		$properties = $form->_getProperties() ;
		unset($properties['uid']) ;
		foreach ($properties as $key => $value ) {
			if (!is_object($value)){
				$newForm->_setProperty( $key , $value ) ;
			}
		}
		$newForm->setName('(Kopie) '.$newForm->getName());
		$newForm->resetUid();
		$newForm->_setProperty('uid',NULL);
		$newForm->_setClone(true);
		
		$attributes = $form->getAttributes() ;
		if(count($attributes)){
			foreach ($attributes as $attribute){
				$newAttribute = new \Nnn\Formcreator\Domain\Model\Attribute;
				$propertiesAttribute = $attribute->_getProperties() ;
				unset($propertiesAttribute['uid']) ;
				foreach ($propertiesAttribute as $key2 => $value2 ) {
					if (!is_object($value2)){
						$newAttribute->_setProperty( $key2 , $value2 ) ;
					}
				}
				$newAttribute->_setProperty('uid',NULL);
				$newAttribute->_setClone(true);

				$newForm->addAttribute($newAttribute);
			}
		}
		
		$this->formRepository->add($newForm);
		$this->redirect('list'); 
	}
	
	
  
	/**
	 * action preview
	 *
	 * @param Nnn\Formcreator\Domain\Model\Form
	 * @return void
	 */
	public function previewAction(\Nnn\Formcreator\Domain\Model\Form $form) {
		$attributes = $form->getAttributes();
		
		if (count($attributes)){
			foreach ($attributes->toArray() as $attribute){
				if ($attribute->getType() == 3 || $attribute->getType() == 5 ){
					$text = $attribute->getText();
					
					$options = explode(PHP_EOL,$text );
					if ($options){
						foreach ($options as $option){
							$optionsArr = explode(',',$option);
							$formOptions[$attribute->getUid()][$optionsArr[0]] = $optionsArr[1];
						}                 
					}
					
					$this->view->assign('options', $formOptions);
				}
			}
		}
		$this->view->assign('form', $form);
	}	

	/**
	 * action new
	 *
	 * @return void
	 */
	public function newAction() {
		
	}

	/**
	 * action create
	 *
	 * @param Nnn\Formcreator\Domain\Model\Form
	 * @return void
	 */
	public function createAction(\Nnn\Formcreator\Domain\Model\Form $newForm) {
		$this->formRepository->add($newForm);
		$this->persistenceManager->persistAll();
		$form  = $this->formRepository->findByUid($newForm->getUid());
		$this->redirect('edit', 'Form','formcreator',array('form' => $form));
	}

	/**
	 * action edit
	 *
	 * @param Nnn\Formcreator\Domain\Model\Form
	 * @ignorevalidation $form
	 * @return void
	 */
	public function editAction(\Nnn\Formcreator\Domain\Model\Form $form) {
		foreach ($this->validations as $key => $value){
			$validationOptions[$key] =  \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('validation.'.$key, 'formcreator');
		}

		$this->view->assign('validations', $validationOptions);
		$this->view->assign('form', $form);
	}
	
	/**
	 * action update
	 *
	 * @param Nnn\Formcreator\Domain\Model\Form
	 * @return void
	 */
	public function updateAction(\Nnn\Formcreator\Domain\Model\Form $form) {
		$formData = $this->request->getArguments();
		$attributes = $form->getAttributes();
		if (count($attributes)){
			foreach ($attributes->toArray() as $attribute){

				$form->removeAttribute($attribute);
			}
			$this->formRepository->update($form);
			$this->persistenceManager->persistAll();
			$this->attributeRepository->deleteFromDb();
		}
		
		if (isset($formData['uid'])){
			foreach ($formData['uid'] as $uid){
				$newAttr = new \Nnn\Formcreator\Domain\Model\Attribute;
				$newAttr->setLabel1($formData['label1'][$uid]);
				$newAttr->setLabel2($formData['label2'][$uid]);
				$newAttr->setSize($formData['size'][$uid]);
				$newAttr->setHeight($formData['height'][$uid]);
				$newAttr->setType($formData['type'][$uid]);
				$newAttr->setText($formData['text'][$uid]);
				$newAttr->setFieldlabel($formData['fieldlabel'][$uid]);
				$newAttr->setFieldname($formData['fieldname'][$uid]);
				$newAttr->setErrorMessage($formData['error-message'][$uid]);
				$newAttr->setErrorMessageUnique($formData['error-message-unique'][$uid]);
				$newAttr->setPlaceholder($formData['placeholder'][$uid]);
				$newAttr->setMandatory($formData['mandatory'][$uid]);
				$newAttr->setUniquefield($formData['uniquefield'][$uid]);
				$newAttr->setFormat($formData['format'][$uid]);
				$newAttr->setDatefield($formData['datefield'][$uid]);
				$newAttr->setValidation($formData['validation'][$uid]);
				// print_r(array($newAttr));
			
				$form->addAttribute($newAttr);
			}
		} 
		$form->setName($formData['name']);
		$form->setSubmit($formData['submit']);
		// \TYPO3\CMS\Core\Utility\DebugUtility::debug($form);
		// die();
		$this->formRepository->update($form);
		$this->persistenceManager->persistAll();
		$this->redirect('preview','Form','formcreator',array('form' => $form));
	}
	
	
	/**
	 * createAttribute
	 * 
	 * @param integer
	 *
	 * @return \Nnn\Formcreator\Domain\Model\Attribute
	 */
	function createAttribute($type){
		$attrData = $this->request->getArguments();
		$form = $this->formRepository->findByUid($attrData['uid']);
		
		$newAttr = new \Nnn\Formcreator\Domain\Model\Attribute;
		$newAttr->setType($type);
		$this->attributeRepository->add($newAttr);
		
		$form->addAttribute($newAttr); 
		$this->persistenceManager->persistAll();
		
		return $newAttr;
	}	
	
	/**
	 * action getInput
	 *
	 * @return void
	 */
	public function getInputAction() {
		$newAttr = $this->createAttribute(1);
		
		foreach ($this->validations as $key => $value){
			$validationOptions[$key] =  \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('LLL:EXT:formcreator/Resources/Private/Language/locallang.xlf:validation.'.$key, 'formcreator');
		}
		$this->view->assign('validations', $validationOptions);
		$this->view->assign('current', $newAttr);
	}	
	
	/**
	 * action getHtml
	 *
	 * @return void
	 */
	public function getHtmlAction() {
		$newAttr = $this->createAttribute(2);
		
		$this->view->assign('current', $newAttr);
	}		
	
	/**
	 * action getSelect
	 *
	 * @return void
	 */
	public function getSelectAction() {
		$newAttr = $this->createAttribute(3);
		
		$this->view->assign('current', $newAttr);
	}	


	/**
	 * action getCheckbox
	 *
	 * @return void
	 */
	public function getCheckboxAction() {
		$newAttr = $this->createAttribute(4);
		
		$this->view->assign('current', $newAttr);
	}	
		
	/**
	 * action getRadio
	 *
	 * @return void
	 */
	public function getRadioAction() {
		$newAttr = $this->createAttribute(5);
		
		$this->view->assign('current', $newAttr);
	}	
	

	/**
	 * action getDivider
	 *
	 * @return void
	 */
	public function getDividerAction() {
		$newAttr = $this->createAttribute(6);
		
		$this->view->assign('current', $newAttr);
	}
	
	/**
	 * action getTextarea
	 *
	 * @return void
	 */
	public function getTextareaAction() {
		$newAttr = $this->createAttribute(7);
		
		$this->view->assign('current', $newAttr);
	}
	

	/**
	 * action getHeader
	 *
	 * @return void
	 */
	public function getHeaderAction() {
		$newAttr = $this->createAttribute(8);
		
		$this->view->assign('current', $newAttr);
	}
	

	/**
	 * action delete
	 *
	 * @param Nnn\Formcreator\Domain\Model\Form
	 * @return void
	 */
	public function deleteAction(\Nnn\Formcreator\Domain\Model\Form $form) {
		$this->formRepository->remove($form);
		$this->redirect('list');
	}
	
	 /**
     * @param array $recipient recipient of the email in the format array('recipient@domain.tld' => 'Recipient Name')
     * @param array $sender sender of the email in the format array('sender@domain.tld' => 'Sender Name')
     * @param string $subject subject of the email
     * @param string $templateName template name (UpperCamelCase)
     * @param array $variables variables to be passed to the Fluid view
     * @return boolean TRUE on success, otherwise false
     */
    protected function sendTemplateEmail(array $recipient, array $sender, $subject, $templateName, array $variables = array()) {
        /** @var \TYPO3\CMS\Fluid\View\StandaloneView $emailView */
        $emailView = $this->objectManager->get('TYPO3\\CMS\\Fluid\\View\\StandaloneView');
		$emailView->setControllerContext($this->controllerContext);
        // without setting controllerExtensionName the redirect to list view goes to root pageId
        $emailView->getRequest()->setControllerExtensionName('formcreator');
        $extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
  
        if (empty($extbaseFrameworkConfiguration['view']['templateRootPath'])) {
            $extbaseFrameworkConfiguration['view']['templateRootPath'] = $extbaseFrameworkConfiguration['view']['templateRootPaths'][0];
        }
        $templateRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName('EXT:formcreator/Resources/Private/Templates/');

        $templatePathAndFilename = $templateRootPath . 'Email/' . $templateName . '.html';
        $emailView->setTemplatePathAndFilename($templatePathAndFilename);
        $emailView->assignMultiple($variables);
        $emailBody = $emailView->render();

        /** @var $message \TYPO3\CMS\Core\Mail\MailMessage */
        $message = $this->objectManager->get('TYPO3\\CMS\\Core\\Mail\\MailMessage');
        $message->setTo($recipient)
                ->setFrom($sender)
                ->setSubject($subject);


        // HTML Email
        $message->addPart($emailBody, 'text/html');

        $message->send();

        return $message->isSent();
    }

}