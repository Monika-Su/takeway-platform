<?php
//�����ߣ�tpl/main.html�����ã����ݿͻ��˵Ĳ�Ʒ/����&ԭ���еĹؼ��֣���ʾ�����ùؼ��ֵĲ�Ʒ
//���أ�JSON��ʽ���ַ���������[{},{},{}]
header('Content-Type:application/json');
$output=[];//��Ҫ��ͻ������������
//��ȡ�ͻ����ύ�Ĳ�ѯ�ؼ���
@$kw=$_REQUEST['kw'];//@��ʾ�����������������е��κ���Ϣ
if(!$kw){
    echo '[]';
    return;//�˳���ǰPHPҳ���ִ��
}

//�������ݿ����������ȡ����
$conn=mysqli_connect('127.0.0.1','root','','kaifanla');
$sql='SET NAMES UTF8';//���ñ��뷽ʽ����ֹ����
mysqli_query($conn,$sql);
$sql="SELECT did,name,price,img_sm,material FROM kf_dish WHERE name LIKE '%$kw%' OR material LIKE '%$kw%' ";
//SQL����е�%���������������ַ�������˼
//ģ����ѯ��SELECT * FROM kf_dish WHERE ���� LIKE %�ؼ���%
$result=mysqli_query($conn,$sql);
while(($row=mysqli_fetch_assoc($result))!=NULL){
    $output[]=$row;
}



//������ת��ΪJSON��ʽ�����
echo json_encode($output);
?>