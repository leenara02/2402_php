-- tng review
-- 강사님 쿼리

-- 1. 사원의 사원번호, 풀네임, 직책명을 출력해 주세요.
-- 조인에 들어갈수있는 조건은 웨어보다 조인에 엔드를 써서 사용

SELECT
	emp.emp_no
	,CONCAT(emp.first_name,' ', emp.last_name ) full_name
	,tit.title
FROM employees emp
	JOIN titles tit
		ON emp.emp_no = tit.emp_no
		AND tit.to_date >= NOW();

-- 2. 사원의 사원번호, 성별, 현재 월급을 출력해 주세요.

SELECT
	emp.emp_no
	,emp.gender
	,sal.salary
FROM employees emp
	JOIN salaries sal
		ON emp.emp_no = sal.emp_no
		AND sal.to_date >=NOW();


-- 3. 10010 사원의 풀네임, 과거부터 현재까지 월급 이력을 출력해 주세요.

SELECT
	CONCAT_WS(' ', emp.first_name, emp.last_name) full_name
	,sal.salary
FROM employees emp
	JOIN salaries sal
		ON emp.emp_no = sal.emp_no
		AND sal.emp_no = 10010

-- 4. 사원의 사원번호, 풀네임, 소속부서명을 출력해 주세요.
-- 오더바이는 거의 필수로 들어감.

SELECT
	emp.emp_no
	,CONCAT_WS(' ', emp.first_name, emp.last_name) full_name
	,dept.dept_name
FROM employees emp
	JOIN dept_emp depte
		ON emp.emp_no = depte.emp_no
		AND depte.to_date >=NOW()
	JOIN departments dept
		ON depte.dept_no = dept.dept_no
ORDER BY emp.emp_no
;



-- 5. 현재 월급의 상위 10위까지 사원의 사번, 풀네임, 월급을 출력해 주세요.

SELECT rank_tbl.*
FROM (
SELECT
	emp.emp_no
	,CONCAT_WS(' ', emp.first_name, emp.last_name) full_name
	,sal.salary
	,RANK() OVER(ORDER BY sal.salary DESC) sal_rank
FROM employees emp
	JOIN salaries sal
		ON emp.emp_no = sal.emp_no
		AND sal.to_date >=NOW()
) rank_tbl
WHERE rank_tbl.sal_rank <= 10
;


-- 6. 현재 각 부서의 부서장의 부서명, 풀네임, 입사일을 출력해 주세요.

SELECT
	dept.dept_name
	,CONCAT_WS(' ', emp.first_name, emp.last_name) full_name
	,emp.hire_date
FROM employees emp
	JOIN dept_manager deptm
		ON emp.emp_no = deptm.emp_no
		AND deptm.to_date >=NOW()
	JOIN departments dept
		ON deptm.dept_no = dept.dept_no
;

-- 7. 현재 직책이 "Staff"인 사원의 전체 평균 월급를 출력해 주세요.

SELECT
	AVG(sal.salary) avg_sal
FROM salaries sal
	JOIN titles tit
		ON sal.emp_no = tit.emp_no
		AND tit.to_date >= NOW()
		AND tit.title = 'staff'
;

-- 8. 부서장직을 역임했던 모든 사원의 풀네임과 입사일, 사번, 부서번호를 출력해 주세요.

SELECT
	CONCAT_WS(' ', emp.first_name, emp.last_name) full_name
	,emp.emp_no
	,emp.hire_date
	,deptm.dept_no
FROM employees emp
	JOIN dept_manager deptm
		ON emp.emp_no = deptm.emp_no
;

-- 9. 현재 각 직책별 평균월급 중 60,000이상인 직급의 직급명, 평균월급(정수)를 내림차순으로 출력해 주세요.
-- 급여의 소수점자리는 올림한다
-- 고객이 이득이면 올리고 고객이 손해면 내림
-- having절에 selet에서 준 별칭을 원래는 못쓰는데 마리아DB는 사용도되고, 속도도 빠름
SELECT
	tit.title
	, CEILING(AVG(sal.salary)) avg_sal
FROM titles tit
	JOIN salaries sal
		ON tit.emp_no = sal.emp_no
		AND tit.to_date >=NOW()
		AND sal.to_date >=NOW()
GROUP BY tit.title HAVING AVG(sal.salary) >=60000
ORDER BY avg_sal DESC;


-- 10. 성별이 여자인 사원들의 직급별 사원수를 출력해 주세요.

SELECT
	tit.title
	,COUNT(emp.emp_no) cnt
FROM employees emp
	JOIN titles tit
		ON emp.emp_no = tit.emp_no
		AND tit.to_date >=NOW()
		AND emp.gender ='F'
GROUP BY tit.title
;

-- 11. 퇴사한 여직원의 수
SELECT
	COUNT(emp.emp_no) cnt
FROM employees emp
	JOIN (
		SELECT
			emp_no
		FROM titles
		GROUP BY emp_no HAVING MAX(to_date) !=99990101
	) tit
		ON emp.emp_no = tit.emp_no
		AND emp.gender='F' 
;

