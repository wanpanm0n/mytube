<div class="row">
	<div class="col-lg-12">
    	<h2 class="page-header">Contents</h2>
    </div>
</div>
<div class="col-md-9">
<!-- 	<div class="row"> -->
		<?php echo CHtml::link('Search','#',array('class'=>'search-button btn btn-small btn-danger', 'style'=>"margin-left: 15px;")); ?>
<!-- 	</div> -->
	<div class="contentSearch col-md-12" style="display:none">
		<?php  $this->renderPartial('_search',array(
		    'model'=>$model,
		)); ?>
	</div>
<div style="clear: both"></div>
<?php 
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'id'=>'contentSearch',
	'template'=>'{items}<div style="clear:both"></div>{pager}'
)); 
// $this->widget('application.extensions.NPager.NListView', array(
// 		'dataProvider' => $dataProvider,
// 		'itemView'=>'_view',
// 		//'template'=>'{items}{pager}'
// ));
?>
</div>
<div class="col-md-3">
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-gear fa-fw"></i> Actions
		</div>
			<?php 
			$this->widget('zii.widgets.CMenu', array(
					'htmlOptions' => array(
							'class'=>'list-group',
					),
					'items'=>array(
						array('label'=>'Create Content', 'url'=>array('create'),'itemOptions'=>array('class' => 'list-group-item')),
						array('label'=>'Manage Content', 'url'=>array('admin'),'itemOptions'=>array('class' => 'list-group-item')),
					),
					'htmlOptions'=>array(
							'class'=>'list-group'
					)
					
			));
			?>
</div>
<?php 
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.contentSearch').toggle();
    return false;
});
$('.contentSearch form').submit(function(){
    $.fn.yiiListView.update('contentSearch', {
        data: $(this).serialize()
    });
    return false;
});
");
?>