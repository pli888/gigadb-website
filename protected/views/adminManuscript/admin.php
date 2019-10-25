<div class="container" id="manage_manuscripts_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">Manuscripts</a></li>
                <li class="active">Manage</li>
            </ol>
            <h4>Manage Manuscripts</h4>
        </div>
    </section>
    <section>
        <a href="/adminManuscript/create" class="btn-green">Create A New Manuscript</a>

        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'manuscript-grid',
            'dataProvider'=>$model->search(),
            'itemsCssClass'=>'table table-bordered',
            'filter'=>$model,
            'columns'=>array(
                'identifier',
                'pmid',
                array('name'=> 'doi_search', 'value'=>'$data->dataset->identifier'),
                array(
                    'class'=>'CButtonColumn',
                ),
            ),
        )); ?>
    </section>
</div>
