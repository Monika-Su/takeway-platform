<?php
//�����ߣ�tpl/order.html
//���أ�JSON��ʽ���ַ���,���磺{"msg":"ok","oid":4}��{"msg":"err","detail":"���ĵ�ַ��д����"}
header('Content-Type:application/json');
$output=[];//��Ҫ��ͻ������������

@$phone=$_REQUEST['phone'];//@��ʾ�����������������е��κ���Ϣ
@$user_name=$_REQUEST['user_name'];
@$sex=$_REQUEST['sex'];
@$addr=$_REQUEST['addr'];
@$did=$_REQUEST['did'];
@$order_time=time()*1000;//��õ�ǰ��������ϵͳʱ��



//�������ݿ����������ȡ����
$conn=mysqli_connect('127.0.0.1','root','','kaifanla');
$sql='SET NAMES UTF8';//���ñ��뷽ʽ����ֹ����
mysqli_query($conn,$sql);
$sql="INSERT INTO kf_order VALUES(NULL,'$phone','$user_name','$sex','$order_time','$addr','$did')";

$result=mysqli_query($conn,$sql);

if($result){
    $output['msg']='OK';
    $output['oid']=mysqli_insert_id($conn);//��ȡ�ո�ִ�е�insert�����ı��
}else{
    $output['msg']='��д�˴����PHP���';
}



//������ת��ΪJSON��ʽ�����
echo json_encode($output);
?>