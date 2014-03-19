<?php
/**
 * 
 *
 * @author 
 * @link 
 * @copyright 
 * @license 
 */

use backend\components\Action;

class ClearImageAction extends Action {
	public function getTitle()
	{
		return "Очистить кэш изображений";
	}
	
	public function getRules()
	{
		return array(array('allow', 'actions' => array('clearimages'), 'roles' => array('Administrator')));
	}
	
	public function getEnabled()
	{
		return true;
	}
	
	public function run($node, $scope)
	{
	}
}
