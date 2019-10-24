<div class="container" id="manage_datasets_types_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">Dataset Types</a></li>
                <li class="active">Manage</li>
            </ol>
            <h4>Manage Dataset Types</h4>
        </div>
    </section>
    <section>

<p>
To list certain news items that you are looking for, you may search via keyword or value. Type your keyword or value into their respective boxes under the column headers and press the enter key. You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>
<a href="/adminDatasetType/create" class="btn-green">Create A New Dataset Type</a>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'type-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'itemsCssClass'=>'table table-bordered',
	'columns'=>array(
		'name',
		'description',
                'number',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
