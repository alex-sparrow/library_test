<?php
$this->pageTitle=Yii::app()->name . ' - Edit Book';
$this->breadcrumbs=array(
	'Books','Edit'
);

?>
<?php
/* @var $this BooksController */
/* @var $model Books */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'books-BookEdit-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

        <div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title'); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'annotation'); ?>
		<?php echo $form->textArea($model,'annotation'); ?>
		<?php echo $form->error($model,'annotation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'publish'); ?>
		<?php echo $form->textField($model,'publish'); ?>
		<?php echo $form->error($model,'publish'); ?>
	</div>

	

	<div class="row">
		<?php echo $form->labelEx($model,'publ_date'); ?>
		<?php echo $form->textField($model,'publ_date',array('class'=>'pick_date')); ?>
		<?php echo $form->error($model,'publ_date'); ?>
	</div>

        <div class="row">
		<?php echo $form->labelEx($model,'edition'); ?>
		<?php echo $form->textField($model,'edition'); ?>
		<?php echo $form->error($model,'edition'); ?>
	</div>
        
        <?php if(isset($authors)): ?>
        <div class="row">
            
            <h3>Authors</h3>
             <?php
                foreach($authors as $auth){
                     echo CHtml::link($auth['lastname'], array('author/edit','a_id'=>$auth['id']));
                     echo '&nbsp';
                     echo CHtml::link('X', array('books/removeauth','a_id'=>$auth['id'],'b_id'=>$model->id),array('class'=>'remove'));
                     echo '<br>';
                 }
             ?>
            <span>Add author</span>
            <?php echo CHtml::textField('add_auth');?>
	</div>
        <?php else: ?>
            <div class="row">
                <span>Select author</span>
                <?php echo CHtml::textField('add_auth');?>
            </div>
        <?php endif; ?>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->