<?php

namespace Nnn\Formcreator\Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2019 
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class \Nnn\Formcreator\Domain\Model\Attribute.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class AttributeTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \Nnn\Formcreator\Domain\Model\Attribute
	 */
	protected $subject = NULL;

	public function setUp() {
		$this->subject = new \Nnn\Formcreator\Domain\Model\Attribute();
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getFieldnameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getFieldname()
		);
	}

	/**
	 * @test
	 */
	public function setFieldnameForStringSetsFieldname() {
		$this->subject->setFieldname('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'fieldname',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getFieldlabelReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getFieldlabel()
		);
	}

	/**
	 * @test
	 */
	public function setFieldlabelForStringSetsFieldlabel() {
		$this->subject->setFieldlabel('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'fieldlabel',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLabel1ReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getLabel1()
		);
	}

	/**
	 * @test
	 */
	public function setLabel1ForStringSetsLabel1() {
		$this->subject->setLabel1('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'label1',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLabel2ReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getLabel2()
		);
	}

	/**
	 * @test
	 */
	public function setLabel2ForStringSetsLabel2() {
		$this->subject->setLabel2('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'label2',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPlaceholderReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getPlaceholder()
		);
	}

	/**
	 * @test
	 */
	public function setPlaceholderForStringSetsPlaceholder() {
		$this->subject->setPlaceholder('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'placeholder',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getTypeReturnsInitialValueForInt() {	}

	/**
	 * @test
	 */
	public function setTypeForIntSetsType() {	}

	/**
	 * @test
	 */
	public function getTextReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getText()
		);
	}

	/**
	 * @test
	 */
	public function setTextForStringSetsText() {
		$this->subject->setText('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'text',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getValidationReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getValidation()
		);
	}

	/**
	 * @test
	 */
	public function setValidationForStringSetsValidation() {
		$this->subject->setValidation('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'validation',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getMandatoryReturnsInitialValueForBool() {
		$this->assertSame(
			FALSE,
			$this->subject->getMandatory()
		);
	}

	/**
	 * @test
	 */
	public function setMandatoryForBoolSetsMandatory() {
		$this->subject->setMandatory(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'mandatory',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getSenderEmailReturnsInitialValueForBool() {
		$this->assertSame(
			FALSE,
			$this->subject->getSenderEmail()
		);
	}

	/**
	 * @test
	 */
	public function setSenderEmailForBoolSetsSenderEmail() {
		$this->subject->setSenderEmail(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'senderEmail',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getSenderNameReturnsInitialValueForBool() {
		$this->assertSame(
			FALSE,
			$this->subject->getSenderName()
		);
	}

	/**
	 * @test
	 */
	public function setSenderNameForBoolSetsSenderName() {
		$this->subject->setSenderName(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'senderName',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getSizeReturnsInitialValueForInt() {	}

	/**
	 * @test
	 */
	public function setSizeForIntSetsSize() {	}

	/**
	 * @test
	 */
	public function getErrorMessageReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getErrorMessage()
		);
	}

	/**
	 * @test
	 */
	public function setErrorMessageForStringSetsErrorMessage() {
		$this->subject->setErrorMessage('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'errorMessage',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDatefieldReturnsInitialValueForBool() {
		$this->assertSame(
			FALSE,
			$this->subject->getDatefield()
		);
	}

	/**
	 * @test
	 */
	public function setDatefieldForBoolSetsDatefield() {
		$this->subject->setDatefield(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'datefield',
			$this->subject
		);
	}
}
