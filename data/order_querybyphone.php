<?php
//�����ߣ�tpl/myorders.html
//���أ�JSON��ʽ���ַ���������[{},{},{}]
header('Content-Type:application/json');
$output=[];//��Ҫ��ͻ������������
//��ȡ�ͻ����ύ�ĵ绰����
@$phone=$_REQUEST['phone'];//@��ʾ�����������������е��κ���Ϣ
if(!$phone){
    echo '[]';
    return;//�˳���ǰPHPҳ���ִ��
}

//�������ݿ����������ȡ����
$conn=mysqli_connect('127.0.0.1','root','','kaifanla');
$sql='SET NAMES UTF8';//���ñ��뷽ʽ����ֹ����
mysqli_query($conn,$sql);
$sql="SELECT oid,phone,user_name,sex,order_time,addr,img_sm FROM kf_dish,kf_order WHERE kf_dish.did=kf_order.did AND phone='$phone' ";
//SQL����е�%���������������ַ�������˼
//ģ����ѯ��SELECT * FROM kf_dish WHERE ���� LIKE %�ؼ���%
$result=mysqli_query($conn,$sql);
while(($row=mysqli_fetch_assoc($result))!=NULL){
    $output[]=$row;
}



//������ת��ΪJSON��ʽ�����
echo json_encode($output);
?>