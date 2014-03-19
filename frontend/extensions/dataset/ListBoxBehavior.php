<?php
/**
 * @author
 * @version
 * @see
 * @link
 * @license
 */

namespace application\extensions\dataset;

use \CJSON;

use kernel\storage\Type;
use kernel\components\DatasetActiveBehavior;

class ListBoxBehavior extends DatasetActiveBehavior {
	public function valueOf(Type $type, array $params = array())
	{
		$owner = $this->getOwner();
		$keys = (array)CJSON::decode($owner[$type->name]);
		
		$values = array();
		foreach( $keys as $key ) {
			$values[] = $type->options['values'][$key];
		}
		return $values;
	}
	
	public function store(Type $type)
	{
		$owner = $this->getOwner();
		$owner[$type->name] = CJSON::encode(array_values($owner[$type->name]));
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
