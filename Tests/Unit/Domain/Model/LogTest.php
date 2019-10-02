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
 * Test case for class \Nnn\Formcreator\Domain\Model\Log.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class LogTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \Nnn\Formcreator\Domain\Model\Log
	 */
	protected $subject = NULL;

	public function setUp() {
		$this->subject = new \Nnn\Formcreator\Domain\Model\Log();
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getIpReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getIp()
		);
	}

	/**
	 * @test
	 */
	public function setIpForStringSetsIp() {
		$this->subject->setIp('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'ip',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getParamsReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getParams()
		);
	}

	/**
	 * @test
	 */
	public function setParamsForStringSetsParams() {
		$this->subject->setParams('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'params',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getFormReturnsInitialValueForInt() {	}

	/**
	 * @test
	 */
	public function setFormForIntSetsForm() {	}
}
