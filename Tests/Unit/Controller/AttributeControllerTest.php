<?php
namespace Nnn\Formcreator\Tests\Unit\Controller;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2019 
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
 * Test case for class Nnn\Formcreator\Controller\AttributeController.
 *
 */
class AttributeControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \Nnn\Formcreator\Controller\AttributeController
	 */
	protected $subject = NULL;

	public function setUp() {
		$this->subject = $this->getMock('Nnn\\Formcreator\\Controller\\AttributeController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllAttributesFromRepositoryAndAssignsThemToView() {

		$allAttributes = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$attributeRepository = $this->getMock('', array('findAll'), array(), '', FALSE);
		$attributeRepository->expects($this->once())->method('findAll')->will($this->returnValue($allAttributes));
		$this->inject($this->subject, 'attributeRepository', $attributeRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('attributes', $allAttributes);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenAttributeToView() {
		$attribute = new \Nnn\Formcreator\Domain\Model\Attribute();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('attribute', $attribute);

		$this->subject->showAction($attribute);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenAttributeToView() {
		$attribute = new \Nnn\Formcreator\Domain\Model\Attribute();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newAttribute', $attribute);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($attribute);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenAttributeToAttributeRepository() {
		$attribute = new \Nnn\Formcreator\Domain\Model\Attribute();

		$attributeRepository = $this->getMock('', array('add'), array(), '', FALSE);
		$attributeRepository->expects($this->once())->method('add')->with($attribute);
		$this->inject($this->subject, 'attributeRepository', $attributeRepository);

		$this->subject->createAction($attribute);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenAttributeToView() {
		$attribute = new \Nnn\Formcreator\Domain\Model\Attribute();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('attribute', $attribute);

		$this->subject->editAction($attribute);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenAttributeInAttributeRepository() {
		$attribute = new \Nnn\Formcreator\Domain\Model\Attribute();

		$attributeRepository = $this->getMock('', array('update'), array(), '', FALSE);
		$attributeRepository->expects($this->once())->method('update')->with($attribute);
		$this->inject($this->subject, 'attributeRepository', $attributeRepository);

		$this->subject->updateAction($attribute);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenAttributeFromAttributeRepository() {
		$attribute = new \Nnn\Formcreator\Domain\Model\Attribute();

		$attributeRepository = $this->getMock('', array('remove'), array(), '', FALSE);
		$attributeRepository->expects($this->once())->method('remove')->with($attribute);
		$this->inject($this->subject, 'attributeRepository', $attributeRepository);

		$this->subject->deleteAction($attribute);
	}
}
