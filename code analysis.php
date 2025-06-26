<?php
// 변환 함수
function shift_string($flag) {
    $shifted_flag = '';

    // 문자열의 각 문자에 대해 처리
    for ($i = 0; $i < strlen($flag); $i++) {
        $char = $flag[$i];

        // 알파벳인지 확인
        if (ctype_alpha($char)) {
            // 문자의 기본 0부터 25까지 숫자로 변환 (a=0, b=1, ..., z=25)
            $char_num = ord(strtolower($char)) - ord('a');

            // 해당 위치에 맞춰 값을 더함
            $shift_amount = $i + 1;  // 첫 번째 문자는 +1, 두 번째는 +2, ...
            $new_char_num = ($char_num + $shift_amount) % 26;  // 26으로 나눠서 순환시킴

            // 변환된 숫자를 다시 문자로 변환 (소문자로 변환)
            $new_char = chr($new_char_num + ord('a'));
            $shifted_flag .= $new_char;
        } else {
            // 알파벳이 아닌 경우 그대로 추가 (예: 공백, 숫자 등)
            $shifted_flag .= $char;
        }
    }

    return $shifted_flag;
}

// 결과 출력
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input_string = $_POST['input_string'];
    if (strlen($input_string) === 4) {  // 4자리 문자열인지 확인
        $shifted_flag = shift_string($input_string);
        
        if ($shifted_flag === 'flag') {
            $result = "정답입니다! 플래그 값: flag:{ef9f2c434c804b11769c3c34e4dd1a0a}";
        } else {
            $result = "변환된 값: $shifted_flag";
        }
    } else {
        $result = "4자리 문자열을 입력해주세요.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shift String Game</title>
    <style>
        button {
            margin-top: 10px;
        }
        pre {
            background-color: #f4f4f4;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>Shift String Game</h1>
    <p>C++코드를 분석하여 4자리 문자열을 입력하면 변환된 값이 'flag'인지 확인해보세요!</p>

    <!-- 사용자 입력 폼 -->
    <form method="POST">
        <label for="input_string">4자리 문자열을 입력하세요:</label>
        <input type="text" name="input_string" id="input_string" required maxlength="4" pattern="[a-zA-Z]{4}">
        <button type="submit">변환</button>
    </form>

    <!-- 결과 출력 -->
    <?php if (isset($result)): ?>
        <p><?php echo $result; ?></p>
    <?php endif; ?>

    <!-- C++ 소스코드 보기 버튼 -->
    <form method="POST" action="">
        <button type="submit" name="show_cpp_code">C++ 소스코드 보기</button>
    </form>

    <!-- C++ 소스코드 출력 -->
    <?php
    if (isset($_POST['show_cpp_code'])) {
        echo '<h2>C++ 소스코드</h2>';
        echo '<pre>';
        echo '#include <iostream>' . PHP_EOL;
        echo '#include <string>' . PHP_EOL;
        echo 'using namespace std;' . PHP_EOL;
        echo '' . PHP_EOL;
        echo 'string shift_string(const string& input) {' . PHP_EOL;
        echo '    string result = "";' . PHP_EOL;
        echo '    for (int i = 0; i < input.length(); ++i) {' . PHP_EOL;
        echo '        char charToShift = input[i];' . PHP_EOL;
        echo '        if (isalpha(charToShift)) {' . PHP_EOL;
        echo '            int charNum = tolower(charToShift) - \'a\';' . PHP_EOL;
        echo '            int shiftAmount = i + 1;' . PHP_EOL;
        echo '            int newCharNum = (charNum + shiftAmount) % 26;' . PHP_EOL;
        echo '            result += (newCharNum + \'a\');' . PHP_EOL;
        echo '        } else {' . PHP_EOL;
        echo '            result += charToShift;' . PHP_EOL;
        echo '        }' . PHP_EOL;
        echo '    }' . PHP_EOL;
        echo '    return result;' . PHP_EOL;
        echo '}' . PHP_EOL;
        echo '' . PHP_EOL;
        echo 'int main() {' . PHP_EOL;
        echo '    string input;' . PHP_EOL;
        echo '    cout << "문자열을 입력하세요: ";' . PHP_EOL;
        echo '    cin >> input;' . PHP_EOL;
        echo '    if (input.length() == 4) {' . PHP_EOL;
        echo '        string shiftedFlag = shift_string(input);' . PHP_EOL;
        echo '        if (shiftedFlag == "flag") {' . PHP_EOL;
        echo '            cout << "정답입니다! 플래그 값: flag" << endl;' . PHP_EOL;
        echo '        } else {' . PHP_EOL;
        echo '            cout << "변환된 값: " << shiftedFlag << endl;' . PHP_EOL;
        echo '        }' . PHP_EOL;
        echo '    } else {' . PHP_EOL;
        echo '        cout << "다시 문자열을 입력해주세요." << endl;' . PHP_EOL;
        echo '    }' . PHP_EOL;
        echo '    return 0;' . PHP_EOL;
        echo '}' . PHP_EOL;
        echo '</pre>';
    }
    ?>
</body>
</html>
