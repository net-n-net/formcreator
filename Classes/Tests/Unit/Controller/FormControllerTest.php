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
 * Test case for class Nnn\Formcreator\Controller\FormController.
 *
 */
class FormControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \Nnn\Formcreator\Controller\FormController
	 */
	protected $subject = NULL;

	public function setUp() {
		$this->subject = $this->getMock('Nnn\\Formcreator\\Controller\\FormController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllFormsFromRepositoryAndAssignsThemToView() {

		$allForms = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$formRepository = $this->getMock('Nnn\\Formcreator\\Domain\\Repository\\FormRepository', array('findAll'), array(), '', FALSE);
		$formRepository->expects($this->once())->method('findAll')->will($this->returnValue($allForms));
		$this->inject($this->subject, 'formRepository', $formRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('forms', $allForms);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenFormToView() {
		$form = new \Nnn\Formcreator\Domain\Model\Form();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('form', $form);

		$this->subject->showAction($form);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenFormToView() {
		$form = new \Nnn\Formcreator\Domain\Model\Form();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newForm', $form);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($form);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenFormToFormRepository() {
		$form = new \Nnn\Formcreator\Domain\Model\Form();

		$formRepository = $this->getMock('Nnn\\Formcreator\\Domain\\Repository\\FormRepository', array('add'), array(), '', FALSE);
		$formRepository->expects($this->once())->method('add')->with($form);
		$this->inject($this->subject, 'formRepository', $formRepository);

		$this->subject->createAction($form);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenFormToView() {
		$form = new \Nnn\Formcreator\Domain\Model\Form();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('form', $form);

		$this->subject->editAction($form);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenFormInFormRepository() {
		$form = new \Nnn\Formcreator\Domain\Model\Form();

		$formRepository = $this->getMock('Nnn\\Formcreator\\Domain\\Repository\\FormRepository', array('update'), array(), '', FALSE);
		$formRepository->expects($this->once())->method('update')->with($form);
		$this->inject($this->subject, 'formRepository', $formRepository);

		$this->subject->updateAction($form);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenFormFromFormRepository() {
		$form = new \Nnn\Formcreator\Domain\Model\Form();

		$formRepository = $this->getMock('Nnn\\Formcreator\\Domain\\Repository\\FormRepository', array('remove'), array(), '', FALSE);
		$formRepository->expects($this->once())->method('remove')->with($form);
		$this->inject($this->subject, 'formRepository', $formRepository);

		$this->subject->deleteAction($form);
	}
}
