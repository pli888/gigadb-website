<?php
$this->breadcrumbs=array(
	'Links'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Link', 'url'=>array('index')),
	array('label'=>'Create Link', 'url'=>array('create')),
	array('label'=>'View Link', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Link', 'url'=>array('admin')),
);
?>

<div class="container" id="update_link_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">Link</a></li>
                <li class="active">Update</li>
            </ol>
            <h4>Update Link <?php echo $model->id; ?></h4>
        </div>
    </section>
    <section>
        <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
    </section>
</div>
