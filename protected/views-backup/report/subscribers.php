<style>
.k-grid tbody .k-button{min-width:10px;}
</style>
<div class="row">
	<div class="col-lg-12">
    	<h2 class="page-header">New Subscribers</h2>
		
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
            <div class="hide" data-bind="css:{hide : recordsSummary().length == 0}" id="Subscriblers_Summary">
            <table class="table table-bordered" border="1">
                <thead>
                    <tr>
                        <th>S.No</th>    
                        <th> Date</th>                   
                        <th>Total</th>
                        </tr>
                </thead>
                <tbody data-bind="foreach: recordsSummary">
                    <tr>
                        <td data-bind="text : ($index()+1)"></td>   
                        <td data-bind="text :  created_date"></td>                     
                          <td data-bind="text :  subscribers"></td>
                    </tr>
                </tbody>
                     <tfoot>
                    <tr>
                       
                        <td></td>
                        <td style="text-align:right;font_weight:bold">Total</td>
                        <td style="font_weight:bold" data-bind="text:total">

                        </td>
                    </tr>
                </tfoot>
            </table>
            </div>

             <div class="hide" data-bind="css:{hide : recordsDetail().length == 0}" id="Subscriblers_Detail">
            <table class="table table-bordered" border="1">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Date</th>
                        <th>Customer</th>
                        <th>Mobile No.</th>
                        
                        </tr>
                </thead>
                <tbody data-bind="foreach: recordsDetail">
                    <tr>
                        <td data-bind="text : ($index()+1)"></td>
                        <td data-bind="text : created_date"></td>     
                         <td data-bind="text : customer_name"></td>
                         <td data-bind="text : sim_no"></td>                        
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


            self.Download = function () {

                var header  ="",body="",reportType = (self.report_type() == "1" ? "Summary" :  "Detail");


           
                if(self.report_type() == "1"){
                    fileName = "subscribers_summary";
                    body = $("#Subscriblers_Summary").html();
                }    
                else{
                     fileName = "subscribers_detail";
                    body = $("#Subscriblers_Detail").html();
                }


                header ="<table><tr><td >Report Type<td><td colspan='3'>"+reportType+"</td></tr><tr><td>From Date<td><td>"+self.from_date()+"<td><td>To Date<td><td>"+self.to_date()+"<td></tr><tr><td colspan='4'></td></tr></table>"


                var content = header+body;
           

                $("<form/>", { method: "post", action: '/report/exportexcel' }).append(
                $("<input/>", { type: "hidden", value: content, name: "Content" })).append(
                $("<input/>", { type: "hidden", value: fileName, name: "FileName" })).append(
                $("<input/>", { type: "hidden", value: '<?=Yii::$app->request->csrfToken?>', name: "_csrf" })).appendTo("body").submit().remove();


            };

            var currentDate =  moment(new Date()).format('YYYY-MM-DD');
            self.from_date = ko.observable(currentDate).extend({dateFormat : true, required : { message : "From date is required"}});
            self.to_date = ko.observable(currentDate).extend({ dateFormat : true,required : { message : "To date is required"}}); 

            self.language_id = ko.observable('');
            self.report_type = ko.observable('');

            self.total = ko.observable(0);
            

            self.recordsSummary = ko.observableArray([]);
            self.recordsDetail = ko.observableArray([]);

            self.reset = function(){
                self.recordsSummary([]);
                self.recordsDetail([]);
            }     


                self.isModelValid = function () {

                     self.errors = ko.validation.group(self); 
     
                if (self.errors().length>0) {

                self.errors.showAllMessages();
                return false;
                }     
                return true;
                };     

            



            self.search = function(){
                self.reset();
                 if(self.isModelValid()){

                           $.ajax({url : "/report/getsubscribers",method : "POST",   data : {

                language_id : self.language_id() ,
                report_type : self.report_type(),
                from_date : self.from_date(),
                to_date: self.to_date()
            },
            beforeSend: function (xhr) {
                xhr.setRequestHeader('_csrf', '<?=Yii::$app->request->csrfToken?>');
            }}).then(function(response){

                if(self.report_type() == 1){

                    self.recordsSummary(response);
                }
                else{

                	if(response.length == 0){
                		$.toaster('No records.', 'Information');
                	}
                	self.recordsDetail(response);
                }

                var _total = 0;

                 ko.utils.arrayForEach(response, function (item) {
            _total += parseInt(item.subscribers);
        });

            self.total(_total);   
                
            }); 

                 }

                    

              


            }
        }

 ko.applyBindings(vModel, $('#searchViewModel').get(0));

  		 


	})
</script>