<?php

/**
 * This is the model class for table "{{storage_user}}".
 *
 * The followings are the available columns in table '{{storage_user}}':
 * @property integer $id
 * @property integer $useractive
 * @property string $username
 * @property string $password
 * @property string $usermail
 * @property string $userhash
 *
 * The followings are the available model relations:
 * @property application\storage\Set[] $tblStorageSets
 */

namespace common\storage; 

use kernel\storage\Type;
use kernel\storage\Set;

class User extends \kernel\storage\User
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return common\storage\User the static model class
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
		return '{{storage_user}}';
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
		$criteria->compare('useractive',$this->useractive);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('usermail',$this->usermail,true);
		$criteria->compare('userhash',$this->userhash,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}