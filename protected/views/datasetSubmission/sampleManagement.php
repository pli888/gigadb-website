<?php
/** @var Dataset $model */
/** @var Unit[] $units */
/** @var Sample[] $samples */
/** @var Species[] $species */
/** @var SampleAttribute[] $sas */
/** @var TemplateName[] $sts */
/** @var TemplateName $template */
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js" integrity="sha384-FzT3vTVGXqf7wRfy8k4BiyzvbNfeYjK+frTVqZeNDFl8woCbF0CYG6g2fMEFFo/i" crossorigin="anonymous"></script>

<div class="container">
    <div class="content">
        <section>
            <div class="dataset-submission-page-title">
                <h4>Add Samples</h4>
            </div>
            <?php $this->renderPartial('_tabs_navigation', array('model' => $model)); ?>
            <div class="form well">
                <div class="form-horizontal">
                    <div class="row subwiz-row">
                        <div class="col-xs-12">
                            <p class="note">
                                Please supply all the information about the experimental samples 
                                included in this dataset. This should include samples used only 
                                for example purposes even when you have only performed in-silco 
                                analysis.
                                <a class="myHint" style="float: none;" data-html="true" data-content="For datasets that include biological sample-related data we would expect the sample metadata to be included in the GigaDB dataset. We understand that the level of sample metadata made available is often limited by sample collection restrictions, but authors should make every effort to provide as comprehensive metadata about samples as is possible. For a checklist of metadata fields please see <a href='http://gigadb.org/site/guide'>http://gigadb.org/site/guide</a>."></a>
                            </p>
                            <p class="note">
                                You should add as many attributes as you have details for, as a 
                                guide we provided a small number of templates for common dataset 
                                types (genomic, metagenomic and imaging) with a suggestion of 
                                possible attributes.
                                <a class="myHint" style="float: none;" data-html="true" data-content="Please see <a target='_blank' href='http://gigadb.org/site/guide'>http://gigadb.org/site/guide</a>."></a>
                            </p>
                        </div>
                    </div>
                    <div class="row subwiz-row">
                        <div class="control-group" id="set-template-div">
                            <div class="col-md-2">
                                <label class='control-label'>Choose a template</label>
                            </div>
                            <div class="controls col-md-4">
                                <?= CHtml::dropDownList('template',
                                    $template ? $template->id : null,
                                    CHtml::listData($sts,'id','template_name'),
                                    array('empty'=> 'Empty', 'class'=>'js-database form-control', 'style'=>'width:200px'));
                                ?>
                                <a href="#" class="btn btn-success <?php if (!$template): ?>disabled js-not-allowed<?php else: ?> js-set-template<?php endif ?>" style="margin-left: 20px;"/>Apply</a>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">Note- applying a new template will delete any attributes already inserted below</label>
                                <a class="myHint" style="float: none;" data-content="The templates provide a guide to some of the possible attributes that could be added to samples, please add more columns as required, or delete those that are not relevant to your data."></a>
                            </div>
                        </div>
                    </div>
                    <div class="row subwiz-row">
                        <div class="col-xs-12">
                            <p class="note">
                                For very few samples you may type the information directly into the web-form below.
                            </p>

                            <div class="additional-bordered" style="overflow-x: auto;margin: 15px 0;">
                                <table class="table table-bordered sample-tab-table" id="samples-table" style="overflow: auto;">
                                    <thead>
                                    <tr>
                                        <th id="sample-grid_c0">
                                            <span>Sample ID</span>
                                            <a class="myHint"
                                               data-content='The name used to uniquely identify the sample in your study'
                                               style="float: right">
                                            </a>
                                        </th>
                                        <th id="sample-grid_c1">
                                            <span>Species name</span>
                                            <a class="myHint"
                                               data-content='Please select the relevant species name from the list here, start typing either the common name or Latin name to refine the list. If the species is not present please contact us to get it added.'
                                               style="float: right">
                                            </a>
                                        </th>
                                        <th id="sample-grid_c2">
                                            <span>Description</span>
                                            <a class="myHint"
                                               data-content='Please provide a short description of this specific sample, it should be unique to this sample, it can include where it was collected, which tissue, and/or what was extracted, e.g. "DNA extracted from blood of captive grown frog in Birmingham."'
                                               style="float: right">
                                            </a>
                                        </th>
                                        <?php if ($rows): ?>
                                            <?php for ($j = 3, $k = count($rows[0]); $j < $k; $j++): ?>
                                                <?php
                                                $attributeName = isset($rows[0][$j]) ? $rows[0][$j] : '';
                                                $attribute = Attribute::findByAttrName($attributeName);
                                                ?>
                                                <th class="sample-attribute-column">
                                                <a class="js-delete-column delete-title" title="delete this column">
                                                    <img alt="delete this column" src="/images/delete.png">
                                                </a>
                
                                                <input type="text" class="js-attribute-name-autocomplete" placeholder='Attribute name' value="<?= $attributeName ?>">
                
                                                <?= CHtml::dropDownList(
                                                    'units[]',
                                                    $attribute ? $attribute->allowed_units : null,
                                                    CHtml::listData($units, 'id', 'name'),
                                                    array('empty'=> 'N/A','style'=>'width:70px;margin-right:20px;', 'class' => 'dropdown-white')
                                                ); ?>
                                            <?php endfor ?>
                                        <?php elseif (!$template): ?>
                                            <?php foreach ($sas as $sa): ?>
                                                <?php if (strtolower($sa->attribute->attribute_name) == 'description') continue ?>
                                                <th class="sample-attribute-column">
                                                    <a class="js-delete-column delete-title" title="delete this column">
                                                        <img alt="delete this column" src="/images/delete.png">
                                                    </a>
                
                                                    <input type="text" class="js-attribute-name-autocomplete" placeholder='Attribute name' value="<?= $sa->attribute->attribute_name ?>">
                
                                                    <?= CHtml::dropDownList('units[]', $sa->unit_id, CHtml::listData($units, 'id', 'name'),array('empty'=> 'N/A','style'=>'width:70px;margin-right:20px;', 'class' => 'dropdown-white')); ?>
                                                </th>
                                            <?php endforeach ?>
                                            <?php else: ?>
                                                <?php foreach ($template->attributes as $attribute): ?>
                                                    <th class="sample-attribute-column">
                                                        <a class="js-delete-column delete-title" title="delete this column">
                                                            <img alt="delete this column" src="/images/delete.png">
                                                        </a>
                    
                                                        <input type="text" class="js-attribute-name-autocomplete" placeholder='Attribute name' value="<?= $attribute->attribute_name ?>">
                    
                                                        <?= CHtml::dropDownList('units[]', $attribute->allowed_units, CHtml::listData($units, 'id', 'name'),array('empty'=> 'N/A','style'=>'width:70px;margin-right:20px;', 'class' => 'dropdown-white')); ?>
                                                    </th>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                            <th class="button-column"><a href="#" class="btn btn-success btn-sample js-add-column" style="max-width: 100px;">Add Column</a></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($rows): ?>
                                                <?php for ($i = 1, $n = count($rows); $i < $n; $i++): ?>
                                            <tr class="item">
                                                <td style="white-space: nowrap;">
                                                    <a class="js-delete-row delete-title" title="delete this sample">
                                                        <img alt="delete this row" src="/images/delete.png">
                                                    </a>
                                                    <input type="text" placeholder='Sample ID' value="<?= isset($rows[$i][0]) ? $rows[$i][0] : '' ?>" style="margin-right: 18px;">
                                                </td>
                                                <td>
                                                    <input type="text" class="js-species-autocomplete" placeholder='Species name' value="<?= isset($rows[$i][1]) ? $rows[$i][1] : '' ?>">
                                                </td>
                                                <td>
                                                    <input type="text" placeholder='Short description of sample' value="<?= isset($rows[$i][2]) ? $rows[$i][2] : '' ?>" style="width:250px;">
                                                </td>
                                                <?php for ($j = 3, $k = count($rows[0]); $j < $k; $j++): ?>
                                                    <td>
                                                        <input type="text" placeholder='Attribute value' value="<?= isset($rows[$i][$j]) ? $rows[$i][$j] : '' ?>" style="width: 250px;">
                                                    </td>
                                                <?php endfor ?>
                                                <td class="button-column">
                                                </td>
                                            </tr>
                                                <?php endfor ?>
                                            <?php elseif (!$template): ?>
                                                <?php foreach($samples as $sample): ?>
                                            <tr class="item">
                                                <td style="white-space: nowrap;">
                                                    <a class="js-delete-row delete-title" title="delete this sample">
                                                        <img alt="delete this row" src="/images/delete.png">
                                                    </a>
                                                    <input type="text" placeholder='Sample ID' value="<?= $sample->name ?>" style="margin-right: 18px;">
                                                </td>
                                                <td>
                                                    <input type="text" class="js-species-autocomplete" placeholder='Species name' value="<?= $sample->species->common_name ?>">
                                                </td>
                                                <td>
                                                    <?php $mySa = $sample->getSampleAttributeByAttributeName('Description') ?>
                                                    <input type="text" placeholder='Short description of sample' value="<?= $mySa ? $mySa->value : '' ?>" style="width: 250px;">
                                                </td>
                                                <?php foreach ($sas as $sa): ?>
                                                    <?php if (strtolower($sa->attribute->attribute_name) == 'description') continue ?>
                                                    <td>
                                                        <?php $mySa = $sample->getSampleAttributeByAttributeIdAndUnitId($sa->attribute_id, $sa->unit_id) ?>
                                                        <input type="text" placeholder='Attribute value' value="<?= $mySa ? $mySa->value : '' ?>" style="width: 250px;">
                                                    </td>
                                                <?php endforeach ?>
                                                <td class="button-column">
                                                    <input type="hidden" class="js-sample-id" value="<?= $sample->id ?>">
                                                </td>
                                            </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                            <tr id="js-no-results"<?php if ((!$template && $samples) || $rows): ?> style="display: none;"<?php endif ?>>
                                                <td colspan="4">
                                                    <span class="empty">No results found.</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="button-column" style="border-top:none;text-align: left;">
                                                    <a href="#" class="btn btn-success btn-sample js-add-row" style="margin-left: 30px;">Add Row</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row subwiz-row">
                        <div class="col-xs-12">
                            <p class="note">
                                Alternatively, if you have many samples you may wish to prepare the information in a spreadsheet and upload that to this page, the uploader will only parse CSV or TSV files.
                            </p>
                
                            <p class="note">
                                Note – ALL samples must include Sample ID, Species name and  sample description as mandatory information.
                                Units should be included in header row in parentheses e.g. depth (m)
                            </p>
                        </div>
                    </div>
                    <div class="row subwiz-row">
                        <form action="/datasetSubmission/validateSamples" data-action="<?= '/datasetSubmission/sampleManagement/id/'. $model->id ?>" method="POST" id="upload-samples" enctype="multipart/form-data">
                            <div class="control-group form-group form-horizontal input-group-prepend" id="add-samples-div">
                                <div class="col-md-2">
                                    <label class='control-label'>Upload sample metadata</label>
                                </div>
                                <div class="controls col-md-4">
                                    <input type="file" id="samples" name="samples">
                                    <input type="hidden" name="upload" value="true">
                                    <a href="#" class="btn btn-success disabled js-not-allowed" style="margin-left: 20px;"/>Upload</a>
                                    <a class="btn btn-success" id="js-add-samples" style="margin-left: 20px;display: none;" value="Upload"/>Upload</a>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label">Note- uploading metadata file will overwrite any values already inserted above</label>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="row subwiz-row">
                        <div class="col-xs-12">
                            <div style="text-align:center" id="samples-save">
                                <a href="/datasetSubmission/fundingManagement/id/<?= $model->id ?>" class="btn background-btn">Previous</a>
                                <a href="/datasetSubmission/sampleManagement/id/<?= $model->id ?>"
                                   class="btn background-btn js-save-samples">Save</a>
                                <a href="/datasetSubmission/end/id/<?= $model->id ?>"
                                   class="btn background-btn js-save-samples">Next</a>
                            </div>
                        </div>
                    </div>
            </div> <!-- form well -->
        </div>
    </div> <!-- content -->
