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

/**
 * LogController
 */
class LogController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {
	/**
	 * formRepository
	 *
	 * @var \Nnn\Formcreator\Domain\Repository\FormRepository
	 * @inject
	 */
	protected $formRepository = NULL;
	
	/**
	 * logRepository
	 *
	 * @var \Nnn\Formcreator\Domain\Repository\LogRepository
	 * @inject
	 */
	protected $logRepository = NULL;
	
	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$forms = $this->formRepository->findAll();
		$rep = $this->objectManager->get(\Nnn\Formcreator\Domain\Repository\LogRepository::class);
		$logs = $rep->findAll();
		$this->view->assign('forms', $forms);
		$this->view->assign('logs', $logs);
	}
	/**
	 * action logs
	 *
	 * @param Nnn\Formcreator\Domain\Model\Form
	 * @return void
	 */
	public function logsAction() {
		$args = $this->request->getArguments();
		 
		if($formId = $args['log']){
			$logs = $this->logRepository->findByForm($formId);
			$this->view->assign('logs', $logs);
		}
		
	}
	
	/**
	 * action show
	 * @param \Nnn\Formcreator\Domain\Model\Log $newLog
	 *
	 * @return void
	 */
	public function showAction(\Nnn\Formcreator\Domain\Model\Log $log) {
		$this->view->assign('log', $log);
	}
	
	/**
	 * action export
	 *
	 * @return void
	 */
	public function exportAction() {
		$args = $this->request->getArguments();
        header('Content-Type: text/html; charset=utf-8');
        header('Pragma: no-cache');
        header('Content-Disposition: attachment; filename=ExportLogs.csv');
		if($formId = $args['forms']){
			$logs = $this->logRepository->findByForm($formId)->toArray();
			if ($logs) {
				// needed for excell to regonize utf-8 charset
				echo pack("CCC", 0xef, 0xbb, 0xbf);

				$output = fopen('php://output', 'w');
				$csv_fields = array();
				
				$i=0;
				foreach($logs as $log){
					$params = unserialize($log->getParams());
					if($i==0){
						$csv_fields[] = addslashes('Uid');
						$csv_fields[] = addslashes('IP');
						
						if($params){
							foreach ($params as $key => $value){
								$csv_fields[] = addslashes($key);
							}
						}
						fputcsv($output, $csv_fields, ';');
					}
					$i++;
					
					$exportFields['uid'] = $log->getUid();
					$exportFields['IP'] = $log->getIp();
					
					if($params){
						foreach ($params as $key => $param) {
							$exportFields[$key] = $param;
							
						}
						fputcsv($output, $exportFields, ';');
					}
				}
				fclose($output);
			}
            exit();
        }
    }


}