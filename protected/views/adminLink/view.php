<?php
$this->breadcrumbs=array(
	'Links'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Link', 'url'=>array('index')),
	array('label'=>'Create Link', 'url'=>array('create')),
	array('label'=>'Update Link', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Link', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Link', 'url'=>array('admin')),
);
?>

<div class="container" id="view_link_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">Link</a></li>
                <li class="active">View</li>
            </ol>
            <h4>View Link #<?php echo $model->id; ?></h4>
        </div>
    </section>
    <section>
        <?php $this->widget('zii.widgets.CDetailView', array(
            'data'=>$model,
            'attributes'=>array(
                'id',
                'dataset_id',
                'is_primary',
                'link',
            ),
        )); ?>
    </section>
</div>
