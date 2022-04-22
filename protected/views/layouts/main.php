<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Mtrading Mobile</title>
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arimo:400,700,400italic" id="style-resource-1">
          <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseurl; ?>/css/jquery-ui.css" />
           <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseurl; ?>/css/jquery-ui-timepicker-addon.css" />
           <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseurl; ?>/css/nprogress.css" />

    <link href="<?php echo Yii::app()->request->baseurl; ?>/css/sb-admin-2.css?v" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseurl; ?>/css/main.css?vew" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseurl; ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseurl; ?>/css/bootstrap-flat.min.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseurl; ?>/css/bootstrap-flat-extras.min.css" rel="stylesheet">
     <link href="<?php echo Yii::app()->request->baseurl; ?>/css/kendo/kendo.common.min.css" rel="stylesheet" />
    <link href="<?php echo Yii::app()->request->baseurl; ?>/css/kendo/kendo.default.min.css" rel="stylesheet" />
    <link href="<?php echo Yii::app()->request->baseurl; ?>/css/kendo/kendo.bootstrap.min.css" rel="stylesheet" />
    <!-- <link href="<?php //echo Yii::app()->request->baseurl; ?>/css/font-awesome.min.css" rel="stylesheet" type="text/css"> -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css?vs">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
   <!-- <script src="<?php //echo Yii::app()->request->baseurl; ?>/js/jquery.min.js"></script> -->
	<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
   <script src="<?php echo Yii::app()->request->baseurl; ?>/js/jquery.toaster.js"></script>
   <script src="<?php echo Yii::app()->request->baseurl; ?>/js/nprogress.js"></script>

   <script src="<?php echo Yii::app()->request->baseurl; ?>/js/moment.js"></script>

   <script src="<?php echo Yii::app()->request->baseurl; ?>/js/bootstrap.min.js"></script>
   <script src="<?php echo Yii::app()->request->baseurl; ?>/js/bootbox.min.js"></script>
   <script src="<?php echo Yii::app()->request->baseurl; ?>/js/kendo.all.min.js"></script>
     <script src="<?php echo Yii::app()->request->baseurl; ?>/js/knockout.js"></script>
     <script src="<?php echo Yii::app()->request->baseurl; ?>/js/knockout.validation.min.js"></script>
    <script>
        window.baseUrl = '<?php echo Yii::app()->request->baseurl; ?>';
        ko.validation.rules['dateFormat'] = {
        validator: function (val, validate) {
        return ko.validation.utils.isEmptyVal(val) || moment(val, 'YYYY-MM-DD',true).isValid();
        },
        message: 'Invalid date format (YYYY-MM-DD)'
        };

         ko.validation.rules['timeFormat'] = {
        validator: function (val, validate) {
            return ko.validation.utils.isEmptyVal(val) || moment(val, 'HH:mm',true).isValid();
        },
        message: 'Invalid time format (HH:mm)'
        };


        ko.validation.registerExtenders();

        var knockoutValidationSettings = {
            insertMessages: false,
            decorateElement: true,
            errorMessageClass: 'error',
            errorElementClass: 'error',
            errorClass: 'error',
            errorsAsTitle: true,
            parseInputAttributes: false,
            messagesOnModified: true,
            decorateElementOnModified: true,
            decorateInputElement: true,
            messageTemplate: 'errorMessageTemplate'
        };
        ko.validation.init(knockoutValidationSettings);


        $(document).ajaxStart(function () {
            NProgress.start();
        }).ajaxStop(function () {
            NProgress.done();
        }).ajaxError(function (xhr, data) {
            NProgress.done();
        });




    </script>

<script src="<?php echo Yii::app()->request->baseurl; ?>/js/knockout.mapping-latest.js"></script>
<script src="<?php echo Yii::app()->request->baseurl; ?>/js/knockout-external-template.js"></script>
<style>
.validationMessage{
        color: #de3a3a;
    font-style: italic;
    font-size: 12px;
}
.form-control.error{ border: 1px solid #d05f5f;}
</style>
</head>

<body>
    <div id="wrapper">
    <?php echo $content; ?>
    </div>

      <script type="text/html" id="errorMessageTemplate">
        <span class="custom-message-error" data-bind="if: field.isModified() && !field.isValid()">
            <i class="fa fa-warning" data-bind="tooltip:name,attr: { 'data-original-title': field.error }"></i>
        </span>
    </script>
    <style type="text/css">
        .custom-message-error {
            bottom: 4px;
            color: #f9d7d7;
            cursor: pointer;
            font-size: 16px;
            position: absolute;
            right: 20px;
            z-index: 1;
        }

        .form-group {
            position: relative;
        }
    </style>

    <!-- /#wrapper -->
    <!-- Bootstrap Core JavaScript -->


    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo Yii::app()->request->baseurl; ?>/js/metisMenu.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseurl; ?>/js/mtrademobile.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseurl; ?>/js/app.js"></script>

    <!-- Morris Charts JavaScript -->
<!--     <script src="../bower_components/raphael/raphael-min.js"></script> -->
<!--     <script src="../bower_components/morrisjs/morris.min.js"></script> -->
<!--     <script src="../js/morris-data.js"></script> -->

    <!-- Custom Theme JavaScript -->

</body>

</html>
