<?php
// hook acfun report.aspx
require_once("init.php");

$page = gotoPage("http://www.acfun.tv/report.aspx");

$js = <<<JAVASCRIPT
<script>
(function(){
	var btns = $('<div class="mod-hcg">').css({
		overFlow:"hidden",
		textAlign: "center",
		marginTop: ".5em"
	}).appendTo("#block-hint .alert");



	var btnBanUser = $('<button class="btn danger mini">')
		.text("屏蔽此人")
		.css({
			"float": "none"
		})
		.click(function(){
			var uid = $("#ipt-name").val();

			$.ajax({
				url: "http://{{domain}}/acfun_save_ban_uid.php?uid=" + uid,
				cache: false,
				dataType: "jsonp",
				success: function(data){
					if(data.success === true) {
						alert("添加成功");
					} else {
						alert("添加失败,请联系管理员");
					}
				}
			});

			return false;
		});

	btns.append(btnBanUser);
})();
</script>
JAVASCRIPT;


$js = str_replace("{{domain}}", DOMAIN, $js);
echo str_replace("</body>",$js . "\n</body>", $page);
