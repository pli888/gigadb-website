<?php
$title= strlen($model->title)>100?strip_tags(substr($model->title, 0,100))." ...":strip_tags($model->title);
$this->pageTitle="GigaDB Dataset - DOI 10.5524/".$model->identifier." - ".$title;

  $template = <<<HTML
<div>
    {items}
</div>
<div class="pull-left">
    {pager}
</div>
<div>
    {summary}
</div>
HTML;

?>
<div class="content">
    <div class="container">


 
                <section></section>
                <div class="subsection">
                    <div class="media">
                        <div class="media-left">
                                        <?php if($model->image) {
                $url = $model->getImageUrl() ? $model->getImageUrl(): $model->image->image('image_upload');
                
                ?>
            <a href="<?= $url ?>" >
                <?= CHtml::image($url, $url, array('class'=>'media-object',
                    'title'=>'<ul style="text-align:left;"><li>'.$model->image->tag.'</li><li>'.'License: '.$model->image->license.'</li><li>'.'Source: '.$model->image->source.'</li><li>'.'Photographer: '.$model->image->photographer.'</li></ul>')); ?>
            </a>
            <?php } ?>
                            
                        </div>
                        <div class="media-body">
                            <h4 class="left-border-title left-border-title-lg"><?echo $model->title; ?></h4>
                            <p class="dataset-release-date-text">Dataset type:  <? echo MyHtml::encode(implode(", ", $model->getDatasetTypes()));?> <br> Data released on <?= strftime("%B %d, %Y",strtotime($model->publication_date)) ?></p>
                            <div class="color-background color-background-block dataset-color-background-block">
                                <p><?= $model->authorNames ?>(<?=substr($model->publication_date,0,4)?>): <?= $model->title.' '.$model->publisher->name.'. '; ?><a href="http://dx.doi.org/<?= $model->identifier; ?>">http://dx.doi.org/<?= $model->identifier; ?></a></p>
                                <p><a class="doi-badge" href="#"><span class="badge">DOI</span><span class="badge">10.5524/<?= $model->identifier; ?></span></a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="subsection">
                    <p><?= $model->description; ?></p>
                </div>
               
                <div class="subsection">
                     <?php if(count($model->datasetAttributes)>0){?>
                    <p>Keywords:</p>
                    <ul class="list-inline">
                    <? foreach ($model->datasetAttributes as $key=>$keyword){
                        if ($keyword->attribute_id == 455)
                            echo "<li><a href='/search/new?keyword=$keyword->value'>$keyword->value</a></li>";

                      
                    }
                    ?>
                    </ul>
                     <?php } ?>
                 <div class="pull-right">
                    <p>
                        <span class="citation-popup" data-content="View citations on Google Scholar">
                            <a href="<?= $model->googleScholarLink ?>" target="_blank"><img class="dataset-des-images" src="/images/google_scholar.png"/></a>
                        </span>
                        <span class="citation-popup" data-content="View citations on Europe PubMed Central">
                            <a href="<?= $model->ePMCLink ?>" target="_blank"><img class="dataset-des-images" src="/images/ePMC.jpg"/></a>
                        </span>
                    </p>
                </div>    
                </div>
                                <div class="subsection">
                                     <span class="content-popup" <?= !Yii::app()->user->isGuest ? '' : 'data-content="Please login to contact submitter"' ?> data-original-title="">
                    <a class="btn background-btn background-btn-o <?= !Yii::app()->user->isGuest ? '' : 'notlogged' ?>" <?= !Yii::app()->user->isGuest ? 'href="mailto:'.$model->submitter->email.'"' : 'href="#"' ?>>
                        Contact Submitter
                    </a>
                   
                </div>
                <div class="subsection">
                  <?php if($model->fairnuse) {
                            if( (time() < strtotime($model->fairnuse))) { ?>
                    <img src="/images/fair_use2.gif" alt="policy" style=""/>
                    <p>
                        These data are made available pre-publication under the Fort Lauderdale rules.
                        Please respect the rights of the data producers to publish their whole dataset analysis first.
                        The data is being made available so that the research community can make use of them for more
                        focused studies without having to wait for publication of the whole dataset analysis paper.
                        If you wish to perform analyses on this complete dataset, please contact the authors directly
                        so that you can work in collaboration rather than in competition.
                    </p>
                    <p><strong>This dataset fair use agreement is in place until <?= strftime('%d %B %Y',strtotime($model->fairnuse))?></strong></p>
                <?php } } ?>  
                </div>
                <div class="subsection">
                    <div class="underline-title">
                        <div>
                            <h4>Additional details</h4>
                        </div>
                    </div>
                    <?php if (count($model->manuscripts) > 0) { ?>
                <h5><strong><?= Yii::t('app' , 'Read the peer-reviewed publication(s):')?></strong></h5>
                <p>
                    <? foreach ($model->manuscripts as $key=>$manuscript){                      
                        echo $manuscript->getFullCitation();
                        if ($manuscript->pmid){
                            $pubmed = MyHtml::link($manuscript->pmid , "http://www.ncbi.nlm.nih.gov/pubmed/" . $manuscript->pmid);
                            echo " (PubMed: $pubmed)";
                        }
                        echo "<br/>";
                    }
                    ?>
                </p>
                <?php } ?>

                <?php if (count($model->relations) > 0) { ?>
                <h5><strong><?= Yii::t('app' , 'Related datasets:')?></strong></h5>
                <p>
                <?php foreach ($model->relations as $key=>$relation){
                if($relation->relationship->name == "IsPreviousVersionOf")
                {
                echo "doi:" . MyHtml::link("10.5524/". $model->identifier, '/dataset/'.$model->identifier) ." " . $relation->relationship->name . " " .'doi:' . MyHtml::link("10.5524/".$relation->related_doi, '/dataset/'.$relation->related_doi)."<b> (It is a more recent version of this dataset) </b>";
                echo "<br/>";
                ?>

                   <?php
            $target = 'window.location='."'".$this->createUrl('dataset/'.$relation->related_doi)."'";
            $this->beginWidget('zii.widgets.jui.CJuiDialog', array(// the dialog
                'id' => 'dialogDisplay1',
                'options' => array(
                    'title' => 'New Version Alert',
                    'autoOpen' => true,
                    'modal' => true,
                    'width' => 400,
                    'height' => 300,
                    'buttons' => array(
                        array('text' => 'Continue to view old version', 'click' => 'js:function(){$(this).dialog("close");}'),
                          array('text' => 'View new version', 'click' => 'js:function(){'.$target.'}'),
                        ),
                ),
            ));
            ?>
            <div class="divForForm">
                <br>

                    There is a new version of this dataset available at: DOI: 10.5524/<?php echo $relation->related_doi ?>


            </div>

                <?php $this->endWidget(); ?>



               <?php }

                else
                {
                echo "doi:" . MyHtml::link("10.5524/". $model->identifier, '/dataset/'.$model->identifier) ." " . $relation->relationship->name . " " .'doi:' . MyHtml::link("10.5524/".$relation->related_doi, '/dataset/'.$relation->related_doi);
                echo "<br/>";
                }
             }
            ?>
        </p>

                <?php } ?>

                <?php 
                        $types = array();
                        $protocol = array();
                        $jb = array();
                        $dmodel = array();
                        $codeocean = array();
                        if (count($model->externalLinks) > 0) { ?>
                <p>
                    <?php
                        
                        foreach ($model->externalLinks as $key=>$externalLink){
                            $types[$externalLink->externalLinkType->name] = 1;
                        }
                        foreach ($types as $typeName => $value) {
                            $typeNameLabel = preg_replace('/(?:^|_)(.?)/e',"strtoupper('$1')",$typeName);
                            $typeNameLabel = preg_replace('/(?<=\\w)(?=[A-Z])/'," $1", $typeNameLabel);
                            $typeNameLabel = trim($typeNameLabel);
                            if($typeNameLabel !== 'Protocols.io' and $typeNameLabel !== 'J Browse' and $typeNameLabel !== '3 D Models' and $typeNameLabel !== 'Code Ocean')
                            {
                               echo "<h5><strong>$typeNameLabel:</strong></h5>";
                            }

                            foreach ($model->externalLinks as $key=>$externalLink){
                                if ($externalLink->externalLinkType->name == $typeName) {
                                    if($typeName == 'Protocols.io')
                                    {
                                       array_push($protocol,$externalLink->url);

                                    }
                                    elseif($typeName == 'JBrowse')
                                    {
                                       array_push($jb,$externalLink->url);
                                    
                                    }
                                    elseif($typeName == '3D Models')
                                    {
                                       array_push($dmodel,$externalLink->url);
                                    
                                    }
                                    elseif($typeName == 'Code Ocean')
                                    {
                                       array_push($codeocean,$externalLink->url);
                                    
                                    }
                                    else
                                    {
                                    echo '<p>'. MyHtml::link($externalLink->url, $externalLink->url) . '</p>';
                                    }
                                }
                            }
                        }

                        
                    ?>
                </p>

                <?php } ?>

                <?php if (count($model->links) > 0) { ?>

                    <?php
                    $primary_links = array();
                    $secondary_links = array();

                    foreach ($model->links as $key=>$link) {
                        if ($link->is_primary) {
                            $primary_links[] = $link;
                        }
                        if (!$link->is_primary) {
                            $secondary_links[] = $link;
                        }
                    }
                    ?>

                    <?php if (!empty($primary_links)) { ?>
                <h5><strong><?=Yii::t('app' , 'Accessions (data included in GigaDB):')?></strong></h5>
                        <p>
                            <? foreach ($primary_links as $link) { ?>
                                <?
                                $tokens = explode(':', $link->link);
                                $name = $tokens[0];
                                $code = $tokens[1];
                                ?>
                                <?= $name ?>:
                                <?= MyHtml::link($code, $link->getFullUrl($link_type), array('target'=>'_blank')); ?>
                                <br/>
                            <? } ?>
                        </p>
                    <?php } ?>

                    <?php if (!empty($secondary_links)) { ?>
                        <h5><strong><?=Yii::t('app' , 'Accessions (data not in GigaDB):')?></strong></h5>
                        <p>
                            <?php foreach ($secondary_links as $link) { ?>
                                <?php
                                $tokens = explode(':', $link->link);
                                $name = $tokens[0];
                                $code = $tokens[1];
                                ?>
                                <?php if ($name != 'http') { ?>
                                    <?= $name ?>:
                                    <?= MyHtml::link($code, $link->getFullUrl($link_type), array('target'=>'_blank')); ?>
                                <?php }else { ?>
                                    <?= MyHtml::link($link->link , $link->link,array('target'=>'_blank')); ?>
                                <?php } ?>
                                <br/>
                            <?php } ?>
                        </p>
                    <?php } ?>

                <?php } ?>
                <?php if (count($model->projects) > 0) { ?>
                <h5><strong><?=Yii::t('app' , 'Projects:')?></strong></h5>
                <p>
                    <? foreach ($model->projects as $key=>$project){
                        if ($project->image_location)
                            echo "<a href='$project->url'><img src='$project->image_location' /></a>";
                        else
                            echo MyHtml::link($project->name, $project->url);

                        echo "<br/>";
                    }
                    ?>
                </p>
                <? } ?>
 
                </div>
              
                <section>
                    <ul class="nav nav-tabs nav-border-tabs" role="tablist">
                        <?php if(count($model->samples) > 0) {
                            ?>
                           <li role="presentation" id="p-sample"><a href="#sample" aria-controls="sample" role="tab" data-toggle="tab">Sample</a></li>
                        <?php }                       
                        ?>
                        <?php if(count($model->files) > 0) {
                            
                              if(count($model->samples) < 1)  
                              { 
                                  ?>
                        <li role="presentation" id="p-file" class="active"><a href="#files" aria-controls="files" role="tab" data-toggle="tab">Files</a></li>  
                              <?php } else { 
                              ?>
                        <li role="presentation" id="p-file"><a href="#files" aria-controls="files" role="tab" data-toggle="tab">Files</a></li>
                        <?php }}                       
                        ?>
                         <?php if(count($model->datasetFunders) > 0) {
                            ?>
                            <li role="presentation" id="p-funding"><a href="#funding" aria-controls="funding" role="tab" data-toggle="tab">Funding</a></li>
                        <?php }                       
                        ?>
                        <?php if(count($protocol) > 0) {
                            ?>
                           <li role="presentation" id="p-protocol"><a href="#protocol" aria-controls="protocol" role="tab" data-toggle="tab">Protocols.io</a></li>
                        <?php }                       
                        ?>
                        <?php if(count($jb) > 0) {
                            ?>
                           <li role="presentation" id="p-jb"><a href="#jb" aria-controls="jb" role="tab" data-toggle="tab">JBrowse</a></li>
                        <?php }                       
                        ?> 
                        <?php if(count($dmodel) > 0) {
                            ?>
                           <li role="presentation" id="p-dmodel"><a href="#demodel" aria-controls="demodel" role="tab" data-toggle="tab">3D Viewer</a></li>
                        <?php }                       
                        ?> 
                        <?php if(count($codeocean) > 0) {
                            ?>
                           <li role="presentation" id="p-codeocean"><a href="#codeocean" aria-controls="codeocean" role="tab" data-toggle="tab">Code Ocean</a></li>
                        <?php }                       
                        ?>    
                        <li role="presentation" id="p-history"><a href="#history" aria-controls="history" role="tab" data-toggle="tab">History</a></li>
                        
                    </ul>
       
            
                    <div class="tab-content"> 
                        
                             <?php if(count($model->samples) > 0) {
                            ?>   
                        
                      <div role="tabpanel" class="tab-pane active" id="sample">
                        <button class="btn btn-default pull-right" type="button" data-toggle="modal" data-target="#files-modal" style="border-color: #e5e5e5; color: #656565; height: 34px; margin-bottom: -34px; background-color: #fff;"><span class="glyphicon glyphicon-adjust"></span> <?php $this->renderPartial('_sample_setting',array('columns'=>$columns)); ?></button>
                        <br>
                        <br>
                        <br>
                        <br>
                                                <?php
            $this->widget('zii.widgets.grid.CGridView', array(
                'id' => 'sample-grid',
                'dataProvider'=>$samples,
                'itemsCssClass'=>'table table-bordered',
                'template' => $template,
                'pager' => 'SiteLinkPager',
                'pagerCssClass' => '',
                'summaryText' => 'Displaying {start}-{end} of {count} Sample(s).',
                'htmlOptions' => array('style'=>'padding-top: 0px'),
                'columns' => array(
                    array(
                        'name' => 'name',
                        'type' => 'raw',
                        'value' => '$data->linkName',
                        'htmlOptions' => array('class'=>'left'),
                        'visible' => in_array('name', $columns),
                        'headerHtmlOptions'=>array('style'=>'color: #099242'),
                    ),
                    array(
                        'name' => 'taxonomic_id',
                        'value' => 'CHtml::link($data->species->tax_id, Species::getTaxLink($data->species->tax_id))',
                        'type' => 'raw',
                        'visible' => in_array('taxonomic_id', $columns),
                        'headerHtmlOptions'=>array('style'=>'color: #099242'),
                    ),
                    array(
                        'name' => 'common_name',
                        'value' => '$data->species->common_name',
                        'visible' => in_array("common_name", $columns),
                        'headerHtmlOptions'=>array('style'=>'color: #099242'),
                    ),
                    array(
                        'name' => 'genbank_name',
                        'value' => '$data->species->genbank_name',
                        'visible' => in_array("genbank_name", $columns),
                        'headerHtmlOptions'=>array('style'=>'color: #099242'),
                    ),
                    array(
                        'name' => 'scientific_name',
                        'value' => '$data->species->scientific_name',
                        'visible' => in_array("scientific_name", $columns),
                        'headerHtmlOptions'=>array('style'=>'color: #099242'),
                    ),
                    array(
                        'name' => 'attribute',
                        'value' => '$data->displayAttr',
                        'type' => 'raw',
                        'visible' => in_array("attribute", $columns),
                        'htmlOptions' => array('class'=>'left'),
                        'headerHtmlOptions'=>array('style'=>'color: #099242'),
                    ),
                ),

            ));
        ?>
    
                      </div>
                            <?php }                       
                        ?>
                    <?php 
                 if(count($model->files) > 0) {
                            
                    if(count($model->samples) > 0) {
                            ?>     
                        <div role="tabpanel" class="tab-pane" id="files">
                         <?php }  else {?>
                         <div role="tabpanel" class="tab-pane active" id="files">    
                         <?php   } ?>        
                            <button class="btn btn-default pull-left" type="button" data-toggle="modal" data-target="#files-modal" style="border-color: #e5e5e5; color: #656565; height: 34px; margin-bottom: -34px; background-color: #fff;"><span class="glyphicon glyphicon-adjust"></span> <?= MyHtml::link(Yii::t('app','(FTP site)'),$model->ftp_site,array('target'=>'_blank'))?></button>
                            <button class="btn btn-default pull-right" type="button" data-toggle="modal" data-target="#files-modal" style="border-color: #e5e5e5; color: #656565; height: 34px; margin-bottom: -34px; background-color: #fff;"><span class="glyphicon glyphicon-adjust"></span> <?php $this->renderPartial('_display_setting',array('setting'=>$setting));?></button>
                            <br>
                            <br>
                            <br>
                            <br>
                            <?php
            $this->widget('zii.widgets.grid.CGridView', array(
                'id' => 'file-grid',
                'dataProvider'=>$files,
                'itemsCssClass'=>'table table-bordered',
                'template' => $template,
                'pager' => 'SiteLinkPager',
                'pagerCssClass' => '',
                'summaryText' => 'Displaying {start}-{end} of {count} File(s).',
                'htmlOptions' => array('style'=>'padding-top: 0px'),
                'columns' => array(
                    array(
                        'name' => 'name',
                        'type' => 'raw',
                        'value' => '$data->nameHtml',
                        'visible' => in_array('name', $setting),
                        'headerHtmlOptions'=>array('style'=>'color: #099242'),
                    ),
                    array(
                        'name' => 'description',
                        'value' => '$data->description',
                        'visible' => in_array('description', $setting),
                        'headerHtmlOptions'=>array('style'=>'color: #099242'),
                    ),
                    array(
                        'name' => 'sample_name',
                        'type' => 'raw',
                        'value' => '$data->getallsample($data->id)',
                        'visible' => in_array('sample_id', $setting),
                        'headerHtmlOptions'=>array('style'=>'color: #099242'),
                    ),
                    array(
                        'name' => 'type_id',
                        'value' => '$data->type->name',
                        'visible' => in_array("type_id", $setting),
                        'headerHtmlOptions'=>array('style'=>'color: #099242'),
                    ),
                    array(
                        'name' => 'format_id',
                        'value' => '$data->format->name',
                        'visible' => in_array("format_id", $setting),
                        'headerHtmlOptions'=>array('style'=>'color: #099242'),
                    ),
                    array(
                        'name' => 'size',
                        'value' => 'File::staticBytesToSize($data->size)',
                        'visible' => in_array("size", $setting),
                        'headerHtmlOptions'=>array('style'=>'color: #099242'),
                    ),
                    array(
                        'name' => 'date_stamp',
                        'value' => '$data->date_stamp',
                        'visible' => in_array("date_stamp", $setting),
                        'headerHtmlOptions'=>array('style'=>'color: #099242'),
                    ),
                    array(
                        'name' => 'attribute',
                        'type' => 'raw',
                        'value' => '$data->attrDesc',
                        'visible' => in_array("attribute", $setting),
                        'headerHtmlOptions'=>array('style'=>'color: #099242'),
                    ),
                    array(
                        'class'=>'CButtonColumn',
                        'template' => '{download}',
                        'buttons' => array(
                            'download' => array(
                                'label'=>'',
                                'url' => '$data->location',
                                'imageUrl' => '',
                                'options' => array(
                                    'target' => '_blank',
                                    'class' => 'download-btn js-download-count',
                                ),
                            )
                        ),
                        'visible' => in_array("location", $setting),
                    ),

                ),

            ));
        ?>

                        </div>
                            <?php }                       
                        ?>
                             <?php if(count($model->datasetFunders) > 0) {
                            ?>
                        
                        <div role="tabpanel" class="tab-pane" id="funding">
                           
                                
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Funding body</th>
                                <th>Awardee</th>
                                <th>Award ID</th>
                                <th>Comments</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                          <?php foreach($model->datasetFunders as $fd) { ?>                              
                            <tr>
                                <td><?= $fd->funder->primary_name_display ?></td>
                                <td><?= $fd->awardee ?></td>
                                <td><?= $fd->grant_award ?></td>
                                <td><?= $fd->comments ?></td>
                            </tr>
                            <?php } ?> 
                        </tbody>
                    </table>
               

                        </div>
                    <?php }                       
                        ?>   
                        
                    <?php if (count($protocol) > 0) { ?>        
                     
                         <div role="tabpanel" class="tab-pane" id="protocol">
                        <?php    
                        
                            echo "<p>Protocols.io:</p>";
                            // echo "<a id=\"js-expand-btn1\" class=\"btn btn-expand\"><div class=\"history-status\"> + </div></a>";
                            // echo "<a id=\"js-close-btn1\" class=\"btn btn-collapse\" style=\"display:none;\"><div class=\"history-status\"> - </div></a>";
                            // echo "<div id=\"js-logs-1\" class=\"js-logs\" style=\"display:none;\">";
                             foreach ($protocol as $p) {

                            {
                                 echo "<iframe src=\"$p\" style=\"width: 850px; height: 320px; border: 1px solid transparent;\"></iframe>";
                            }
                               
                            }
                            // echo "</div>"; 
                         ?>    
                             
                              </div> 
                             
                             
                    <?php }?>  
                    
                    <?php if (count($jb) > 0) { ?>        
                     
                         <div role="tabpanel" class="tab-pane" id="jb">
                        <?php    
                        
                             echo "<p>JBrowse:</p>";
                             //echo "<a id=\"js-expand-btn2\" class=\"btn btn-expand\"><div class=\"history-status\"> + </div></a>";
                            // echo "<a id=\"js-close-btn2\" class=\"btn btn-collapse\" style=\"display:none;\"><div class=\"history-status\"> - </div></a>";
                             //echo "<div id=\"js-logs-2\" class=\"js-logs\" style=\"display:none;\">";
                             foreach ($jb as $p) {

                            {    
                                 echo "<iframe src=\"$p\" style=\"width: 1000px; height: 520px; border: 1px solid transparent;\"></iframe>";
                                 echo "<br>";
                                 echo "<a href=\"$p\" target=\"_blank\">Open the JBrowse</a>";
                            }
                               
                            }
                             //echo "</div>";
                         ?>    
                             
                              </div> 
                             
                             
                    <?php }?>   
                    
                    <?php if (count($dmodel) > 0) { ?>        
                     
                         <div role="tabpanel" class="tab-pane" id="demodel">
                        <?php    
                        
                             echo "<p>3D Models:</p>";
                             //echo "<a id=\"js-expand-btn3\" class=\"btn btn-expand\"><div class=\"history-status\"> + </div></a>";
                            // echo "<a id=\"js-close-btn3\" class=\"btn btn-collapse\" style=\"display:none;\"><div class=\"history-status\"> - </div></a>";
                            // echo "<div id=\"js-logs-3\" class=\"js-logs\" style=\"display:none;\">";
                             foreach ($dmodel as $p) {

                            {    
                                 echo "<iframe src=\"$p\" style=\"width: 950px; height: 520px; border: 1px solid transparent;\"></iframe>";
                                
                            }
                               
                            }
                            // echo "</div>";
                         ?>    
                             
                             </div>
                             
                             
                    <?php }?>  
                            
                     <?php if (count($codeocean) > 0) { ?>        
                     
                         <div role="tabpanel" class="tab-pane" id="codeocean">
                        <?php    
                        
                             echo "<p>Code Ocean:</p>";
                             //echo "<a id=\"js-expand-btn3\" class=\"btn btn-expand\"><div class=\"history-status\"> + </div></a>";
                            // echo "<a id=\"js-close-btn3\" class=\"btn btn-collapse\" style=\"display:none;\"><div class=\"history-status\"> - </div></a>";
                            // echo "<div id=\"js-logs-3\" class=\"js-logs\" style=\"display:none;\">";
                             foreach ($codeocean as $p) {

                            {    
                                 echo "<p>$p</p>";
                                
                            }
                               
                            }
                            // echo "</div>";
                         ?>    
                             
                             </div>
                             
                             
                    <?php }?>        
                            
                           
                        
                                       
                        <div role="tabpanel" class="tab-pane" id="history">
                            
                          <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Action</th>                               
                            </tr>
                        </thead>
                        <tbody>                            
                        <?php foreach($logs as $log) : ?>
                        <tr>
                            <td><?= date('F j, Y', strtotime($log->created_at)) ?></td>
                            <td><?= $log->message ?></td>
                        </tr>
                        <?php endforeach ?>
                        </tbody>
                       </table>

                        </div>
                    </div>
                </section>
            </div>
        </div>





