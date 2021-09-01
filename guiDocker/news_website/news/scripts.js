
$(document).ready(function(){
	// When user clicks on submit comment to add comment under post
	$('#comment_form').on('submit', function(e) {
		e.preventDefault();
        var comment_text = $('#comment_text').val();
        var comment_name = $('#comment_name').val();
		var url = "comments.php";
        var myParam = location.search.split('newsid=')[1]
		// Stop executing if not value is entered
        if (comment_text === "" ) return;

		$.ajax({
			url: url,
			type: "POST",
			data: {comment_text:comment_text,
				comment_name:comment_name,
				id:myParam},

			success: function(data){
				console.log(data);

                var response = JSON.parse(data);
				if (data === "error") {
					alert('There was an error adding comment. Please try again');
				} else {
                    $('#comments-wrapper').append("<li class='clearfix'><div class='post-comments'><p class='meta'>"
                     + response.date+ "  <a>"+response.name+"</a> says : <i class='pull-right'><a></a></i></p><p>"+response.content+
                        "</p></div></li>" );
 
                 
                    $('#comment_text').val('');
                    $('#comment_name').val('');
				}
			} 
		});
	});
	
});