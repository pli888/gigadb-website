<?php
$this->breadcrumbs=array(
	'Authors'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Author', 'url'=>array('index')),
	array('label'=>'Create Author', 'url'=>array('create')),
	array('label'=>'View Author', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Author', 'url'=>array('admin')),
);
?>

<div class="container" id="update_author_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">Author</a></li>
                <li class="active">Update</li>
            </ol>
            <h4>Update Author <?php echo $model->id; ?></h4>
        </div>
    </section>
    <section>
        <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
    </section>
</div>
