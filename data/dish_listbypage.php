<?php
//调用者：tpl/main.html，作用：根据客户端提交的菜品的起始下标，分页显示菜品（一个最多5行记录）
//返回：JSON格式的字符串，形如[{},{},{},{},{}]
header('Content-Type:application/json');
$output=[];//将要向客户端输出的数组
//从哪一行开始读取记录，如0/5/10
@$start=$_REQUEST['start'];//@表示不向服务器端输出此行的任何信息
if(!$start){
    $start=0;
}
//每页显示的记录行数
$count=5;

//连接数据库服务器，读取数据
$conn=mysqli_connect('127.0.0.1','root','','kaifanla');
$sql='SET NAMES UTF8';//设置编码方式，防止乱码
mysqli_query($conn,$sql);
$sql="SELECT did,name,price,img_sm,material FROM kf_dish LIMIT $start,$count";//LIMIT限制从哪儿开始获取
$result=mysqli_query($conn,$sql);
while(($row=mysqli_fetch_assoc($result))!=NULL){
    $output[]=$row;
}


sleep(2);
//把数据转换为JSON格式并输出
echo json_encode($output);
?>