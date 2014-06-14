<?php
//发布消息的表单

//只在用户登录后显示此表单

if (isset($_COOKIE['user_id'])&&!isset($_COOKIE['pass'])){
        echo'<div class="uk-width-medium-4-5"><div class="uk-panel uk-panel-header uk-panel-box"><h3 class="uk-panel-title">发布资源</h3><form action="post_source.php" class="uk-form uk-form-stacked"method="post" accept-charset="utf-8">';
		echo '<div class="uk-form-row"> <label class="uk-form-label">电子资源名称</label>';
		echo '<div class="uk-form-controls"><input name="s_name" class="uk-width-1-1" type="text" size="50" maxlength="50" ';
		if (isset($subject)) {
			echo "value=\"$subject\" ";
		}
	
		echo '/></div>';
        echo'<div class="uk-form-row">
                                <label class="uk-form-label">链接</label>
                                <div class="uk-form-controls"><input name="s_src" class="uk-width-1-1" type="text" size="50" maxlength="50"/></div></div>';
        echo'<div class="uk-form-row">
                                <label class="uk-form-label">厂商</label>
                                <div class="uk-form-controls"><input name="s_pro" class="uk-width-1-1" type="text" size="50" maxlength="50"/></div></div>';
        echo'<div class="uk-form-row">
                                <label class="uk-form-label">简介</label>
                                <div class="uk-form-controls"><input name="s_ex" class="uk-width-1-1" type="text" size="153" maxlength="230"/> </div></div>';
         echo'<div class="uk-form-row">
                                <label class="uk-form-label">分类</label>
                                <div class="uk-form-controls">
         <select name="s_class">
                  <option value="中文电子期刊">中文电子期刊</option>
                  <option value="中文电子图书">中文电子图书</option>
                  <option value="外文电子期刊">外文电子期刊</option>
                  <option value="外文电子图书">外文电子图书</option>
                  <option value="多媒体资源">多媒体资源</option>
                  <option value="特色资源">特色资源</option>
                  <option value="专题（经济等）数据库">专题（经济等）数据库</option>
                  <option value="试用资源">试用资源</option>
        </select></div></div>';
        echo'<div class="uk-form-row">
                                <label class="uk-form-label">使用说明</label>
                                <div class="uk-form-controls"><textarea name="s_text" >';
        if(isset($body)){
        echo $body;
        }
        echo'</textarea></div></div>';
        echo'<div class="uk-form-row">
                                <div class="uk-form-controls">
                                    <button name="submit" class="uk-button uk-button-primary">发布</button>
                                </div></form></div></div>';
}else{
    echo'<p>您未登录，请登录后发布消息！</p>';
}
?>