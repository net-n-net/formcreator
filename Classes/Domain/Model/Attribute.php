<?php
namespace Nnn\Formcreator\Domain\Model;

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

/**
 * Attribute
 */
class Attribute extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * fieldname
	 *
	 * @var string
	 */
	protected $fieldname = '';

	/**
	 * fieldlabel
	 *
	 * @var string
	 */
	protected $fieldlabel = '';

	/**
	 * label1
	 *
	 * @var string
	 */
	protected $label1 = '';

	/**
	 * label2
	 *
	 * @var string
	 */
	protected $label2 = '';
	
	/**
	 * format
	 *
	 * @var string
	 */
	protected $format = '';

	/**
	 * placeholder
	 *
	 * @var string
	 */
	protected $placeholder = '';

	/**
	 * type
	 *
	 * @var int
	 */
	protected $type = '';

	/**
	 * text
	 *
	 * @var string
	 */
	protected $text = '';

	/**
	 * validation
	 *
	 * @var string
	 */
	protected $validation = '';

	/**
	 * mandatory
	 *
	 * @var bool
	 */
	protected $mandatory = FALSE;	
	
	/**
	 * uniquefield
	 *
	 * @var bool
	 */
	protected $uniquefield = FALSE; 

	/**
	 * senderEmail
	 *
	 * @var bool
	 */
	protected $senderEmail = FALSE;

	/**
	 * senderName
	 *
	 * @var bool
	 */
	protected $senderName = FALSE;

	/**
	 * size
	 *
	 * @var int
	 */
	protected $size = 0;
	
	/**
	 * height
	 *
	 * @var int
	 */
	protected $height = 0;

	/**
	 * errorMessage
	 *
	 * @var string
	 */
	protected $errorMessage = '';
	
	/**
	 * errorMessageUnique
	 *
	 * @var string
	 */
	protected $errorMessageUnique = '';

	/**
	 * datefield
	 *
	 * @var bool
	 */
	protected $datefield = FALSE;

	/**
	 * Returns the boolean state of mandatory
	 *
	 * @return bool
	 */
	public function isMandatory() {
		return $this->mandatory;
	}

	/**
	 * Returns the boolean state of uniquefield
	 *
	 * @return bool
	 */
	public function isUniquefield() {
		return $this->uniquefield;
	}

	/**
	 * Returns the boolean state of senderEmail
	 *
	 * @return bool
	 */
	public function isSenderEmail() {
		return $this->senderEmail;
	}

	/**
	 * Returns the boolean state of senderName
	 *
	 * @return bool
	 */
	public function isSenderName() {
		return $this->senderName;
	}

	/**
	 * Returns the label1
	 *
	 * @return string label1
	 */
	public function getLabel1() {
		return $this->label1;
	}

	/**
	 * Sets the label1
	 *
	 * @param string $label1
	 * @return void
	 */
	public function setLabel1($label1) {
		$this->label1 = $label1;
	}

	/**
	 * Returns the label2
	 *
	 * @return string label2
	 */
	public function getLabel2() {
		return $this->label2;
	}

	/**
	 * Sets the label2
	 *
	 * @param string $label2
	 * @return void
	 */
	public function setLabel2($label2) {
		$this->label2 = $label2;
	}

	/**
	 * Returns the format
	 *
	 * @return string format
	 */
	public function getFormat() {
		return $this->format;
	}

	/**
	 * Sets the format
	 *
	 * @param string $format
	 * @return void
	 */
	public function setFormat($format) {
		$this->format = $format;
	}

	/**
	 * Returns the text
	 *
	 * @return string text
	 */
	public function getText() {
		return $this->text;
	}

	/**
	 * Sets the text
	 *
	 * @param string $text
	 * @return void
	 */
	public function setText($text) {
		$this->text = $text;
	}

	/**
	 * Returns the placeholder
	 *
	 * @return string placeholder
	 */
	public function getPlaceholder() {
		return $this->placeholder;
	}

	/**
	 * Sets the placeholder
	 *
	 * @param string $placeholder
	 * @return void
	 */
	public function setPlaceholder($placeholder) {
		$this->placeholder = $placeholder;
	}

	/**
	 * Returns the mandatory
	 *
	 * @return bool mandatory
	 */
	public function getMandatory() {
		return $this->mandatory;
	}

	/**
	 * Sets the mandatory
	 *
	 * @param bool $mandatory
	 * @return void
	 */
	public function setMandatory($mandatory) {
		$this->mandatory = $mandatory;
	}
	
	/**
	 * Returns the uniquefield
	 *
	 * @return bool uniquefield
	 */
	public function getUniquefield() {
		return $this->uniquefield;
	}

	/**
	 * Sets the uniquefield
	 *
	 * @param bool $uniquefield
	 * @return void
	 */
	public function setUniquefield($uniquefield) {
		$this->uniquefield = $uniquefield;
	}

	/**
	 * Returns the senderEmail
	 *
	 * @return bool senderEmail
	 */
	public function getSenderEmail() {
		return $this->senderEmail;
	}

	/**
	 * Sets the senderEmail
	 *
	 * @param bool $senderEmail
	 * @return void
	 */
	public function setSenderEmail($senderEmail) {
		$this->senderEmail = $senderEmail;
	}

	/**
	 * Returns the senderName
	 *
	 * @return bool senderName
	 */
	public function getSenderName() {
		return $this->senderName;
	}

	/**
	 * Sets the senderName
	 *
	 * @param bool $senderName
	 * @return void
	 */
	public function setSenderName($senderName) {
		$this->senderName = $senderName;
	}

	/**
	 * Returns the size
	 *
	 * @return int size
	 */
	public function getSize() {
		return $this->size;
	}

	/**
	 * Sets the size
	 *
	 * @param int $size
	 * @return void
	 */
	public function setSize($size) {
		$this->size = $size;
	}

	/**
	 * Returns the height
	 *
	 * @return int height
	 */
	public function getHeight() {
		return $this->height;
	}

	/**
	 * Sets the height
	 *
	 * @param int $height
	 * @return void
	 */
	public function setHeight($height) {
		$this->height = $height;
	}

	/**
	 * Returns the type
	 *
	 * @return int type
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * Sets the type
	 *
	 * @param string $type
	 * @return void
	 */
	public function setType($type) {
		$this->type = $type;
	}

	/**
	 * Returns the errorMessage
	 *
	 * @return string $errorMessage
	 */
	public function getErrorMessage() {
		return $this->errorMessage;
	}

	/**
	 * Sets the errorMessage
	 *
	 * @param string $errorMessage
	 * @return void
	 */
	public function setErrorMessage($errorMessage) {
		$this->errorMessage = $errorMessage;
	}
	
	/**
	 * Returns the errorMessageUnique
	 *
	 * @return string $errorMessageUnique
	 */
	public function getErrorMessageUnique() {
		return $this->errorMessageUnique;
	}

	/**
	 * Sets the errorMessageUnique
	 *
	 * @param string $errorMessageUnique
	 * @return void
	 */
	public function setErrorMessageUnique($errorMessageUnique) {
		$this->errorMessageUnique = $errorMessageUnique;
	}

	/**
	 * Returns the fieldname
	 *
	 * @return string fieldname
	 */
	public function getFieldname() {
		return $this->fieldname;
	}

	/**
	 * Sets the fieldname
	 *
	 * @param string $fieldname
	 * @return void
	 */
	public function setFieldname($fieldname) {
		$this->fieldname = $fieldname;
	}

	/**
	 * Returns the fieldlabel
	 *
	 * @return string fieldlabel
	 */
	public function getFieldlabel() {
		return $this->fieldlabel;
	}

	/**
	 * Sets the fieldlabel
	 *
	 * @param string $fieldlabel
	 * @return void
	 */
	public function setFieldlabel($fieldlabel) {
		$this->fieldlabel = $fieldlabel;
	}

	/**
	 * Returns the datefield
	 *
	 * @return bool $datefield
	 */
	public function getDatefield() {
		return $this->datefield;
	}

	/**
	 * Sets the datefield
	 *
	 * @param bool $datefield
	 * @return void
	 */
	public function setDatefield($datefield) {
		$this->datefield = $datefield;
	}

	/**
	 * Returns the boolean state of datefield
	 *
	 * @return bool
	 */
	public function isDatefield() {
		return $this->datefield;
	}

	/**
	 * Returns the validation
	 *
	 * @return string validation
	 */
	public function getValidation() {
		return $this->validation;
	}

	/**
	 * Sets the validation
	 *
	 * @param string $validation
	 * @return void
	 */
	public function setValidation($validation) {
		$this->validation = $validation;
	}

}