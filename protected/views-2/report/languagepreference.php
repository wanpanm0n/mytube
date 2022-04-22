<style>
.k-grid tbody .k-button{min-width:10px;}
</style>
<div class="row">
	<div class="col-lg-12">
    	<h2 class="page-header">Customer By Language Preference</h2>
		
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

<div class="col-md-3" data-bind="css:{hide :report_type() != 2 }">
  <div class="form-group">
  <label for="usr">Language:</label>

 <script>

 var _languages =<?php echo $languages;?>;
 </script>



  <select class="form-control" data-bind="options: _languages, value:language_id,optionsText: 'name', optionsValue: 'id',optionCaption : 'Select Language'" >

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

            <div class="hide" data-bind="css:{hide : recordsSummary().length == 0}" id="Language_Preference_Summary">
            <table class="table table-bordered" border="1">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Date</th>
                       
                        


                       <th> Nepali</th>
                       <th> Bangladeshi</th>
                       <th> Indian</th>
                       <th> Indonesian</th>
                       <th> Malaysian</th>
                       <th> Tamil</th>
                      <th>  English</th>
                      <th>Total</th>
                        </tr>
                </thead>
                <tbody data-bind="foreach: recordsSummary">
                    <tr>
                        <td data-bind="text : ($index()+1)"></td>
                         <td data-bind="text :  date"></td>
                         <td data-bind="text : Nepali"></td>
                          <td data-bind="text :  Bangladeshi"></td>
                           <td data-bind="text :  Indian"></td>
                            <td data-bind="text :  Indonesian"></td>
                             <td data-bind="text :  Malaysian"></td>
                              <td data-bind="text :  Tamil"></td>
                               <td data-bind="text :  English"></td>
                                <td data-bind="text :  Total"></td>
                    </tr>
                </tbody>
                <tfoot>
                           <tr>
                        <td ></td>
                        <td >Total</td>
                        <td data-bind="text : Nepali"></td>
                        <td data-bind="text :  Bangladeshi"></td>
                        <td data-bind="text :  Indian"></td>
                        <td data-bind="text :  Indonesian"></td>
                        <td data-bind="text :  Malaysian"></td>
                        <td data-bind="text :  Tamil"></td>
                        <td data-bind="text :  English"></td>
                        <td data-bind="text :  Total"></td>
                    </tr>
                </tfoot>
            </table>
            </div>

             <div class="hide" data-bind="css:{hide : recordsDetail().length == 0}" id="Language_Preference_Detail">
            <table class="table table-bordered" border="1">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Date</th>
                        <th>Customer</th>
                        <th>Mobile No.</th>
                        <th>Language</th>
                        </tr>
                </thead>
                <tbody data-bind="foreach: recordsDetail">
                    <tr>
                        <td data-bind="text : ($index()+1)"></td>
                        <td data-bind="text:created_date"></td>
                         <td data-bind="text : customer_name"></td>
                         <td data-bind="text : sim_no"></td>
                          <td data-bind="text :  prefered_language"></td>   
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
            self.language_id = ko.observable('');
            self.report_type = ko.observable('');
           var currentDate =  moment(new Date()).format('YYYY-MM-DD');
            self.from_date = ko.observable(currentDate).extend({dateFormat : true, required : { message : "From date is required"}});
            self.to_date = ko.observable(currentDate).extend({ dateFormat : true,required : { message : "To date is required"}}); 

            self.recordsSummary = ko.observableArray([]);
            self.recordsDetail = ko.observableArray([]);
            
            self.Nepali= ko.observable(0);
            self.Bangladeshi= ko.observable(0);
            self.Indian= ko.observable(0);	
            self.Indonesian= ko.observable(0);
            self.Malaysian= ko.observable(0);	
            self.Tamil= ko.observable(0);	
            self.English= ko.observable(0);
            self.Total= ko.observable(0);

            self.reset = function(){
                self.recordsSummary([]);
                self.recordsDetail([]);
                 self.Nepali(0);
            self.Bangladeshi(0);
            self.Indian(0);	
            self.Indonesian(0);
            self.Malaysian(0);	
            self.Tamil(0);	
            self.English(0);
            self.Total(0);
            }


              self.Download = function () {


              var objLanguage =  ko.utils.arrayFirst(_languages, function(item) {
                return item.id == self.language_id();
                });

                 var header  ="",body="",
                 reportType = (self.report_type() == "1" ? "Summary" :  "Detail"),language =(objLanguage.id == "" ? "All" :  objLanguage.name);


                if(self.report_type() == "1"){
                    fileName = "language_preference_summary";
                    body = $("#Language_Preference_Summary").html();
                }    
                else{
                     fileName = "language_preference_detail";
                    body = $("#Language_Preference_Detail").html();
                }
           

                
                header ="<table><tr><td >Report Type<td><td>"+reportType+"</td><td >Language<td><td>"+language+"</td></tr><tr><td>From Date<td><td>"+self.from_date()+"<td><td>To Date<td><td>"+self.to_date()+"<td></tr><tr><td colspan='4'></td></tr></table>"
                var content = header+body;
           

                $("<form/>", { method: "post", action: '/report/exportexcel' }).append(
                $("<input/>", { type: "hidden", value: content, name: "Content" })).append(
                $("<input/>", { type: "hidden", value: fileName, name: "FileName" })).append(
                $("<input/>", { type: "hidden", value: '<?=Yii::$app->request->csrfToken?>', name: "_csrf" })).appendTo("body").submit().remove();


            };

            
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

                           $.ajax({url : "/report/getlanguagepreference",method : "POST",   data : {

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
                     ko.utils.arrayForEach(response,function(item){

                        self.Nepali(self.Nepali() + parseInt(item.Nepali));
                        self.Bangladeshi(self.Bangladeshi() + parseInt(item.Bangladeshi));
                        self.Indian(self.Indian() + parseInt(item.Indian));	
                        self.Indonesian(self.Indonesian() + parseInt(item.Indonesian));
                        self.Malaysian(self.Malaysian() + parseInt(item.Malaysian));
                        self.Tamil(self.Tamil() + parseInt(item.Tamil));
                        self.English(self.English() + parseInt(item.English));
                        self.Total(self.Total() + parseInt(item.Total));


                  })
                    if(response.length == 0){
                    $.toaster('No records.', 'Information');
                  }
                }
                else{

                  self.recordsDetail(response);

                 

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