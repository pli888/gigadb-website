<?php
$exLinks = $isManuscripts || $isProtocols || $is3dImages || $isCodes || $isSources;
echo "exLinks: $exLinks";
?>
<div class="form-horizontal additional-bordered">
    <h3 style="display: inline-block">Other links</h3>
    <a class="myHint" style="float: none;" data-content="If some of the data in this dataset is already hosted on a stable open access internationally recognized repository such as those listed below please include details."></a>


    <p class="note">
        Do you wish to add links to any of the following:
    </p>

    <!-- Add manuscript that uses this dataset -->
    <?php $this->renderPartial('_manuscripts', array('model' => $model, 'isManuscripts' => $isManuscripts)); ?>
    <!-- Add protocols.io link -->
    <?php $this->renderPartial('_protocols', array('model' => $model, 'isProtocols' => $isProtocols)); ?>
    <!-- Add SketchFab link -->
    <?php $this->renderPartial('_3d_images', array('model' => $model, 'is3dImages' => $is3dImages)); ?>
    <!-- Add Code Ocean link -->
    <?php $this->renderPartial('_codes', array('model' => $model, 'isCodes' => $isCodes)); ?>
    <!-- Add URL that is a source for this dataset -->
    <?php $this->renderPartial('_sources', array('model' => $model, 'isSources' => $isSources)); ?>

    <div class="clear"></div>
    <!-- Render table to display links if they exist -->
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
            <!-- Render rows for $manuscripts -->
            <?php foreach($manuscripts as $exLink): ?>
                <?php $this->renderPartial('_manuscript_tr', array('model' => $model, 'manuscript' => $exLink)); ?>
            <?php endforeach; ?>
            <!-- Render rows for $protocols -->
            <?php foreach($protocols as $exLink): ?>
                <?php $this->renderPartial('_others_tr', array('model' => $model, 'exLink' => $exLink)); ?>
            <?php endforeach; ?>
            <!-- Render rows for $_3dImages SketchFab -->
            <?php foreach($_3dImages as $exLink): ?>
                <?php $this->renderPartial('_others_tr', array('model' => $model, 'exLink' => $exLink)); ?>
            <?php endforeach; ?>
            <!-- Render rows for $codes Code Ocean -->
            <?php foreach($codes as $exLink): ?>
                <?php $this->renderPartial('_others_tr', array('model' => $model, 'exLink' => $exLink)); ?>
            <?php endforeach; ?>
            <!-- Render rows for other $sources for this dataset -->
            <?php foreach($sources as $exLink): ?>
                <?php $this->renderPartial('_others_tr', array('model' => $model, 'exLink' => $exLink)); ?>
            <?php endforeach; ?>
            <!-- Display this row if no links have been added and table needs to be displayed -->
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

    // Execute if content is added to text field in manuscripts section
    $(manuscriptsDiv).on('keydown', 'input[name="link"]', function (event) {
        var input = $(this);

        setTimeout((function(){
            var val = input.val().trim();
            var valLength = val.length;

            // Change behaviour of buttons if text field has content
            if (valLength){
                $('.js-not-allowed', manuscriptsDiv).removeClass('js-not-allowed').addClass('js-add-exLink btn-success');
            } else {
                $('.js-add-exLink', manuscriptsDiv).removeClass('js-add-exLink btn-success').addClass('js-not-allowed');
            }

            var keycode = (event.keyCode ? event.keyCode : event.which);
            if(keycode == '13'){
                $('.js-add-exLink', manuscriptsDiv).trigger('click');
            }
        }), 50);
    });

    // Execute if content is added to text field in protocols.io section
    $(protocolsDiv).on('keydown', 'input[name="link"]', function (event) {
        var input = $(this);

        setTimeout((function(){
            var val = input.val().trim();
            var valLength = val.length;

            // Change behaviour of buttons if text field has content
            if (valLength){
                $('.js-not-allowed', protocolsDiv).removeClass('js-not-allowed').addClass('js-add-exLink btn-success');
            } else {
                $('.js-add-exLink', protocolsDiv).removeClass('js-add-exLink btn-success').addClass('js-not-allowed');
            }

            var keycode = (event.keyCode ? event.keyCode : event.which);
            if(keycode == '13'){
                $('.js-add-exLink', protocolsDiv).trigger('click');
            }
        }), 50);
    });

    // Execute if content is added to text field in SketchFab section
    $(_3dimagesDiv).on('keydown', 'input[name="link"]', function (event) {
        var input = $(this);

        setTimeout((function(){
            var val = input.val().trim();
            var valLength = val.length;

            // Change behaviour of buttons if text field has content
            if (valLength){
                $('.js-not-allowed', _3dimagesDiv).removeClass('js-not-allowed').addClass('js-add-exLink btn-success');
            } else {
                $('.js-add-exLink', _3dimagesDiv).removeClass('js-add-exLink btn-success').addClass('js-not-allowed');
            }

            var keycode = (event.keyCode ? event.keyCode : event.which);
            if(keycode == '13'){
                $('.js-add-exLink', _3dimagesDiv).trigger('click');
            }
        }), 50);
    });

    // Execute if content is added to text field in Code Ocean section
    $(codesDiv).on('keydown', 'input[name="link"]', function (event) {
        var input = $(this);

        setTimeout((function(){
            var val = input.val().trim();
            var valLength = val.length;

            // Change behaviour of buttons if text field has content
            if (valLength){
                $('.js-not-allowed', codesDiv).removeClass('js-not-allowed').addClass('js-add-exLink btn-success');
            } else {
                $('.js-add-exLink', codesDiv).removeClass('js-add-exLink btn-success').addClass('js-not-allowed');
            }

            var keycode = (event.keyCode ? event.keyCode : event.which);
            if(keycode == '13'){
                $('.js-add-exLink', codesDiv).trigger('click');
            }
        }), 50);
    });

    // Execute if content is added to text field in other sources of dataset section
    $(sourcesDiv).on('keydown', 'input[name="link"]', function () {
        var input = $(this);

        setTimeout((function(){
            var val = input.val().trim();
            var valLength = val.length;

            // Change behaviour of buttons if text field has content
            if (valLength){
                $('.js-not-allowed', sourcesDiv).removeClass('js-not-allowed').addClass('js-add-exLink btn-success');
            } else {
                $('.js-add-exLink', sourcesDiv).removeClass('js-add-exLink btn-success').addClass('js-not-allowed');
            }
        }), 50);
    });

    // Execute if Add Link button is clicked
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

                    // Create HTML table row code to display row
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
                    if (response.exLink['type'] == <?= AIHelper::MANUSCRIPTS ?>) {
                        div = manuscriptsDiv;
                    } else if (response.exLink['type'] == <?= AIHelper::PROTOCOLS ?>) {
                        div = protocolsDiv;
                    }  else if (response.exLink['type'] == <?= AIHelper::_3D_IMAGES ?>) {
                        div = _3dimagesDiv;
                    }  else if (response.exLink['type'] == <?= AIHelper::CODES ?>) {
                        div = codesDiv;
                    }  else if (response.exLink['type'] == <?= AIHelper::SOURCES ?>) {
                        div = sourcesDiv;

                        $('textarea[name="link"]', div).val('');
                    }

                    $('input[name="link"]', div).val('');
                    $('.js-add-exLink', div).removeClass('js-add-exLink btn-success').addClass('js-not-allowed');

                    $('#related-doi-block').show();

                    checkIfCanSave();

                    $(".delete-title").tooltip({'placement':'left'});
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
