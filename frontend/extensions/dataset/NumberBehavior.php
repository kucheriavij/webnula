<?php
/**
 * @author
 * @version
 * @see
 * @link
 * @license
 */

namespace application\extensions\dataset;

use kernel\storage\Type;
use kernel\components\DatasetActiveBehavior;

class NumberBehavior extends DatasetActiveBehavior {
	public function valueOf(Type $type, array $params = array())
	{
		$owner = $this->getOwner();
		return $owner[$type->name];
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
