<?php

use yii\helpers\Url;
?>

<main role="main" class="container">        
        <div class="row">
                <div class="col-lg-5" style="margin: auto">
                        <div class="card">
                                <div class="card-header">
                                        <h2>注册</h2>
                                </div>
                                <div class="card-body">
                                                <div class="form-group field-signupform-username required validating">
                                                        <label for="signupform-username">用户名</label>
                                                        <input type="text" id="username" class="form-control name" >
                                                        <div class="invalid-feedback u1"></div>
                                                </div>

                                                <div class="form-group field-signupform-password required">
                                                        <label for="signupform-password">密码</label>
                                                        <input type="password" id="password" class="form-control">

                                                        <div class="invalid-feedback u2"></div>
                                                </div>
                                                <div class="form-group field-signupform-password_repeat required">
                                                        <label for="signupform-password_repeat">重复密码</label>
                                                        <input type="password" id="password_repeat" class="form-control" >

                                                        <div class="invalid-feedback u3"></div>
                                                </div>
                                                <div class="form-group">
                                                        <button type="submit" id="sub2" class="btn btn-primary" name="signup-button">注册</button>                    </div>

                                        <hr>
                                        <div id="w0"></div>
                                </div>
                        </div>
                </div>
        </div>
</main>

<script type="text/javascript">

        $(function(){
                var reg = /^[a-zA-Z\u4e00-\u9fa5][a-zA-Z0-9_\u4e00-\u9fa5]*$/u;

                $("#sub2").on('click',function(){
                    var name = $("#username").val();
                    var pwd = $("#password").val();
                    var pwd_2 = $("#password_repeat").val();

                    if(!(reg.test(name))){
                        Dempty($(".u1"));
                        $(".u1").css('display','block').append('用户名由字母，汉字，数字，下划线组成，且不能以数字和下划线开头。');
                        return;
                    }else{
                        Dempty($(".u1"));
                    } 

                    if(pwd == ""){
                        Dempty($(".u2"));
                        $(".u2").css('display','block').append('请输入密码！');
                        return;
                    }else{
                        Dempty($(".u2"));
                    } 

                    if(pwd_2 == "" || pwd != pwd_2){
                        Dempty($(".u3"));
                        $(".u3").css('display','block').append('密码不一致！');
                        return;
                    }else{
                        Dempty($(".u3"));
                    } 

                    $.ajax({
                            url : "<?= Url::to(['site/sign'])?>",//具体的url 根据项目的路径自己调下
                            type : 'post',
                            data : {"name":name,"pwd":pwd},
                            dataType : 'json',
                            async : false,
                            success : function(data){
                                    if(data.result){
                                        alert("注册成功");
                                        window.location.href="<?= Url::to(['site/login'])?>";
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

