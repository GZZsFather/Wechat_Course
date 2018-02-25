<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>
<head>
 <title>Index</title>
   <meta name="viewport" content="width=device-width, initial-scale=1" />
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
 <h1>Select Page</h1>
 <h2><?php echo (session('username')); ?></h2>
 <h3><?php echo (session('name')); ?></h3>

 <div>
   <form action="/index.php/Home/Student/SelectCourse" method="post" id="SelectCourse">
     <input type="text" name="course_id" class="course_id" placeholder="Course_id" required="">
     <input type="text" name="teacher_id" class="teacher_id" placeholder="Teacher_id" required="">
     <input type="submit" value="SelectCourse">
   </form>
 </div>

 <div class="footer-w3l">
   <p class="agile"> &copy; 2018 GZZsFather</a></p>
 </div>
</body>
</html>