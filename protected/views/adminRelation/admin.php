<div class="container" id="manage_relations_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">Relations</a></li>
                <li class="active">Manage</li>
            </ol>
            <h4>Manage Relations</h4>
        </div>
    </section>
    <section>
        <a href="/adminRelation/create" class="btn-green">Create A New Relation</a>

        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'relation-grid',
            'dataProvider'=>$model->search(),
            'itemsCssClass'=>'table table-bordered',
            'filter'=>$model,
            'columns'=>array(
                array('name'=> 'doi_search', 'value'=>'$data->dataset->identifier'),
                'related_doi',
                array('name'=> 'relationship_name', 'value'=>'$data->relationship->name'),
                array(
                    'class'=>'CButtonColumn',
                ),
            ),
        )); ?>
    </section>
</div>




