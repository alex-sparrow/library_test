<?php

class BooksController extends Controller
{
        public function actionIndex(){
            //include scripts and css
            Yii::app()->getClientScript()->registerCoreScript('jquery');
            $cs = Yii::app()->clientScript;
            $cs->registerScriptFile('/js/'.'books.js'); // register script file
             //  
            
            //pager creation
            $criteria = new CDbCriteria();
            $count=Books::model()->count($criteria);
            $pages=new CPagination($count);
            //  elements on page
            $pages->pageSize=5;
            $pages->applyLimit($criteria);
    
            $b_data = Books::model()->with('authors')->findAll($criteria); //get Book with authors through many to many relation
            
            foreach($b_data as $item){  //get only author lastname.
               $tmp_auth = array();
               foreach($item->authors as $auth)
               {
                   $tmp_auth[] =  $auth->firstname.' '.$auth->lastname; 
               }
               $item->authors = $tmp_auth;
            }
            
            $this->render('index',array('b_data'=>$b_data,'pages'=>$pages));
        }
        
        public function actionRemove($b_id){
            Yii::app()->db->createCommand()
                ->delete('lt_books_authors','book_id='.$b_id); //removing records from link table      
            Books::model()->deleteByPk($b_id);
            $this->actionIndex();
        }
        public function actionEdit($b_id){
            
            //include scripts and css
            Yii::app()->getClientScript()->registerCoreScript('jquery');
            Yii::app()->getClientScript()->registerCoreScript('jquery.ui');
            $cs = Yii::app()->clientScript;
            $cs->registerCssFile('/js/datepicker/css/'.'datepicker.css');
            
            $cs->registerScriptFile('/js/'.'books.js'); 
            //
            $book = new Books();
            $book = $book->findByPk($b_id);
            $command = Yii::app()->db->createCommand(); 
            if(isset($_POST['Books']))//Saving form data
		{
			$book->attributes=$_POST['Books'];
			if($book->validate())
			{
                           $book->save();                         
                           if(isset($_POST['add_auth'])&&!empty($_POST['add_auth'])) //If new author was selected
                            {
                                $criteria = new CDbCriteria;
                                $criteria->compare('lastname', $_POST['add_auth']);
                                $add_author = Authors::model()->find($criteria);     //If author exists

                                if(!empty($add_author))                             //insert link book-author to link table
                                    $command->insert('lt_books_authors',array(
                                        'author_id' =>$add_author->id,
                                        'book_id' =>$b_id
                                    ));                                   
                            }                 
			}
		}
            
            //Collecting Data
            
            $command = Yii::app()->db->createCommand();
            $authors = $command->select('a.id,a.lastname')
                                ->from('authors a')
                                 ->join('lt_books_authors lt_b_a', 'a.id=lt_b_a.author_id')
                                ->where('lt_b_a.book_id='.$b_id)
                                ->queryAll(); //find book authors
            
            $this->render('edit',array('model'=>$book,'authors'=>$authors));
        }
        public function actionAdd(){
             Yii::app()->getClientScript()->registerCoreScript('jquery');
            Yii::app()->getClientScript()->registerCoreScript('jquery.ui');
            $cs = Yii::app()->clientScript;
            $cs->registerCssFile('/js/datepicker/css/'.'datepicker.css');
            
            $cs->registerScriptFile('/js/'.'books.js'); 
            //
            $book = new Books();
            $command = Yii::app()->db->createCommand(); 
            
             if(isset($_POST['Books']))
		{
			$book->attributes=$_POST['Books'];
			if($book->validate())
			{
                           $book->save();
                           
                           if(isset($_POST['add_auth'])&&!empty($_POST['add_auth'])) //If new author was selected
                            {
                                $criteria = new CDbCriteria;
                                $criteria->compare('lastname', $_POST['add_auth']);
                                $add_author = Authors::model()->find($criteria);     //If author exists

                                if(!empty($add_author))                             //insert link book-author to link table
                                    $command->insert('lt_books_authors',array(
                                        'author_id' =>$add_author->id,
                                        'book_id' =>$book->id
                                    ));   
                                
                            }     
                            
                           $this->actionIndex();
                           return true;
			}
		}
            $this->render('edit',array('model'=>$book));
        }
        public function actionRemoveauth($b_id,$a_id){//remove Author record from the book
            Yii::app()->db->createCommand()
                ->delete('lt_books_authors','book_id='.$b_id); //removing records from link table
            $this->redirect(array('/books/edit','b_id'=>$b_id)); 
        }
}

