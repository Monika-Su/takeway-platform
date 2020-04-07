<?php
//调用者：tpl/main.html，作用：根据客户端的菜品/名称&原料中的关键字，显示包含该关键字的菜品
//返回：JSON格式的字符串，形如[{},{},{}]
header('Content-Type:application/json');
$output=[];//将要向客户端输出的数组
//读取客户端提交的查询关键字
@$kw=$_REQUEST['kw'];//@表示不向服务器端输出此行的任何信息
if(!$kw){
    echo '[]';
    return;//退出当前PHP页面的执行
}

//连接数据库服务器，读取数据
$conn=mysqli_connect('127.0.0.1','root','','kaifanla');
$sql='SET NAMES UTF8';//设置编码方式，防止乱码
mysqli_query($conn,$sql);
$sql="SELECT did,name,price,img_sm,material FROM kf_dish WHERE name LIKE '%$kw%' OR material LIKE '%$kw%' ";
//SQL语句中的%代表“任意多个任意字符”的意思
//模糊查询：SELECT * FROM kf_dish WHERE 列名 LIKE %关键词%
$result=mysqli_query($conn,$sql);
while(($row=mysqli_fetch_assoc($result))!=NULL){
    $output[]=$row;
}



//把数据转换为JSON格式并输出
echo json_encode($output);
?>