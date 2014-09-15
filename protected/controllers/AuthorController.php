<?php

class AuthorController extends Controller {

    public function actionIndex() {
        //include scripts and css
        Yii::app()->getClientScript()->registerCoreScript('jquery');
        $cs = Yii::app()->clientScript;
        $cs->registerScriptFile('/js/' . 'books.js'); // register script file
        // 
        //pager creation
        $criteria = new CDbCriteria();
        $count = Authors::model()->count($criteria);
        $pages = new CPagination($count);
        //  elements on page
        $pages->pageSize = 10;
        $pages->applyLimit($criteria);
        //
        $a_data = Authors::model()->findAll();

        $this->render('index', array('a_data' => $a_data));
    }

    public function actionEdit($a_id) {
        $author = new Authors();
        $author = $author->findByPk($a_id);
        $command = Yii::app()->db->createCommand();
        if (isset($_POST['Authors'])) {//Saving form data
            $author->attributes = $_POST['Authors'];
            if ($author->validate()) {
                $author->save();
            }
        }

        //Collecting Data

        $command = Yii::app()->db->createCommand();


        $this->render('edit', array('model' => $author));
    }

    public function actionAdd() {
        $author = new Authors();

        if (isset($_POST['Authors'])) {
            $author->attributes = $_POST['Authors'];
            if ($author->validate()) {
                $author->save();
                $this->actionIndex();
                return true;
            }
        }
        $this->render('edit', array('model' => $author));
    }

    public function actionRemove($a_id) {
        Yii::app()->db->createCommand()
                ->delete('lt_books_authors', 'author_id=' . $a_id); //removing records from link table      
        Authors::model()->deleteByPk($a_id);
        $this->actionIndex();
    }

}
