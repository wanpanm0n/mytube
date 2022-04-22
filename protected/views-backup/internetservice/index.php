<style>
.k-grid tbody .k-button{min-width:10px;}
</style>
<div class="row">
	<div class="col-lg-12">
    	<h2 class="page-header">Internet Service</h2>
		<a href="/internetservice/create" class="btn btn-default">Add</a>
    </div>
</div>
<div class="row" style="margin-top:15px;">

<div class="col-md-12">
	<div class="kendo-grid" id="kendoGrid"></div>
</div>


</div>

<script>

	$(function(){

		var kendoGrid = null;

		

		$.ajax({url : "/internetservice/select",method : "POST",   
		beforeSend: function (xhr) {
                              xhr.setRequestHeader('_csrf', '<?=Yii::$app->request->csrfToken?>');
                          }}).then(function(response){

							 kendoGrid = $("#kendoGrid").kendoGrid({ 
                        dataSource: {
                            data: response, 
                            schema: {
                                model: {
                                    fields: {
                                        Name: { type: "string" },
                                        Detail: { type: "string" },
                                      
                                        IsActive: { type: "boolean" }
                                    }
                                }
                            },
                            pageSize: 20
                        },
                      
                        scrollable: true,
                        sortable: true,
                        filterable: true,
                        pageable: {
                            input: true,
                            numeric: false
                        },
                        columns: [
                            { field: "Name", title: "Name" },
                            { field: "Detail", title: "Detail"},
                       
                            { field: "IsActive", width: "130px" ,template:function(data){ return data.IsActive ? "Yes" : "No"}},
							{ width: "130px", 
							
							command: [
								{ name: "editAction" ,text: "", click :searchRow , className : "fa fa-search"  },
							{ name : "delete",text: "", click : deleteRow , className : "fa fa-remove text-danger" }]}
                        ]
                    }).data("kendoGrid");

					function searchRow(e){ 
							e.preventDefault();
							var tr = $(e.target).closest("tr");
								var item = kendoGrid.dataItem($(e.target).closest("tr"));
						window.location.href="/internetservice/update/id/"+item.Id;
						}

					function deleteRow(e){





						e.preventDefault();

						bootbox.confirm("Are you sure want to delete?",function(r){

							if(r){

								var tr = $(e.target).closest("tr");
								var item = kendoGrid.dataItem($(e.target).closest("tr"));
							
								 $.ajax({url : "/internetservice/delete", method : "POST", data : {
								 '_csrf' : '<?=Yii::$app->request->csrfToken?>', Id : item.Id}}).then(function(response){

										if(response.success){
											bootbox.alert("Deleted successfully.");							

											kendoGrid.removeRow(tr);
										}
								 })
								//
							}	

						})

					}



		})


		 


	})
</script>