<?php
//调用者：tpl/myorders.html
//返回：JSON格式的字符串，形如[{},{},{}]
header('Content-Type:application/json');
$output=[];//将要向客户端输出的数组
//读取客户端提交的电话号码
@$phone=$_REQUEST['phone'];//@表示不向服务器端输出此行的任何信息
if(!$phone){
    echo '[]';
    return;//退出当前PHP页面的执行
}

//连接数据库服务器，读取数据
$conn=mysqli_connect('127.0.0.1','root','','kaifanla');
$sql='SET NAMES UTF8';//设置编码方式，防止乱码
mysqli_query($conn,$sql);
$sql="SELECT oid,phone,user_name,sex,order_time,addr,img_sm FROM kf_dish,kf_order WHERE kf_dish.did=kf_order.did AND phone='$phone' ";
//SQL语句中的%代表“任意多个任意字符”的意思
//模糊查询：SELECT * FROM kf_dish WHERE 列名 LIKE %关键词%
$result=mysqli_query($conn,$sql);
while(($row=mysqli_fetch_assoc($result))!=NULL){
    $output[]=$row;
}



//把数据转换为JSON格式并输出
echo json_encode($output);
?>