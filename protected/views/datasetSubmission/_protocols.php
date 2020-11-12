<div class="row" style="margin-bottom: 5px; margin-top: 10px;">
    <div class="col-xs-12">
        <div class="col-xs-6">
            <span>Protocols.io link to methods used to generate this data</span>
        </div>
        <div class="col-xs-6">
        <a href="#"
           id="protocols-no"
           data-target="others-grid"
           data-target2="protocols"
           data-url="/adminExternalLink/deleteExLinks"
           data-id="<?= $model->id ?>"
           data-type="<?= AIHelper::PROTOCOLS ?>"
           class="btn btn-default additional-button <?php if ($isProtocols === false): ?>btn-success btn-disabled<?php else: ?>js-no-button<?php endif; ?>"/>No</a>

        <a href="#"
           id="protocols-yes"
           data-target="protocols"
           class="btn btn-default additional-button <?php if ($isProtocols === true): ?>btn-success btn-disabled<?php else: ?>js-yes-button<?php endif; ?>"/>Yes</a>
        </div>
    </div>
</div>

<div class="row" id="protocols"<?php if ($isProtocols !== true): ?> style="display: none"<?php endif; ?>>
    <div class="control-group">
        <div class="col-md-4">
            <label class='control-label'>Please provide the Protocols.io DOI</label>
        </div>
        <div class="controls col-md-4">
            <?= CHtml::textField('link', '', array('class'=>'form-control js-ex-link others-input', 'size' => 60, 'maxlength' => 100, 'placeholder' => "e.g. doi:10.17504/protocols.io.gk8buzw")); ?>
        </div>
        <div class="col-md-4">
            <a href="#" dataset-id="<?=$model->id?>" data-type="<?= AIHelper::PROTOCOLS ?>" class="btn btn-success disabled js-not-allowed"/>Add Link</a>
        </div>
    </div>
</div>
