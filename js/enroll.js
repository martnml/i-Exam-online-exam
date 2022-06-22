$(document).ready(function(){	
	var userRecords = $('#examEnrollListing').DataTable({
		"lengthChange": false,
		"processing":true,
		"serverSide":true,		
		"bFilter": false,
		'serverMethod': 'post',		
		"order":[],
		"ajax":{
			url:"exam_action.php",
			type:"POST",
			data:{action:'getExamEnroll', 'exam_id':$('#examEnrollListing').attr('data-exam-id')},
			dataType:"json"
		},
		"columnDefs":[
			{
				"targets":[0],
				"orderable":false,
			},
		],
		"pageLength": 10
	});	
	
	$(document).on('click', '.view', function(){
		var id = $(this).attr("id");
		var action = 'getUser';
		$.ajax({
			url:'users_action.php',
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",
			success:function(respData){				
				$("#userDetails").on("shown.bs.modal", function () {
					var resultHTML = '';
					respData.data.forEach(function(item){						
						resultHTML +="<tr>";
						for (var i = 0; i < item.length; i++) {							 
							 resultHTML +="<td>"+item[i]+"</td>";
						}
						resultHTML +="</tr>";
					});					
					$('#userList').html(resultHTML);											
				}).modal();			
			}
		});
	});
});