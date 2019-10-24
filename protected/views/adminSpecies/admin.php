<div class="container" id="admin_species_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">Species</a></li>
                <li class="active">Admin</li>
            </ol>
            <h4>Manage Species</h4>
        </div>
    </section>
    <section>
        <a href="/adminSpecies/create" class="btn-green">Create New Species</a>
        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'species-grid',
            'dataProvider'=>$model->search(),
            'itemsCssClass'=>'table table-bordered',
            'filter'=>$model,
            'columns'=>array(
                'tax_id',
                'common_name',
                'genbank_name',
                'scientific_name',
                array(
                    'class'=>'CButtonColumn',
                ),
            ),
        )); ?>
    </section>
</div>

