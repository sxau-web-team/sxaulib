<?php # Script 3.4 - index.php
$page_title = '山西农业大学图书馆';
include ('./includes/header.html');
?>

    <script language="JavaScript">
function on_submit1() {
if (document.form2.txttm.value.length !=0)
{
if (document.form2.select1.value=="timing" ) 
{document.form2.action="http://libweb.sxau.edu.cn/wxjs/tmjs.asp";
 document.form2.submit();}
else if (document.form2.select1.value=="zuozhe")
{document.form2.action="http://libweb.sxau.edu.cn/wxjs/zzjs_form.asp";
document.form2.submit();} 
else if(document.form2.select1.value=="fenlei")  
{document.form2.action="http://libweb.sxau.edu.cn/wxjs/fljs_form.asp";
document.form2.submit();}
else if(document.form2.select1.value=="zhuti")  
{document.form2.action="http://libweb.sxau.edu.cn/wxjs/ztjs_form.asp";
document.form2.submit();}
}
else {
alert("请输入检索词");
window.form2.txttm.focus();
return (false);}
}
</script>


     

 <div class="uk-grid" data-uk-grid-margin>

                <div class="uk-width-medium-1-2">
                    <?php include('image.php'); ?>
                </div>

                <div class="uk-width-medium-1-2">
                    <h2>本馆介绍 <i class="uk-icon-map-marker"></i></h2>
                    <p>山西农大图书馆的前身是始建于1907年的私立铭贤学堂图书馆。1951年随学校被政府接管，改名为山西农学院图书馆，1979年改为现名。图书馆从无到有，历经百年沧桑，规模逐渐扩大。目前馆舍建筑总面积约2.64万㎡，其中新馆面积约2.5万㎡，于2005年9月竣工落成。内设各种阅览室16个，阅览座位目前配置达到1500席，预计达到3000席。六个主要阅览室实行周一至周日全天候开放，每天从早8点到晚10点，连续开放14小时，周开馆时间达94小时。</p>
                    <h2>馆藏资源 <i class="uk-icon-file"></i></h2>
                    <p>
                    图书馆现有各类藏书近150万册，其中纸质图书约100万册，电子图书57万册；中、外文期刊(含电子版)1.5万余种；农业及生物类优秀博、硕士论文4.2万余篇；各类中外文数据库24个。形成了以农业、生物科学为主，理、工、经、管、法、社等学科协调发展的多科性现代化文献信息服务中心。</p>
                    <p>More  <a href="http://libweb.sxau.edu.cn/bgjs/gsjs.asp"><i class="uk-icon-plus"></i></a></p>
                </div>

            </div>

                            


<div class="uk-grid">
    <div class="uk-width-medium-1-2" data-uk-scrollspy="{cls:'uk-animation-slide-right', repeat: true}">
        <div class="uk-panel uk-panel-box">
          <div class="uk-panel-badge "><i class="uk-icon-link uk-icon-small"></i><a href="art_list.php" > 更多</a></div>
          <h2 class="uk-panel-title">最新消息  <i class="uk-icon-rss uk-icon-small"></i></h2>
          <table class="uk-table uk-table-striped uk-table-condensed">
            <tbody>
                 <?php 
 @require ('mysqli_connect.php'); // Connect to the db.
        
// Make the query:
$q = "SELECT CONCAT(post_title) AS name,CONCAT(ID) AS ar_id, CONCAT(post_date) AS dr FROM post order by ID desc limit 0,8 ";     
$r = @mysqli_query ($dbc, $q); // Run the query.

// Count the number of returned rows:
$num = mysqli_num_rows($r);

if ($num > 0) { // If it ran OK, display the records.
echo ''; 
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        echo '<tr><td><a href="article.php?aid='.$row['ar_id'].'">' . $row['name'] . '</a></td> <td><span class="uk-text-danger">['.date("Y-m-d",strtotime(($row['dr']))).']</span></td></tr>
        ';
    }
