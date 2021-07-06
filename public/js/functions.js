function doValidation(id, actionUrl, formName) {

	function showErrors(resp) {
		$("#" + id).parent().parent().find('.errors').html(' ');
		$("#" + id).parent().parent().find('.errors').html(getErrorHtml(resp[id]));
	}

	$.ajax({
		type : 'POST',
		url : actionUrl,
		data : $("#" + formName).serialize(),
		dataType : 'json',
		success : showErrors
	});
}

function getErrorHtml(formErrors) {
	if (( typeof (formErrors) === 'undefined') || (formErrors.length < 1))
		return;

	var out = '<ul>';
	for (errorKey in formErrors) {
		out += '<li>' + formErrors[errorKey] + '</li>';
	}
	out += '</ul>';
	return out;
}
function faqHandler(){
    $(".faq-q").click( function () {
        var container = $(this).parents(".faq-c");
        var answer = container.find(".faq-a");
        var trigger = container.find(".faq-t");

        answer.slideToggle(200);

        if (trigger.hasClass("faq-o")) {
            trigger.removeClass("faq-o");
        }
        else {
            trigger.addClass("faq-o");
        }
    });
}


 $('.faq_section').ready(function(){
	$(".box").click(function(){
	  $(this).next().slideToggle("fast");
	  $(this).find('i').toggle();
	});  

});

