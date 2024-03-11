-- 뷰(VIEW) : 읽기전용 가상테이블
-- 가상테이블로, 보안과 함께 사용자의 편의성을 높이기 위해 사용
-- 기존의 테이블에 각각의 데이터를 가지고와서 읽기전용으로 가상테이블을 만든다.
-- 장점 : 복잡한 SQL을 편하게 조회할 수 있다.
-- 단점 : INDEX를 사용할 수 없어 조회 속도가 느림.

-- 사원의 사번, 생년월일, 이름, 성, 성별, 입사일, 현재급여, 현재직책을 출력 해 주세요.
SELECT
	emp.emp_no, emp.birth_date, emp.first_name, emp.last_name, emp.gender, emp.hire_date
	,sal.salary
	,tit.title
FROM employees emp
	JOIN salaries sal
		ON emp.emp_no = sal.emp_no
		AND sal.to_date >=NOW()
	JOIN titles tit
		ON sal.emp_no = tit.emp_no
		AND tit.to_date >=NOW();
	
-- 위 쿼리를 뷰로 작성
-- 뷰에는 인덱스를 넣을 수 없음
-- 뷰에 where을 넣으면 속도가 느려진다.
-- 빠른경우도 있고 느릴때도 있다. 데이터의 양에 따라서

CREATE VIEW view_emp_info
AS
	SELECT
		emp.emp_no, emp.birth_date, emp.first_name, emp.last_name, emp.gender, emp.hire_date
		,sal.salary
		,tit.title
	FROM employees emp
		JOIN salaries sal
			ON emp.emp_no = sal.emp_no
			AND sal.to_date >=NOW()
		JOIN titles tit
			ON sal.emp_no = tit.emp_no
			AND tit.to_date >=NOW()
;

SELECT * FROM view_emp_info;