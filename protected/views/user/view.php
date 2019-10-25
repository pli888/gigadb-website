<div class="container" id="view_user_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">User</a></li>
                <li class="active">View</li>
            </ol>
            <h4>View User #<?php echo $model->id; ?></h4>
        </div>
    </section>
    <section>
        <?php
        $user_command = UserCommand::model()->findByAttributes(array("requester_id" => $model->id, "status" => "pending")) ;
        $linked_author = Author::findAttachedAuthorByUserId($model->id) ;

        ?>

        <?php $this->widget('zii.widgets.CDetailView', array(
            'data'=>$model,
            'attributes'=>array(
                'id',
                'email',
                'first_name',
                'last_name',
                'affiliation',
                'role',
                array(
                    'label'=>'Is Activated',
                    'value'=> $model->is_activated ? 'Yes' : 'No'),
                array(
                    'label'=>'Is Receiving Newsletter',
                    'value'=> $model->newsletter ? 'Yes' : 'No'),
            ),
        )); ?>

        <div class="clear"></div>
        <?php
        if ( null != $user_command ) {
            echo "<div class=\"alert alert-info\">";
            $claimed_author = Author::model()->findByPk($user_command->actionable_id);
            if (null != $claimed_author) {
                echo "<p>This user has a pending claim on {$claimed_author->getDisplayName()} ({$claimed_author->id})</p>";
            }
            echo CHtml::link('Edit user to validate/reject the claim',
                array('user/update', 'id'=>$model->id),
                array('class' => 'btn'));
            echo "</div>";
        }
        else if ( null !=  $linked_author) {
        echo "<div class=\"alert alert-info\">";
        ?>
        This user is linked to author: <? echo $linked_author->getDisplayName() ?> (<? echo $linked_author->id ?>)
</div>
<?php
echo "</div>";
}
?>
    </section>
</div>
