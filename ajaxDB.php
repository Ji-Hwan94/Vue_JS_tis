<?php

header("Content-Type: text/xml"); 

$mysql_hostname = 'localhost';

$mysql_username = 'ghkdrbqhd';

$mysql_password = 'qhd85246!';

$mysql_database = 'ghkdrbqhd';

$mysql_port = '3306';

$mysql_charset = 'utf8';

 

//1. DB 연결
// mysql_hostname, mysql_username, mysql_password이 parameter이다.
$connect = mysqli_connect($mysql_hostname, $mysql_username, $mysql_password);  

 

if(!$connect){
    // print out과 같은 역할
    echo '[연결실패] : '.mysql_error().'<br>'; 

    die('MySQL 서버에 연결할 수 없습니다.');

    

} 

//2. DB 선택
// 데이터 베이스를 선택하는 함수 (어떤 db를 사용할 지 선택)
mysqli_select_db($connect,$mysql_database) or die('DB 선택 실패');

 

//3. 문자셋 지정

mysqli_query($connect,' SET NAMES '.$mysql_charset);

 

//4. 쿼리 생성

$query = 'select name,price from products;';

 

//5. 쿼리 실행

$result = mysqli_query($connect,$query);





//6. 결과 처리

$output='<?xml version="1.0" encoding="UTF-8"?>';

$output.='<products>';

// fetch를 사용해서  한 행을 만들어서 한 개씩 저장.
while($row = mysqli_fetch_array($result))

{

    //echo $row['name'].'<br>';

    // .=은 java에서의 +=와 같다.
    $output.='<product>';

    $output.='<name>'.$row['name'].'</name>';

    $output.='<price>'.$row['price'].'</price>';

    // 작업이 끝나면 product를 닫는다
    $output.='</product>';

}

$output.='</products>';

 

echo $output;

 

//6. 연결 종료

mysqli_close($connect);

 

?>