<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>Staff Manage</title>
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
                            <li><a href="/index.php/Admin/">Index</a></li>
                            <li><a href="/index.php/Admin/CourseManage">Course Manage</a></li>
                            <li><a href="/index.php/Admin/Search">Search Course</a></li>
                            <li><a class="menu-top-active" href="">Staff Manage</a></li>


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
                    <h4 class="page-head-line">Staff Manage</h4>

                </div>

            </div>
            <div class="col-md-13">


              <div class="col-md-6">
                <div class="panel panel-default">
                <div class="panel-heading">
                   New Student
                </div>
                <div class="panel-body">
                  <form action="/index.php/Admin/StaffManage/NewStudent" method="post" id="SelectCourse">
                    <div class="col-md-5">
                      姓名:<input type="text" class="form-control" id="student_name" name="student_name" placeholder="请输入姓名" />
                      <p><p>
                      学号:<input type="text" class="form-control" id="student_id" name="student_id" placeholder="请输入学号" />
                      <p><p>
                      籍贯:
                      <input type="text" class="form-control" id="jg" name="jg" placeholder="请输入籍贯" />
                      <p><p>
                      联系电话:<p><p>
                      <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="联系电话" />
                      <p><p>



                    </div>
                    <div class="col-md-5">
                      <div>出生日期:</div>
                      <select class="form-control" name="year">
                        <option>1990</option>
                        <option>1991</option>
                        <option>1992</option>
                        <option>1993</option>
                        <option>1994</option>
                        <option>1995</option>
                        <option>1996</option>
                        <option>1997</option>
                        <option>1998</option>
                        <option>1999</option>
                      </select>
                      <p><p>
                        <select class="form-control" name="month">
                          <option>01</option>
                          <option>02</option>
                          <option>03</option>
                          <option>04</option>
                          <option>05</option>
                          <option>06</option>
                          <option>07</option>
                          <option>08</option>
                          <option>09</option>
                          <option>10</option>
                          <option>10</option>
                          <option>12</option>
                        </select>
                        <p><p>
                        <select class="form-control" name="day">
                          <option>01</option>
                          <option>02</option>
                          <option>03</option>
                          <option>04</option>
                          <option>05</option>
                          <option>06</option>
                          <option>07</option>
                          <option>08</option>
                          <option>09</option>
                          <option>10</option>
                          <option>10</option>
                          <option>12</option>
                          <option>13</option>
                          <option>14</option>
                          <option>15</option>
                          <option>16</option>
                          <option>17</option>
                          <option>18</option>
                          <option>19</option>
                          <option>20</option>
                          <option>21</option>
                          <option>22</option>
                          <option>23</option>
                          <option>24</option>
                          <option>25</option>
                          <option>26</option>
                          <option>27</option>
                          <option>28</option>
                          <option>29</option>
                          <option>30</option>
                          <option>31</option>
                        </select>
                        <p><p>
                        <div>性别:</div>
                        <select class="form-control" name="gender">
                          <option>男</option>
                          <option>女</option>
                        </select>
                        <p><p>
                          <div>院系号:</div>
                          <select class="form-control" name="department_id">
                            <option>01</option>
                            <option>02</option>
                            <option>03</option>
                          </select>
                          <p><p>

                    </div>

                    <div class="col-md-1">
                        <br>
                        <button type="submit" class="btn btn-default">New</button>
                        <!-- <div><?php echo ($count); ?></div> -->
                    </div>
                  </div>
                </div>

                  </form>
              </div>

              <div class="col-md-6">
                <div class="panel panel-default">
                <div class="panel-heading">
                   New Teacher
                </div>
                <div class="panel-body">
                  <form action="/index.php/Admin/StaffManage/NewTeacher" method="post" id="SelectCourse">
                    <div class="col-md-5">
                      姓名:<input type="text" class="form-control" id="teacher_name" name="teacher_name" placeholder="请输入姓名" />
                      <p><p>
                      工号:<input type="text" class="form-control" id="teacher_id" name="teacher_id" placeholder="请输入工号" />
                      <p><p>
                      基本工资
                      <input type="text" class="form-control" id="jbgz" name="jbgz" placeholder="请输入基本工资" />
                      <p><p>
                      学历:<p><p>
                      <input type="text" class="form-control" id="education" name="education" placeholder="学历" />
                      <p><p>



                    </div>
                    <div class="col-md-5">
                      <div>出生日期:</div>
                      <select class="form-control" name="year">
                        <option>1970</option>
                        <option>1971</option>
                        <option>1972</option>
                        <option>1973</option>
                        <option>1974</option>
                        <option>1975</option>
                        <option>1976</option>
                        <option>1977</option>
                        <option>1978</option>
                        <option>1979</option>
                        <option>1980</option>
                        <option>1981</option>
                        <option>1982</option>
                        <option>1983</option>
                        <option>1984</option>
                        <option>1985</option>
                        <option>1986</option>
                        <option>1987</option>
                        <option>1988</option>
                        <option>1989</option>
                        <option>1990</option>
                      </select>
                      <p><p>
                        <select class="form-control" name="month">
                          <option>01</option>
                          <option>02</option>
                          <option>03</option>
                          <option>04</option>
                          <option>05</option>
                          <option>06</option>
                          <option>07</option>
                          <option>08</option>
                          <option>09</option>
                          <option>10</option>
                          <option>10</option>
                          <option>12</option>
                        </select>
                        <p><p>
                        <select class="form-control" name="day">
                          <option>01</option>
                          <option>02</option>
                          <option>03</option>
                          <option>04</option>
                          <option>05</option>
                          <option>06</option>
                          <option>07</option>
                          <option>08</option>
                          <option>09</option>
                          <option>10</option>
                          <option>10</option>
                          <option>12</option>
                          <option>13</option>
                          <option>14</option>
                          <option>15</option>
                          <option>16</option>
                          <option>17</option>
                          <option>18</option>
                          <option>19</option>
                          <option>20</option>
                          <option>21</option>
                          <option>22</option>
                          <option>23</option>
                          <option>24</option>
                          <option>25</option>
                          <option>26</option>
                          <option>27</option>
                          <option>28</option>
                          <option>29</option>
                          <option>30</option>
                          <option>31</option>
                        </select>
                        <p><p>
                        <div>性别:</div>
                        <select class="form-control" name="gender">
                          <option>男</option>
                          <option>女</option>
                        </select>
                        <p><p>
                          <div>院系号:</div>
                          <select class="form-control" name="department_id">
                            <option>01</option>
                            <option>02</option>
                            <option>03</option>
                          </select>
                          <p><p>

                    </div>

                    <div class="col-md-1">
                        <br>
                        <button type="submit" class="btn btn-default">New</button>
                        <!-- <div><?php echo ($count); ?></div> -->
                    </div>
                  </div>
                </div>

                  </form>
              </div>


            <div class="row">
              <div class="col-md-4">
                <div class="panel panel-default">
                  <div class="panel-heading">
                     Delete Student
                  </div>
                  <div class="panel-body">
                    <div class="col-md-10">
                      <form action="/index.php/Admin/StaffManage/DeleteStudent" method="post">
                          <hr/>
                          学号:<input type="text" class="form-control" id="student_id" name="student_id" placeholder="请输入学号" />
                          <p><p>
                          姓名:<input type="text" class="form-control" id="student_name" name="student_name" placeholder="请输入姓名" />
                          <p><p>
                            <br>

                          <button type="submit" class="btn btn-default">Delete</button>
                          <hr/>
                      </form>
                  </div>
                </div>

              </div>
            </div>


            <div class="col-md-4">
              <div class="panel panel-default">
                <div class="panel-heading">
                   Delete Teacher
                </div>
                <div class="panel-body">
                  <div class="col-md-10">
                    <form action="/index.php/Admin/StaffManage/DeleteTeacher" method="post">
                        <hr/>
                        工号:<input type="text" class="form-control" id="teacher_id" name="teacher_id" placeholder="请输入工号" />
                        <p><p>
                        姓名:<input type="text" class="form-control" id="teacher_name" name="teacher_name" placeholder="请输入姓名" />
                        <p><p>
                          <br>

                        <button type="submit" class="btn btn-default">Delete</button>
                        <hr/>
                    </form>
                </div>
              </div>

            </div>
          </div>

          <div class="col-md-4">
            <div class="panel panel-default">
              <div class="panel-heading">
                 Delete OpenCourse
              </div>
              <div class="panel-body">
                <div class="col-md-10">
                  <form action="/index.php/Admin/StaffManage/DeleteOpenCourse" method="post">

                      工号:<input type="text" class="form-control" id="teacher_id" name="teacher_id" placeholder="请输入工号" />
                      <p><p>
                      课号:<input type="text" class="form-control" id="course_id" name="course_id" placeholder="请输入课号" />
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
                      <p><p>

                      <button type="submit" class="btn btn-default">Delete</button>
                      <hr/>
                  </form>
              </div>
            </div>

          </div>
        </div>



            </div>

            <div class="col-md-6">
              <div class="panel panel-default">
              <div class="panel-heading">
                 Teacher List
              </div>
              <div class="row">
                  <div class="col-md-12">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                  <tr>
                                      <th>学院</th>
                                      <th>工号</th>
                                      <th>姓名</th>
                                      <th>性别</th>
                                      <th>出生日期</th>
                                      <th>学历</th>

                                  </tr>
                                </thead>
                                <tbody>
                                  <?php if(is_array($TeacherList)): $i = 0; $__LIST__ = $TeacherList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                     <td><?php echo ($vo["mc"]); ?></td>
                                     <td><?php echo ($vo["gh"]); ?></td>
                                     <td><?php echo ($vo["xm"]); ?></td>
                                     <td><?php echo ($vo["xb"]); ?></td>
                                     <td><?php echo ($vo["csrq"]); ?></td>
                                     <td><?php echo ($vo["xl"]); ?></td>

                                   </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                  <div class="result page"><?php echo ($CoursePage); ?></div>
                                </tbody>
                            </table>

                        </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>


            <div class="col-md-6">
              <div class="panel panel-default">
              <div class="panel-heading">
                 Student List
              </div>
              <div class="row">
                  <div class="col-md-12">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                  <tr>
                                      <th>学院</th>
                                      <th>学号</th>
                                      <th>姓名</th>
                                      <th>性别</th>
                                      <th>出生日期</th>
                                      <th>籍贯</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php if(is_array($StudentList)): $i = 0; $__LIST__ = $StudentList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                     <td><?php echo ($vo["mc"]); ?></td>
                                     <td><?php echo ($vo["xh"]); ?></td>
                                     <td><?php echo ($vo["xm"]); ?></td>
                                     <td><?php echo ($vo["xb"]); ?></td>
                                     <td><?php echo ($vo["csrq"]); ?></td>
                                     <td><?php echo ($vo["jg"]); ?></td>

                                   </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
                            <div class="result page"><?php echo ($StudentPage); ?></div>
                        </div>
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