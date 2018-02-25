<?php
namespace Teacher\Controller;
use Think\Controller;

class ScoreController extends Controller{
  public function index(){
    $Occupation = I("session.occupation");
    if(!$Occupation){
      $this->error("Log in first!");
    }
    if($Occupation == "Student"){
      $this->error("This page is only available for teachers!",U("/Student"));
    }
    if($Occupation == "Admin"){
      $this->error("This page is only available for teachers!",U("/Admin"));
    }
    $this->display();
  }


  public function SearchScore(){
    $OpenCourse = M("OpenCourse");
    $SelectCourse = M("select_course");
    $Teacher_id = I("session.user_id");
    $Course_id = I("post.course_id");

    if(!$Course_id){
      $this->error("缺少课程号!");
    }

    $Year = I("post.year");
    $Season = I("post.season");

    $query_xq= $Year." ".$Season;

    $CourseResult = $OpenCourse->where("kh = %s and xq = '%s'",array($Course_id,$query_xq))->find();

    if(!$CourseResult){
      $this->error("课程未开设");
    }

    $condition["select_course.gh"] = $Teacher_id;
    $condition["select_course.xq"] = $query_xq;

    $OpenList = $OpenCourse->where("open_course.gh = %s and open_course.xq = '%s'",array($Teacher_id,$query_xq))
      ->field("open_course.kh,course.km")
      ->join("course on open_course.kh = course.kh")
      ->select();

    $list = $SelectCourse->where($condition)
      ->field("select_course.kh,course.km,course.xf,select_course.pscj,select_course.kscj,select_course.zpcj,student.xm,select_course.xh,select_course.xq")
      ->join("course on select_course.kh = course.kh")
      ->join("student on select_course.xh = student.xh")
      ->select();


    $ps_sum = 0;$ks_sum = 0;$zp_sum = 0;
    $ps_avg = 0;$ks_avg = 0;$zp_avg = 0;
    $count = 0;
    $fail_num = 0;
    foreach($list as $value){
      $count = $count +1;
      $ps_sum = $ps_sum + $value['pscj'];
      $ks_sum = $ks_sum + $value['kscj'];
      $zp_sum = $zp_sum + $value['zpcj'];
      if($value['zpcj']<60 && $value['pscj'] && $value['kscj']){
        $fail_num = $fail_num + 1;
      }
    }
    if($count != 0){
      $ps_avg = $ps_sum/$count;
      $ks_avg = $ks_sum/$count;
      $zp_avg = $zp_sum/$count;
    }
    $FailRate = $fail_num / $count;
    $Result['count'] = $count;
    $Result['FailRate'] = $FailRate*100;
    $Result['pscj_avg'] = $ps_avg;
    $Result['kscj_avg'] = $ks_avg;
    $Result['zpcj_avg'] = $zp_avg;

    $this->assign("OpenList",$OpenList);
    $this->assign('list',$list);
    $this->assign('xq',$query_xq);
    $this->assign('Result',$Result);
    $this->display("index");
  }

  public function Grading(){
    $Semester = C("Time_Now");
    $Teacher_id = I("session.user_id");
    $Student_id = I("post.student_id");
    $Course_id = I("post.course_id");
    $pscj = I("post.pscj");
    $kscj = I("post.kscj");
    $zpcj = I("post.zpcj");

    $OpenCourse = M("OpenCourse");
    $OpenResult = $OpenCourse->where("gh = %s and xq = '%s'",array($Teacher_id,$Semester))->find();

    if(!$OpenResult){
      $this->error("您本学期没有开设这门课程。");
    }

    $condition["xq"] = $Semester;
    $condition["xh"] = $Student_id;
    $condition["gh"] = $Teacher_id;

    $data["pscj"] = $pscj;
    $data["kscj"] = $kscj;
    $data["zpcj"] = $zpcj;

    $SelectCourse = M("SelectCourse");
    $SelectResult = $SelectCourse->where($condition)->find();

    if($SelectResult){
      $SelectCourse->where($condition)->save($data);
      $this->success('打分成功',"index");
      // $this->display("index");
    }
    else{
      $this->error("这名学生没有选这门课。");

    }
  }
}
 ?>
