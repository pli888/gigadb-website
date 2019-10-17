<?php
$this->breadcrumbs=array(
	'Datasets'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Dataset', 'url'=>array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('dataset-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="container" id="manage_datasets_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">Datasets</a></li>
                <li class="active">Manage</li>
            </ol>
            <h4>Manage Datasets</h4>
        </div>
    </section>
    <section>
        <p>
            You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
            or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
            Date should be exactly in this format: <b>yyyy-mm-dd</b>
        </p>
        <a href="/adminDataset/create" class="btn-green">Create Dataset</a>
    </section>

    <section>
        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'dataset-grid',
            'dataProvider'=>$model->search(),
            'itemsCssClass'=>"table table-bordered table-fixed",
            'filter'=>$model,
            'columns'=>array(
                'id',
                'identifier',
                'manuscript_id',
                'title',
                // 'publisher',
                // 'dataset_size',
                // 'ftp_site',
                // 'upload_status',
                // 'excelfile',
                // 'excelfile_md5',
                'publication_date',
                array('name'=> 'curator_id', 'value'=>'$data->getCuratorName()'),
                    'modification_date',
                    'upload_status',
                    array('class'=>'CButtonColumn',
                        'buttons'=>array(
                        'view' => array(
                        'url' => 'Yii::app()->createUrl("dataset/view" , array("id" => $data->identifier))'
                        )
                    ),
                ),
            ),
        )); ?>
    </section>
</div>
