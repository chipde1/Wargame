<?php
// 사용자 입력을 받음
$key = $_POST['key'];
$value = $_POST['value'];

// 객체 생성
$obj = new stdClass();

// 사용자 입력에 따라 동적으로 객체에 값을 추가
$obj->$key = $value;

// 공격자가 프로토타입을 오염시켰는지 확인
if (isset($obj->__proto__) && isset($obj->__proto__['isAdmin']) && $obj->__proto__['isAdmin'] === true) {
    // 프로토타입 오염이 성공하면 플래그를 출력
    echo "<h2>Congratulations! You successfully polluted the prototype!</h2>";
    echo "<h3>Here is the flag{4ca8a95edcb45a890a2efa4c12cd3c61}</h3>";
} else {
    // 정상적인 처리
    echo "<h2>Result:</h2>";
    echo "<pre>";
    print_r($obj);
    echo "</pre>";
}
?>
