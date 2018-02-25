<?php
namespace Admin\Controller;
use Think\Controller;

class StaffManageController extends Controller{
  public function index(){
    $Occupation = I("session.occupation");
    $Admin_id = I("session.user_id");
    $Semester = C('Time_Now');
    if(!$Occupation){
      $this->error("Log in first!");
    }
    if($Occupation != "Admin"){
      if($Occupation == "Student"){
        $this->error("This page is only available for Admin!",U("/Student"));
      }
      else{
        $this->error("This page is only available for Admin!",U("/Teacher"));
      }
    }

    $Student = M("Student");
    $Teacher = M("Teacher");

    $StudentCount = $Student->count();
    $TeacherCount = $Teacher->count();

    $StudentPage = new \Think\Page($StudentCount,10);
    $TeacherPage = new \Think\Page($TeacherCount,10);

    $StudentList = $Student
      ->field("department.mc,student.xh,student.xm,student.xb,student.csrq,student.jg")
      ->join("department on department.yxh = student.yxh")
      ->limit($StudentPage->firstRow.','.$StudentPage->listRows)
      ->select();
    $TeacherList = $Teacher
      ->field("department.mc,teacher.gh,teacher.xm,teacher.xb,teacher.csrq,teacher.xl")
      ->join("department on department.yxh = teacher.yxh")
      ->limit($TeacherPage->firstRow.",".$TeacherPage->listRows)
      ->select();
    $StudentShow = $StudentPage->show();
    $TeacherShow = $TeacherPage->show();
    $this->assign("StudentList",$StudentList);
    $this->assign("TeacherList",$TeacherList);
    $this->assign("StudentPage",$StudentShow);
    $this->assign("TeacherPage",$TeacherShow);

    $this->display();
  }

  public function NewStudent(){
    $Student_name = I("post.student_name");
    $Student_id = I("post.student_id");
    $JG = I("post.jg");
    $Phone_number = I("post.phone_number");
    $Gender = I("post.gender");
    $Department_id = I("post.department_id");
    $Year = I("post.year");
    $Month = I("post.month");
    $Day = I("post.day");

    $Student = M("Student");

    $query_csrq = $Year."-".$Month."-".$Day;

    if(!$Student_name || !$Student_id || !$JG || !$Phone_number){
        $this->error("每一项都必须填写！");
    }

    $Result = $Student->where("xh = '%s'",$Student_id)->find();
    if($Result){
      $this->error("学号已存在!");
    }

    $data['xm'] = $Student_name;
    $data["xh"] = $Student_id;
    $data["xb"] = $Gender;
    $data["csrq"] = $query_csrq;
    $data["jg"] = $JG;
    $data["sjhm"] = $Phone_number;
    $data["yxh"] = $Department_id;
    $data["passwd"] = "123456";

    $Student->add($data);
    $this->success("添加成功！");

  }

  public function DeleteStudent(){
    $Student_name = I("post.student_name");
    $Student_id = I("post.student_id");

    if(!$Student_name && !$Student_id){
      $this->error("You should fill in either of them!");
    }

    $Student = M("Student");
    $SelectCourse = M("SelectCourse");

    if($Student_id){
      $Result1 = $SelectCourse->where("xh = %s",$Student_id)->find();
        if($Result1){
          $this->error("这名学生已经选过课，不能删除！");
          //此处若是有需求可以改成在删除学生之前删除他的所有选课信息
        }

      if($Student_name){
        $Result = $Student->where("xm = '%s' and xh = %s",array($Student_name,$Student_id))->find();
        if($Result){
            $Student->where('xh = %s',$Student_id)->delete();
            $this->success("删除成功！");
        }
        else{
          $this->error('查无此人！');
        }
      }
      else{
        $Student->where('xh = %s',$Student_id)->delete();
        $this->success("删除成功！");
      }

    }
    else{
      $count = $Student->where("xm = '%s'",$Student_name)->count();
      if($count == 1){

        $StudentList = $Student->where("xm = '%s'",$Student_name)->find();
        $Student_id = $StudentList["xh"];
        $Result1 = $SelectCourse->where("xh = %s",$Student_id)->find();
        if($Result1){
          $this->error("这名学生已经选过课，不能删除！");
          //此处若是有需求可以改成在删除学生之前删除他的所有选课信息
        }
        $Student->where("xm = '%s'",$Student_name)->delete();
        $this->success('删除成功！');
      }
      elseif($count == 0){
        $this->error('查无此人！');
      }
      elseif($count >1){
        $this->error('有重名 请用学号删除！');
      }
    }

  }

