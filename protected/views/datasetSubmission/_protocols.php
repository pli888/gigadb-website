<div class="row" style="margin-bottom: 5px; margin-top: 10px;">
    <div class="span9">
        <span>Protocols.io link to methods used to generate this data</span>

        <!-- Render NO button to add manuscript -->
        <!-- If there are no manuscripts (false) then No button is green and disabled, and js-no-button functionality added -->
        <!-- No button is grey if $isManuscripts is null and js-no-button functionality added -->
        <a href="#"
           id="protocols-no"
           data-target="others-grid"
           data-target2="protocols"
           data-url="/adminExternalLink/deleteExLinks"
           data-id="<?= $model->id ?>"
           data-type="<?= AIHelper::PROTOCOLS ?>"
           class="btn btn-default others-button <?php if ($isProtocols === false): ?>btn-success btn-disabled<?php else: ?>js-no-button<?php endif; ?>"/>No</a>

        <!-- Render YES button to add manuscript -->
        <!-- If there are manuscripts (true) then YES button is green and disabled -->
        <!-- No button is grey if $isManuscripts is null and js-yes-button functionality added -->
        <a href="#"
           id="protocols-yes"
           data-target="protocols"
           class="btn btn-default others-button <?php if ($isProtocols === true): ?>btn-success btn-disabled<?php else: ?>js-yes-button<?php endif; ?>"/>Yes</a>
    </div>
</div>

<!-- Render form if $isManuscripts is false -->
<div class="row" id="protocols"<?php if ($isProtocols !== true): ?> style="display: none"<?php endif; ?>>
    <div class="span9">
        <label class='control-label others-label'>Please provide the Protocols.io DOI</label>
        <div class="controls">
            <!-- id = "link" -->
            <?= CHtml::textField('link', '', array('class'=>'js-ex-link others-input', 'size' => 60, 'maxlength' => 100, 'placeholder' => "e.g. doi:10.17504/protocols.io.gk8buzw")); ?>
        </div>
    </div>
    <div class="span2">
        <!-- Render Add Link button -->
        <!-- js-add-exLink class added to button when it turns active -->
        <a href="#" dataset-id="<?=$model->id?>" data-type="<?= AIHelper::PROTOCOLS ?>" class="btn btn-default js-not-allowed"/>Add Link</a>
    </div>
</div>
