/**
* Comment on Posts AJAX functions
* (c) 2013 Ali@php(Ali Faraji - http://www.phpbbpersian.com)
*/
function ajax_add_comment(element, postid, action, limit){
	$(document).ready(function(){
	
		$(element).hide();
			var message = $("textarea#message").val();
			var post_id = $("input#post_id").val();
			var poster = $("input#poster").val();
			var commentsubmit = $("input#commentsubmit").val();

			$.post(action, { comment: message, post_id: post_id, poster: poster, commentsubmit: commentsubmit},
			function(data){
				$("#p"+ postid +"").load("viewtopic.php?p="+ postid +"limit="+ limit +"" + " #p"+ postid +">*", "");
				$('html, body').animate({scrollTop:$("#scrollpoint"+ postid +"").position().top}, 'slow');	
			});
				
					
	});
}
function ajax_edit_comment(element, postid, commentid, limit){
	$(document).ready(function(){

		$(element).hide();
			var message = $("textarea#message").val();
			var post_id = $("input#post_id").val();
			var commentupdate = $("input#commentupdate").val();

			$.post(window.location.href, { comment: message, post_id: post_id, commentupdate: commentupdate},
			function(data){
				$("#c"+ commentid +"").load("viewtopic.php?p="+ postid +"&limit="+ limit +"" + " #c"+ commentid +">*", "");
				$('html, body').animate({scrollTop:$("#c"+ commentid +"").position().top}, 'slow');	
				
			});
				
					
	});
}