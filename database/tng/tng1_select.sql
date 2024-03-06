-- 1. 직책테이블의 모든 정보를 조회해주세요.
SELECT *
FROM titles;

-- 2. 급여가 60,000 이하인 사원의 사번을 조회해 주세요.
SELECT
	emp_no
	,salary
FROM salaries
WHERE salary <=60000
GROUP BY emp_no;

-- 3. 급여가 60,000에서 70,000인 사원의 사번을 조회해 주세요.

SELECT
	emp_no
	,salary
FROM salaries
WHERE salary BETWEEN 60000 AND 70000
ORDER BY salary asc ;

-- 4. 사원번호가 10001, 10005인 사원의 사원테이블의 모든 정보를 조회해 주세요.

SELECT *
FROM employees
WHERE emp_no IN(100001, 100005);

-- 5. 직급명에 "Engineer"가 포함된 사원의 사번과 직급을 조회해 주세요.'

SELECT
	emp_no
	,title
FROM titles
WHERE title LIKE('%Engineer%')
;

-- 6. 사원 이름을 오름차순으로 정렬해서 조회해 주세요.

SELECT
	first_name
FROM employees
ORDER BY first_name asc;

-- 7. 사원별 급여의 평균을 조회해 주세요.

SELECT
	AVG(salary)
FROM salaries;

-- 8. 사원별 급여의 평균이 30,000 ~ 50,000인, 사원번호와 평균급여를 조회해 주세요.

SELECT
	emp_no
	,AVG(salary)
FROM salaries
GROUP BY emp_no HAVING AVG(salary) BETWEEN 30000 AND 50000;

-- 9. 사원별 급여 평균이 70,000이상인, 사원의 사번, 이름, 성, 성별을 조회해 주세요.

SELECT 
	emp.emp_no
	,emp.first_name
	,emp.last_name
	,emp.gender
FROM employees emp
WHERE salary IN(
	SELECT
		AVG(salary)	
	FROM salaries sal
	GROUP BY emp_no
	HAVING AVG(salary) >70000
);







-- 10. 현재 직책이 "Senior Engineer"인, 사원의 사원번호와 성을 조회해 주세요.