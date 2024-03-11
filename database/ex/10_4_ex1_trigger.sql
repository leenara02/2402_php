-- 트리거 

-- DELETE FROM employees WHERE emp_no = 10001;

-- DELETE FROM titles WHERE emp_no = 10001;

-- trigger
-- 트리거 생성
DELIMITER $$
CREATE TRIGGER trigger_employees_emp_info
BEFORE DELETE 
ON employees
FOR EACH ROW
BEGIN
	DELETE FROM titles WHERE emp_no = OLD.emp_no;
END $$
DELIMITER ;

DELETE FROM employees WHERE emp_no = 10002;

-- 트리거조회
SHOW TRIGGERS;

-- 트리거 삭제
DROP TRIGGER trigger_employees_emp_info;