echo ''; 
    mysqli_free_result ($r); // Free up the resources.  

} else { // If no records were returned.

    echo '<p class="error">There are currently no news.</p>';

}

mysqli_close($dbc); // Close the database connection.

?>
           </tbody>

</table>
        </div>
</div>
    <div class="uk-width-medium-1-2" data-uk-scrollspy="{cls:'uk-animation-slide-bottom', repeat: true}">
        <div class="uk-panel uk-panel-box">
          <div class="uk-panel-badge "><i class="uk-icon-link uk-icon-small"></i><a href="source_list.php?class=1" > 更多</a></div>
          <h2 class="uk-panel-title">电子资源   <i class="uk-icon-tags uk-icon-small"></i></h2>
          <table class="uk-table uk-table-striped uk-table-condensed">
            <tbody>
                 <?php 
 @require ('mysqli_connect.php'); // Connect to the db.e
        
// Make the query:
$q = "SELECT CONCAT(s_name) AS name,CONCAT(s_src) AS s_src,CONCAT(s_date) AS s_date,CONCAT(ID) AS ar_id FROM source order by ID desc limit 0,8  ";
$r = @mysqli_query ($dbc, $q); // Run the query.

// Count the number of returned rows:
$num = mysqli_num_rows($r);

if ($num > 0) { // If it ran OK, display the records.<i class="uk-icon-tag"></i>
echo ''; 
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        echo '<tr><td><a href="'.$row['s_src'].'">' . $row['name'] . '</a></td> <td><span class="uk-text-danger"><a href="source.php?aid='.$row['ar_id'].'">使用说明 <i class="uk-icon-external-link"></i></a></span></td><td><span class="uk-text-danger">['.date("Y-m-d",strtotime(($row['s_date']))).']</span></td></tr>
        ';
    }
echo ''; 
    mysqli_free_result ($r); // Free up the resources.  

} else { // If no records were returned.

    echo '<p class="error">There are currently no news.</p>';

}

mysqli_close($dbc); // Close the database connection.

?>
           </tbody>

</table>
        </div>
</div>
    </div>
</div>
  
<br>
 
<br>
         <div class="uk-panel uk-panel-box " data-uk-scrollspy="{cls:'uk-animation-slide-right', repeat: true}">
              <form class="uk-form" name="form2" id="form2" action="" method="post" accept-charset="gb2312" target=_blank>
               <h2 class="uk-panel-title">馆藏资源查询  <i class="uk-icon-search uk-icon-small"></i></h2>
                
                  <input  name="txttm" type="text" id="txttm" size="26" />
        
                        <select name="select1">
                                <option value="timing" selected>题名</option>
                                <option value="zuozhe">作者</option>
                                <option value="fenlei">分类号</option>
                                  <option value="zhuti">主题词</option>
                       </select>
                   <button class="uk-button uk-button-primary" id="button" onclick="javascript:on_submit1();" >查 询</button>
        
                
                 </form>
                 <br>
                 </div>
<br>
 
