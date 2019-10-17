<div class="container" id="manage_datasets_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">Dataset - Authors</a></li>
                <li class="active">Manage</li>
            </ol>
            <h4>Manage Dataset - Authors</h4>
        </div>
    </section>
    <section>
        <a href="/adminDatasetAuthor/create" class="btn-green">Add an author to a Dataset</a>
    </section>

    <section>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'dataset-author-grid',
	'dataProvider'=>$model->search(),
	'itemsCssClass'=>'table table-bordered',
	'filter'=>$model,
	'columns'=>array(
		array('name'=> 'doi_search', 'value'=>'$data->dataset->identifier' , 'sortable' => True ),
		array('name'=> 'author_name_search', 'value'=>'$data->author->name'),
		array('name'=> 'orcid_search', 'value'=>'$data->author->orcid'),
		array('name'=> 'rank_search', 'value'=>'$data->rank'),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
    </section>
</div>
