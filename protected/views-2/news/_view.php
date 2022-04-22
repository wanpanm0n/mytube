  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <a href="<?php echo Yii::app()->request->baseUrl.'/news/view/id/'.CHtml::encode($data->id); ?>">
      	<img src="<?php echo $this->imageNewsPath().CHtml::encode($data->image); ?>" alt="..." style="min-height:171px;height:171px;">
      </a>
      <div class="caption" style="text-align: center">
      	<p><a href="<?php echo Yii::app()->request->baseUrl.'/news/view/id/'.CHtml::encode($data->id); ?>"><?php echo CHtml::encode($data->title); ?></p></a>
      	<p><a href="<?php echo Yii::app()->request->baseUrl.'/news/view/id/'.CHtml::encode($data->id); ?>"><?php echo CHtml::encode($data->title_unicode); ?></p></a>
      </div>
    </div>
  </div>