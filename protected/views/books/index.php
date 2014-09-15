<?php
$this->pageTitle=Yii::app()->name . ' - Books';
$this->breadcrumbs=array(
	'Books',
);
?>

<h1>Books</h1>
<table class="lib_t">
    <thead>
        <tr><td></td></tr>
    </thead>
    <tbody>
        <?php      
            foreach ($b_data as $item):
        ?>
                <tr><td colspan="2">Title: <?php echo CHtml::link($item->title,'javascript:void(0)',array('class'=>'b_title')); ?> </td><td>Authors: <?php echo implode(',',$item->authors);?></td></tr>
                <tr class="expand"><td >Publish agency: <?php echo $item->publish; ?></td><td>Creation date: <?php echo $item->publ_date; ?></td><td>Number: <?php echo $item->edition; ?></td></tr>
                <tr class="expand"><td colspan="3"><?php echo $item->annotation; ?></td></tr>
                <tr><td colspan="3" class="l_row"><?php echo CHtml::link('Edit book', array('books/edit','b_id'=>$item->id));?>&nbsp;<?php echo CHtml::link('Remove book', array('books/remove','b_id'=>$item->id),array('class'=>'remove'));?></td></tr>
        <?php
            endforeach;
         ?>   
                        
    </tbody>
    <tfoot>
            <tr><td colspan="3"><?php echo CHtml::link('Add New Book', array('books/add'));?></td></tr>
            <tr><td colspan='3'>
                            <?php
                                $this->widget('CLinkPager', array(
                                    'pages' => $pages,
                                ));
                            ?>
                        </td></tr>
    </tfoot>
</table>

