<?php
    $this->pageTitle=Yii::app()->name . ' - Books';
    $this->breadcrumbs=array(
            'Books',
    );
?>
<h1>Authors</h1>
<table class="lib_t">
    <thead>
        <tr><td></td></tr>
    </thead>
    <tbody>
        <?php      
            foreach ($a_data as $item):
        ?>
                <tr><td><?php echo $item->firstname; ?>&nbsp;<?php echo $item->surname; ?>&nbsp;<?php echo $item->lastname; ?></td></tr>
                <tr><td class="l_row"><?php echo CHtml::link('Edit author', array('author/edit','a_id'=>$item->id));?>&nbsp;<?php echo CHtml::link('Remove author', array('author/remove','a_id'=>$item->id),array('class'=>'remove'));?></td></tr>
        <?php
            endforeach;
         ?>   
        
    </tbody>
    <tfoot>
            <tr><td ><?php echo CHtml::link('Add New Author', array('author/add'));?></td></tr>
    </tfoot>
</table>