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
use \CHtml;
use \Yii;
use kernel\storage\Set;
use kernel\storage\Storage;
use kernel\components\DatasetActiveBehavior;

class RelationBehavior extends DatasetActiveBehavior {
	public function valueOf(Type $type, array $params = array())
	{
		
	}
	
	public function store(Type $type)
	{
		$owner = $this->getOwner();
		$set = $owner->set();
		
		$options = $type->options;
		$command = $owner->getDbConnection()->createCommand();
		
		$modelName = CHtml::modelName($set->classname);
		$target = Set::model()->find('classname=?',array($options['target']));
		
		switch( $options['relation'] ) {
			case 'HAS_ONE':
			case 'HAS_MANY':
				break;
				
			case 'MANY_MANY':
				
				if( $owner instanceof Storage ) {
					if( is_null($owner[$type->name]) ) {
						$owner[$type->name] = $owner[$set->entityid];
						$owner->insert(array($type->name));
					}
				} else {
					if( is_null($owner[$type->name]) ) {
						// initialize 
						if( $owner->saveEx() ) {
							$owner[$type->name] = $owner->primaryKey;
							$owner->update(array($type->name));
						}
					}
				}
				
				$condition = sprintf("%s = ?", $type->name);
				$command->delete($options['table'], $condition, array($owner[$type->name]));
				
				$params = array();
				$relationName = $this->generateRelationName($set->tablename, $this->getRealName($target->tablename), true);
				foreach( $_POST[$modelName][$relationName] as $index => $value ) {
					$params[$options['field']] = $value;
					$params[$type->name] = $owner[$type->name];
					$command->insert($options['table'], $params);
				}
				break;
		}
	}
	
	public function delete(Type $type)
	{
		
	}
	
	public function cleanUp(Type $type, array $params = array())
	{
		
	}
	
	/**
	 * 
	 * @param object $tableName
	 * @return 
	 */
	protected function getRealName($tableName) {
		if(Yii::app()->getDb()->tablePrefix!==null && $tableName!='')
			$tableName=preg_replace('/{{(.*?)}}/',Yii::app()->getDb()->tablePrefix.'\1',$tableName);
		return $tableName;
	}
	
	/**
	 * 
	 * @param object $tableName
	 * @param object $fkName
	 * @param object $multiple
	 * @return 
	 */
	protected function generateRelationName($tableName, $fkName, $multiple)
	{
		if(strcasecmp(substr($fkName,-2),'id')===0 && strcasecmp($fkName,'id'))
			$relationName=rtrim(substr($fkName, 0, -2),'_');
		else
			$relationName=$fkName;
		$relationName[0]=strtolower($relationName);

		if($multiple)
			$relationName=$this->pluralize($relationName);

		$names=preg_split('/_+/',$relationName,-1,PREG_SPLIT_NO_EMPTY);
		if(empty($names)) return $relationName;  // unlikely
		for($name=strtolower($names[0]), $i=1;$i<count($names);++$i)
			$name.=ucfirst($names[$i]);

		$rawName=$name;
		$table=Yii::app()->getDb()->getSchema()->getTable($tableName);
		$i=0;
		while(isset($table->columns[$name]))
			$name=$rawName.($i++);

		return $name;
	}
	
	/**
	 * 
	 * @param object $name
	 * @return 
	 */
	private function pluralize($name)
	{
		$rules=array(
			'/(m)ove$/i' => '\1oves',
			'/(f)oot$/i' => '\1eet',
			'/(c)hild$/i' => '\1hildren',
			'/(h)uman$/i' => '\1umans',
			'/(m)an$/i' => '\1en',
			'/(t)ooth$/i' => '\1eeth',
			'/(p)erson$/i' => '\1eople',
			'/([m|l])ouse$/i' => '\1ice',
			'/(x|ch|ss|sh|us|as|is|os)$/i' => '\1es',
			'/([^aeiouy]|qu)y$/i' => '\1ies',
			'/(?:([^f])fe|([lr])f)$/i' => '\1\2ves',
			'/(shea|lea|loa|thie)f$/i' => '\1ves',
			'/([ti])um$/i' => '\1a',
			'/(tomat|potat|ech|her|vet)o$/i' => '\1oes',
			'/(bu)s$/i' => '\1ses',
			'/(ax|test)is$/i' => '\1es',
			'/s$/' => 's',
		);
		foreach($rules as $rule=>$replacement)
		{
			if(preg_match($rule,$name))
				return preg_replace($rule,$replacement,$name);
		}
		return $name.'s';
	}
}
