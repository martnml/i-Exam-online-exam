$(document).ready(function(){	
	$('#exam_list').change(function(){
		$('#exam_list').attr('required', 'required');		
		exam_id = $('#exam_list').val();
		$.ajax({
			url:"../user_exam_action.php",
			method:"POST",
			data:{action:'examDetails', page:'index', exam_id:exam_id},
			success:function(data){
				$('#exam_details').html(data);
			}
		});		
	});
	




	$(document).on('click', '#enrollExam', function(){
		var exam_id = $('#enrollExam').attr('data-exam_id');		
		$.ajax({
			url:"../user_exam_action.php",
			method:"POST",
			data:{action:'enrollExam', exam_id:exam_id},
			beforeSend:function() {
				$('#enrollExam').attr('disabled', 'disabled');
				$('#enrollExam').text('please wait');
			},
			success:function() {
				$('#enrollExam').attr('disabled', false);
				$('#enrollExam').removeClass('btn-warning');
				$('#enrollExam').addClass('btn-success');
				$('#enrollExam').text('Enroll success');
			}
		});
	});
	
	var examRecords = $('#userExamListing').DataTable({
		"lengthChange": false,
		"processing":true,
		"serverSide":true,		
		"bFilter": false,
		'serverMethod': 'post',		
		"order":[],
		"ajax":{
			url:"../user_exam_action.php",
			type:"POST",
			data:{action:'listUserExam'},
			dataType:"json"
		},
		"columnDefs":[
			{
				"targets":[0, 7],
				"orderable":false,
			},
		],
		"pageLength": 10
	});		
	
	if($("#examTimer").length) {
		console.log("timerrrr");
		$("#examTimer").TimeCircles({ 
			time:{
				Days:{
					show: false
				},
				Hours:{
					show: false
				}
			}
		});
		






		$('#examTimer').TimeCircles().addListener(function() {
			var remainingSecond = $('#examTimer').TimeCircles().getTime()
			if(remainingSecond < 1) {
				$("#examTimer").TimeCircles().end().fadeOut(); 
				alert('Exam time over');
				window.location.reload();
			}
		});		
	}
	
	loadQuestion();
	questionNavigation();
	



	$(document).on('click', '.next', function(){
		var questionId = $(this).attr('id');
		loadQuestion(questionId);
	});






	$(document).on('click', '.previous', function(){
		var questionId = $(this).attr('id');
		loadQuestion(questionId);
	});
	





	$(document).on('click', '.answer_option', function(){
		var questionId = $(this).data('question_id');
		var answerOption = $(this).data('id');
		var examId = $('#processExamId').attr('data-exam_id');
		$.ajax({
			url:"../user_exam_action.php",
			method:"POST",
			data:{question_id:questionId, answer_option:answerOption, exam_id:examId, action:'answer'},
			success:function(data) {
			}
		})
	});
	




	
	$(document).on('click', '.question_navigation', function(){
		var questionId = $(this).data('question_id');
		loadQuestion(questionId);
	});
	
	
			
});





function questionNavigation() {
	if($('#processExamId').length) {
		var examId = $('#processExamId').data('data-exam_id');
		if(examId) {
			$.ajax({
				url:"../user_exam_action.php",
				method:"POST",
				data:{exam_id:examId, action:'questionNavigation'},
				success:function(data) {
					$('#question_navigation_area').html(data);
				}
			});
		}
	}
}






function loadQuestion(question_id = '') {
	var examId = $('#processExamId').attr('data-exam_id');
	$.ajax({
		url:"../user_exam_action.php",
		method:"POST",
		data:{exam_id:examId, question_id:question_id, action:'loadQuestion'},
		success:function(data){			
			$('#single_question_area').html(data);
		}
	})
}