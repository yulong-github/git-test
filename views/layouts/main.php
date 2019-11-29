<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;
use yii\web\Session;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="zh-CN" class="fontawesome-i2svg-active fontawesome-i2svg-complete">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>分享</title>
    <meta name="csrf-param" content="_csrf-frontend">
	<meta name="csrf-token" content="QpICVvZEfZcxe4KdoiN6EmRDv-mBNksF22wj0XlIKlcIyDQFjgssrkUR2_z7RQlmLyDvorF0A2H2AE6AMiIbCA==">
	<link href="/css/style.css" rel="stylesheet">
	<link href="/css/bootstrap.css" rel="stylesheet">
	<link href="/css/default.css" rel="stylesheet">
	<link type="image/x-icon" href="favicon.ico" rel="shortcut icon">
	<link href="/css/jquery.atwho.min.css" rel="stylesheet">
	<link href="/css/emojione.min.css" rel="stylesheet">
	<link href="/css/site.css" rel="stylesheet">
	
	<script src="/js/jquery.js"></script>
	<script src="/js/bootstrap.bundle.js"></script>
	<script src="/js/all.min.js"></script>
	<script src="/js/yii.js"></script>
	<script src="/js/highlight.pack.js"></script>
	<script src="/js/iscroll.js"></script>
	<script src="/js/infinite-scroll.pkgd.js"></script>
	<script src="/js/jquery.caret.min.js"></script>
	<script src="/js/jquery.atwho.min.js"></script>

	<!--<script src="/js/main.js"></script> -->
	
	

    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
	<header>
		<nav id="w5" class="navbar navbar-expand-lg navbar-light bg-light border-bottom shadow-sm fixed-top" role="navigation">
			<div class="container">
				<a class="navbar-brand" href=" /">分享</a>
				<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#w5-collapse" aria-controls="w5-collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div id="w5-collapse" class="collapse navbar-collapse">
					<ul id="w6" class="navbar-nav mr-auto nav">
						<!--<li class="nav-item"><a class="nav-link active" href="/">首页</a></li>-->
						<!--<li class="nav-item"><a class="nav-link" href=" https://www.baidu.com/group">圈子</a></li>
						<li class="nav-item"><a class="nav-link" href=" https://www.baidu.com/feed">微话题</a></li>
						<li class="nav-item"><a class="nav-link" href=" https://www.baidu.com/top">排行</a></li>
						<li class="nav-item"><a class="nav-link" href=" https://www.baidu.com/timeline">时间线</a></li>
						-->
					</ul>
					<!--<form class="form-inline d-none d-md-block" action=" https://www.baidu.com/search/global" method="get">
						<div class="input-group"><input type="text" id="search" class="form-control" name="q" placeholder="全站搜索" autocomplete="off">
							<span class="input-group-append">
								<button type="submit" class="btn btn-secondary d-none d-md-block">
									<svg class="svg-inline--fa fa-search fa-w-16" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="search" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""></svg>
								</button>
							</span>
						</div>
						<div id="search-resultbox"></div>
					</form> -->
                                        <?php
                                            if(empty(Yii::$app->session['user'])){
                                        ?>
					<ul id="w7" class="navbar-nav nav">
                                            <li class="nav-item"><a class="nav-link" href="<?= Url::to(["site/sign"])?>">注册<?= Yii::$app->session['user']['id']?></a></li>
                                            <li class="nav-item"><a class="nav-link" href="<?= Url::to(["site/login"])?>">登录</a></li>
					</ul>
                                        <?php
                                            }else{
                                        ?>
                                        <ul id="w3" class="navbar-nav nav">
                                            <li class="dropdown nav-item">
                                                <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><?= Yii::$app->session['user']['username']?> </a>
                                                <div id="w5" class="dropdown-menu"><a class="dropdown-item" href="<?= Url::to(['user/index'])?>">个人主页</a>
                                                    <a class="dropdown-item" href="#">我的积分</a>
                                                    <a class="dropdown-item" href="<?= Url::to(["site/logout"])?>" data-method="post">退出登录</a>
                                                </div>
                                            </li>
                                        </ul>
                                        <?php 
                                            }
                                        ?>
				</div>
			</div>
		</nav>
	</header>

	<?= $content ?>


	<footer class="footer mt-auto py-3">
		<div class="container">
			<div class="d-flex">
				<span class="mr-auto">Copyright © 2019 by <a href="https://www.yiichina.com/">Yii China</a>. <span class="d-none d-sm-inline">All Rights Reserved.</span></span>
				<span class="d-none d-lg-inline">
					技术支持 <a href="http://www.yiiframework.com/" rel="external">Yii 框架</a> v2.0.23. 京ICP备09104811号-2            </span>
			</div>
		</div>
	</footer>

	
	
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
