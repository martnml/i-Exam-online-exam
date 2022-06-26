$(document).ready(function () {
	var examRecords = $('#examListing').DataTable({
		"lengthChange": false,
		"processing": true,
		"serverSide": true,
		"bFilter": false,
		'serverMethod': 'post',
		"order": [],
		"ajax": {
			url: "../exam_action.php",
			type: "POST",
			data: { action: 'listExam' },
			dataType: "json"
		},
		"columnDefs": [
			{
				// "targets": [0, 1, 2, 3],
				"orderable": false,
			},
		],
		"pageLength": 10
	});

	$('#addExam').click(function () {
		$('#examModal').modal({
			backdrop: 'static',
			keyboard: false
		});
		$('#examForm')[0].reset();
		$("#examModal").on("shown.bs.modal", function () {
			$('.modal-title').html("<i class='fa fa-plus'></i> Add Exam");
			$('#action').val('addExam');
			$('#save').val('Save');
		});
	});

	$("#examListing").on('click', '.update', function () {
		var id = $(this).attr("id");
		var action = 'getExam';
		
		$.ajax({
			url: '../exam_action.php',
			method: "POST",
			data: { id: id, action: action },
			dataType: "json",
			success: function (data) {
				$("#examModal").on("shown.bs.modal", function () {
					$('#id').val(data.id);
					$('#exam_title').val(data.exam_title);
					$('#exam_title').val(data.exam_title);
					$('#id_specility').val(data.id_specility);
					$('#exam_duration').val(data.duration);
					$('#endtime').val(data.endtime);
					$('#total_question').val(data.total_question);
					
					$('#marks_right_answer').val(data.marks_per_right_answer);
					$('#marks_wrong_answer').val(data.marks_per_wrong_answer);
					$('#status').val(data.status);
					$('.modal-title').html("<i class='fa fa-plus'></i> Edit Exam");
					$('#action').val('updateExam');
					$('#save').val('Save');
				}).modal({
					backdrop: 'static',
					keyboard: false
				});
			}
		});
	});

	$("#examModal").on('submit', '#examForm', function (event) {
		event.preventDefault();
		$('#save').attr('disabled', 'disabled');
		var formData = $(this).serialize();
		$.ajax({
			url: "../exam_action.php",
			method: "POST",
			data: formData,
			success: function (data) {
				$('#examForm')[0].reset();
				$('#examModal').modal('hide');
				$('#save').attr('disabled', false);
				examRecords.ajax.reload();
			}
		})
	});

	$("#examListing").on('click', '.delete', function () {
		var id = $(this).attr("id");
		var action = "deleteExam";
		if (confirm("Are you sure you want to delete this Exam?")) {
			$.ajax({
				url: "../exam_action.php",
				method: "POST",
				data: { id: id, action: action },
				success: function (data) {
					examRecords.ajax.reload();
				}
			})
		} else {
			return false;
		}
	});

	$(document).on('click', '.view', function () {
		var id = $(this).attr("id");
		var action = 'getTasks';
		$.ajax({
			url: '../exam_action.php',
			method: "POST",
			data: { id: id, action: action },
			dataType: "json",
			success: function (respData) {
				$("#tasksDetails").on("shown.bs.modal", function () {
					var resultHTML = '';
					respData.data.forEach(function (item) {
						resultHTML += "<tr>";
						for (var i = 0; i < item.length; i++) {
							resultHTML += "<td>" + item[i] + "</td>";
						}
						resultHTML += "</tr>";
					});
					$('#tasksList').html(resultHTML);
				}).modal();
			}
		});
	});

});