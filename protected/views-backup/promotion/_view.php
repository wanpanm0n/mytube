  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <a href="<?php echo Yii::app()->request->baseUrl.'/promotion/view/id/'.CHtml::encode($data->id); ?>">
      	<img src="<?php echo $this->imagePromotionPath().'/'.CHtml::encode($data->image); ?>" alt="..." style="min-height:171px;height:171px;">
      </a>
      <div class="caption" style="text-align: center">
      	<p><a href="<?php echo Yii::app()->request->baseUrl.'/promotion/view/id/'.CHtml::encode($data->id); ?>"><?php echo CHtml::encode($data->company); ?></p></a>

      </div>
    </div>
  </div>