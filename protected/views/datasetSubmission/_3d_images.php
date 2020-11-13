<div class="row" style="margin-bottom: 5px; margin-top: 10px;">
    <div class="col-xs-12">
        <div class="col-xs-6">
            <span>SketchFab 3d-Image viewer links</span>
        </div>
        <div class="col-xs-3">
            <a href="#"
               id="3d_images-no"
               data-target="others-grid"
               data-target2="3d_images"
               data-url="/adminExternalLink/deleteExLinks"
               data-id="<?= $model->id ?>"
               data-type="<?= AIHelper::_3D_IMAGES ?>"
               class="btn btn-default others-button <?php if ($is3dImages === false): ?>btn-success btn-disabled<?php else: ?>js-no-button<?php endif; ?>"/>No</a>

            <a href="#"
               id="3d_images-yes"
               data-target="3d_images"
               class="btn btn-default others-button <?php if ($is3dImages === true): ?>btn-success btn-disabled<?php else: ?>js-yes-button<?php endif; ?>"/>Yes</a>
        </div>
    </div>
</div>

<div class="row" id="3d_images"<?php if ($is3dImages !== true): ?> style="display: none"<?php endif; ?>>
    <div class="control-group">
        <div class="col-md-4">
            <label class='control-label'>Please provide SketchFab Link</label>
        </div>
        <div class="controls col-md-4">
            <?= CHtml::textField('link', '', array('class'=>'form-control js-ex-link others-input', 'size' => 60, 'maxlength' => 100, 'placeholder' => "e.g. https://skfb.ly/69wDV")); ?>
        </div>
        <div class="col-md-4">
            <a href="#" dataset-id="<?=$model->id?>" data-type="<?= AIHelper::_3D_IMAGES ?>" class="btn btn-success disabled js-not-allowed"/>Add Link</a>
        </div>
    </div>
</div>
