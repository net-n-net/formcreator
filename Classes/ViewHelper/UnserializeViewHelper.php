<?php
namespace Nnn\Formcreator\ViewHelper;

class UnserializeViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper {
	
	/** 
	* @param string $serialized 
	* @return mixed
	*/
	public function render($serialized) {
		
		// \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump(array(__CLASS__.'->'.__FUNCTION__,$serialized));
        // die();        
               
		return unserialize($serialized);
	}

}