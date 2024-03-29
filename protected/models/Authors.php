<?php

/**
 * This is the model class for table "authors".
 *
 * The followings are the available columns in table 'authors':
 * @property string $id
 * @property string $firstname
 * @property string $surname
 * @property string $lastname
 * @property string $nationality
 * @property integer $birth_y
 *
 * The followings are the available model relations:
 * @property LtBooksAuthors[] $ltBooksAuthors
 */
class Authors extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'authors';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lastname', 'required'),
			array('birth_y', 'numerical', 'integerOnly'=>true),
			array('firstname, surname, lastname, nationality', 'length', 'max'=>60),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, firstname, surname, lastname, nationality, birth_y', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			    'books'=>array(self::MANY_MANY, 'Books','lt_books_authors(book_id,author_id)')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'firstname' => 'Firstname',
			'surname' => 'Surname',
			'lastname' => 'Lastname',
			'nationality' => 'Nationality',
			'birth_y' => 'Birth Y',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

	
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('surname',$this->surname,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('nationality',$this->nationality,true);
		$criteria->compare('birth_y',$this->birth_y);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Authors the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
