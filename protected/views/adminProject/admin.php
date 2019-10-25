<div class="container" id="create_file_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">Projects</a></li>
                <li class="active">Manage</li>
            </ol>
            <h4>Manage Projects</h4>
        </div>
    </section>
    <section>
        <a href="/adminProject/create" class="btn-green">Create New Project</a>

        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'project-grid',
            'dataProvider'=>$model->search(),
            'itemsCssClass'=>'table table-bordered',
            'filter'=>$model,
            'columns'=>array(
                'url',
                'name',
                'image_location',
                array(
                    'class'=>'CButtonColumn',
                ),
            ),
        )); ?>
    </section>
</div>
