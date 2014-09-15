<?php

/**
 * This is the model class for table "books".
 *
 * The followings are the available columns in table 'books':
 * @property string $id
 * @property string $title
 * @property string $annotation
 * @property string $publish
 * @property string $publ_date
 * @property integer $edition
 *
 * The followings are the available model relations:
 * @property LtBooksAuthors[] $ltBooksAuthors
 */
class Books extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'books';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('title', 'required'),
			array('edition', 'numerical', 'integerOnly'=>true),
			array('title, publish', 'length', 'max'=>45),
			array('annotation', 'length', 'max'=>255),
			array('publ_date', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, annotation, publish, publ_date, edition', 'safe', 'on'=>'search'),
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
                    'authors'=>array(self::MANY_MANY, 'Authors','lt_books_authors(author_id, book_id)')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'annotation' => 'Annotation',
			'publish' => 'Publish',
			'publ_date' => 'Publ Date',
			'edition' => 'Edition',
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

		$criteria->compare('title',$this->title,true);
		$criteria->compare('annotation',$this->annotation,true);
		$criteria->compare('publish',$this->publish,true);
		$criteria->compare('publ_date',$this->publ_date,true);
		$criteria->compare('edition',$this->edition);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function beforeDelete(){
            
           /* 
            */
            return parent::beforeDelete();
        }
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Books the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        protected function afterFind()
    {
        // convert to display format
        $this->publ_date = date('d-m-Y',$this->publ_date);

        parent::afterFind();
    }
     protected function beforeSave()
    {
        // convert to storage format
        $this->publ_date = strtotime($this->publ_date);
        
        return parent::beforeSave();
    }
}
