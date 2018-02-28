#/usr/local/bin/python3

import pymysql

config = {
          'host':'101.132.97.42',
          'port':3306,
          'user':'root',
          'password':'123456',
          'db':'',
          'charset':'utf8mb4',
          }

connection = pymysql.connect(**config)

sql = '''
create database wechat;

use wechat;
create table department
( yxh varchar(2) not null primary key,
  mc char(10) not null,
  dz char(16) not null,
  lxdh varchar(8) not null)character set = utf8;
insert into department values('01','计算机学院','上大东校区三号楼','65347567');
insert into department values('02','通讯学院','上大东校区二号楼','65341234');
insert into department values('03','材料学院','上大东校区四号楼','65347890');


create table student
( xh varchar(8) not null primary key,
  xm varchar(10) not null,
  xb varchar(2) not null,
  csrq date not null,
  jg varchar(6) not null,
  sjhm char(11) not null,
  yxh varchar(2) not null references department(yxh),
  passwd char(32) not null) character set = utf8;
insert into student values('15121101','李明','男','1993-03-06','上海','13613005466','02','123456');
insert into student values('15121102','刘晓明','男','1992-12-08','安徽','18913457890','01','123456');
insert into student values('15121103','张颖','女','1993-01-05','江苏','18826490423','01','123456');
insert into student values('15121104','刘晶晶','女','1994-11-06','上海','13331934111','01','123456');
insert into student values('15121105','刘成刚','男','1991-06-07','上海','18015872567','01','123456');
insert into student values('15121106','李二丽','女','1993-05-04','江苏','18107620945','01','123456');
insert into student values('15121107','张晓峰','男','1992-08-16','浙江','13912341078','01','123456');
create index idx1 on student(yxh asc,xm desc);

create table outer_user
( id varchar(8) not null primary key,
  yhm varchar(20) not null,
  xm varchar(10) not null,
  xb varchar(2) not null,
  csrq date not null,
  sfz varchar(18) not null,
  sjhm char(11) not null,
  passwd char(32) not null) character set = utf8;
insert into outer_user values('00000001','zhangsan','张三','男','1993-03-06','310230199001011234','13613005466','123456');
insert into outer_user values('00000002','lisi','李四','男','1992-12-08','310230199111111111','18913457890','123456');
create index idx1 on outer_user(id asc,xm desc);


create table teacher
( gh varchar(5) not null primary key,
  xm varchar(10) not null,
  xb varchar(2) not null check(xb='男' or xb='女'),
  csrq date not null check(csrq between '1900-01-01' and '1990-12-31'),
  xl char(6) not null check(xl in('讲师','副教授','教授')),
  jbgz numeric(6,2) not null check(jbgz>0),
  yxh varchar(2) not null references department(yxh),
  intro text default null,
  passwd char(32) not null)character set = utf8;
insert into teacher values('0101','陈迪茂','男','1973-03-06','副教授','3567.00','01','','123456');
insert into teacher values('0102','马小红','女','1972-12-08','讲师','2845.00','01','','123456');
insert into teacher values('0201','张心颖','女','1960-01-05','教授','4200.00','02','','123456');
insert into teacher values('0103','吴宝钢','男','1980-11-06','讲师','2554.00','01','','123456');

create table course
( kh varchar(8) not null primary key,
  km varchar(10) not null,
  xf varchar(1) default '4',
  jg float not null,
  yxh varchar(2) not null references department(yxh),
  intro text default null)character set = utf8;
insert into course values('08305001','离散数学','4','400','01','');
insert into course values('08305002','数据库原理','4','500','01','');
insert into course values('08305003','数据结构','4','500','01','');
insert into course values('08305004','系统结构','6','600','01','');
insert into course values('08301001','分子物理学','4','400','03','');
insert into course values('08302001','通信学','3','300','02','');
create index idx2 on course(kh);

create table open_course
( xq varchar(14) not null,
  kh varchar(8) not null references course(kh),
  gh varchar(5) not null references teacher(gh),
  sksj varchar(12) not null,
  primary key(xq,kh,gh))character set = utf8;
insert into open_course values('2012-2013 秋季','08305001','0103','三 5-6');
insert into open_course values('2012-2013 冬季','08305002','0101','三 1-4');
insert into open_course values('2012-2013 冬季','08305002','0102','三 1-4');
insert into open_course values('2012-2013 冬季','08305002','0103','三 1-4');
insert into open_course values('2012-2013 冬季','08305003','0102','五 5-6');
insert into open_course values('2013-2014 秋季','08305004','0101','二 1-4');
insert into open_course values('2013-2014 秋季','08305001','0102','一 5-6');
insert into open_course values('2013-2014 冬季','08302001','0201','一 5-8');

create table select_course
( xh varchar(8) not null references student(xh),
  xq varchar(14) not null,
  kh varchar(8) not null,
  gh varchar(5) not null,
  pscj tinyint check(pscj between 1 and 100),
  kscj tinyint check(kscj between 1 and 100),
  zpcj tinyint check(zpcj between 1 and 100),
  foreign key(xq,kh,gh) references open_course(xq,kh,gh),
  primary key(xh,xq,kh,gh))character set = utf8;
insert into select_course values('15121101','2012-2013 秋季','08305001','0103',60,60,60);
insert into select_course values('15121102','2012-2013 秋季','08305001','0103',87,87,87);
insert into select_course values('15121102','2012-2013 冬季','08305002','0101',82,82,82);
insert into select_course values('15121102','2013-2014 秋季','08305004','0101',null,null,74);
insert into select_course values('15121103','2012-2013 秋季','08305001','0103',56,56,56);
insert into select_course values('15121103','2012-2013 冬季','08305002','0102',75,75,75);
insert into select_course values('15121103','2012-2013 冬季','08305003','0102',84,84,84);
insert into select_course values('15121103','2013-2014 秋季','08305001','0102',null,null,80);
insert into select_course values('15121103','2013-2014 秋季','08305004','0101',78,null,null);
insert into select_course values('15121104','2012-2013 秋季','08305001','0103',74,74,90);
insert into select_course values('15121104','2013-2014 冬季','08302001','0201',null,null,75);
insert into select_course values('15121106','2012-2013 秋季','08305001','0103',85,85,94);
insert into select_course values('15121106','2012-2013 冬季','08305002','0103',66,66,90);
insert into select_course values('15121107','2012-2013 秋季','08305001','0103',90,90,90);
insert into select_course values('15121107','2012-2013 冬季','08305003','0102',79,79,79);
insert into select_course values('15121107','2013-2014 冬季','08302001','0201',null,null,60);


create table sign_in
( xh varchar(8) not null references student(xh),
  kh varchar(8) not null references course(kh),
  rq date not null,
  attendance boolean default false
)character set = utf8;


create table open_apply
(  id int(10) primary key not null auto_increment,
   xq varchar(14) not null,
   gh varchar(5) not null references teacher(gh),
   kh varchar(8) not null references course(kh),
   sksj varchar(12) not null,
   applier varchar(5) not null references teacher(gh),
   status varchar(10) not null)character set = utf8;


create table admin
( id varchar(10) not null primary key,
  xm varchar(10) not null,
  sjhm char(11) not null,
  privilege int(2) not null,
  passwd char(32) not null) character set = utf8;
  insert into admin values("0001","root","12345678910",10,"123456");

'''
with connection.cursor() as cursor:
        cursor.execute(sql)
connection.commit()
connection.close()

print("creation success!")
