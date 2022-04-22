<style>
.k-grid tbody .k-button{min-width:10px;}
</style>
<div class="row">
	<div class="col-lg-12">
    	<h2 class="page-header">IATS</h2>
		<a href="/iatscountry/create" class="btn btn-default">Add</a>
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



		$.ajax({url : "/iatscountry/select",method : "POST",
		beforeSend: function (xhr) {
                              xhr.setRequestHeader('_csrf', '<?=Yii::app()->request->csrfToken?>');
                          }}).then(function(response){

							 kendoGrid = $("#kendoGrid").kendoGrid({
                        dataSource: {
                            data: response,
                            schema: {
                                model: {
                                    fields: {
                                        Name: { type: "string" },
                                        Amount: { type: "string" },
                                        Country: { type: "string" },

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
                            { field: "Amount", title: "Detail"},

                            { field: "Country", width: "130px"},
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
						window.location.href="/iatscountry/update/id/"+item.Id;
						}

					function deleteRow(e){





						e.preventDefault();

						bootbox.confirm("Are you sure want to delete?",function(r){

							if(r){

								var tr = $(e.target).closest("tr");
								var item = kendoGrid.dataItem($(e.target).closest("tr"));

								 $.ajax({url : "/iatscountry/delete", method : "POST", data : {
								 '_csrf' : '<?=Yii::app()->request->csrfToken?>', Id : item.Id}}).then(function(response){

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