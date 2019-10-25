<div class="container" id="manage_external_link_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">External Link</a></li>
                <li class="active">Manage</li>
            </ol>
            <h4>Manage External Links</h4>
        </div>
    </section>
    <section>
    <a href="/adminExternalLink/create" class="btn-green">Create New External Link</a>

    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'external-link-grid',
        'dataProvider'=>$model->search(),
        'itemsCssClass'=>'table table-bordered',
        'filter'=>$model,
        'columns'=>array(
            array('name'=> 'doi_search', 'value'=>'$data->dataset->identifier'),
            array('name'=> 'external_link_type_search', 'value'=>'$data->external_link_type->name'),
            'url',
            array(
                'class'=>'CButtonColumn',
            ),
        ),
    )); ?>
    </section>
</div>

