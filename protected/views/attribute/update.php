<div class="container" id="update_attribute_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">Attribute</a></li>
                <li class="active">Update</li>
            </ol>
            <h4>Update Attribute <?php echo $model->id; ?></h4>
        </div>
    </section>
    <section>
        <a href="/attribute/admin">Back</a>

        <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
    </section>
</div>