</div> <!-- container -->

<script>
    $('#samples-table').resizable();
    $(".delete-title").tooltip({'placement':'right'});

    function getAttributesAutocomplete() {
        $( ".js-attribute-name-autocomplete" ).autocomplete({
            minLength: 2,
            source : '/datasetSubmission/getAttributes',
            select: function (a, b) {
                var $this = $(this);
                checkUnit($this);
            }
        });
    }

    getAttributesAutocomplete();

    function getSpeciesNameAutocomplete() {
        var speciesList = JSON.parse('<?= json_encode(array_values(CHtml::listData($species, 'id', 'common_name'))) ?>');
        $("#js-species-autocomplete").autocomplete({
            source: speciesList
        });
    }
    getSpeciesNameAutocomplete();

    var baseUrl = '<?= '/datasetSubmission/sampleManagement/id/'. $model->id ?>';
    var units = JSON.parse('<?= json_encode(CHtml::listData($units, 'id', 'name')) ?>');
    var datasetId = <?= $model->id ?>;
    var samplesTable = $('#samples-table');

    $(samplesTable).on('click', ".js-delete-row", function() {
        if (!confirm('Are you sure you want to delete this row?')) {
            return false;
        }


        $(this).closest('tr').remove();

        if (samplesTable.find('.item').length === 0) {
            $('#js-no-results').show();
        }

        return false;
    });

    $(samplesTable).on('click', ".js-delete-column", function() {
        if (!confirm('Are you sure you want to delete this column?')) {
            return false;
        }


        var th = $(this).closest('th');
        var index = $(this).closest('th').index();

        samplesTable.find('.item').each(function () {
            $(this).find('td').eq(index).remove();
        });

        th.remove();

        return false;
    });

    var newTd = '<td>' +
        '<input type="text" placeholder=\'Attribute value\' style="width: 250px;">' +
        '</td>';

    var unitsSelect = '<select style="width:70px;margin-right:20px;" class="dropdown-white" name="units[]">' +
        '<option value="">N/A</option>';

    for (var i in units) {
        unitsSelect += '<option value="'+i+'">'+units[i]+'</option>';
    }

    unitsSelect +='</select>';

    var newTh = '<th class="sample-attribute-column">' +
        '<a class="js-delete-column delete-title" title="delete this column">' +
        '<img alt="delete this column" src="/images/delete.png">' +
        '</a>' +

        '<input type="text" placeholder=\'Attribute name\' class="js-attribute-name-autocomplete">' +

        unitsSelect +

        '</td>';

    $(samplesTable).on('click', ".js-add-column", function() {
        var th = $(this).closest('th');
        var index = $(this).closest('th').index();

        samplesTable.find('.item').each(function () {
            $(this).find('td').eq(index).before(newTd);
        });

        th.before(newTh);

        getAttributesAutocomplete();

        return false;
    });

    $(samplesTable).on('click', ".js-add-row", function() {
        var newTr = '<tr class="item">';

        newTr += '<td style="white-space: nowrap;">' +
            '<a class="js-delete-row delete-title" title="delete this sample">' +
            '<img alt="delete this row" src="/images/delete.png">' +
            '</a>' +
            '<input type="text" placeholder=\'Sample ID\' style="margin-right: 18px;">' +
            '</td>';

        newTr += '<td>' +
            '<input id="js-species-autocomplete" type="text" class="js-species-autocomplete" placeholder=\'Species name\'>' +
            '</td>';

        newTr += '<td>' +
            '<input type="text" placeholder=\'Short description of sample\' style="width:250px;">' +
            '</td>';

        for (var i = 0, n = samplesTable.find('.sample-attribute-column').length - 1; i < n; i++) {
            newTr += newTd;
        }

        newTr += '<td class="button-column"></td>' +
            '</tr>';

        $('#js-no-results').before(newTr);

        $('#js-no-results').hide();

        $(".delete-title").tooltip({'placement':'right'});

        getSpeciesNameAutocomplete();

        return false;
    });

    $(document).on('click', ".js-save-samples", function() {
        saveSamples($(this).attr('href'));

        return false;
    });

    $(document).on('click', '#js-add-samples', function() {
        var form = $('#upload-samples');

        form.ajaxSubmit({
            beforeSend:function(){
                ajaxIndicatorStart('loading data.. please wait..');
            },
            success: function (response) {
                if (response.success) {
                    $('<input>').attr({
                        type: 'hidden',
                        name: 'rows',
                        value: JSON.stringify(response.rows)
                    }).appendTo(form);

                    if (response.matches) {
                        var question = 'Do you want:';
                        for (var i in response.matches) {
                            question += ' ' + response.matches[i] + ' instead ' + i + ',';
                        }

                        question = question.slice(0,-1) + '?';

                        if (confirm(question)) {
                            $('<input>').attr({
                                type: 'hidden',
                                name: 'matches',
                                value: JSON.stringify(response.matches)
                            }).appendTo(form);
                        }
                    }

                    form.attr('action', form.data('action'));
                    form.submit();
                } else {
                    alert(response.message)
                }
            },
            error: function(xhr) {
                alert(xhr.responseText);
            }
        });

        return false;
    });

    function saveSamples(url) {
        var samples = [];
        var sample_attrs = [];

        let trs = samplesTable.find('.item');
        let attr_tds = samplesTable.find('.sample-attribute-column');

        trs.each(function() {
            let tr = $(this);

            let id = tr.find('.js-sample-id').val();
            if (!id) {id = 0;}
            let sample_id = tr.children('td').eq(0).find('input').val();
            let species_name = tr.children('td').eq(1).find('input').val();


            let attr_values = [];
            for (var i = 0, n = attr_tds.length; i < n; i++) {
                let attr_value = tr.children('td').eq(2 + i).find('input').val().trim();
                attr_values.push(attr_value);
            }

            samples.push({
                id: id,
                sample_id: sample_id,
                species_name: species_name,
                attr_values: attr_values,
            });
        });

        attr_tds.each(function() {
            let td = $(this);

            let id = td.find('.js-sample-attr-id').val();
            if (!id) {id = 0;}
            let attr_name = td.find('input').val();
            if (!attr_name) {attr_name = '';}
            let unit_id = td.find('select').val();
            if (!unit_id) {unit_id = 0;}


            sample_attrs.push({
                id: id,
                attr_name: attr_name,
                unit_id: unit_id,
            });
        });

        $.ajax({
            type: 'POST',
            url: '/datasetSubmission/saveSamples',
            data:{
                dataset_id: datasetId,
                samples: samples,
                sample_attrs: sample_attrs,
            },
            success: function(response){
                if(!response.success) {
                    alert(response.message);
                } else {
                    window.location.href = url;
                }
            },
            error: function(xhr) {
                alert(xhr.responseText);
            }
        });
    }

    function checkUnit($this)
    {
        setTimeout((function(){
            $.ajax({
                type: 'GET',
                url: '/datasetSubmission/checkUnit',
                data:{
                    attr_name: $this.val(),
                },
                success: function(response){
                    var select = $this.closest('th').find('select');
                    if(response.success) {
                        select.val(response.unitId)
                    } else {
                        select.val('');
                    }
                },
                error: function(xhr) {
                    alert(xhr.responseText);
                }
            });
        }), 50);
    }

    $(document).on('keydown', '.js-attribute-name-autocomplete', function () {
        var $this = $(this);

        checkUnit($this);
    });

    $(document).on('change', '#template', function () {
        if ($(this).val()){
            $('.js-not-allowed', '#set-template-div').removeClass('disabled js-not-allowed').addClass('js-set-template');
        } else {
            $('.js-set-template').removeClass('js-set-template').addClass('disabled js-not-allowed');
        }
    });

    $(document).on('change', '#samples', function () {
        if ($(this).val()){
            $('.js-not-allowed', '#add-samples-div').hide();
            $('#js-add-samples').show();
        } else {
            $('.js-not-allowed', '#add-samples-div').show();
            $('#js-add-samples').hide();
        }
    });

    $(document).on('click', '.js-set-template', function () {
        if (samplesTable.find('.item').length) {
            if (!confirm('Please note that all data in table will be overwritten! Are you sure?')) {
                return false;
            }
        }

        window.location.href = baseUrl + '/template/' + $('#template').val();

        return false;
    });

    function ajaxIndicatorStart(text)
    {
        if($('body').find('#resultLoading').attr('id') != 'resultLoading'){
            $('body').append('<div id="resultLoading" style="display:none"><div><img width="30" src="/images/ajax-loader.gif"><div>'+text+'</div></div><div class="bg"></div></div>');
        }

        $('#resultLoading').css({
            'width':'100%',
            'height':'100%',
            'position':'fixed',
            'z-index':'10000000',
            'top':'0',
            'left':'0',
            'right':'0',
            'bottom':'0',
            'margin':'auto'
        });

        $('#resultLoading .bg').css({
            'background':'#000000',
            'opacity':'0.7',
            'width':'100%',
            'height':'100%',
            'position':'absolute',
            'top':'0'
        });

        $('#resultLoading>div:first').css({
            'width': '250px',
            'height':'75px',
            'text-align': 'center',
            'position': 'fixed',
            'top':'0',
            'left':'0',
            'right':'0',
            'bottom':'0',
            'margin':'auto',
            'font-size':'16px',
            'z-index':'10',
            'color':'#ffffff'

        });

        $('#resultLoading .bg').height('100%');
        $('#resultLoading').fadeIn(300);
        $('body').css('cursor', 'wait');
    }

    function ajaxIndicatorStop()
    {
        $('#resultLoading .bg').height('100%');
        $('#resultLoading').fadeOut(300);
        $('body').css('cursor', 'default');
    }

    $(document).ajaxStop(function () {
        //hide ajax indicator
        ajaxIndicatorStop();
    });
</script>
