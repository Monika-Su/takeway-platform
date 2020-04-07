<?php
//调用者：tpl/detail.html
//返回：JSON格式的字符串，形如{}
header('Content-Type:application/json');

@$did=$_REQUEST['did'];//@表示不向服务器端输出此行的任何信息
if(!$did){
    echo '{}';
    return;//退出当前PHP页面的执行
}

//连接数据库服务器，读取数据
$conn=mysqli_connect('127.0.0.1','root','','kaifanla');
$sql='SET NAMES UTF8';//设置编码方式，防止乱码
mysqli_query($conn,$sql);
$sql="SELECT did,name,price,img_lg,material,detail FROM kf_dish WHERE did=$did ";
//SQL语句中的%代表“任意多个任意字符”的意思
//模糊查询：SELECT * FROM kf_dish WHERE 列名 LIKE %关键词%
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);

//把数据转换为JSON格式并输出
echo json_encode($row);
?>