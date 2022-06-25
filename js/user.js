
$(document).ready(function (user) {
	var page = $("#page").val();
	var userRecords = $('#userListing').DataTable({
		"lengthChange": false,
		"processing": true,
		"serverSide": true,
		"bFilter": false,
		'serverMethod': 'post',
		"order": [],
		"ajax": {
			url: "../users_action.php",
			type: "POST",
			data: { user: user, action: 'listUsers' },
			dataType: "json"
		},
		"columnDefs": [
			{
				// "targets":[0, 6,7],
				"orderable": false,
			},
		],
		"pageLength": 10
	});

	$(document).on('click', '.view', function () {
		var id = $(this).attr("id");
		var action = 'getUser';
		$.ajax({
			url: '../users_action.php',
			method: "POST",
			data: { id: id, action: action },
			dataType: "json",
			success: function (respData) {
				$("#userDetails").on("shown.bs.modal", function () {
					var resultHTML = '';
					respData.data.forEach(function (item) {
						resultHTML += "<tr>";
						for (var i = 0; i < item.length; i++) {
							resultHTML += "<td>" + item[i] + "</td>";
						}
						resultHTML += "</tr>";
					});
					$('#userList').html(resultHTML);
				}).modal();
			}
		});
	});

	$('#addUser').click(function () {
		$('#userModal').modal('show');
		$('#userForm')[0].reset();
		$('.modal-title').html("<i class='fa fa-plus'></i> Add User");
		$('#action').val('addUser');
		$('#save').val('Save');
	});


	$(document).on('click', '.update', function () {
		var userId = $(this).attr("id");
		var action = 'getUserDetails';
		$.ajax({
			url: '../users_action.php',
			method: "POST",
			data: { userId: userId, action: action },
			dataType: "json",
			success: function (data) {
				$('#userModal').modal('show');
				$('#userId').val(data.id);
				// $('#firstName').val(data.first_name);
				// $('#lastName').val(data.last_name);
				$('#email').val(data.email);
				$('#address').val(data.address);
				$('#mobile').val(data.mobile);
				$('#created').val(data.created);
				// $('#role').val(data.role);
				// $('#gender').val(data.gender);
				// $('#1st_specility').val(data.name_specility);
				$('.modal-title').html("<i class='fa fa-plus'></i> Edit User");
				$('#action').val('updateUser');
				$('#save').val('Save');
			}
		})
	});

	$(document).on('submit', '#userForm', function (event) {
		event.preventDefault();
		$('#save').attr('disabled', 'disabled');
		var formData = $(this).serialize();
		$.ajax({
			url: "../users_action.php",
			method: "POST",
			data: formData,
			success: function (data) {
				$('#userForm')[0].reset();
				$('#userModal').modal('hide');
				$('#save').attr('disabled', false);
				userRecords.ajax.reload();
			}
		})
	});

	$(document).on('click', '.delete', function () {
		var userId = $(this).attr("id");
		var action = "deleteUser";
		if (confirm("Are you sure you want to delete this student?")) {
			$.ajax({
				url: "../users_action.php",
				method: "POST",
				data: { userId: userId, action: action },
				success: function (data) {
					userRecords.ajax.reload();
				}
			})
		} else {
			return false;
		}
	});
});