<div class="clear"></div>


<?php if (count($relates)) : ?>



<?php endif ?>
<a href="/dataset/<?php echo $previous_doi?>"  title="Previous dataset">><span class="fa fa-angle-left fixed-btn-left"></span></a>
<a href="/dataset/<?php echo $next_doi?>" title="Next dataset">><span class="fa fa-angle-right fixed-btn-right"></span></a>

<!-- Place this tag in your head or just before your close body tag. -->
<script>

/* Document ready for Thumbnail Slider */
/* ----------------------------------- */
$(document).ready(function() {
    // If the related are more than 3 so we add the caroussel
    if ($('#myCarousel').attr('data-total') > 3) {
        $('#myCarousel').carousel({
            interval: 4000,
            wrap: 'circular'
        });
    }
    	$('.tab-container').on("click", function() {
		$(this).toggleClass('tab-show');
		$(this).toggleClass('tab-hide');

		var arrow = $(this).find('.tab-container__arrow')[0];
		$(arrow).toggleClass('flip-vertical');
	});
        
        var url = location.pathname;
        var sample_index = url.lastIndexOf('Sample_');
        var file_index = url.lastIndexOf('File_');
        
         if (/Sample/.test(window.location.href)) {
             $("#p-sample").addClass("active");
              var e = document.getElementById('p-sample');
              if (!!e && e.scrollIntoView) {
                   e.scrollIntoView();
              }
             
        }
        else{
             $("#p-sample").addClass("active");           
        }
         if (/File/.test(window.location.href)) {
            
             $("#p-sample").removeClass("active");
             $("#sample").removeClass("tab-pane active");
             $("#sample").addClass("tab-pane");
             $("#p-file").addClass("active");
             $("#files").addClass("active");
             
             var e = document.getElementById('p-file');
             if (!!e && e.scrollIntoView) {
             e.scrollIntoView();
            }
            
             
        }
   
        if(sample_index > 0 && file_index>0)
        {
        if(sample_index > file_index)
        {
            $("#p-file").removeClass("active");
            $("#files").removeClass("tab-pane active");
            $("#files").addClass("tab-pane");
            $("#p-sample").addClass("active");
            $("#sample").addClass("active");
              var e = document.getElementById('p-sample');
              if (!!e && e.scrollIntoView) {
                   e.scrollIntoView();
              }   
        }
       else
        {
             $("#p-sample").removeClass("active");
             $("#sample").removeClass("tab-pane active");
             $("#sample").addClass("tab-pane");
             $("#p-file").addClass("active");
             $("#files").addClass("active");
             
             var e = document.getElementById('p-file');
             if (!!e && e.scrollIntoView) {
             e.scrollIntoView();
            }
        }
    }
        
});
/* ----------------------------------- */

