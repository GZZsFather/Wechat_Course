<?php
namespace Home\Controller;
use Think\Controller;

class UserController extends Controller{

  private function is_login(){
    $Username = I('session.username');
    if($Username){
      return True;
    }
    return False;
  }

  public function Login(){
    $Student = M("student");
    $Teacher = M('teacher');
    $Admin = M("admin");
    $Username = I('post.username');
    $Passwd = I('post.password');
    if(empty($Username) || empty($Passwd)){
      $this->error('用户名和密码不能为空!');
    }

    $student_result = $Student->where('xh = %s',$Username)->select();
    $teacher_result = $Teacher->where('gh = %s',$Username)->select();
    $admin_result = $Admin->where("id = %s",$Username)->select();
    // echo "Username: ".$Username."Password: ".$Passwd;
    // echo $result[0]['passwd'];
    //这里做测试先不做处理，日后补上md5加密
    if($student_result){
      if($student_result[0]['passwd'] == $Passwd){
        $XM = $student_result[0]['xm'];
        $setSession = array("name"=>"session_id","expire"=>3600);
        session($setSession);
        session("user_id",$Username);
        // session("passwd",$Passwd);
        session("occupation","Student");
        session("name",$XM);
        $this->success("Welcome ".$XM,U('/Student'));
      }
      else{
        $this->error("用户名或密码错误！");
      }
    }
    elseif($teacher_result){
      if($teacher_result[0]['passwd'] == $Passwd){
        $XM = $teacher_result[0]['xm'];
        $setSession = array("name"=>"session_id","expire"=>3600);
        session($setSession);
        session("user_id",$Username);
        session("occupation",$teacher_result[0][xl]);
        // session("passwd",$Passwd);
        session("name",$XM);
        $this->success("Welcome ".$XM,U('/Teacher'));
      }
      else{
        $this->error("用户名或密码错误！");
      }
    }
    elseif($admin_result){
      if($admin_result[0]['passwd'] == $Passwd){
        $XM = $admin_result[0]['xm'];
        $setSession = array("name"=>"session_id","expire"=>3600);
        session($setSession);
        session("user_id",$Username);
        session("occupation","Admin");
        // session("passwd",$Passwd);
        session("name",$XM);
        $this->success("Welcome ".$XM,U('/Admin'));
      }
      else{
        $this->error("用户名或密码错误！");
      }
    }
    else{
      $this->error("用户不存在");
    }

  }

  public function index(){
    $this->display();
  }

  public function Logout(){
    $Username = I('session.user_id');
    if($Username){
      session("username",null);
      session('[destroy]');
      $this->success('退出成功!','/index.php/Home/');
    }
    else{
      $this->error("没有登陆");
    }
  }
}

 ?>
