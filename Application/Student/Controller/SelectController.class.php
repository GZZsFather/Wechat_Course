<?php
namespace Student\Controller;
use Think\Controller;
class SelectController extends Controller {
    public function index(){
      // $this->show("Hello world");
      //把已选课程的参数传入前端

      $Occupation = I("session.occupation");

      if(!$Occupation){
        $this->error("Log in first!");
      }
      if($Occupation != "Student"){
        if($Occupation == "Admin"){
          $this->error("This page is only available for Student!",U("/Admin"));
        }
        else{
          $this->error("This page is only available for Student!",U("/Teacher"));
        }
      }

      $SelectCourse = M("SelectCourse");
      $Student_id = I("session.user_id");
      $Semester = C('Time_Now');
      // $Student_id = "15121103";


      $count = $SelectCourse->where("xh = %s and xq = '%s'",array($Student_id,$Semester))->count();
      $Page = new \Think\Page($count,10);
      $Selected = $SelectCourse->where("select_course.xh = %s and select_course.xq = '%s'",array($Student_id,$Semester))
      ->field("select_course.kh,course.km,teacher.xm,select_course.gh,open_course.sksj,course.xf")
      ->join("course on select_course.kh = course.kh")
      ->join("teacher on select_course.gh = teacher.gh")
      ->join("open_course on select_course.kh = open_course.kh and open_course.xq = select_course.xq")
      ->limit($Page->firstRow.','.$Page->listRows)->select();


      $Show = $Page->show();
      $this->assign('list',$Selected);
      $this->assign('page',$Show);
      $this->display();
    }

    public function SelectCourse(){

      $SelectCourse = M("SelectCourse");
      $OpenCourse = M("OpenCourse");

      $Course_id = I("post.course_id");
      $Teacher_id = I("post.teacher_id");
      $Student_id = I("session.user_id");

      $Semester = C('Time_Now');

      $selected = $SelectCourse->where("xh = %s and kh = %s and gh = %s and xq = '%s'",array($Student_id,$Course_id,$Teacher_id,$Semester))->find();
      if ($selected){
        $this->error("You have selected this course!");
      }
      else{
          $exist = $OpenCourse->where("kh = %s and gh = %s and xq = '%s'",array($Course_id,$Teacher_id,$Semester))->find();

          if($exist){
            $data['xh'] = $Student_id;
            $data['kh'] = $Course_id;
            $data['gh'] = $Teacher_id;
            $data['xq'] = $Semester;

            $SelectCourse->add($data);
            $this->success("Course selected successfully!","");

          }
          else{
            $this->error("Course not opened!");
          }
      }
    }

    public function DeleteCourse(){

          $SelectCourse = M("SelectCourse");
          $Course_id = I("post.course_id");
          $Teacher_id = I("post.teacher_id");
          $Student_id = I("session.user_id");

          $Semester = C('Time_Now');

          $selected = $SelectCourse->where("xh = %s and kh = %s and gh = %s and xq = '%s'",array($Student_id,$Course_id,$Teacher_id,$Semester))->find();
          if($selected){
            $SelectCourse->where("xh = %s and kh = %s and gh = %s and xq = '%s'",array($Student_id,$Course_id,$Teacher_id,$Semester))->delete();
            $this->success("Course deleted!");
          }
          else{
            $this->error("You haven't selected this course!");
          }
    }
}
