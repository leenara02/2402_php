-- 프로시저(procedure)

DELIMITER $$
CREATE PROCEDURE test()
BEGIN 
	SELECT * FROM employees WHERE emp_no <=10005;
END $$
DELIMITER ;


-- 프로시저 호출
CALL test();

-- 프로시저 삭제
DROP PROCEDURE test;

