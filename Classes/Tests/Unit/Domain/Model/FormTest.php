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
 * Test case for class \Nnn\Formcreator\Domain\Model\Form.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class FormTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \Nnn\Formcreator\Domain\Model\Form
	 */
	protected $subject = NULL;

	public function setUp() {
		$this->subject = new \Nnn\Formcreator\Domain\Model\Form();
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getNameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getName()
		);
	}

	/**
	 * @test
	 */
	public function setNameForStringSetsName() {
		$this->subject->setName('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'name',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getSubmitReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getSubmit()
		);
	}

	/**
	 * @test
	 */
	public function setSubmitForStringSetsSubmit() {
		$this->subject->setSubmit('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'submit',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getAttributesReturnsInitialValueForAttribute() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getAttributes()
		);
	}

	/**
	 * @test
	 */
	public function setAttributesForObjectStorageContainingAttributeSetsAttributes() {
		$attribute = new \Nnn\Formcreator\Domain\Model\Attribute();
		$objectStorageHoldingExactlyOneAttributes = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneAttributes->attach($attribute);
		$this->subject->setAttributes($objectStorageHoldingExactlyOneAttributes);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneAttributes,
			'attributes',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addAttributeToObjectStorageHoldingAttributes() {
		$attribute = new \Nnn\Formcreator\Domain\Model\Attribute();
		$attributesObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$attributesObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($attribute));
		$this->inject($this->subject, 'attributes', $attributesObjectStorageMock);

		$this->subject->addAttribute($attribute);
	}

	/**
	 * @test
	 */
	public function removeAttributeFromObjectStorageHoldingAttributes() {
		$attribute = new \Nnn\Formcreator\Domain\Model\Attribute();
		$attributesObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$attributesObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($attribute));
		$this->inject($this->subject, 'attributes', $attributesObjectStorageMock);

		$this->subject->removeAttribute($attribute);

	}



	
}