$(".hint").tooltip({'placement':'right'});
$(".image-hint").tooltip({'placement':'top'});

$("#js-expand-btn").click(function(){
      $(this).hide();
      $("#js-close-btn").show();
      $("#js-logs-2").show();
});

$("#js-close-btn").click(function(){
      $(this).hide();
      $("#js-expand-btn").show();
      $("#js-logs-2").hide();
});


$("#js-expand-btn1").click(function(){
      $(this).hide();
      $("#js-close-btn1").show();
      $("#js-logs-1").show();
});

$("#js-close-btn1").click(function(){
      $(this).hide();
      $("#js-expand-btn1").show();
      $("#js-logs-1").hide();
});

$("#js-expand-btn2").click(function(){
      $(this).hide();
      $("#js-close-btn2").show();
      $("#js-logs-2").show();
});

$("#js-close-btn2").click(function(){
      $(this).hide();
      $("#js-expand-btn2").show();
      $("#js-logs-2").hide();
});
$("#js-expand-btn3").click(function(){
      $(this).hide();
      $("#js-close-btn3").show();
      $("#js-logs-3").show();
});

$("#js-close-btn3").click(function(){
      $(this).hide();
      $("#js-expand-btn3").show();
      $("#js-logs-3").hide();
});

$(".js-download-count").click(function(){
    var location = $(this).attr('href');
    $.ajax({
       type: 'POST',
       url: '/adminFile/downloadCount',
       data:{'file_href': location},
       success: function(response){
            if(response.success) {
            } else {
                alert(response.message);
            }
          },
      error:function(){
        }
    });
});

$(".content-popup").popover({'placement':'right'});
$(".citation-popup").popover({'placement':'top'});
</script>
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>

<script type="text/javascript">
    $(".js-desc").click(function(e) {
        e.preventDefault();
        id = $(this).attr('data');
        $(this).hide();
        $('.js-short-'+id).toggle();
        $('.js-long-'+id).toggle();
    });
</script>
