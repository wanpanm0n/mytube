<style>
.k-grid tbody .k-button{min-width:10px;}
</style>
<div class="row">
	<div class="col-lg-12">
    	<h2 class="page-header">Push Notification</h2>
		<a href="/pushnotification/create" class="btn btn-default">Add</a>
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



		$.ajax({url : "/pushnotification/select",method : "POST",
		beforeSend: function (xhr) {
                              xhr.setRequestHeader('_csrf', '<?=Yii::app()->request->csrfToken?>');
                          }}).then(function(response){

							 kendoGrid = $("#kendoGrid").kendoGrid({
                        dataSource: {
                            data: response,
                            schema: {
                                model: {
                                    fields: {
                                        Message: { type: "string" },

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
							{ field: "Title", title: "Title" },
                            { field: "Message", title: "Message" },
                            { field: "CreatedDate", title: "Created Date"},

							{ width: "130px",

							command: [
								{ name: "editAction" ,text: "", click :searchRow , className : "fa fa-search"  },

							{ name : "delete",text: "", click : deleteRow , className : "fa fa-remove text-danger" },
								{ name: "sendNotificationAction" ,text: "", click :pushNotification , className : "fa fa-bell"  },]}
                        ]
                    }).data("kendoGrid");

					function searchRow(e){
							e.preventDefault();
							var tr = $(e.target).closest("tr");
								var item = kendoGrid.dataItem($(e.target).closest("tr"));
						window.location.href="/pushnotification/update/id/"+item.Id;
						}


					function pushNotification(e) {
					e.preventDefault();

					bootbox.confirm("Are you sure want to send the push notification?",function(r){

						if(r){

								var tr = $(e.target).closest("tr");
								var item = kendoGrid.dataItem($(e.target).closest("tr"));

								 $.ajax({url : "/pushnotification/send", method : "POST",dataType :"json", data : {
								 '_csrf' : '<?=Yii::app()->request->csrfToken?>', Id : item.Id}}).then(function(response){
									$message = response.success != 0 ? "Send successfully.": "Please retry again.";
									 bootbox.alert($message);

								 })

							}

					});

					}
					function deleteRow(e){





						e.preventDefault();

						bootbox.confirm("Are you sure want to delete?",function(r){

							if(r){

								var tr = $(e.target).closest("tr");
								var item = kendoGrid.dataItem($(e.target).closest("tr"));

								 $.ajax({url : "/pushnotification/delete", method : "POST",  data : {
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