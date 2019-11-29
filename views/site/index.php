<?php
 use yii\helpers\Url;
?>	

<main role="main" class="container">
    <div class="row">
            <div class="col-lg-9">
                    <div id="w4" class="card mb-3">
                            <div class="card-header">

                                    <div class="dropdown d-block d-md-none">
                                            <a class="btn btn-outline-secondary " href="/" >
                                                    刷新
                                            </a>
                                    </div>
                                    <ul id="w2" class="nav nav-pills d-none d-md-flex">
                                            <li class="nav-item"><a class="active nav-link" href=" /">刷新</a></li>

                                    </ul>

                                    <div class="dropdown d-block d-md-none">
                                            <a class="btn btn-outline-secondary" href="#" >
                                                    发布
                                            </a>

                                    </div>
                                    <ul id="w2" class="nav nav-pills d-none d-md-flex">
                                        <li class="nav-item"><a class="active nav-link" href="<?= Url::to(["publish/publish"])?>">发布</a></li>

                                    </ul>
                            </div>
                            <div class="card-body p-0">
                                    <ul class="media-list">
                                            <li class="media" data-key="216">
                                                    <a class="mr-3" href=" #" rel="author">
                                                            <img src="./image/02_avatar_small.jpg" alt="╃巡洋艦㊣">
                                                    </a>
                                                    <div class="media-body">
                                                            <h2>
                                                                    <a href="#">人生首马-康保草原国际马拉松-成绩4小时29分</a>
                                                            </h2>
                                                            <div class="media-footer">
                                                                    <a href="#" rel="author">╃巡洋艦㊣1111</a> 
                                                                    发布于 1天前
                                                            </div>
                                                    </div>
                                                    <a href="#">
                                                            <svg class="svg-inline--fa fa-comment-medical fa-w-16" 
                                                            aria-hidden="true" focusable="false" data-prefix="fas" 
                                                            data-icon="comment-medical" role="img" xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 512 512" data-fa-i2svg="">
                                                            <path fill="currentColor" d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"></path>
                                                            </svg> &nbsp;2
                                                    </a> 
                                                    <!--<a href=" #" class="badge badge-primary align-self-center">2</a>-->
                                            </li>

                                    </ul>
                            </div>
                    </div>
            </div>

    <div class="col-lg-3">

            <div class="btn-group d-flex mb-3">
               <div class="card mb-3">
                            <div class="card-header">
                                    <h2>最新公告</h2>
                                    <a href="#">
                                            <svg class="svg-inline--fa fa-comment-medical fa-w-16" 
                                            aria-hidden="true" focusable="false" data-prefix="fas" 
                                            data-icon="comment-medical" role="img" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 512 512" data-fa-i2svg="">
                                            <path fill="currentColor" d="M256 32C114.62 32 0 125.12 0 240c0 49.56 21.41 95 57 130.74C44.46 421.05 2.7 466 2.2 466.5A8 8 0 0 0 8 480c66.26 0 116-31.75 140.6-51.38A304.66 304.66 0 0 0 256 448c141.39 0 256-93.12 256-208S397.39 32 256 32zm96 232a8 8 0 0 1-8 8h-56v56a8 8 0 0 1-8 8h-48a8 8 0 0 1-8-8v-56h-56a8 8 0 0 1-8-8v-48a8 8 0 0 1 8-8h56v-56a8 8 0 0 1 8-8h48a8 8 0 0 1 8 8v56h56a8 8 0 0 1 8 8z"></path></svg>
                                    </a>            
                            </div>
                            <div class="card-body">
                                    <ul class="media-list">
                                            <li class="media">
                                                    <a class="mr-2" href="#" rel="author"></a>
                                                    <div class="media-body">

                                                                    财富榜已入前八，功夫不负有心人
                                                                    财富榜已入前八，功夫不负有心人 财富榜已入前八，功夫不负有心人
                                                                    财富榜已入前八，功夫不负有心人 
                                                                    <div class="media-footer">
                                                                            1天前       
                                                                    </div>
                                                    </div>
                                            </li>

                                    </ul>
                            </div>
                    </div>
            </div>

    </div>
</main>