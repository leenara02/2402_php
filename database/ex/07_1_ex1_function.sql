-- 내장함수 (function) : 데이터를 처리하고 분석하는데 사용하는 프로그램

-- 데이터타입 변환 함수
-- CAST(값 AS 데이터타입), CONVERT(값, 데이터타입)
SELECT 123, CAST(123 AS CHAR(3)), CONVERT(123, CHAR(3));

-- 제어흐름 함수
-- IF(컬럼=수식(값), 참일 때, 거짓일 때) : 수식(값)이 참이면 참일때, 거짓이면 거짓일때를 출력
SELECT emp_no, if(gender = 'M', '남자', '여자') gender
FROM employees;

-- 급여가 80000 이상인 사원은 '고소득자' 아니면 '그냥저냥' 으로 출력(사번,고소득자/그냥저냥)
SELECT emp_no, if(salary >= 80000, '고소득자', '그냥저냥') salary
FROM salaries
WHERE to_date >= NOW();

-- IFNULL(수식1, 수식2) : 수식1이 NULL이면 수식2를 반환
-- 수식1이 NULL이 아니면 수식1을 반환
-- 없는데이터(NULL)를 눈에 보이게 하기 위해서 하는것
SELECT IFNULL(NULL, '22');

-- NULLIF(수식1, 수식2)
-- 수식1과 수식2를 비교해서 같으면 NULL을 반환
-- 다르면 수식 1을 반환
SELECT NULLIF(1,1), NULLIF(1,2);

-- CASE ~ WHEN ~ ELSE ~ END : 다중분기를 위해서 사용
-- a가 b냐?그럼 이거 a가 c냐? 그럼이거
-- 알아두면 편리함. 모르겠으면 php에서 열심히해야됨.
-- 숙달해두면 좋음
SELECT 
	gender
	,case gender
	 when 'M' then '남자'
	 when 'F' then '여자'
	 ELSE '무성'
	 END ko_gender
FROM employees;

-- NULL 과 공백은 다름
-- NULL은 방 자체가없고 공백은 방은있는 느낌
-- NULL은 저장 자체를 안함


-- 문자열함수 (php에서 많이 씀) (데이터값이 문자임)
-- 문자열 연결
-- CONCAT_WS(구분자, 값1, 값2, ...)
SELECT CONCAT(11,22), CONCAT_WS(',', 11, 22);
-- 사번, 생일, 풀네임, 성별, 입사일자 출력
SELECT
	emp_no
	,birth_date
	,CONCAT_WS(' ', last_name, first_name) full_name
	,gender
	,hire_date
FROM employees;

-- FORMAT (숫자, 소수점 자리수)
-- 숫자에 ','를 넣어주고 소수점 자리수까지 표현
-- 얼마인지 적을때 사용
-- 소수점은 기본으로 반올림
SELECT FORMAT(1234567, 0);

-- LEFT(문자열, 길이) : 문자열의 왼쪽부터 길이만큼 잘라서 반환(출력)
-- RIGHT(문자열, 길이) : 문자열의오른쪽부텉 길이만큼 잘라 반환
SELECT LEFT('abcde', 2), RIGHT('abcde', 2);

-- SUBSTRING(문자열, 시작위치, 길이)
-- 대부분 언어프로그램에서 문자열 자를때 다 서브스트링을 사용하기 때문에 편함
-- 문자열을 시작위치에서 길이만큼 잘라 반환
-- 대부분 언어프로그램은 시작이 0인 경우가 많음
SELECT SUBSTRING('abcd', 3, 2);

-- SUBSTRING_INDEX(문자열, 구분자, 횟수)
-- 왼쪽부터 구분자가 횟수번째 이후를 버림
-- 횟수가 음수면 오른쪽부터 적용
SELECT SUBSTRING_INDEX('test.blade.txt', '.', -2);

-- UPPER(문자열), LOWER(문자열)
SELECT UPPER('asdfDD'), LOWER('AGDFDaa');

-- LPAD(문자열, 길이, 채울 문자열) : 생각보다 많이 씀
-- 문자열을 포함 채울 문자열의 길이만큼 왼쪽에 삽입해서 반환
SELECT LPAD(1, 10, '0');
-- RPAD(문자열, 길이, 채울 문자열)
-- 문자열을 포함 채울 문자열의 길이만큼 오른쪽에 삽입해서 반환
SELECT RPAD('안녕', 10, '0');

-- TRIM(문자열) : 좌우의 공백을 제거해서 반환 (많이 씀,중요함)
SELECT '    asdf    ', TRIM('    asdf    ');


-- 수학함수 (데이터값이 숫자임)
-- CEILING(값) : 값 올림 (다른언어들은 CEIL 이라고 적음)
-- ROUND(값) : 값 반올림
-- FLOOR(값) : 버림
SELECT CEILING(1.4), ROUND(1.4), FLOOR(1.9);

-- TRUNCATE(값, 정수)
-- 소수점 기준으로 정수 위치까지 구하고 나머지 버림
-- DDL 부분에 TRUNCATE가 자료를 삭제하는문이 있기 때문에 함부로 사용x
SELECT TRUNCATE(1.123, 1);

-- 날짜 / 시간 함수(DB에서 많이 씀)
-- NOW() : 현재 날짜/시간 을 반환(YYYY-MM-DD hh:mi:ss)
SELECT NOW();

-- DATE(데이트형식 값) : 해당 값을 YYYY-MM-DD로 변환
SELECT DATE(NOW());
-- YYYYMMDDhhmiss / YYYY-MM-DD hh:mi:ss

-- ADDDATE(기준날짜, INTERVAL 추가할 날짜/시간) 
-- 기준날짜에 추가할 날짜/시간을 더해서 반환
SELECT ADDDATE(NOW(), INTERVAL -1 YEAR);
SELECT ADDDATE(NOW(), INTERVAL -1 MONTH);
SELECT ADDDATE(date(NOW()), INTERVAL -6 DAY);


-- 집계함수
-- COUNT() : 검색결과의 레코드 수를 출력
-- (*) : NULL이 있어도 집계 / (컬럼명) : NULL은 집계하지않음
SELECT
	emp_no
	,COUNT(*)
	,COUNT(to_date)
FROM salaries
GROUP BY emp_no;

-- 순위함수 (DB에선 사용 잘 안함)
-- RANK() OVER(ORDER BY 컬럼 ASC/DESC)
-- 지정한 컬럼을 기준으로 순위를 매겨 반환
-- 동일한 순위가 있으면 동일한 순위를 부여
-- 예)1,1,3,4,4,6 ..
SELECT
	emp_no
	,salary
	,RANK() OVER(ORDER BY salary DESC) sal_rank
FROM salaries
WHERE to_date >=NOW()
LIMIT 5;
-- ROW_NUMBER() OVER(ORDER BY 컬럼 ASC/DESC)
-- 동일한 순위가 있어도 각 행에 고유번호를 부여
-- 예) 1,2,3,4,5,6,7 ... 
SELECT
	emp_no
	,salary
	,ROW_NUMBER() OVER(ORDER BY salary DESC) sal_rown
FROM salaries
WHERE to_date >= NOW()
LIMIT 5;