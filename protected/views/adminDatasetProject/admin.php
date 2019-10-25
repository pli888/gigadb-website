<div class="container" id="manage_dataset_projects_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">Dataset - Projects</a></li>
                <li class="active">Manage</li>
            </ol>
            <h4>Manage Dataset - Projects</h4>
        </div>
    </section>
    <section>
        <a href="/adminDatasetProject/create" class="btn-green">Add a Project to a Dataset</a>

        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'dataset-project-grid',
            'dataProvider'=>$model->search(),
            'itemsCssClass'=>'table table-bordered',
            'filter'=>$model,
            'columns'=>array(
                array('name'=> 'doi_search', 'value'=>'$data->dataset->identifier'),
                array('name'=> 'project_name_search', 'value'=>'$data->project->name'),
                array(
                    'class'=>'CButtonColumn',
                ),
            ),
        )); ?>
    </section>
</div>
