<div class="container" id="manage_publisher_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">Publisher</a></li>
                <li class="active">Manage</li>
            </ol>
            <h4>Manage Publishers</h4>
        </div>
    </section>
    <section>
        <p>
            You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
            or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
        </p>

        <a href="/adminPublisher/create" class="btn-green">Create a new publisher</a>

        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'publisher-grid',
            'dataProvider'=>$model->search(),
            'itemsCssClass' => 'table table-bordered',
            'filter'=>$model,
            'columns'=>array(
                'name',
                'description',
                array(
                    'class'=>'CButtonColumn',
                ),
            ),
        )); ?>
    </section>
</div>
