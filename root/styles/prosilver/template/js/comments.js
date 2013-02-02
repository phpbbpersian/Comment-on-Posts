/**
* Comment on Posts AJAX functions
* (c) 2013 Ali@php(Ali Faraji - http://www.phpbbpersian.com)
*/

function ajax_edit_form(postid, posterid, commentid, limit, path){
	$(document).ready(function(){

	$("#commentsending").load(""+ path +"?p="+ postid +"&limit="+ limit +"&ce="+ commentid +"" + " #commentsending>*", "");
	
		$("#commentsending").keyup(function(){
			$("#charremain").css("display", "block");
			var messagelength = $("#commentsending textarea#message").val().length;	
			var remainchar = maxlimit - messagelength;
			$("#charremain").html("" + langremainchar + " " + remainchar + "");
		}); 
		
		$('<div></div>').appendTo('body')
			$("#commentsending")
            .dialog({
                modal: true,
				closeOnEscape: true,
				title: langeditcomment,
				zIndex: 10000,
				autoOpen: true,
                width: 'auto',
				height: 'auto',
				position: 'center',
				resizable: false,
				buttons: [{
					text: langsubmit,
					click: function () {
					var message = $("#commentsending textarea#message").val();
					var poster = posterid;
					var post_id = postid;
					var commentsubmit = $("#commentsending input#commentsubmit").val();
					var ce = commentid;
					
				$.post(""+ path +"?p="+ postid +"&limit="+ limit +"&ce="+ commentid +"", { comment: message, post_id: post_id, poster: poster, commentupdate: commentsubmit},
				function(data){
					if (message.length > maxlimit && maxlimit != "0") {
						$('<div></div>').appendTo('body')
						.html(langmaxcharerror)
						.dialog({
							modal: true,
							closeOnEscape: true,
							title: langcharerrortitle,
							zIndex: 10000,
							autoOpen: true,
							width: 'auto',
							height: 'auto',
							resizable: false,
						close: function (event, ui) {
							$(this).remove();
							}
						});
					}
					else if (message.length < minlimit) {
						$('<div></div>').appendTo('body')
						.html(langmincharerror)
						.dialog({
							modal: true,
							closeOnEscape: true,
							title: langcharerrortitle,
							zIndex: 10000,
							autoOpen: true,
							width: 'auto',
							height: 'auto',
							resizable: false,
						close: function (event, ui) {
							$(this).remove();
							}
						});
			
					}
					else {
						$("#c"+ commentid +"").load(""+ path +"?p="+ postid +"&limit="+ limit +"" + " #c"+ commentid +">*", "");
						$('html, body').animate({scrollTop:$("#c"+ commentid +"").position().top}, 'slow');	
						$("#commentsending").dialog("destroy");
						$("#commentsending").css("display", "none");
						$(this).removeClass();
						$(this).removeAttr("style");
						$(this).remove();
						$("textarea#message").val("");

					}
				});
					},
				},],
				
                close: function (event, ui) {
				$("textarea#message").val('');
                $("#commentsending").dialog("destroy");
                $(this).removeClass();
                $(this).removeAttr("style");
				$("#charremain").css("display", "none");
				$("#commentsending").css("display", "none");

                
                        }
                    });	
	
	});
}
function ajax_send_form(action, posterid, postid, limit, path){
	$(document).ready(function(){
	
		$("#commentsending textarea#message").keyup(function(){
			$("#charremain").css("display", "block");
			var messagelength = $("#commentsending textarea#message").val().length;	
			var remainchar = maxlimit - messagelength;
			$("#charremain").html("" + langremainchar + " " + remainchar + "");
		});
		
		$('<div></div>').appendTo('body')
			$("#commentsending")
            .dialog({
                modal: true,
				closeOnEscape: true,
				title: langsendtitle,
				zIndex: 10000,
				autoOpen: true,
                width: 'auto',
				height: 'auto',
				position: 'center',
				resizable: false,
				buttons: [{
					text: langsubmit,
					click: function () {
					var message = $("#commentsending textarea#message").val();
					var poster = posterid;
					var post_id = postid;
					var commentsubmit = $("#commentsending input#commentsubmit").val();
					
				$.post(action, { comment: message, post_id: post_id, poster: poster, commentsubmit: commentsubmit},
				function(data){
					if (message.length > maxlimit && maxlimit != "0") {
						$('<div></div>').appendTo('body')
						.html(langmaxcharerror)
						.dialog({
							modal: true,
							closeOnEscape: true,
							title: langcharerrortitle,
							zIndex: 10000,
							autoOpen: true,
							width: 'auto',
							height: 'auto',
							resizable: false,
						close: function (event, ui) {
							$(this).remove();
							}
						});
					}
					else if (message.length < minlimit) {
						$('<div></div>').appendTo('body')
						.html(langmincharerror)
						.dialog({
							modal: true,
							closeOnEscape: true,
							title: langcharerrortitle,
							zIndex: 10000,
							autoOpen: true,
							width: 'auto',
							height: 'auto',
							resizable: false,
						close: function (event, ui) {
							$(this).remove();
							}
						});
			
					}
					else {
						$("#p"+ postid +"").load(""+ path +"?p="+ postid +"&limit="+ limit +"" + " #p"+ postid +">*", "");
						$('html, body').animate({scrollTop:$("#scrollpoint"+ postid +"").position().top}, 'slow');	
						$("#commentsending").dialog("destroy");
						$("#commentsending").css("display", "none");
						$(this).removeClass();
						$(this).removeAttr("style");
						$(this).remove();
						$("textarea#message").val("");

					}
				});
		
					},
				},],
				
                close: function (event, ui) {
				$("textarea#message").val('');
                $("#commentsending").dialog("destroy");
                $(this).removeClass();
                $(this).removeAttr("style");
				$("#charremain").css("display", "none");
				$("#commentsending").css("display", "none");

                        }
                    });	
			
	});

}
function ajax_pagination(action, postid, limit){
	$(document).ready(function(){
		$("#p"+ postid +"").load(""+ action +"" + " #p"+ postid +">*", "");
		$('html, body').animate({scrollTop:$("#commentscroll"+ postid +"").position().top}, 'slow');	
	});
}
function ajax_delete_comment(postid, commentid, limit, path){
	$(document).ready(function(){

		$('<div></div>').appendTo('body')
			.html(langcomdelete)
            .dialog({
                modal: true,
				closeOnEscape: true,
				title: langcomdeletetitle,
				zIndex: 10000,
				autoOpen: true,
                width: 'auto',
				height: 'auto',
				position: 'center',
				resizable: false,
				buttons: [{
					text: langyes,
					click: function () {
            			$.get(""+ path +"?p="+ postid +"&cd="+ commentid +"&confirm=1", { },
						function(data){
							$("#p"+ postid +"").load(""+ path +"?p="+ postid +"&limit="+ limit +"" + " #p"+ postid +">*", "");
							$('html, body').animate({scrollTop:$("#p"+ postid +"").position().top}, 'slow');
							
					});
						$(this).remove();
					},
				}, {
					text: langno,
					click: function () {
					$(this).remove(); 
					},
				}],
                close: function (event, ui) {
                            $(this).remove();
                        }
                    });
	});
} 