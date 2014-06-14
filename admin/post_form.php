<?php
//发布消息的表单

//只在用户登录后显示此表单

if (isset($_COOKIE['user_id'])&&!isset($_COOKIE['pass'])){
        echo' <div class="uk-width-medium-4-5"><div class="uk-panel uk-panel-header uk-panel-box"><h3 class="uk-panel-title">发布消息</h3><form action="post.php" class="uk-form uk-form-stacked" method="post" accept-charset="utf-8">';
		echo ' <div class="uk-form-row"> <label class="uk-form-label">标题</label>';
		echo '<div class="uk-form-controls"><input name="subject"  class="uk-width-1-1" type="text" size="153" maxlength="30" ';
		if (isset($subject)) {
			echo "value=\"$subject\" ";
		}
	
		echo '/></div>';
         echo '<div class="uk-form-row">';
         echo '<label class="uk-form-label">描述</label>';
         echo ' <div class="uk-form-controls">';
          echo '<input type="text" name="dec" placeholder="" class="uk-width-1-1"> </div> </div>';
          
        echo'<div class="uk-form-row">
                                <label class="uk-form-label">内容</label>
                                <div class="uk-form-controls">
                                    <textarea class="uk-width-1-1" name="body" id="form-h-t" cols="100" rows="9"></textarea>
                               ';
        if(isset($body)){
        echo $body;
        }
        echo'</textarea></div>
                            </div>';
        echo'  <div class="uk-form-row">
                                <div class="uk-form-controls">
                                    <button name="submit" class="uk-button uk-button-primary">发布</button>
                                </div></form></div></div>';
}else{
    echo'<p>您未登录，请登录后发布消息！</p>';
}
?>
</div>

               