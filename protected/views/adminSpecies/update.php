<?php
$this->breadcrumbs=array(
	'Species'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Species', 'url'=>array('index')),
	array('label'=>'Create Species', 'url'=>array('create')),
	array('label'=>'View Species', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Species', 'url'=>array('admin')),
);
?>

<div class="container" id="update_species_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">Species</a></li>
                <li class="active">Update</li>
            </ol>
            <h4>Update Species #<?php echo $model->id; ?></h4>
        </div>
    </section>
    <section>
        <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
    </section>
</div>