<br>
        <div class="uk-grid">
                                <div class="uk-width-medium">

                                    <div class="uk-panel uk-panel-box" data-uk-scrollspy="{cls:'uk-animation-slide-top', repeat: true}">
                                        
                                         <h2 class="uk-panel-title">资源快递   <i class="uk-icon-location-arrow uk-icon-small"></i></h2>
                                    <ul class="uk-tab" data-uk-tab="{connect:'#tab-content'}">
                                        <li class=""><a href="#">国内文献</a></li>
                                        <li class="uk-active"><a href="#">省内大学</a></li>
                                        <li class=""><a href="#">论文相关</a></li>
                                        <li class=""><a href="#">FAQ</a></li>

                                    <li class="uk-tab-responsive uk-active"><a href="javascript:void(0);">Tab</a><div class="uk-dropdown uk-dropdown-small"><ul class="uk-nav uk-nav-dropdown"><li><a href="javascript:void(0);">Tab</a></li><li><a href="javascript:void(0);">Tab</a></li><li><a href="javascript:void(0);">Tab</a></li></ul><div></div></div></li></ul>

                                    <ul id="tab-content" class="uk-switcher uk-margin">
                                        <li class="">
                                                <dl class="uk-description-list uk-description-list-line">
                                <dt>高等教育数字图书馆</dt>
                                <dd><a href="http://www.calis.edu.cn/">http://www.calis.edu.cn/</a></dd>
                                <dt>中国国家图书馆</dt>
                                <dd><a href="http://www.nlc.gov.cn/">http://www.nlc.gov.cn/</a></dd>
                                <dt>中国农业大学图书馆</dt>
                                <dd><a href="http://www.lib.cau.edu.cn/">http://www.lib.cau.edu.cn/</a></dd>
                                <dt>中科院文献情报中心</dt>
                                <dd><a href="http://www.las.ac.cn/index.jsp">http://www.las.ac.cn/index.jsp</a></dd>
                                <dt>中国农业科学院</dt>
                                <dd><a href="http://www.caas.net.cn/">http://www.caas.net.cn/</a></dd>
                            </dl>
                                        </li>
                                        <li class="uk-active">
                                          
                                          <dl class="uk-description-list uk-description-list-line">
                                <dt>山西省图书馆</dt>
                                <dd><a href="http://lib.sx.cn/">http://lib.sx.cn/</a></dd>
                                <dt>山西大学图书馆</dt>
                                <dd><a href="http://www.lib.sxu.edu.cn/">http://www.lib.sxu.edu.cn/</a></dd>
                                <dt>太原理工大学图书馆</dt>
                                <dd><a href="http://www.lib.tyut.edu.cn/">http://www.lib.tyut.edu.cn/</a></dd>
                                <dt>山西财经大学图书馆/dt>
                                <dd><a href="http://lib.sxufe.edu.cn/">http://lib.sxufe.edu.cn/</a></dd>
                                <dt>中北大学图书馆</dt>
                                <dd><a href="http://lib.nuc.edu.cn/new/index1.action">http://lib.nuc.edu.cn/new/index1.action</a></dd>
                            </dl>
                                        </li>
                                        <li class="">
                                          
                                          <dl class="uk-description-list uk-description-list-line">
                                <dt>中国科技论文在线</dt>
                                <dd><a href="http://www.paper.edu.cn/">http://www.paper.edu.cn/</a></dd>
                                <dt> 博硕士论文提交</dt>
                                <dd><a href="http://211.82.8.236:81/survey/view.php?id=2">http://211.82.8.236:81/survey/view.php?id=2</a></dd>
                                <dt>学位论文管理系统</dt>
                                <dd><a href="http://211.82.8.235/login.aspx">http://211.82.8.235/login.aspx</a></dd>
                                 <dt>知网中国学术期刊数据库 </dt>
                                <dd><a href="http://www.cnki.net/">http://www.cnki.net/</a></dd>
                                 <dt>超星中文发现系统 </dt>
                                <dd><a href="http://fx.sxau.superlib.net/">http://fx.sxau.superlib.net/</a></dd>
                            </dl>
                                        </li>
                                        <li class="">
                                          
                                          <dl class="uk-description-list uk-description-list-line" >
                                <dt >1.  图书馆主页的网址是什么？</dt>
                                <dd>答：http://www.libweb.sxau.edu.cn　，主页全面反映了图书馆提供资源和服务的情况。</dd>
                                <dt>2.  如何及时了解图书馆的新资源、新服务？</dt>
                                <dd>答：图书馆的新资源、新服务以及有关的通知，会在图书馆主页的“最新消息”或“公告通知”中及时发布。</dd>
                                <dt>3.  图书馆为读者提供哪些培训，在哪里看培训通知？</dt>
                                <dd>答：为了提高读者的信息素质，图书馆信息部为全校读者开设了网络信息检索利用课程，具体课程安排见图书馆主页“读者指南”的分页——“读者培训”。</dd>
                                <dt>4.  图书馆自习室、阅览室为什么不能占座位？</dt>
                                <dd>答：图书馆本是为读者提供借阅图书、参考阅览的场所，并没有教室自习的职能。抢占座位本身是一种损人利己的行为，所以本馆从来不允许将书籍或本子占座位。每位同学只能占据一个座位，严禁用书、本或其他物品为他人占据座位。同学短期离开，可委托周围同学代为说明，超过半小时，即视为离去，工作人员有权将其书、本等物品收集后，放置在大厅台上，以便腾空座位。特殊情况也应事先和工作人员联系，协商解决。</dd>
                                <dt>5. 图书馆具体开馆时间？</dt>
                                <dd>答：流通部开放时间为：（周一至周五）
