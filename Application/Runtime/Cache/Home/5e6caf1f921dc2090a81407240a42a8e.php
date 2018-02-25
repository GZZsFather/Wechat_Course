<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>
<head>
 <title>Index</title>
   <meta name="viewport" content="width=device-width, initial-scale=1" />
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
 <h1>Student Index</h1>
 <h2><?php echo (session('studnet_id')); ?></h2>
 <h3><?php echo (session('name')); ?></h3>
 <div>
    <a href = '/index.php/Home/Student/SelectCourses.html'>Select Course</a><br>
    <a href = '/index.php/Home/Student/DeletePage.html'>Delete Course</a><br>
    <a href = '/index.php/Home/Student/SelectedCourses.html'>Selected Courses</a><br>
    <a href = ''>delete course</a><br>
 </div>

 <div>
   <table>
     <thead>
         <tr>
             <th>#</th>
             <th>xh</th>
             <th>gh</th>
             <th>kh</th>
         </tr>
     </thead>
     <tbody>
       <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
          <td></td>
          <td><?php echo ($vo["xh"]); ?></td>
          <td><?php echo ($vo["gh"]); ?></td>
          <td><?php echo ($vo["kh"]); ?></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
     </tbody>
   </table>

 </div>
 <div class="result page"><?php echo ($page); ?></div>

 <div class="footer-w3l">
   <p class="agile"> &copy; 2018 GZZsFather</a></p>
 </div>
</body>
</html>