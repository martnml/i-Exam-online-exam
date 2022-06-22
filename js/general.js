$(document).ready(function(){
	var urlPath = window.location.pathname,
    urlPathArray = urlPath.split('.'),
    tabId = urlPathArray[0].split('/').pop();
	$('#exam, #question, #user, #enroll_exam, #view_exam, #process_exam').removeClass('active');	
	$('#'+tabId).addClass('active');


	$('div[id^="expand"]').click(function(){
		$(this).next().show();
	})	
	
});