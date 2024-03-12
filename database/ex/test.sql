-- 1. 사원 정보테이블에 자신의 정보를 적절하게 넣어주세요.
INSERT INTO employees ( 
	emp_no
	,birth_date
	,first_name
	,last_name
	,gender
	,hire_date
)
VALUES (
	500000
	,20020103
	,'nara'
	,'Lee'
	,'F'
	,20240311
);
-- 2. 월급, 직책, 소속부서 테이블에 자신의 정보를 적절하게 넣어주세요.
INSERT INTO salaries (emp_no, salary, from_date, to_date)
VALUES (500000, 100000, 20240311, 99990101);
INSERT INTO titles (emp_no, title, from_date, to_date)
VALUES (500000, 'staff', 20240311, 99990101);
INSERT INTO dept_emp (emp_no, dept_no, from_date, to_date)
VALUES (500000, 'd001', 20240311, 99990101);
-- 3. 짝궁의 [1,2]것도 넣어주세요.
INSERT INTO employees
( emp_no ,birth_date ,first_name ,last_name ,gender ,hire_date )
VALUES (500001 , 19991218,'eunhye' ,'Ju' ,'F' ,20240311);
INSERT INTO salaries (emp_no, salary, from_date, to_date)
VALUES (500001, 100000, 20240311, 99990101);
INSERT INTO titles (emp_no, title, from_date, to_date)
VALUES (500001, 'Engineer', 20240311, 99990101);
INSERT INTO dept_emp (emp_no, dept_no, from_date, to_date)
VALUES (500001, 'd001', 20240311, 99990101);

-- 4. 나와 짝궁의 소속 부서를 d009로 변경해 주세요.
UPDATE dept_emp
	SET dept_no = 'd009'
WHERE emp_no IN(500000, 500001);
-- 5. 짝궁의 모든 정보를 삭제해 주세요.
DELETE FROM titles WHERE emp_no=500001;
DELETE FROM salaries WHERE emp_no=500001;
DELETE FROM dept_emp WHERE emp_no=500001;
DELETE FROM employees WHERE emp_no=500001;
-- 6.'d009'부서의 관리자를 나로 변경해 주세요.

SELECT *
from dept_manager 
WHERE dept_no='d009' and to_date >=NOW();

UPDATE dept_manager
	SET to_date = 20240311
WHERE dept_no='d009' AND to_date>=NOW();

INSERT INTO dept_manager (dept_no, emp_no, from_date, to_date)
VALUES ('d009', 500000, 20240311, 99990101);

-- 7. 오늘 날짜부로 나의 직책을 'Senior Engineer'로 변경해 주세요.
UPDATE titles
	SET to_date = 20240311
WHERE emp_no = 500000 AND to_date>=NOW();

INSERT INTO titles (emp_no, title, from_date, to_date)
VALUES (500000,'Senior Engineer', 20240311, 99990101);

-- 8. 최고 연봉 사원과 최저 연봉 사원의 사번과 이름을 출력해 주세요.
SELECT
	emp.emp_no
	,emp.first_name
FROM employees emp
	JOIN salaries sal
		ON emp.emp_no = sal.emp_no
		AND sal.to_date >=NOW()
WHERE sal.salary = (SELECT MIN(salary) FROM salaries)
	OR sal.salary = (SELECT MAX(salary) FROM salaries);


-- 9. 전체 사원의 평균 연봉을 출력해 주세요.

SELECT CEILING(AVG(salary))
FROM salaries
WHERE to_date >=NOW();

-- 10. 사번이 499,975인 사원의 지금까지 평균 연봉을 출력해 주세요.
SELECT
	AVG(sal.salary)
FROM employees emp
	JOIN salaries sal
		ON emp.emp_no = sal.emp_no
		AND sal.emp_no = 499975;
		
CREATE DATABASE test2;
USE employees;
CREATE TABLE users (
	user_id		INT 			PRIMARY KEY AUTO_INCREMENT
	,user_name	VARCHAR(30) NOT NULL
	,authflg 	CHAR(1) 		DEFAULT '0'
	,birth_day 	DATE			NOT NULL
	,created_at DATETIME 	NOT NULL DEFAULT CURRENT_DATE()
);

ALTER TABLE users MODIFY COLUMN created_at DATETIME NOT NULL DEFAULT CURRENT_DATE();

INSERT INTO users (user_id, user_name, authflg, birth_day, created_at)
	VALUE (DEFAULT,'그린', '0', 20240126, DEFAULT);
	
UPDATE users
	SET user_name = '테스터'
		,authflg = '1'
		,birth_day = 20240126
		,created_at = NOW()
	WHERE user_id = 1;

	
DELETE FROM users
WHERE user_id = 1;

ALTER TABLE users ADD COLUMN addr VARCHAR(100) NOT NULL DEFAULT '-';

DROP TABLE users;

SELECT
	u.username
	,u.birthday
	,ran.rankname
FROM users u
	JOIN rankmanagement ran
		ON u.userid = ran.userid
		AND u.userid = '1';
		
USE employees;

SELECT *
FROM employees
WHERE emp_no = 253406;