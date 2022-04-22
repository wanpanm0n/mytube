<style>
.k-grid tbody .k-button{min-width:10px;}
</style>
<div class="row">
	<div class="col-lg-12">
    	<h2 class="page-header">Active Customers</h2>
		
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
  <label for="usr">Frequency Type:</label>
  <select class="form-control" data-bind="options: [{id : 1 , name : 'Daily'},{id : 2 , name : 'Hourly'}], value:interval_type,optionsText: 'name', optionsValue: 'id'" >

  </select>
</div>
</div>

<div class="col-md-3">
  <div class="form-group">
  <label for="usr">Type:</label>
  <select class="form-control" data-bind="options: [{id : 1 , name : 'Summary'},{id : 2 , name : 'Detail'}], value:report_type,optionsText: 'name', optionsValue: 'id'" >

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

<div class="col-md-3" >
  <div class="form-group">
  <label for="usr">To Date:</label>
<input type ="text" data-bind="value:to_date"  class="form-control" id="to_date"/>
<span class="validationMessage" data-bind="validationMessage: to_date"></span>
</div>
</div>


</div>  

<div class="row hide"  data-bind="css:{hide : !(interval_type() == 2 && report_type() == 2)}">
<div class="col-md-3">
  <div class="form-group">
  <label for="usr">Start Time:</label>
<input type ="text" data-bind="value:from_time" class="form-control" id="from_time"/>
<span class="validationMessage" data-bind="validationMessage: from_time"></span>
</div>
</div>

<div class="col-md-3">
  <div class="form-group">
  <label for="usr">End Time:</label>
<input type ="text" data-bind="value:to_time"  class="form-control" id="to_time"/>
<span class="validationMessage" data-bind="validationMessage: to_time"></span>
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
            <button data-bind="click:Download,css:{hide : recordsDaySummary().length == 0 && recordsHourSummary().length == 0 && recordsDayDetail().length == 0 && recordsHourDetail().length == 0}" class="btn btn-primary hide" type="button" >Download</button>
            </div>


            <div class="hide" data-bind="css:{hide : recordsDaySummary().length == 0}" id="DaySummary">
            <table class="table table-bordered" border="1">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Date</th>
                        <th>Unique Subscriber</th>
                        <th>Total Txn</th>
                        </tr>
                </thead>
                <tbody data-bind="foreach: recordsDaySummary">
                    <tr>
                        <td data-bind="text : ($index()+1)"></td>
                         <td data-bind="text : Date"></td>
                          <td data-bind="text :  Unique_user"></td>
                          <td data-bind="text :  Total_Txn"></td>
                    </tr>
                </tbody>
            </table>
            </div>

        <div class="hide" data-bind="css:{hide : recordsHourSummary().length == 0}" id="HourSummary">
            <table class="table table-bordered" border="1">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Time</th>
                        <th>Unique Subscribers</th>
                        <th>Total Txn</th>
                        </tr>
                </thead>
                <tbody data-bind="foreach: recordsHourSummary">
                    <tr>
                        <td data-bind="text : ($index()+1)"></td>
                         <td data-bind="text : frequency"></td>
                          <td data-bind="text :  unique_user"></td>
                          <td data-bind="text :  Total_Txn"></td>
                    </tr>
                </tbody>
            </table>
            </div>

           

             <div class="hide" data-bind="css:{hide : recordsDayDetail().length == 0}" id="DayDetail">
            <table class="table table-bordered" border="1">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Customer</th>
                        <th>Mobile No.</th>
                     
                        <th>Date</th>
                        </tr>
                </thead>
                <tbody data-bind="foreach: recordsDayDetail">
                    <tr>
                        <td data-bind="text : ($index()+1)"></td>
                         <td data-bind="text : customer_name"></td>
                         <td data-bind="text : mobile_no"></td>                  
                           <td data-bind="text :  created_date"></td>
                    </tr>
                </tbody>
            </table>
            </div>



              <div class="hide" data-bind="css:{hide : recordsHourDetail().length == 0}" id="HourDetail">
            <table class="table table-bordered" border="1">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Customer</th>
                        <th>Mobile No.</th>
                     
                        <th>Date</th>
                        </tr>
                </thead>
                <tbody data-bind="foreach: recordsHourDetail">
                    <tr>
                        <td data-bind="text : ($index()+1)"></td>
                         <td data-bind="text : customer_name"></td>
                         <td data-bind="text : mobile_no"></td>                  
                           <td data-bind="text :  created_date"></td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/assets/4b6d66a3/jui/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/js/jquery-ui-timepicker-addon.js"></script>
