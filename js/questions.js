$(document).ready(function () {
	var questionsRecords = $('#questionsListing').DataTable({
		"lengthChange": false,
		"processing": true,
		"serverSide": true,
		"bFilter": false,
		'serverMethod': 'post',
		"order": [],
		"ajax": {
			url: "../questions_action.php",
			type: "POST",
			data: { action: 'listQuestions', 'exam_id': $('#questionsListing').attr('data-exam-id') },
			dataType: "json"
		},
		"columnDefs": [
			{
				"targets": [0, 3, 4],
				"orderable": false,
			},
		],
		"pageLength": 10
	});

	$('#addQuestions').click(function () {
		$('#questionsModal').modal({
			backdrop: 'static',
			keyboard: false
		});
		$("#questionsModal").on("shown.bs.modal", function () {
			$('#questionsForm')[0].reset();
			$('.modal-title').html("<i class='fa fa-plus'></i> Add Questions");
			$('#exam_id').val($('#questionsListing').attr('data-exam-id'));
			$('#action').val('addQuestions');
			$('#save').val('Save');
		});
	});

	$("#questionsListing").on('click', '.update', function () {
		var id = $(this).attr("id");
		var action = 'getQuestion';
		$.ajax({
			url: '../questions_action.php',
			method: "POST",
			data: { question_id: id, action: action },
			dataType: "json",
			success: function (respData) {
				$("#questionsModal").on("shown.bs.modal", function () {
					$('#questionsForm')[0].reset();
					respData.data.forEach(function (item) {
						$('#id').val(item['question_id']);
						$('#exam_id').val($('#questionsListing').attr('data-exam-id'));
						$('#question_title').val(item['question']);
						$('#option_title_' + item['option']).val(item['title']);
						$('#answer_option').val(item['answer']);
					});
					$('.modal-title').html("<i class='fa fa-plus'></i> Edit questions");
					$('#action').val('updateQuestions');
					$('#save').val('Save');
				}).modal({
					backdrop: 'static',
					keyboard: false
				});
			}
		});
	});

	$("#questionsModal").on('submit', '#questionsForm', function (event) {
		event.preventDefault();
		$('#save').attr('disabled', 'disabled');
		var formData = $(this).serialize();
		$.ajax({
			url: "../questions_action.php",
			method: "POST",
			data: formData,
			success: function (data) {
				$('#questionsForm')[0].reset();
				$('#questionsModal').modal('hide');
				$('#save').attr('disabled', false);
				questionsRecords.ajax.reload();
			}
		})
	});

	$("#questionsListing").on('click', '.delete', function () {
		var id = $(this).attr("id");
		var action = "deleteQuestions";
		if (confirm("Are you sure you want to delete this Question?")) {
			$.ajax({
				url: "../questions_action.php",
				method: "POST",
				data: { id: id, action: action },
				success: function (data) {
					questionsRecords.ajax.reload();
				}
			})
		} else {
			return false;
		}
	});
});