<?php
use yii\helpers\Url;
?>
<main role="main" class="container">
	<div class="row">
		<div class="col-lg-9">
        
			<div class="card mb-3">
                                <div class="card-header">
                                        <h2>发布</h2>
                                </div>
                                <div class="card-body">
                                        <div class="form-group field-post-title required">
                                                <label class="control-label" for="post-title">链接地址</label>
                                                <textarea id="profile-signature" class="form-control" placeholder="例如 http://pan.baidu.com/s/1WIolFfE"></textarea>
                                                <div class="invalid-feedback u1"></div>
                                                <hr>
                                                <div class="help-block">
                                                    财富榜已入前八，功夫不负有心人 
                                                </div>
                                        </div>
                                </div>
                                <div class="card-footer">
                                        <div class="form-group">
                                                <button type="submit" id="sub2" class="btn btn-success">发布</button>        
                                        </div>
                                </div>
			</div>
		</div>
		<div class="col-lg-3">
                        财富榜已入前八，功夫不负有心人 财富榜已入前八，功夫不负有心人 
                        财富榜已入前八，功夫不负有心人 财富榜已入前八，功夫不负有心人

		</div>
	</div>
</main>
<script type="text/javascript">

        $(function(){
                var reg = /^([hH][tT]{2}[pP]:\/\/|[hH][tT]{2}[pP][sS]:\/\/)(([A-Za-z0-9-~]+).)+([A-Za-z0-9-~\/])+$/;

                $("#sub2").on('click',function(){
                    var link = $("#profile-signature").val();

                    if(!(reg.test(link))){
                        Dempty($(".u1"));
                        $(".u1").css('display','block').append('请输入正确的链接地址！');
                        return;
                    }else{
                        Dempty($(".u1"));
                    } 

                    $.ajax({
                            url : "<?= Url::to(['publish/publish'])?>",//具体的url 根据项目的路径自己调下
                            type : 'post',
                            data : {"link":link},
                            dataType : 'json',
                            async : false,
                            success : function(data){
                                    if(data.result){
                                        alert("发布成功");
                                        window.location.href="/";
                                    }else{
                                        alert(data.exp);
                                    }
                            },
                            error : function(){
                                    alert(data.result);
                            }
                    });
                });

                function Dempty(e){
                    e.empty();
                }
        })
</script>