  public function NewTeacher(){
    $Teacher_name = I("post.teacher_name");
    $Teacher_id = I("post.teacher_id");
    $JBGZ = I("post.jbgz");
    $Education = I("post.education");
    $Gender = I("post.gender");
    $Department_id = I("post.department_id");
    $Year = I("post.year");
    $Month = I("post.month");
    $Day = I("post.day");

    $query_csrq = $Year."-".$Month."-".$Day;

    $Teacher = M("Teacher");

    if(!$Teacher_name || !$Teacher_id || !$JBGZ || !$Education){
      $this->error("每一项均为必填！");
    }

    $Result = $Teacher->where("gh = %s",$Teacher_id)->find();
    if($Result){
      $this->error("工号已经存在！");
    }

    $data["gh"] = $Teacher_id;
    $data["xm"] = $Teacher_name;
    $data["xb"] = $Gender;
    $data["csrq"] = $query_csrq;
    $data["xl"] = $Education;
    $data["yxh"] = $Department_id;
    $data["jbgz"] = (int)$JBGZ;
    $data["passwd"] = "123456";

    $Teacher->add($data);
    $this->success("添加成功！");



  }

  public function DeleteTeacher(){

    $Teacher_id = I("post.teacher_id");
    $Teacher_name = I("post.teacher_name");
    $Semester = C("Time_Now");
    $OpenCourse = M("OpenCourse");
    $Teacher = M("Teacher");

    if($Teacher_id){
      $Result1 = $OpenCourse->where("gh = %s",$Teacher_id)->find();
      // $Result1 = true;
        if($Result1){
          $this->error("这名教师已经开课，不能删除！");
          //此处若是有需求可以改成在删除和教师有关的所有信息
        }

      if($Teacher_name){
        $Result = $Teacher->where("xm = '%s' and gh = %s",array($Teacher_name,$Teacher_id))->find();
        if($Result){
            $Teacher->where("gh = %s",$Teacher_id)->delete();
            $this->success("删除成功！");
        }
        else{
          $this->error('查无此人！');
        }
      }
      else{
        $Teacher->where("gh = %s",$Teacher_id)->delete();
        $this->success("删除成功！");
      }

    }
    else{
      $count = $Teacher->where("xm = '%s'",$Teacher_name)->count();
      if($count == 1){

        $Teacher1 = $Teacher->where("xm = '%s'",$Teacher_name)->find();
        $Teacher_id = $Teacher1["gh"];
        $Result1 = $OpenCourse->where("gh = %s",$Teacher_id)->find();
        // $Result1 = True;
          if($Result1){
            $this->error("这名教师已经开课，不能删除！");
            //此处若是有需求可以改成在删除和教师有关的所有信息
          }
        $Teacher->where("xm = '%s'",$Teacher_name)->delete();
        $this->success('删除成功！');
      }
      elseif($count == 0){
        $this->error('查无此人！');
      }
      elseif($count >1){
        $this->error('有重名 请用学号删除！');
      }
    }

  }

  public function DeleteOpenCourse(){
    $Teacher_id = I("post.teacher_id");
    $Course_id = I("post.course_id");
    $Semester = I("post.semester");

    if(!$Teacher_id || !$Course_id || !$Semester){
      $this->error("You should fill in both of them");
    }

    $OpenCourse = M("OpenCourse");
    $SelectCourse = M("SelectCourse");

    $OpenResult = $OpenCourse->where("gh = %s and kh = %s and xq = '%s'",array($Teacher_id,$Course_id,$Semester))->find();
    if($OpenResult){
      $SelectResult = $SelectCourse->where("gh = %s and kh = %s and xq = '%s'",array($Teacher_id,$Course_id,$Semester))->find();
      if($SelectResult){
        $this->error("课程已有人选修，无法删除");
        //这部分后面可以改成相关项全部删除
      }
      else{
        $OpenCourse->where("gh = %s and kh = %s and xq = '%s'",array($Teacher_id,$Course_id,$Semester))->delete();
        $this->success("删除成功！");
      }
    }
    else{
      $this->error("课程未开设");
    }


  }
}
 ?>
