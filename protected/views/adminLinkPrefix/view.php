<?php
$this->breadcrumbs=array(
	'Prefixes'=>array('index'),
	$model->prefix,
);

$this->menu=array(
	array('label'=>'List Prefix', 'url'=>array('index')),
	array('label'=>'Create Prefix', 'url'=>array('create')),
	array('label'=>'Update Prefix', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Prefix', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Prefix', 'url'=>array('admin')),
);
?>

<div class="container" id="view_link_prefix_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">Link prefix</a></li>
                <li class="active">View</li>
            </ol>
            <h4>View Prefix #<?php echo $model->id; ?></h4>
        </div>
    </section>
    <section>
        <? if (Yii::app()->user->checkAccess('admin')) { ?>
            <div class="actionBar">
                [<?= CHtml::link('Manage Link Prefixes', array('admin')) ?>]
            </div>
        <? } ?>
    </section>
    <section>
        <?php $this->widget('zii.widgets.CDetailView', array(
            'data'=>$model,
            'attributes'=>array(
                'id',
                'prefix',
                'url',
            ),
        )); ?>
    </section>
</div>
