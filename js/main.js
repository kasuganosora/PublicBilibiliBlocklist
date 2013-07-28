$(document).ready(function(){
	$(document).on("click",".btn-delete",function(e){
		var tr = $(e.target).parents("tr");
		var id = tr.data("id");
		$.get("delete.php",{id:id},function(data){
			if(data == "ok"){
				tr.remove();
			}
		});
		return false;
	});
	
	$(".js-f-all").click(function(){
		$("#blocklist tbody tr").removeClass("hide");
		$(".js-nav-filter-btn li").removeClass("active");
		$(this).parent().addClass("active");
		return false;
	});
	
	$(".js-f-keyword,.js-f-user,.js-f-color").click(function(){
		var type = $(this).attr("class").replace("js-f-","");
		$("#blocklist tbody tr").each(function(index){
			var tr = $(this);
			if(tr.data("type") != type){
				tr.addClass("hide");
			}else{
				tr.removeClass("hide");
			}
		});
		$(".js-nav-filter-btn li").removeClass("active");
		$(this).parent().addClass("active");
		return false;
	});
	
});