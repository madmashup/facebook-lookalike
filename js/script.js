$(function(){
	$("#postform").submit(function(e){
		e.preventDefault();
		var post_data=$(this).serialize();//returns a string of all the data inside the form
		$.ajax({
			url:"post_insert.php",
			type:"GET",
			data:{data:post_data},
			success:function(resp){
				if(resp!=""){
					$("#postbox").prepend(resp);
					$("#resetbtn").click();
				}
			}
		});
	});

	//$(".delete").click(function(e){
		$(document).on("click",".delete",function(e){//works on live data
		e.preventDefault();
		if(!confirm("Do you really want to delete this post?")){
			return false;
		}
		var postid=$(this).data("postid");
		var t=$(this);
		if(postid!=""){
			$.ajax({
				url:"delete_post.php",
				type:"GET",
				data:{post_id:postid},
				success:function(resp){
					if(resp==1){
						t.parents(".panel").slideUp(function(){
							$(this).remove();
						});
					}else{
						alert("Error deleting this post, please refresh your page and try again.");
					}
				}
			});
		}
	});

	$("#searchbar").keyup(function(){
		var word=$(this).val();
		if(word!=""){
			$.ajax({
				url:"search.php",
				type:"GET",
				data:{w:word},
				success:function(resp){
					$("#search_result").html(resp);
				}
			});
		}else{
			$("#search_result").html("");
		}
	});
});