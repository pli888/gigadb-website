<?php
$this->breadcrumbs=array(
	'Relations'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Relation', 'url'=>array('index')),
	array('label'=>'Create Relation', 'url'=>array('create')),
	array('label'=>'View Relation', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Relation', 'url'=>array('admin')),
);
?>

<div class="container" id="update_relation_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">Relation</a></li>
                <li class="active">Update</li>
            </ol>
            <h4>Update Relation <?php echo $model->id; ?></h4>
        </div>
    </section>
    <section>
        <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
    </section>
</div>
