<?php
namespace Teacher\Controller;
use Think\Controller;

class CourseController extends Controller{
  public function index(){

    $Occupation = I("session.occupation");
    $Teacher_id = I("session.user_id");
    $Semester = C('Time_Now');
    if(!$Occupation){
      $this->error("Log in first!");
    }
    if($Occupation == "Student"){
      $this->error("This page is only available for teachers!",U("/Student"));
    }
    if($Occupation == "Admin"){
      $this->error("This page is only available for teachers!",U("/Admin"));
    }

    $OpenCourse = M("OpenCourse");
    $OpenApply = M("OpenApply");
    $CourseList = $OpenCourse->where("open_course.gh = %s and open_course.xq = '%s'",array($Teacher_id,$Semester))
      ->field("open_course.kh,course.km,open_course.sksj,course.xf")
      ->join("course on open_course.kh = course.kh")
      ->select();

    $count = $OpenApply->where("applier = %s",$Teacher_id)->count();

    $ApplyPage = new \Think\Page($count,10);
    $ApplyList = $OpenApply->where("applier = %s",$Teacher_id)
      ->field("open_apply.kh,course.km,open_apply.sksj,course.xf,open_apply.status,open_apply.id")
      ->join("course on open_apply.kh = course.kh")
      ->limit($ApplyPage->firstRow.','.$ApplyPage->listRows)
      ->select();

    $ApplyShow = $ApplyPage->show();
    $this->assign("ApplyList",$ApplyList);
    $this->assign("CourseList",$CourseList);
    $this->assign("ApplyPage",$ApplyPage);

    $this->display();
  }

  public function OpenCourse(){
    $OpenApply = M("OpenApply");
    $Course = M("Course");
    $Teacher = M("Teacher");

    $Teacher_id = I("session.user_id");
    $Semester = C('Time_Now');

    $Course_id = I("post.course_id");
    $Post_Teacher_id = I("post.teacher_id");

    $Year = I("post.year");
    $Season = I("post.season");
    $Day = I("post.day");
    $Begin = I("post.begin");
    $End = I("post.end");

    if(!$Course_id || !$Teacher_id || $Day == "empty" || $Begin == "empty" || $End == "empty"){
      $this->error("除了简介以外每一个项目都必须填写！");
    }

    $CourseResult = $Course->where("kh = %s",$Course_id)->find();
    $TeacherResult = $Teacher->where("gh = %s",$Post_Teacher_id)->find();
    if(!$CourseResult){
      $this->error("该课程不存在!");
    }
    if(!$TeacherResult){
      $this->error("老师不存在");
    }


    $Semester = $Year." ".$Season;
    $Time = $Day." ".$Begin."-".$End;

    $data["xq"] = $Semester;
    $data["gh"] = $Post_Teacher_id;
    $data["kh"] = $Course_id;
    $data["sksj"] = $Time;
    $data["applier"] = $Teacher_id;
    $data["status"]= "Auditing";

    $OpenApply->add($data);
    $this->success("申请成功！");


  }
}
 ?>
