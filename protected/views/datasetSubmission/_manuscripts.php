<div class="row" style="margin-bottom: 5px;">
    <div class="col-xs-12">
        <div class="col-xs-6">
            <span>A published manuscript that uses this data</span>
        </div>
        <div class="col-xs-6">
        <a href="#"
           id="manuscripts-no"
           data-target="others-grid"
           data-target2="manuscripts"
           data-url="/adminExternalLink/deleteExLinks"
           data-id="<?= $model->id ?>"
           data-type="<?= AIHelper::MANUSCRIPTS ?>"
           class="btn btn-default others-button <?php if ($isManuscripts === false): ?>btn-success btn-disabled<?php else: ?>js-no-button<?php endif; ?>"/>No</a>

        <a href="#"
           id="manuscripts-yes"
           data-target="manuscripts"
           class="btn btn-default others-button <?php if ($isManuscripts === true): ?>btn-success btn-disabled<?php else: ?>js-yes-button<?php endif; ?>"/>Yes</a>
        </div>
    </div>
</div>

<div class="row" id="manuscripts"<?php if ($isManuscripts !== true): ?> style="display: none"<?php endif; ?>>
    <div class="control-group">
        <div class="col-md-4">
            <label class='control-label'>Please provide the DOI of the manuscript</label>
        </div>
        <div class="controls col-md-4">
            <?= CHtml::textField('link', '', array('class'=>'form-control js-ex-link others-input', 'size' => 60, 'maxlength' => 100, 'placeholder' => "e.g. doi:10.1093/gigascience/giy095")); ?>
        </div>
        <div class="col-md-4">
            <a href="#" dataset-id="<?=$model->id?>" data-type="<?= AIHelper::MANUSCRIPTS ?>" class="btn btn-success disabled js-not-allowed"/>Add Link</a>
        </div>
    </div>
</div>
