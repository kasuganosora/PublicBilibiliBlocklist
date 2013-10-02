<?php
require_once("init.php");

$type = mysql_real_escape_string($_GET['type']);
$data = mysql_real_escape_string($_GET['data']);
if(isset($type) && isset($data) && $type != ""){
	//添加
	$mode = "blocklist";
	$uid = 1;
	$sql = "REPLACE INTO `filter` (val,type,mode,uid) VALUES('$data','$type','$mode','$uid');";
	$db->query($sql);
	
	header("Location: index.php");
	exit();  
}

$sql = "select * from `filter` order by `id` desc";
$blockList = $db->get_results($sql);
if(!$blockList){
	$blockList = array();
}
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Bilibili公用过滤列表</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="可以多个用户直接共用一张过滤列表,来防止小学生的弹幕攻击">
	<meta name="author" content="ReitsukiSion">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.css" type="text/css" media="screen" title="no title" charset="utf-8">
	<link rel="stylesheet" href="bootstrap/css/bootstrap-responsive.css" type="text/css" media="screen" title="no title" charset="utf-8">
	<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" title="no title" charset="utf-8">
</head>
<body>
	<div class="container">
		<div class="masthead">
			<h3 class="muted">Bilibili公用过滤列表</h3>
			<form class="form-inline" method="GET">
				<select class="span1" name="type">
				  <option value="keyword">文本</option>
				  <option value="user">用户</option>
				  <option value="color">颜色</option>
				</select>
			  <input type="text" name="data" class="input" placeholder="屏蔽内容">
			  <button type="submit" class="btn">保存</button>
			  <a class="btn btn-inverse" role="button" href="#upload-xml-modal" data-toggle="modal">导入XML</a>
			</form>
			<div class="navbar">
			  <div class="navbar-inner">
			    <ul class="nav js-nav-filter-btn">
			      <li class="active"><a href="#" class="js-f-all">全部</a></li>
			      <li><a href="#" class="js-f-keyword">关键字</a></li>
			      <li><a href="#" class="js-f-user">用户</a></li>
				  <li><a href="#" class="js-f-color">颜色</a></li>
			    </ul>
			  </div>
			</div>
		</div>
		<table class="table table-bordered" id="blocklist">
			<thead>
				<tr>
					<th class="span1">类型</th>
					<th class="span8">内容</th>
					<th class="span1">删除</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($blockList as $item){ 
					$typeStr;
					switch( $item->type){
						case "keyword":
							$typeStr = "关键字";
						break;
						case "user":
							$typeStr = "用户";
						break;
						case "color":
							$typeStr = "颜色";
						break;
					}
					?>
					<tr data-id="<?php echo $item->id; ?>" data-type="<?php echo $item->type; ?>">
						<td><?php echo $typeStr; ?></td>
						<td><?php echo reducingString($item->val); ?></td>
						<td class="action"><button class="btn btn-danger btn-delete">删除</button></td>
					</tr>
					<?php } ?>
			</tbody>
		</table>
		
	</div>
	
	
	<!-- Modal -->
	<div id="upload-xml-modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<form action="importxml.php" method="post" accept-charset="utf-8" enctype="multipart/form-data">
	 	   <div class="modal-header">
	   	 	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	   	 	<h3 id="myModalLabel">导入XML文件</h3>
	  	</div>
	  	<div class="modal-body">
	    	<p>把bilibili播放器的XML文件导入到公用过滤列表中</p>
			<input type="file" name="file" id="file" /> 
	  	</div>
	  	<div class="modal-footer">
	    	<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
	    	<button class="btn btn-primary"  type="submit">导入XML</button>
	  		</div>
	  	</form>
	</div>
	
	<script type="text/javascript" src="js/jquery-2.0.3.min.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>	
</body>
</html>