<?php
$this->breadcrumbs=array(
	'Types'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Type', 'url'=>array('index')),
	array('label'=>'Create Type', 'url'=>array('create')),
	array('label'=>'View Type', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Type', 'url'=>array('admin')),
);
?>

    <div class="container" id="update_type_page">
        <section class="page-title-section">
            <div class="page-title">
                <ol class="breadcrumb pull-right">
                    <li><a href="/">Home</a></li>
                    <li><a href="/">Type</a></li>
                    <li class="active">Update</li>
                </ol>
                <h4>Update Type <?php echo $model->id; ?></h4>
            </div>
        </section>
        <section>
            <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
        </section>
    </div>