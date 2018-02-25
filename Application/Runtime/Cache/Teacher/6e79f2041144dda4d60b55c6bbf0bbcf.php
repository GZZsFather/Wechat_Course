<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>Search</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="/Public/assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME ICONS  -->
    <link href="/Public/assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="/Public/assets/css/style.css" rel="stylesheet" />
     <!-- HTML5 Shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <strong>Email: </strong>zxkarl150130@gmail.com
                    &nbsp;&nbsp;
                    <strong>Support: </strong>+90-897-678-44
                </div>

            </div>
        </div>
    </header>
    <!-- HEADER END-->
    <div class="navbar navbar-inverse set-radius-zero">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">

                    <img src="/Public/assets/img/logo.png" />
                </a>

            </div>

            <div class="left-div">
                <div class="user-settings-wrapper">
                    <ul class="nav">

                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                                <span class="glyphicon glyphicon-user" style="font-size: 25px;"></span>
                            </a>
                            <div class="dropdown-menu dropdown-settings">
                                <div class="media">
                                    <a class="media-left" href="#">
                                        <img src="/Public/assets/img/64-64.jpg" alt="" class="img-rounded" />
                                    </a>
                                    <div class="media-body">
                                      <h4 class="media-heading"><?php echo (session('name')); ?> </h4>
                                      <h5><?php echo (session('user_id')); ?></h5>
                                      <h6><?php echo (session('occupation')); ?></h6>

                                    </div>
                                </div>
                                <hr />
                                <h5><strong>Personal Bio : </strong></h5>
                                Empty is beauty.
                                <hr />
                                <!-- <a href="#" class="btn btn-info btn-sm">Full Profile</a>&nbsp; <a href="login.html" class="btn btn-danger btn-sm">Logout</a> -->
                                <form  action="/index.php/Home/user/Logout" method="post" id="logout">
                                  <button type="submit" class="btn btn-info btn-sm">Logout</button>&nbsp;
                                </form>

                            </div>
                        </li>


                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- LOGO HEADER END-->
    <section class="menu-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">
                            <li><a href="/index.php/Teacher/">Index</a></li>
                            <li><a href="/index.php/Teacher/Course">Course</a></li>
                            <li><a class="menu-top-active" href="">Search Course</a></li>
                            <li><a  href="/index.php/Teacher/Score">Scores</a></li>


                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line">Search Page</h4>

                </div>

            </div>
            <div class="col-md-1">
            </div>
            <div class="col-md-10">
              <div class="panel panel-default">
              <div class="panel-heading">
                 Search Course
              </div>
              <div class="panel-body">
                <form action="/index.php/Teacher/Search/SearchCourse" method="post" id="SelectCourse">
                  <div class="col-md-3">
                    课程号:<input type="text" class="form-control" id="course_id" name="course_id" placeholder="请输入课号" />
                    <p><p>
                    教师号:<input type="text" class="form-control" id="teacher_id" name="teacher_id" placeholder="请输入教师号" />
                    <p><p>
                    课程名称:<input type="text" class="form-control" id="course_name" name="course_name" placeholder="请输入课程名称" />
                    <p><p>

                  </div>
                  <div class="col-md-6">
                    <div class="col-md-6">
                      教师名称:<input type="text" class="form-control" id="teacher_name" name="teacher_name" placeholder="请输入教师名称" />
                      <p><p>
                      学分数:<input type="text" class="form-control" id="grades" name="grades" placeholder="请输入学分数" />
                      <p><p>
                        <div>学期:</div>
                        <select class="form-control" name="semester">
                          <option>2012-2013 春季</option>
                          <option>2012-2013 夏季</option>
                          <option>2012-2013 秋季</option>
                          <option>2012-2013 冬季</option>
                          <option>2013-2014 春季</option>
                          <option>2013-2014 夏季</option>
                          <option>2013-2014 秋季</option>
                          <option>2013-2014 冬季</option>
                          <option>2013-2014 春季</option>
                          <option>2013-2014 夏季</option>
                          <option>2013-2014 秋季</option>
                          <option>2013-2014 冬季</option>
                          <option>2014-2015 冬季</option>
                          <option>2014-2015 春季</option>
                          <option>2014-2015 夏季</option>
                          <option>2014-2015 秋季</option>
                          <option>2014-2015 冬季</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">

                                      <div>日:</div>
                                      <select class="form-control" name="day">
                                        <option>empty</option>
                                        <option>一</option>
                                        <option>二</option>
                                        <option>三</option>
                                        <option>四</option>
                                        <option>五</option>
                                        <option>六</option>
                                        <option>日</option>
                                      </select>
                                      <p><p>

                                      <div>开始时间:</div>
                                      <select class="form-control" name="begin">
                                          <option>empty</option>
                                          <option>1</option>
                                          <option>2</option>
                                          <option>3</option>
                                          <option>4</option>
                                          <option>5</option>
                                          <option>6</option>
                                          <option>7</option>
                                          <option>8</option>
                                          <option>9</option>
                                          <option>10</option>
                                          <option>11</option>
                                          <option>12</option>
                                          <option>13</option>
                                      </select>
                                      <p><p>
                                      <div>结束时间:</div>
                                      <select class="form-control" name="end">
                                        <option>empty</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                        <option>8</option>
                                        <option>9</option>
                                        <option>10</option>
                                        <option>11</option>
                                        <option>12</option>
                                        <option>13</option>
                                      </select>
                                  </div>
                    </div>

                    <p><p>
                  </div>
                  <div class="col-md-1">
                    <br>
                      <button type="submit" class="btn btn-default">Search</button>
                      <!-- <div><?php echo ($count); ?></div> -->
                  </div>
                </div>
              </div>

                </form>
            </div>


            <div class="col-md-12">
              <div class="row">
                  <div class="col-md-12">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                  <tr>
                                      <th>任课老师</th>
                                      <th>工号</th>
                                      <th>课号</th>
                                      <th>课名</th>
                                      <th>上课时间</th>
                                      <th>学分</th>

                                  </tr>
                                </thead>
                                <tbody>
                                  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                     <td><?php echo ($vo["xm"]); ?></td>
                                     <td><?php echo ($vo["gh"]); ?></td>
                                     <td><?php echo ($vo["kh"]); ?></td>
                                     <td><?php echo ($vo["km"]); ?></td>
                                     <td><?php echo ($vo["sksj"]); ?></td>
                                     <td><?php echo ($vo["xf"]); ?></td>

                                   </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
                            <div class="result page"><?php echo ($page); ?></div>
                        </div>
                    </div>
                  </div>

              </div>

            </div>


        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    &copy; 2018 GZZsDad | By : <a href="http://www.designbootstrap.com/" target="_blank">DesignBootstrap</a>
                </div>

            </div>
        </div>
    </footer>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="/Public/assets/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="/Public/assets/js/bootstrap.js"></script>
</body>
</html>