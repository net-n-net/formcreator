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
 * Test case for class Nnn\Formcreator\Controller\LogController.
 *
 */
class LogControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \Nnn\Formcreator\Controller\LogController
	 */
	protected $subject = NULL;

	public function setUp() {
		$this->subject = $this->getMock('Nnn\\Formcreator\\Controller\\LogController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllLogsFromRepositoryAndAssignsThemToView() {

		$allLogs = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$logRepository = $this->getMock('', array('findAll'), array(), '', FALSE);
		$logRepository->expects($this->once())->method('findAll')->will($this->returnValue($allLogs));
		$this->inject($this->subject, 'logRepository', $logRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('logs', $allLogs);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenLogToView() {
		$log = new \Nnn\Formcreator\Domain\Model\Log();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newLog', $log);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($log);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenLogToLogRepository() {
		$log = new \Nnn\Formcreator\Domain\Model\Log();

		$logRepository = $this->getMock('', array('add'), array(), '', FALSE);
		$logRepository->expects($this->once())->method('add')->with($log);
		$this->inject($this->subject, 'logRepository', $logRepository);

		$this->subject->createAction($log);
	}
}
