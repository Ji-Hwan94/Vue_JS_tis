<?php
header("access-control-allow-origin: *");
header("Content-Type: text/json; charset=UTF-8"); 

if(!isset($_POST['id']) || 
!isset($_POST['pw'])) exit;

$user_id = $_POST['id'];
$user_pw = $_POST['pw'];


// DB에서 member테이블 update
$mysql_hostname = 'localhost';
$mysql_username = 'ghkdrbqhd3';
$mysql_password = 'bong0423';
$mysql_database = 'ghkdrbqhd3';
$mysql_port = '3306';
$mysql_charset = 'utf8';

//1. DB 연결
$connect = mysqli_connect($mysql_hostname, $mysql_username, $mysql_password); 

if(!$connect){
	echo '[연결실패] : '.mysqli_error().'<br>'; 
	die('MySQL 서버에 연결할 수 없습니다.');
    
} 
//2. DB 선택
mysqli_select_db($connect,$mysql_database) or die('DB 선택 실패');

//3. 문자셋 지정
mysqli_query($connect,' SET NAMES '.$mysql_charset);

//4. 쿼리 생성 / id로 이름과 주소를 수정
$query = "select name from login;";

//5. 쿼리 실행
$result = mysqli_query($connect,$query);

$output='';
while($row = mysqli_fetch_array($result))
{	
    if ($output!="")
    {
        $output.= ",";//콤마붙이기
    }

    // 데이터가 한 건이기 때문에 배열로 만들지 않는다.  //.$row['name']은 db에 저장된 이름을 가져온다.
    $output.='{"id":"'.$row['id'].'","name":"'.$row['name'].'"}';  
   
}
//$output='['.$output.']';

//6. 연결 종료
mysqli_close($connect);

echo '{
    "message":"환영합니다."
}';

?>