<?php
/**
 * @author  Martyushev Dmitry (dangozero@gmail.com)
 * @copyright Copyright (c) 2014, dangozero
 * @license LICENSE
 */
namespace application\extensions\dataset;

use kernel\storage\Type;
use kernel\components\DatasetActiveBehavior;

class RadioButtonBehavior extends DatasetActiveBehavior {
	public function valueOf(Type $type, array $params = array())
	{
		$owner = $this->getOwner();
		$key = $owner[$type->name];
		return $type->options['values'][$key];
	}
	
	public function store(Type $type)
	{
		// NOTHING
	}
	
	public function delete(Type $type)
	{
		// NOTHING
	}
	
	public function cleanUp(Type $type, array $params = array())
	{
		// NOTHING
	}
}
