<?php
/**
 * @author
 * @version
 * @see
 * @link
 * @license
 */

namespace application\extensions\dataset;

use \CHtml;
use \CJSON;

use kernel\storage\Type;
use kernel\storage\Set;
use kernel\storage\Dataset;
use kernel\components\DatasetActiveBehavior;

class ObjectBehavior extends DatasetActiveBehavior {
	protected $_elements = array();
	
	public function valueOf(Type $type, array $params = array())
	{
		$owner = $this->getOwner();
		if( !isset($this->_elements[$type->id]) ) {
			$result = array();
			$pk = CJSON::decode($owner[$type->name]);
			if(($target = Set::model()->findByPk($type->options['target'])) !== null) {
				$result = Dataset::model($target->classname)->findAllByPk($pk);
			}
			$this->_elements[$type->id] = $result;
		}
		return $this->_elements[$type->id];
	}
	
	public function store(Type $type)
	{
		if(($target = Set::model()->findByPk($type->options['target'])) !== null)
		{
			$className = CHtml::modelName($target->classname);
			if( isset($_POST[$className]) ) {
				foreach($_POST[$className] as $index => $datas ) {
				}
			}
		}
	}
	
	public function delete(Type $type)
	{
		
	}
	
	public function cleanUp(Type $type, array $params = array())
	{
		
	}
}
