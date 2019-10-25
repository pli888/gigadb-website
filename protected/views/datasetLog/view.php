<div class="container" id="view_update_logs_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">Update Logs</a></li>
                <li class="active">View</li>
            </ol>
            <h4>View DatasetLog #<?php echo $model->id; ?></h4>
        </div>
    </section>
    <section>
        <?php $this->widget('zii.widgets.CDetailView', array(
            'data'=>$model,
            'attributes'=>array(
                'id',
                'dataset_id',
                array('label'=> 'DOI', 'value'=>$model->dataset->identifier),
                'message',
                'created_at',
                'model',
                'model_id',
            ),
        )); ?>
    </section>
</div>
