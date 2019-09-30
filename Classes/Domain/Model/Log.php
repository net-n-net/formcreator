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
 * Log
 */
class Log extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * crdate
	 *
	 * @var string
	 */
	protected $crdate;
	
	/**
	 * ip
	 *
	 * @var string
	 */
	protected $ip = '';

	/**
	 * params
	 *
	 * @var string
	 */
	protected $params = '';

	/**
	 * form
	 *
	 * @var int
	 */
	protected $form = 0;

	/**
	 * Returns the crdate
	 *
	 * @return string crdate
	 */
	public function getCrdate() {
		return $this->crdate;
	}
	
	/**
	 * Sets the crdate
	 *
	 * @param string $crdate
	 * @return void
	 */
	public function setCrdate($crdate) {
		$this->crdate = $crdate;
	}

	
	/**
	 * Returns the ip
	 *
	 * @return string ip
	 */
	public function getIp() {
		return $this->ip;
	}

	/**
	 * Sets the ip
	 *
	 * @param string $ip
	 * @return void
	 */
	public function setIp($ip) {
		$this->ip = $ip;
	}

	/**
	 * Returns the params
	 *
	 * @return string params
	 */
	public function getParams() {
		return $this->params;
	}

	/**
	 * Sets the params
	 *
	 * @param string $params
	 * @return void
	 */
	public function setParams($params) {
		$this->params = $params;
	}

	/**
	 * Returns the form
	 *
	 * @return int form
	 */
	public function getForm() {
		return $this->form;
	}

	/**
	 * Sets the form
	 *
	 * @param int $form
	 * @return void
	 */
	public function setForm($form) {
		$this->form = $form;
	}

}