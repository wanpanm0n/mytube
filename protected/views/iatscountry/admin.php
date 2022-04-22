<div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Manage Internet Service</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="col-md-12"><a href="/internetservice/create" class="btn btn-default"> Add</a></div>
<div class="col-md-12">

<!-- <p> -->
<!-- You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> -->
<!-- or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done. -->
<!-- </p> -->

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
 <?php
 //$this->renderPartial('_search',array(
// 	'model'=>$model,
// ));
 		?>
</div><!-- search-form -->
<div id="statusMsg">
	<?php if(Yii::app()->user->hasFlash('delete_failed')): ?>
		<div class="alert alert-danger">
		    <?php echo Yii::app()->user->getFlash('delete_failed'); ?>
		</div>
	<?php endif; ?>
</div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'content-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'afterAjaxUpdate' => 'reinstallDatePicker',
	//'itemsCssClass' => 'table table-bordered table-stripped',
	'columns'=>array(
		//'id',
		//'title',
			array(
					'name' => 'name',
					'type'=>'raw',
					'value' => 'CHtml::link(UHtml::markSearch($data,"name"),array("internetservice/view","id"=>$data->id))',
			),

// 			array(
// 					'header' => 'Title (Unicode)',
// 					'type'=>'html',
// 					'value' => 'CHtml::link($data->title_unicode,array("content/view","id"=>$data->id))',
// 			),
			array(
					'name' => 'code',
					//'filter'=>'',
					//'type'=>'raw',
					'value'=>'$data->code'
),			array(
					'name' => 'price',
					//'filter'=>'',
					//'type'=>'raw',
					'value'=>'$data->price'
),


		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}{delete}',
			'htmlOptions'=>array('class'=>'col-md-2', 'style'=>'text-align:center'),
			'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',
			   'buttons'=>array
    (
        'delete' => array
        (
            'label'=>'Send an e-mail to this user',
            'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',
            'click'=>"function(){
                                    $.fn.yiiGridView.update('user-grid', {
                                        type:'POST',
                                        url:$(this).attr('href'),
                                        success:function(data) {
                                              $('#AjFlash').html(data).fadeIn().animate({opacity: 1.0}, 3000).fadeOut('slow');

                                              $.fn.yiiGridView.update('user-grid');
                                        }
                                    })
                                    return false;
                              }
                     ",
            'url'=>'Yii::app()->controller->createUrl("email",array("id"=>$data->primaryKey))',
        ),
    )
		),
	),
)); ?>
</div>

<?php
// $this->widget('zii.widgets.CMenu', array(
// 		'items'=>array(
// 	array('label'=>'List Content', 'url'=>array('index')),
// 	array('label'=>'Create Content', 'url'=>array('create')),
// )));


?>

 <script>
         var myUrl = "http://stream.mtradeasia.com/internetservice/delete/";

		 $(function(){

			 $(".delete").off().on("click",function(){

				$.ajax({
					type : "POST",
					url : myUrl,
					data: {id : 31,_csrf:'<?=Yii::app()->request->csrfToken?>'},
					success  : function(response) {
					alert("Table is editted");
				}
				});
			 })
		 })


		 </script>
</div>
