<div class="container" id="manage_funder_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">Funder</a></li>
                <li class="active">Manage</li>
            </ol>
            <h4>Manage Funders</h4>
        </div>
    </section>
    <section>
        <a href="/funder/create" class="btn-green">Add New Funder</a>

        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'funder-grid',
            'dataProvider'=>$model->search(),
            'itemsCssClass' =>'table table-bordered',
            'filter'=>$model,
            'columns'=>array(
                'id',
                'uri',
                'primary_name_display',
                'country',
                array(
                    'class'=>'CButtonColumn',
                ),
            ),
        )); ?>
    </section>
</div>





