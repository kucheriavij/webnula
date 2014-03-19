<?php

/**
 * This is the model class for table "{{storage_object}}".
 *
 * The followings are the available columns in table '{{storage_object}}':
 * @property integer $id
 * @property integer $set_id
 * @property integer $parent_id
 * @property integer $sort
 * @property integer $publish
 * @property string $title
 * @property string $name
 * @property string $url
 */

namespace common\storage; 

use kernel\storage\Type;
use kernel\storage\Set;

class Object extends \kernel\storage\Object
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return common\storage\Object the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{storage_object}}';
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return \CMap::mergeArray(parent::relations(), array(
		));
	}


	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('set_id',$this->set_id);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('publish',$this->publish);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('url',$this->url,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}