<?php
$this->breadcrumbs=array(
	'Publishers'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Publisher', 'url'=>array('index')),
	array('label'=>'Create Publisher', 'url'=>array('create')),
	array('label'=>'Update Publisher', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Publisher', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Publisher', 'url'=>array('admin')),
);
?>

<div class="container" id="view_publisher_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">Publisher</a></li>
                <li class="active">View</li>
            </ol>
            <h4>View Publisher #<?php echo $model->id; ?></h4>
        </div>
    </section>
    <section>
        <a href='/adminPublisher/admin'>[Manage Publishers]</a>

        <?php $this->widget('zii.widgets.CDetailView', array(
            'data'=>$model,
            'attributes'=>array(
                'id',
                'name',
                'description',
            ),
        )); ?>
    </section>
</div>
