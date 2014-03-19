<?php

/**
 * This is the model class for table "{{storage_media}}".
 *
 * The followings are the available columns in table '{{storage_media}}':
 * @property integer $id
 * @property integer $group_id
 * @property integer $type_id
 * @property integer $sort
 * @property integer $main
 * @property string $title
 * @property string $description
 * @property string $kind
 * @property string $file
 *
 * The followings are the available model relations:
 * @property application\storage\Type $type
 * @property application\storage\Set[] $tblStorageSets
 */

namespace common\storage; 

use kernel\storage\Type;
use kernel\storage\Set;

class Media extends \kernel\storage\Media
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return common\storage\Media the static model class
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
		return '{{storage_media}}';
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
		$criteria->compare('group_id',$this->group_id);
		$criteria->compare('type_id',$this->type_id);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('main',$this->main);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('kind',$this->kind,true);
		$criteria->compare('file',$this->file,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}