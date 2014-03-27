<?php
/**
 * @author  Martyushev Dmitry (dangozero@gmail.com)
 * @copyright Copyright (c) 2014, dangozero
 * @license LICENSE
 */
namespace application\extensions\dataset;

use \CDbCriteria;

use kernel\storage\Type;
use kernel\storage\Media;

use kernel\components\Image;

use kernel\components\DatasetActiveBehavior;

class ImageBehavior extends DatasetActiveBehavior {
	private $_files = array();
	
	public function createCriteria($condition='',$params=array())
	{
		if(is_array($condition))
			$criteria=new CDbCriteria($condition);
		elseif($condition instanceof CDbCriteria)
			$criteria=clone $condition;
		else
		{
			$criteria=new CDbCriteria;
			$criteria->condition=$condition;
			$criteria->params=$params;
		}
		return $criteria;
	}
	
	protected function images($type, $group_id, $params = array())
	{
		if(isset($params['criteria']))
		{
			$criteria = $this->createCriteria($params['criteria']);
		} else {
			$criteria = new CDbCriteria();
		}
		$criteria->compare('type_id', $type->id);
		$criteria->compare('group_id', $group_id);
		$criteria->compare('kind', 'images');
		$criteria->order = 'sort ASC';
		
		if( !isset($this->_files[$group_id]) ) 
		{
			$this->_files[$group_id] = array();
			foreach( Media::model()->findAll($criteria) as $media )
			{
				$this->_files[$group_id][] = new Image($media, $params);
			}
		}
		return $this->_files[$group_id];
	}
	
	public function valueOf(Type $type, array $params = array())
	{
		$owner = $this->getOwner();
		if(isset($owner->{$type->name}))
			return $this->images($type, $owner->{$type->name}, $params);
		return array();
	}
	
	public function store(Type $type)
	{
		$owner = $this->getOwner();
		$group_id = $owner[$type->name];
		
		if(isset($_POST['Media'][$group_id]))
		{
			foreach( $_POST['Media'][$group_id] as $id => $attributes)
			{
				$media = Media::model()->findByPk($id);
				$media->setAttributes($attributes);
				$media->save();
			}
		}
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
