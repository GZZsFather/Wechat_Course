<?php
namespace Admin\Controller;
use Think\Controller;

class CourseManageController extends Controller{
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


    $OpenCourse = M("OpenCourse");
    $CourseCount = $OpenCourse->where("xq = '%s'",$Semester)->count();
    $CoursePage = new \Think\Page($CourseCount,10);
    $OpenList = $OpenCourse->where("xq = '%s'",$Semester)
      ->field("open_course.kh,course.km,open_course.gh,teacher.xm,open_course.sksj")
      ->join("teacher on teacher.gh = open_course.gh")
      ->join("course on course.kh = open_course.kh")
      ->limit($CoursePage->firstRow.','.$CoursePage->listRows)
      ->select();
    $Show = $CoursePage->show();
    $this->assign("CoursePage",$CoursePage);
    $this->assign("OpenList",$OpenList);


    $OpenApply = M("OpenApply");
    $count = $OpenApply->where("status = 'Auditing'")->count();
    $ApplyPage = new \Think\Page($count,10);
    $ApplyList = $OpenApply->where("status = 'Auditing'")
      ->field("open_apply.id,course.km,open_apply.kh,A.xm as teacher,B.xm as applier,open_apply.sksj")
      ->join("teacher as A on A.gh = open_apply.gh")
      ->join("teacher as B on B.gh = open_apply.applier")
      ->join("course on course.kh = open_apply.kh")
      ->limit($ApplyPage->firstRow.','.$ApplyPage->listRows)
      ->select();
    $ApplyShow = $ApplyPage->show();
    $this->assign("ApplyPage",$ApplyShow);
    $this->assign("ApplyList",$ApplyList);


    $this->display();
  }

  public function NewCourse(){
    $Course = M("Course");
    $Course_id = I("post.course_id");
    $Course_name = I("post.course_name");
    $Department_id = I("post.department_id");
    $Grade = I("post.grade");
    $Price = I("post.price");
    $Intro = I("post.intro");

    if($Course_id && $Course_name && $Department_id && $Grade){

      if($Course->where("kh = '%s'",$Course_id)->find()){
        $this->error("课号重复");
      }

      if($Course->where("km = '%s'",$Course_name)->find()){
        $this->error("课名重复");
      }

      $data["kh"] = $Course_id;
      $data["km"] = $Course_name;
      $data["xf"] = $Grade;
      $data["jg"] = (float)$price;
      $data["intro"] = $Intro;
      $data["yxh"] = $Department_id;

      $Course->add($data);
      $this->success("添加成功！");

    }
    else{
      $this->error("除了简介每一项均必须填写");
    }

  }

  public function DeleteCourse(){
    $Course = M("Course");
    $SelectCourse = M("SelectCourse");
    $CourseName = I("post.course_name");
    $CourseId=I("post.course_id");

    if(!$CourseName && !$CourseId){
      $this->error('You should fill in either of them!');
    }

    if($CourseName){
      $condition["km"] = $CourseName;
    }
    if($CourseId){
      $condition["kh"] = $CourseId;
    }

    $HasResult = $SelectCourse->where("kh = %s",$CourseId)->find();
    if($HasResult){
      $this->error("此课程已有人选修 无法删除！");
    }

    $Result = $Course->where($condition)->find();
    if($Result){
      if($CourseName){
        $km = $CourseName;
      }
      else{
        $km = $Result['km'];
      }
      $Course->where($condition)->delete();
      $this->success("课程 ".$km." 删除成功!");
    }
    else{
      $this->error("课程不存在！");
    }
  }

  public function Agree(){
    $Id = I("post.id");
    $OpenApply = M("OpenApply");
    $OpenCourse = M("OpenCourse");
    $Result = $OpenApply->where("id = %s",$Id)->select();

    if($Result){
      if($Result[0]["status"] == "Auditing"){
        $data["xq"] = $Result[0]["xq"];
        $data["kh"] = $Result[0]["kh"];
        $data["gh"] = $Result[0]["gh"];
        $data["sksj"] = $Result[0]["sksj"];
        $OpenCourse->add($data);

        $OpenApply->status="Agreed";
        $OpenApply->where("id = %s",$Id)->save();
        $this->success("Agreed success!");
      }
      elseif($Result[0]["status"] == "Denied"){
        $this->error("You've already rejected it!");
      }
      elseif($Result[0]["status"] == "Agreed"){
        $this->error("You've already agreeed it!");
      }
    }
    else{
      $this->error("No such apply!");
    }
  }

  public function Reject(){
    $Id = I("post.id");

    $OpenApply = M("OpenApply");
    $Result = $OpenApply->where("id = %s",$Id)->select();

    if($Result){
      if($Result[0]["status"] == "Auditing"){
        $OpenApply->status="Denied";
        $OpenApply->where("id = %s",$Id)->save();
        $this->success("Rejected success!");
      }
      elseif($Result[0]["status"] == "Denied"){
        $this->error("You've already rejected it!");
      }
      elseif($Result[0]["status"] == "Agreed"){
        $this->error("You've already agreeed it!");
      }
    }
    else{
      $this->error("No such apply!");
    }

  }
}
 ?>
