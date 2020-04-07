<?php
//调用者：tpl/order.html
//返回：JSON格式的字符串,形如：{"msg":"ok","oid":4}或{"msg":"err","detail":"您的地址填写有误"}
header('Content-Type:application/json');
$output=[];//将要向客户端输出的数组

@$phone=$_REQUEST['phone'];//@表示不向服务器端输出此行的任何信息
@$user_name=$_REQUEST['user_name'];
@$sex=$_REQUEST['sex'];
@$addr=$_REQUEST['addr'];
@$did=$_REQUEST['did'];
@$order_time=time()*1000;//获得当前服务器端系统时间



//连接数据库服务器，读取数据
$conn=mysqli_connect('127.0.0.1','root','','kaifanla');
$sql='SET NAMES UTF8';//设置编码方式，防止乱码
mysqli_query($conn,$sql);
$sql="INSERT INTO kf_order VALUES(NULL,'$phone','$user_name','$sex','$order_time','$addr','$did')";

$result=mysqli_query($conn,$sql);

if($result){
    $output['msg']='OK';
    $output['oid']=mysqli_insert_id($conn);//获取刚刚执行的insert自增的编号
}else{
    $output['msg']='编写了错误的PHP语句';
}



//把数据转换为JSON格式并输出
echo json_encode($output);
?>