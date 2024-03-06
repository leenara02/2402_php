-- SUB QUERY
-- 쿼리 안에 또다른 쿼리가 들어있는 쿼리

-- WHERE 절에 사용하는 서브쿼리
-- d001부서장의 사원정보 출력
-- 서브쿼리를 가져올때 비교연산자가 출력되는 레코드의 갯수와 일치해야함
SELECT *
FROM employees
WHERE 
	emp_no = (
		SELECT emp_no
		FROM dept_manager
		WHERE dept_no = 'd001'
		AND to_date >=NOW()
	);
-- 모든 부서의 부서장의 사원 정보를 출력
-- 여러결과를 출력할때는 다중행 비교연산자를 사용해야한다

SELECT *
FROM employees
WHERE 
	emp_no IN (
		SELECT emp_no
		FROM dept_manager
		WHERE to_date >=NOW()
	);
-- d001 부서에 속했던 적이 있는 사원의 사번과 풀네임을 출력
SELECT
	emp_no
	, CONCAT_WS(' ',last_name,first_name) full_name
FROM employees
WHERE
	emp_no IN (
		SELECT emp_no
		FROM dept_emp
		WHERE
		dept_no = 'd001'
	);

SELECT *
FROM dept_emp
WHERE dept_no = 'd001'
	AND to_date <=NOW();

-- 강사님 쿼리
-- where조건과 서브쿼리 select 는 같아야된다
SELECT
	emp_no
	, CONCAT_WS(' ',last_name, first_name) full_name
FROM employees
WHERE
	emp_no IN(
		SELECT emp_no
		FROM dept_emp
		WHERE dept_no = 'd001'
	);
	
-- 현재 직책이 senior Engineer인 사원의 사번과 생일을 출력
SELECT
	emp_no
	,birth_date
FROM employees
WHERE emp_no IN (
		SELECT emp_no
		FROM titles
		WHERE title = 'senior Engineer'
			AND to_date >=NOW()
	);

SELECT emp_no
FROM titles
WHERE title = 'senior Engineer';

-- 다중열 서브쿼리
-- 여러 열이 나올때는 어떤조건이 어떤테이블인지 앞에 지정해줘야함
-- dpe. 또는 dpm. 같은 아이들은 연관서브쿼리 라고한다.
-- 속도가 느려서 되도록 안쓰는게좋음
select dpe.*
FROM dept_emp dpe
WHERE (dpe.dept_no, dpe.emp_no) IN (
	SELECT 
		dpm.dept_no
		,dpm.emp_no
	FROM dept_manager dpm
	WHERE dpe.emp_no = dpm.emp_no
);

-- SELECT에 사용하는 서브쿼리
-- 사원의 사원번호, 평균급여, 사원명
SELECT
	employees.emp_no
	,(
		SELECT AVG(salaries.salary)
		FROM salaries
		WHERE salaries.emp_no = employees.emp_no
	) avg_sal
	,employees.first_name
FROM employees
;

-- FROM 절에서 사용되는 서브쿼리 (현업 많이 사용)
-- FROM절 서브쿼리는 임시테이블이 되기 때문에 테이블 별칭을 붙여줘야함
-- 임시로 테이블을 만들어서 쓰는경우 한번씩 사용하는 서브쿼리
SELECT tmp.*
FROM(SELECT emp_no, birth_date
	FROM employees) tmp
;

-- INSERT 문에서 서브쿼리 사용
INSERT employees (
	emp_no
	,birth_date
	,first_name
	,last_name
	,gender
	,hire_date
)
VALUES (
	(SELECT MAX(emp.emp_no) +1 FROM employees emp)
	,20020103
	,'Nara'
	,'Lee'
	,'F'
	,20240306
);

-- UPDATE 문에서 사용
UPDATE employees
SET
	first_name = (
		SELECT
			left(title, 10)
		FROM titles
		WHERE emp_no = 10001
			AND to_date>=NOW()
	)
WHERE emp_no = 500000; 
