<?php
//�����ߣ�tpl/detail.html
//���أ�JSON��ʽ���ַ���������{}
header('Content-Type:application/json');

@$did=$_REQUEST['did'];//@��ʾ�����������������е��κ���Ϣ
if(!$did){
    echo '{}';
    return;//�˳���ǰPHPҳ���ִ��
}

//�������ݿ����������ȡ����
$conn=mysqli_connect('127.0.0.1','root','','kaifanla');
$sql='SET NAMES UTF8';//���ñ��뷽ʽ����ֹ����
mysqli_query($conn,$sql);
$sql="SELECT did,name,price,img_lg,material,detail FROM kf_dish WHERE did=$did ";
//SQL����е�%���������������ַ�������˼
//ģ����ѯ��SELECT * FROM kf_dish WHERE ���� LIKE %�ؼ���%
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);

//������ת��ΪJSON��ʽ�����
echo json_encode($row);
?>