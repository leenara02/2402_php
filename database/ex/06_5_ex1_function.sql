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