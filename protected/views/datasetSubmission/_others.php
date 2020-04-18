<div class="form-horizontal additional-bordered">
    <h3 style="display: inline-block">Other links</h3>
    <a class="myHint" style="float: none;" data-content="Dont know what to add here."></a>


    <p class="note">
        Do you wish to add links to any of the following:
    </p>

    <?php $this->renderPartial('_manuscripts', array('model' => $model, 'isManuscripts' => $isManuscripts)); ?>
    <?php $this->renderPartial('_protocols', array('model' => $model, 'isProtocols' => $isProtocols)); ?>
    <?php $this->renderPartial('_3d_images', array('model' => $model, 'is3dImages' => $is3dImages)); ?>
    <?php $this->renderPartial('_codes', array('model' => $model, 'isCodes' => $isCodes)); ?>
    <?php $this->renderPartial('_sources', array('model' => $model, 'isSources' => $isSources)); ?>

    <div class="clear"></div>
    <div id="others-grid" class="grid-view"<?php if (!$exLinks): ?> style="display: none;"<?php endif ?>>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th id="author-grid_c0" width="35%">Url</th>
                <th id="author-grid_c0" width="35%">Link Description</th>
                <th id="author-grid_c0" width="20%">External Link Type</th>
                <th id="author-grid_c5" class="button-column" width="10%"></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($exLinks as $exLink): ?>
                <tr class="odd js-my-item-<?= $exLink->type ?>">
                    <td><?= \yii\helpers\Html::encode($exLink->url) ?></td>
                    <td><?= $exLink->description ?></td>
                    <td>
                        <?= $exLink->getTypeName() ?>
                    </td>
                    <td class="button-column">
                        <input type="hidden" class="js-type" value="<?= $exLink->type ?>">
                        <input type="hidden" class="js-my-id" value="<?= $exLink->id ?>">
                        <a class="js-delete-exLink delete-title" exLink-id="<?=$exLink->id?>" data-id="<?= $model->id ?>" title="delete this row">
                            <img alt="delete this row" src="/images/delete.png">
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr class="js-no-results"<?php if ($exLinks): ?> style="display: none"<?php endif ?>>
                <td colspan="4">
                    <span class="empty">No results found.</span>
                </td>
            </tr>
            <tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    var othersDiv = $('#others-block');
    var manuscriptsDiv = $('#manuscripts');
    var protocolsDiv = $('#protocols');
    var _3dimagesDiv = $('#3d_images');
    var codesDiv = $('#codes');
    var sourcesDiv = $('#sources');

    $(manuscriptsDiv).on('change', 'input[name="link"]', function () {
        if ($(this).val()){
            $('.js-not-allowed', manuscriptsDiv).removeClass('js-not-allowed').addClass('js-add-exLink btn-green');
        } else {
            $('.js-add-exLink', manuscriptsDiv).removeClass('js-add-exLink btn-green').addClass('js-not-allowed');
        }
    });

    $(protocolsDiv).on('change', 'input[name="link"]', function () {
        if ($(this).val()){
            $('.js-not-allowed', protocolsDiv).removeClass('js-not-allowed').addClass('js-add-exLink btn-green');
        } else {
            $('.js-add-exLink', protocolsDiv).removeClass('js-add-exLink btn-green').addClass('js-not-allowed');
        }
    });

    $(_3dimagesDiv).on('change', 'input[name="link"]', function () {
        if ($(this).val()){
            $('.js-not-allowed', _3dimagesDiv).removeClass('js-not-allowed').addClass('js-add-exLink btn-green');
        } else {
            $('.js-add-exLink', _3dimagesDiv).removeClass('js-add-exLink btn-green').addClass('js-not-allowed');
        }
    });

    $(codesDiv).on('change', 'input[name="link"]', function () {
        if ($(this).val()){
            $('.js-not-allowed', codesDiv).removeClass('js-not-allowed').addClass('js-add-exLink btn-green');
        } else {
            $('.js-add-exLink', codesDiv).removeClass('js-add-exLink btn-green').addClass('js-not-allowed');
        }
    });

    $(sourcesDiv).on('change', 'input[name="link"]', function () {
        if ($(this).val()){
            $('.js-not-allowed', sourcesDiv).removeClass('js-not-allowed').addClass('js-add-exLink btn-green');
        } else {
            $('.js-add-exLink', sourcesDiv).removeClass('js-add-exLink btn-green').addClass('js-not-allowed');
        }
    });

    $(othersDiv).on('click', ".js-add-exLink", function(e) {
        e.preventDefault();
        var $this = $(this);
        var  did = $this.attr('dataset-id');
        var url = $this.closest('.row').find('.js-ex-link').val();
        var externalLinkType = $this.data('type');
        var externalLinkDescription = '';
        var textArea = $this.closest('.row').find('.js-ex-description');
        if (textArea.length) {
            externalLinkDescription = textArea.val();
        }

        $.ajax({
            type: 'POST',
            url: '/adminExternalLink/getExLink',
            data:{'dataset_id': did, 'url': url,  'externalLinkType': externalLinkType, 'externalLinkDescription': externalLinkDescription},
            success: function(response){
                if(response.success) {
                    var exit = false;
                    var trs = othersDiv.find('.odd');
                    trs.each(function() {
                        let tr = $(this);
                        let url = tr.children('td').eq(0).text().trim();
                        let type_name = tr.children('td').eq(2).text().trim();

                        if (response.exLink['url'] == url && type_name == response.exLink['type_name']) {
                            alert('This link has been added already.');
                            exit = true;
                            return false;
                        }
                    });

                    if (exit) {
                        return false;
                    }

                    var tr = '<tr class="odd js-my-item-'+ response.exLink['type'] +'">' +
                        '<input type="hidden" class="js-type" value="' + response.exLink['type'] + '">' +
                        '<td>' + response.exLink['url'] + '</td>' +
                        '<td>' + response.exLink['description'] + '</td>' +
                        '<td>' + response.exLink['type_name'] + '</td>' +
                        '<td class="button-column">' +
                        '<a class="js-delete-exLink delete-title" title="delete this row">' +
                        '<img alt="delete this row" src="/images/delete.png">' +
                        '</a>' +
                        '</td>' +
                        '</tr>';

                    $('.js-no-results', othersDiv).before(tr);
                    $('.js-no-results', othersDiv).hide();

                    let div;
                    if (response.exLink['type'] == 3) {
                        div = manuscriptsDiv;
                    } else if (response.exLink['type'] == 4) {
                        div = protocolsDiv;
                    }  else if (response.exLink['type'] == 5) {
                        div = _3dimagesDiv;
                    }  else if (response.exLink['type'] == 6) {
                        div = codesDiv;
                    }  else if (response.exLink['type'] == 7) {
                        div = sourcesDiv;

                        $('textarea[name="link"]', div).val('');
                    }

                    $('input[name="link"]', div).val('');
                    $('.js-add-exLink', div).removeClass('js-add-exLink btn-green').addClass('js-not-allowed');

                    $('#related-doi-block').show();

                    checkIfCanSave();
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr) {
                alert(xhr.responseText);
            }
        });
    });

    $(othersDiv).on('click', ".js-delete-exLink", function(e) {
        if (!confirm('Are you sure you want to delete this item?'))
            return false;
        e.preventDefault();

        $(this).closest('tr').remove();

        if (relatedDoiDiv.find('.odd').length === 0) {
            $('.js-no-results', relatedDoiDiv).show();
        }

        checkIfCanSave();
    });
</script>