<?php

/**
 * This is the model class for table "{{storage_section}}".
 *
 * The followings are the available columns in table '{{storage_section}}':
 * @property integer $id
 * @property integer $set_id
 * @property integer $parent_id
 * @property integer $root_id
 * @property integer $level
 * @property integer $left_key
 * @property integer $right_key
 * @property integer $publish
 * @property string $title
 * @property string $name
 * @property string $url
 * @property string $r_url
 * @property string $handler
 *
 * The followings are the available model relations:
 * @property application\storage\Set $set
 * @property application\storage\Set[] $tblStorageSets
 */

namespace common\storage; 

use kernel\storage\Type;
use kernel\storage\Set;

class Section extends \kernel\storage\Section
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return common\storage\Section the static model class
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
		return '{{storage_section}}';
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
		$criteria->compare('root_id',$this->root_id);
		$criteria->compare('level',$this->level);
		$criteria->compare('left_key',$this->left_key);
		$criteria->compare('right_key',$this->right_key);
		$criteria->compare('publish',$this->publish);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('r_url',$this->r_url,true);
		$criteria->compare('handler',$this->handler,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}