<style>
.k-grid tbody .k-button{min-width:10px;}
</style>
<div class="row">
	<div class="col-lg-12">
    	<h2 class="page-header">Customer By Browsing Preference</h2>

    </div>
</div>
<div id="searchViewModel">
<div class="panel panel-default">
        <div class="panel-heading">
            Filter
        </div>

        <div class="panel-body">

<div class="row" >

<div class="col-md-3">
  <div class="form-group">
  <label for="usr">Type:</label>
  <select class="form-control" data-bind="options: [{id : 1 , name : 'Summary'},{id : 2 , name : 'Detail'}], value:report_type,optionsText: 'name', optionsValue: 'id'" >

  </select>
</div>
</div>

<div class="col-md-3" data-bind="css:{hide : report_type() == 1}">
  <div class="form-group">
  <label for="usr">Feature:</label>
 <script>

 var _actions =<?php echo $browingActions;?>;
 </script>



  <select class="form-control" data-bind="options: _actions, value:service_id,optionsText: 'name', optionsValue: 'id',optionCaption : 'Select Feature'" >

  </select>
</div>
</div>


<div class="col-md-3">
  <div class="form-group">
  <label for="usr">From Date:</label>
<input type ="text" data-bind="value:from_date" class="form-control" id="from_date"/>
<span class="validationMessage" data-bind="validationMessage: from_date"></span>
</div>
</div>

<div class="col-md-3">
  <div class="form-group">
  <label for="usr">To Date:</label>
<input type ="text" data-bind="value:to_date"  class="form-control" id="to_date"/>
<span class="validationMessage" data-bind="validationMessage: to_date"></span>
</div>
</div>


</div>
<div class="row" >

<div class="col-md-4">
  <div>

  <button data-bind="click : search" id="viewReport" class="btn btn-primary" type="button"><i class="fa fa-search"></i> View</button>
</div>
</div>


</div>
        </div>
    </div>

    <div class="row ">
        <div class="col-md-12">
            <div style="margin-bottom:15px" >
            <button data-bind="click:Download,css:{hide : recordsSummary().length == 0 && recordsDetail().length == 0}" class="btn btn-primary hide" type="button" >Download</button>
            </div>
            <div class="hide" data-bind="css:{hide : recordsSummary().length == 0}" id="Browsing_Preference_Summary">
            <table class="table table-bordered" border="1">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Date</th>
                        <th>Unique Subscribers</th>
                        <th>Promotion</th>
                        <th>News</th>
                        <th>Video</th>
                        <th>Total Txn</th>

                        </tr>
                </thead>
                <tbody data-bind="foreach: recordsSummary">
                    <tr>
                        <td data-bind="text : ($index()+1)"></td>
                         <td data-bind="text : Date"></td>
                          <td data-bind="text :  unique_user"></td>
                          <td data-bind="text :  Promotion"></td>
                          <td data-bind="text :  News"></td>
                          <td data-bind="text :  Video"></td>
                          <td data-bind="text :  Total_txn"></td>
                    </tr>
                </tbody>
            </table>
            </div>

             <div class="hide" data-bind="css:{hide : recordsDetail().length == 0}" id="Browsing_Preference_Detail">
            <table class="table table-bordered" border="1">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Customer</th>
                        <th>Mobile No.</th>
                        <th>Feature</th>
                        <th>Date</th>
                        </tr>
                </thead>
                <tbody data-bind="foreach: recordsDetail">
                    <tr>
                        <td data-bind="text : ($index()+1)"></td>
                         <td data-bind="text : customer_name"></td>
                         <td data-bind="text : mobile_no"></td>
                          <td data-bind="text :  service"></td>
                           <td data-bind="text :  created_date"></td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/assets/4b6d66a3/jui/js/jquery-ui.min.js"></script>
<script>

	$(function(){

        jQuery('#from_date').datepicker({'showAnim':'fold','dateFormat':'yy-mm-dd'});
jQuery('#to_date').datepicker({'showAnim':'fold','dateFormat':'yy-mm-dd'});


        var vModel = function(){



            var self = this;

    self.isModelValid = function () {

                     self.errors = ko.validation.group(self);

                if (self.errors().length>0) {

                self.errors.showAllMessages();
                return false;
                }
                return true;
                };


                  self.Download = function () {

                   var objFeature =  ko.utils.arrayFirst(_actions, function(item) {
                return item.id == self.service_id();
                });

                 var header  ="",body="",
                 reportType = (self.report_type() == "1" ? "Summary" :  "Detail"),feature =(objFeature.id == "" ? "All" :  objFeature.name);



                if(self.report_type() == "1"){
                    fileName = "browsing_preference_summary";
                    body = $("#Browsing_Preference_Summary").html();
                }
                else{
                     fileName = "browsing_preference_detail";
                    body = $("#Browsing_Preference_Detail").html();
                }


                header ="<table><tr><td >Report Type</td><td>"+reportType+"</td><td>Feature</td><td>"+feature+"</td></tr><tr><td>From Date</td><td>"+self.from_date()+"</td><td>To Date</td><td>"+self.to_date()+"</td></tr><tr><td colspan='4'></td></tr></table>"



                var content = header + body;



                $("<form/>", { method: "post", action: '/report/exportexcel' }).append(
                $("<input/>", { type: "hidden", value: content, name: "Content" })).append(
                $("<input/>", { type: "hidden", value: fileName, name: "FileName" })).append(
                $("<input/>", { type: "hidden", value: '<?=Yii::app()->request->csrfToken?>', name: "_csrf" })).appendTo("body").submit().remove();


            };


            self.service_id = ko.observable('');
            self.report_type = ko.observable('');
    var currentDate =  moment(new Date()).format('YYYY-MM-DD');
            self.from_date = ko.observable(currentDate).extend({dateFormat : true, required : { message : "From date is required"}});
            self.to_date = ko.observable(currentDate).extend({ dateFormat : true,required : { message : "To date is required"}});

            self.recordsSummary = ko.observableArray([]);
            self.recordsDetail = ko.observableArray([]);

            self.reset = function(){

                self.recordsSummary([]);
                self.recordsDetail([]);
            }

            self.search = function(){
self.reset();
                 if(self.isModelValid()){

                           $.ajax({url : "/report/getBrowsingpreference",method : "POST",   data : {

                service_id : self.service_id() ,
                report_type : self.report_type(),
                from_date : self.from_date(),
                to_date: self.to_date()
            },
            beforeSend: function (xhr) {
                xhr.setRequestHeader('_csrf', '<?=Yii::app()->request->csrfToken?>');
            }}).then(function(response){

                if(self.report_type() == 1){

                    self.recordsSummary(response);
                    if(response.length == 0){
                    $.toaster('No records.', 'Information');
                  }
                }
                else{self.recordsDetail(response);

if(response.length == 0){
                    $.toaster('No records.', 'Information');
                  }
                }

            });

                 }






            }
        }

 ko.applyBindings(vModel, $('#searchViewModel').get(0));




	})
</script>