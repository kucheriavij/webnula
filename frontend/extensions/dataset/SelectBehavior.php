<?php
/**
 * @author  Martyushev Dmitry (dangozero@gmail.com)
 * @copyright Copyright (c) 2014, dangozero
 * @license LICENSE
 */
namespace application\extensions\dataset;

use kernel\storage\Type;
use kernel\components\DatasetActiveBehavior;

class SelectBehavior extends DatasetActiveBehavior {
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
		
	}
	
	public function delete(Type $type)
	{
		
	}
	
	public function cleanUp(Type $type, array $params = array())
	{
		
	}
}