8：00-11：30；14：30-18：00（夏季）；14：00-17：30（冬季）
阅览室开放时间为：（周一至周日）
8：00-11：30；14：30-21：30（夏季）；14：00-21：00（冬季）
电子阅览室开放时间为：（周一至周日）
8：00-22：30（夏季，周五14：30-18：30不开）
8：00-22：00（冬季，周五14：00-18：00不开） </dd>
                                <dt>6.  入馆需持有什么证件？</dt>
                                <dd>答：持有效证件——借书证进行借阅。</dd>
                                <dt>7.   调离的读者需要办理退证手续吗？</dt>
                                <dd>答：按照学校规定，调离的读者必须到图书馆归还所借图书、还清欠款，退还借书证，经流通部、阅览室、过刊室和文印室签字盖章，办理离校（或临时离校）手续。/dd>
                                <dt><a href="http://libweb.sxau.edu.cn/faq.htm">MORE</a></dt>
                            </dl>
                                        </li>
                                    </ul>

                                
                                    </div>
                                </div>
        </div>
         
      


                            <div class="uk-grid">
                                <div class="uk-width-medium-1-4">
                                    <div class="uk-panel uk-panel-box uk-text-center" data-uk-scrollspy="{cls:'uk-animation-fade', repeat: true}">
                                        <h3 class="uk-panel-title">图书/期刊阅览室开放时间</h3>
                                        <p>星期一 —— 四、六、日    8:00--22:00</p>
                                        <p>星期五    上午: 8:00-14:00  晚上: 18:00-22:00</p>
                                    </div>
                                </div>
                                <div class="uk-width-medium-1-4">
                                    <div class="uk-panel uk-panel-box uk-text-center" data-uk-scrollspy="{cls:'uk-animation-fade', delay:300, repeat: true}">
                                    <br>
                                        <h3 class="uk-panel-title">期刊阅览室开放时间</h3>
                                        <p>星期一 —— 日    8:00--22:00</p>
                                        <br>
                                        
                                        <br>
                                    </div>
                                </div>
                                <div class="uk-width-medium-1-4">
                                    <div class="uk-panel uk-panel-box  uk-text-center" data-uk-scrollspy="{cls:'uk-animation-fade', delay:600, repeat: true}">
                                        <h3 class="uk-panel-title">电子阅览室开放时间</h3>
                                        <p>星期一——四、六、日    <br>8:00--22:30</p>
                                        <p>星期五    上午: 8:00-14:30 <br> 晚上: 16:30-22:30</p>
                                        
                                    </div>
                                </div>
                                <div class="uk-width-medium-1-4">
                                    <div class="uk-panel uk-panel-box  uk-text-center" data-uk-scrollspy="{cls:'uk-animation-fade', delay:900, repeat: true}">
                                        <h3 class="uk-panel-title">中文图书借书处开放时间</h3>
                                        <p>星期一——四、六、日    上午：8:00-12:00 <br> 下午：2：00-6：00</p>
                                        <p>星期五    上午: 8:00-12:00 </p>

                                    </div>
                                </div>
                          
</div>

<?php
include ('./includes/footer.html');
?>