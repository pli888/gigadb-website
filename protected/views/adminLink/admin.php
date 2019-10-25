<div class="container" id="manage_link_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">Link</a></li>
                <li class="active">Manage</li>
            </ol>
            <h4>Manage Links</h4>
        </div>
    </section>
    <section>
        <a href="/adminLink/create" class="btn-green">Create A New Link</a>

        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'link-grid',
            'dataProvider'=>$model->search(),
            'itemsCssClass'=>'table table-bordered',
            'filter'=>$model,
            'columns'=>array(
                array('name'=> 'doi_search', 'value'=>'$data->dataset->identifier'),
                'is_primary',
                'link',
                array(
                    'class'=>'CButtonColumn',
                ),
            ),
        )); ?>
    </section>
</div>
