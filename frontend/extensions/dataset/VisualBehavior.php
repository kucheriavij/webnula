<?php
/**
 * @author  Martyushev Dmitry (dangozero@gmail.com)
 * @copyright Copyright (c) 2014, dangozero
 * @license LICENSE
 */
namespace application\extensions\dataset;

use kernel\storage\Type;
use kernel\components\DatasetActiveBehavior;

class VisualBehavior extends DatasetActiveBehavior {
	public function valueOf(Type $type, array $params = array())
	{
		$owner = $this->getOwner();
		return $owner[$type->name];
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
