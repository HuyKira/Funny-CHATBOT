jQuery(document).ready(function($) {
	var chat = $('.fcb_chat-box').length;
	if(chat){
		$('.chat-del').click(function(event) {
			$('.fcb_chat-box').slideToggle(300);
			setTimeout(function(){ 
		  		$('.tab-name').show();
		  	}, 200);
		});
		$('.tab-name').click(function(event) {
			$('.fcb_chat-box').slideToggle(300);
			$(this).hide();
		});
		$('.chat-content').scrollTop($('.chat-content')[0].scrollHeight);
		$( ".form-chat" ).submit(function( event ) {
		  	event.preventDefault();
		  	var data = $('#content-txt').val(),
		  		x = Math.floor((Math.random() * fcb_count)),
		  		message = fcb_message;
		  	$('.chat-content').append('<ul class="cus-chat live"><li><p>'+data+'</p></li></ul>');
		  	$('.chat-content').scrollTop($('.chat-content')[0].scrollHeight);
		  	$('#content-txt').val('');
		  	setTimeout(function(){ 
		  		$('.chat-content').append('<ul class="start-chat"><li class="load"><img src="'+fcb_img_load+'"></li></ul>');
		  		$('.chat-content').scrollTop($('.chat-content')[0].scrollHeight);
		  	}, 400);
		  	setTimeout(function(){ 
		  		$('.chat-content').append('<ul class="start-chat"><li><p class="live">'+message[x]+'</p></li></ul>');
		  		$('.load').hide();
		  		$('.chat-content').scrollTop($('.chat-content')[0].scrollHeight);
		  	}, 2000);
		});
	};
});