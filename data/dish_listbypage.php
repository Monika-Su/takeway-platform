<?php
//�����ߣ�tpl/main.html�����ã����ݿͻ����ύ�Ĳ�Ʒ����ʼ�±꣬��ҳ��ʾ��Ʒ��һ�����5�м�¼��
//���أ�JSON��ʽ���ַ���������[{},{},{},{},{}]
header('Content-Type:application/json');
$output=[];//��Ҫ��ͻ������������
//����һ�п�ʼ��ȡ��¼����0/5/10
@$start=$_REQUEST['start'];//@��ʾ�����������������е��κ���Ϣ
if(!$start){
    $start=0;
}
//ÿҳ��ʾ�ļ�¼����
$count=5;

//�������ݿ����������ȡ����
$conn=mysqli_connect('127.0.0.1','root','','kaifanla');
$sql='SET NAMES UTF8';//���ñ��뷽ʽ����ֹ����
mysqli_query($conn,$sql);
$sql="SELECT did,name,price,img_sm,material FROM kf_dish LIMIT $start,$count";//LIMIT���ƴ��Ķ���ʼ��ȡ
$result=mysqli_query($conn,$sql);
while(($row=mysqli_fetch_assoc($result))!=NULL){
    $output[]=$row;
}


sleep(2);
//������ת��ΪJSON��ʽ�����
echo json_encode($output);
?>