<script>

	$(function(){

        jQuery('#from_date').datepicker({'showAnim':'fold','dateFormat':'yy-mm-dd'});
jQuery('#to_date').datepicker({'showAnim':'fold','dateFormat':'yy-mm-dd'});
$('#from_time').timepicker();
$('#to_time').timepicker();

        var vModel = function(){

            

            var self = this;

             self.report_type = ko.observable('');
              self.interval_type = ko.observable('');

                  var currentDate =  moment(new Date()).format('YYYY-MM-DD');
           
            self.from_date = ko.observable(currentDate).extend({ dateFormat : true, required : { message : "From date is required"}});
            self.to_date = ko.observable(currentDate).extend({dateFormat : true, required : {         message : "To date is required",
     
                }});

             self.from_time = ko.observable('').extend({ timeFormat : true,required : { 
                 message : "From time is required",
                  onlyIf: function() {
           return self.interval_type() == 2 && self.report_type() == 2;
        }
                }});
            self.to_time = ko.observable('').extend({ timeFormat : true,required : { 
                 message : "To time is required",
                  onlyIf: function() {
            return self.interval_type() == 2 && self.report_type() == 2;
        }
                }});


              self.isModelValid = function () {

                     self.errors = ko.validation.group(self); 
     
                if (self.errors().length>0) {

                self.errors.showAllMessages();
                return false;
                }     
                return true;
                };   


                   self.Download = function () {

                    var header  ="",body="",
                 reportType = (self.report_type() == "1" ? "Summary" :  "Detail"),feature = (self.interval_type() == "1" ? "Daily" : "Hourly");



                if(self.report_type() == "1" && self.interval_type() == "1"){
                    fileName = "day_summary";
                    body = $("#DaySummary").html();
                }  
                else if(self.report_type() == "2" && self.interval_type() == "1"){

                   fileName = "day_detail";
                    body = $("#DayDetail").html();
                }  
               else if(self.report_type() == "1" && self.interval_type() == "2"){

                  fileName = "hour_summary";
                  body = $("#HourSummary").html();
                    
                }
                else{
                  fileName = "hour_detail";
                  body = $("#HourDetail").html();
                }


                header ="<table><tr><td >Report Type</td><td>"+reportType+"</td><td>Frequency Type</td><td>"+feature+"</td></tr><tr><td>From Date</td><td>"+self.from_date()+"</td><td>To Date</td><td>"+self.to_date()+"</td></tr>"
                
                if(self.interval_type() == "2")
                    header+="<tr><td>Start Time</td><td>"+self.from_time()+"</td><td>End Time</td><td>"+self.to_time()+"</td></tr>"


                
                header +="<tr><td colspan='4'></td></tr></table>"
                
                var content = header + body;
           

                $("<form/>", { method: "post", action: '/report/exportexcel' }).append(
                $("<input/>", { type: "hidden", value: content, name: "Content" })).append(
                $("<input/>", { type: "hidden", value: fileName, name: "FileName" })).append(
                $("<input/>", { type: "hidden", value: '<?=Yii::$app->request->csrfToken?>', name: "_csrf" })).appendTo("body").submit().remove();


            };


           

            self.interval_type.subscribe(function(value){
            
            if(value != 2){
                self.from_time('')
                self.to_time('')
              }
    
})

           
            self.recordsDaySummary = ko.observableArray([]);
            self.recordsDayDetail = ko.observableArray([]);

            self.recordsHourSummary = ko.observableArray([]);
            self.recordsHourDetail = ko.observableArray([]);

            self.reset = function(){

                self.recordsDaySummary([]);
                self.recordsDayDetail([]);
                self.recordsHourSummary([]);
                self.recordsHourDetail([]);
            }

            self.search = function(){
self.reset();
                 if(self.isModelValid()){


                     var url = self.interval_type() == 1 ? "/report/getactivecustomerbyday" : "/report/getactivecustomerbyhour",
                     data = {              
                report_type : self.report_type(),
                from_date : self.from_date(),
                to_date: self.to_date()
            };


            if(self.interval_type() == 2){
                $.extend(data,{

                    from_time : self.from_time(),
                    to_time: self.to_time()


                 })
            }

                $.ajax({url : url ,method : "POST",   data : data,
            beforeSend: function (xhr) {
                xhr.setRequestHeader('_csrf', '<?=Yii::$app->request->csrfToken?>');
            }}).then(function(response){


                 if(self.interval_type() == 1){

                         if(self.report_type() == 1){

                    self.recordsDaySummary(response);
                }
                else{self.recordsDayDetail(response);}

                 }
                 else{

                     if(self.report_type() == 1){

                    self.recordsHourSummary(response);
                }
                else{self.recordsHourDetail(response);}
                 }


                 	if(response.length == 0){
                		$.toaster('No records.', 'Information');
                	}




               
                
            }); 

                 }

                    

              


            }
        }

 ko.applyBindings(vModel, $('#searchViewModel').get(0));

  		 


	})
</script>