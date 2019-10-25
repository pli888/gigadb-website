<?php
$this->breadcrumbs=array(
	'Publishers'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Publisher', 'url'=>array('index')),
	array('label'=>'Create Publisher', 'url'=>array('create')),
	array('label'=>'View Publisher', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Publisher', 'url'=>array('admin')),
);
?>

<div class="container" id="update_publisher_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">Publisher</a></li>
                <li class="active">Update</li>
            </ol>
            <h4>Update Publisher <?php echo $model->id; ?></h4>
        </div>
    </section>
    <section>
        <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
    </section>
</div>
