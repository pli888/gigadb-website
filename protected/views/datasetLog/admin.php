<div class="container" id="manage_update_logs_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">Update Logs</a></li>
                <li class="active">Manage</li>
            </ol>
            <h4>Manage Update Logs</h4>
        </div>
    </section>
    <section>
        <a href="/datasetLog/create" class="btn-green">Add an update log</a>

        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'dataset-log-grid',
            'dataProvider'=>$model->search(),
            'itemsCssClass'=>'table table-bordered',
            'filter'=>$model,
            'columns'=>array(
                'id',
                'dataset_id',
                array('name'=> 'doi', 'value'=>'$data->dataset->identifier'),
                'message',
                'created_at',
                'model',
                'model_id',
                array(
                    'class'=>'CButtonColumn',
                ),
            ),
        )); ?>
    </section>
</div>

