document.getElementById('pollutionForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const key = document.getElementById('key').value;
    const value = document.getElementById('value').value;

    // 일반 객체 생성
    let obj = {};

    // 중첩된 키 처리: "__proto__.isAdmin" -> ["__proto__", "isAdmin"]
    const keys = key.split('.');
    let current = obj;

    // 마지막 키 전까지 반복
    for (let i = 0; i < keys.length - 1; i++) {
        const k = keys[i];

        // 키가 존재하지 않으면 객체 생성
        if (!(k in current)) {
            current[k] = {};
        }

        // 다음 단계로 이동
        current = current[k];
    }

    // 마지막 키에 값 할당
    const lastKey = keys[keys.length - 1];
    try {
        // "true"나 "false"를 실제 boolean으로 변환
        const parsedValue = (value === "true") ? true :
                            (value === "false") ? false :
                            value;
        current[lastKey] = parsedValue;
    } catch (e) {
        current[lastKey] = value;
    }

    // 결과 출력
    const result = document.getElementById('result');

    // Prototype Pollution 감지
    if ({}.isAdmin === true) {
        result.innerHTML = `<h3>✅ Prototype polluted!</h3><h4>FLAG{4ca8a95edcb45a890a2efa4c12cd3c61}</h4>`;
    } else {
        result.innerHTML = `<pre>${JSON.stringify(obj, null, 2)}</pre>`;
    }
});
