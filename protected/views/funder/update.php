<div class="container" id="update_funder_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">Funder</a></li>
                <li class="active">Update</li>
            </ol>
            <h4>Update Funder <?php echo $model->id; ?></h4>
        </div>
    </section>
    <section>
        <a href="/funder/admin">Back</a>

        <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
    </section>
</div>
