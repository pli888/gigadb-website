<div class="container" id="manage_dataset_funder_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">Dataset Funder</a></li>
                <li class="active">Manage</li>
            </ol>
            <h4>Manage Dataset Funders</h4>
        </div>
    </section>
    <section>
        <a href="/datasetFunder/create" class="btn-green">Add New Dataset Funders</a>

        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'dataset-funder-grid',
            'dataProvider'=>$model->search(),
            'itemsCssClass' => 'table table-bordered',
            'filter'=>$model,
            'columns'=>array(
                array(
                    'name' => 'doi_search',
                    'value' => '$data->dataset->identifier',
                ),
                array(
                    'name' => 'funder_search',
                    'value' => '$data->funder->primary_name_display',
                ),
                'grant_award',
                'awardee',
                'comments',
                array(
                    'class'=>'CButtonColumn',
                ),
            ),
        )); ?>
    </section>
</div>











