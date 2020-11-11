<div class="container">
    <div class="content">
        <section>
            <div class="dataset-submission-page-title">
                <h4>The end</h4>
            </div>
            <?php $this->renderPartial('_tabs_navigation', array('model' => $model)); ?>
            <div class="form well">
                <div class="form-horizontal">
                    <div class="row subwiz-row">
                        <div class="col-xs-12">
                            <div id="end-grid" class="grid-view">
                                <p class="note">
                                    All the dataset and sample metadata has been received, thank you.
                                </p>
                    
                                <p class="note">
                                    A curator will assigned to check the information and to advise you 
                                    of how to supply the data files to us. Once the curator has checked 
                                    the metadata they will provide you with a login for our private FTP 
                                    server where you can upload the data files. Once uploaded you will 
                                    be required to provide some file metadata, including a description, 
                                    data type, and a file format for each file.
                                </p>
                    
                                <p class="note">
                                    If you do not hear from us within 2 working days please feel free 
                                    to contact us by email 
                                    <a href="mailto:support@gigasciencejournal.com">support@gigasciencejournal.com</a>, 
                                    please include the GigaScience manuscript submission ID in the 
                                    subject line.
                                </p>
                    
                                <div class="clear"></div>
                                <div style="text-align:center" >
                                    <?php if ($model->is_test): ?>
                                        <a href="/datasetSubmission/end/id/<?= $model->id ?>/is_test/0" class="btn-green">Make this submission REAL</a>
                                    <?php endif; ?>
                                    <a href="/user/view_profile/added/<?= $model->id ?>/#submitted" class="btn-green">Return to your profile page</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
