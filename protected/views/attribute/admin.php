<div class="container" id="manage_attribute_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">Attribute</a></li>
                <li class="active">Manage</li>
            </ol>
            <h4>Manage Attribute</h4>
        </div>
    </section>
    <section>
        <a href="/attribute/create" class="btn-green">Add New Attribute</a>

        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'attribute-grid',
            'dataProvider'=>$model->search(),
            'itemsCssClass' =>'table table-bordered',
            'filter'=>$model,
            'columns'=>array(
                'id',
                'attribute_name',
                'definition',
                'model',
                'structured_comment_name',
                'value_syntax',
                'allowed_units',
                'occurance',
                'ontology_link',
                'note',
                array(
                    'class'=>'CButtonColumn',
                ),
            ),
        )); ?>
    </section>
</div>




