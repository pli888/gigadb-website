<?php
$this->breadcrumbs=array(
	'Species'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Species', 'url'=>array('index')),
	array('label'=>'Create Species', 'url'=>array('create')),
	array('label'=>'Update Species', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Species', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Species', 'url'=>array('admin')),
);
?>

<div class="container" id="view_species_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">Species</a></li>
                <li class="active">View</li>
            </ol>
            <h4>View Species #<?php echo $model->id; ?></h4>
        </div>
    </section>
    <section>
        <?php $this->widget('zii.widgets.CDetailView', array(
            'data'=>$model,
            'attributes'=>array(
                'id',
                'tax_id',
                'common_name',
                'genbank_name',
                'scientific_name',
            ),
        )); ?>
    </section>
</div>
