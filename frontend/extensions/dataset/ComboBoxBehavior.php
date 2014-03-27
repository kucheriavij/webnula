<?php
/**
 * @author  Martyushev Dmitry (dangozero@gmail.com)
 * @copyright Copyright (c) 2014, dangozero
 * @license LICENSE
 */

namespace application\extensions\dataset;

use \CHtml;

use kernel\storage\Type;
use kernel\components\DatasetActiveBehavior;

class ComboBoxBehavior extends DatasetActiveBehavior {
	public function valueOf(Type $type, array $params = array())
	{
		$owner = $this->getOwner();
		$key = $owner[$type->name];
		if(isset($type->options['values'][$key])) {
			return $type->options['values'][$key];
		}
		return null;
	}
	
	public function store(Type $type)
	{
		$owner = $this->getOwner();
		$modelName = CHtml::modelName($type->set->classname);
		
		$owner[$type->name] = $_POST[$modelName][$type->name];
		if( isset($_POST[$modelName]['new'][$type->name]) ) {
			$new_value = $_POST[$modelName]['new'][$type->name];
			$options = $type->options;

			if( !in_array($new_value, $options['values']) ) {
				$owner[$type->name] = array_push($options['values'], $new_value);
				$type->options = $options;
				$type->update(array('options'));
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
