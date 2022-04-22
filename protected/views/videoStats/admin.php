<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Reports</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
<div class="col-lg-12">
                    <div class="panel panel-default">
<!--                         <div class="panel-heading"> -->
<!--                         	<i class="fa fa-user fa-w"></i> -->
<!--                             Manage Categories -->
<!--                         </div> -->
                        <!-- /.panel-heading -->
                        <div class="panel-body">

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" >
<?php //echo CHtml::button('Export', array('id'=>'export-button','class'=>'span-3 button')); ?>

<?php 
//VideoStats::model()->getOldestDate();
$this->renderPartial('_search',array(
	'model'=>$model
)); ?>
</div><!-- search-form -->

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'video-stats-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		//'id',
		//'phone_number',
		array(
			'name'=>'phone_number',
			'type'=>'raw',
			'value'=>'$data->phone_number',
			'htmlOptions' => array('style'=>'text-align: center')
		),
		array(
			'name'=>'sim_serial_number',
			'type'=>'raw',
			'value'=>'$data->sim_serial_number',
			'htmlOptions' => array('style'=>'text-align: center')
		),
		array(
			'name'=>'language_id',
			'type'=>'raw',
			'value'=>'$data->language->name',
			'htmlOptions' => array('style'=>'text-align: center')
		),
		//'count',
		array(
			'header'=>'No of Views',
			'value'=>'$data->count',
			'htmlOptions' => array('style'=>'text-align: center')
		)
		
	),
));
?>
</div>
</div>
</div>
<?php
Yii::app()->clientScript->registerScript('search', "
	/*
$('#export-button').on('click',function() {
    $.fn.yiiGridView.export();
});
$.fn.yiiGridView.export = function() {
    $.fn.yiiGridView.update('video-stats-grid',{ 
        success: function() {
            $('#video-stats-grid').removeClass('grid-view-loading');
            window.location = '". $this->createUrl('exportFile')  . "';
        },
        data: $('.search-form form').serialize() + '&export=true'
    });
};
*/
/*
$('#exportAll-button').on('click',function() {
    $('.exportDate').toggle();
    return false;
});
*/

$('#exportAll-button').on('click',function() {
	$.fn.yiiGridView.exportAll();
});
$.fn.yiiGridView.exportAll = function() {
	$.fn.yiiGridView.update('video-stats-grid',{ 
        success: function() {
            $('#video-stats-grid').removeClass('grid-view-loading');
            window.location = '". $this->createUrl('exportFile')  . "';
        },
        data:  $('.search-form form').serialize()+'&exportAll=true'
    });
}");
/*
$.fn.yiiGridView.exportAll = function() {
	$.fn.yiiGridView.update('video-stats-grid',{ 
        success: function() {
            $('#video-stats-grid').removeClass('grid-view-loading');
            window.location = '". $this->createUrl('exportFile')  . "';
        },
        data: 'exportAll=true'
    });
}
*/
?>