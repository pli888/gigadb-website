<?php
$this->breadcrumbs=array(
	'Manuscripts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Manuscript', 'url'=>array('index')),
	array('label'=>'Create Manuscript', 'url'=>array('create')),
	array('label'=>'View Manuscript', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Manuscript', 'url'=>array('admin')),
);
?>

<div class="container" id="update_manuscript_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">Manuscript</a></li>
                <li class="active">Update</li>
            </ol>
            <h4>Update Manuscript <?php echo $model->id; ?></h4>
        </div>
    </section>
    <section>
        <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
    </section>
</div>
