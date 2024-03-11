-- 스토어드 함수
-- stored function

DELIMITER $$
CREATE FUNCTION my_sum(num1 INT, num2 INT)
	RETURNS INT 
BEGIN
	RETURN num1 + num2;
END $$
DELIMITER ;

-- 함수 호출
SELECT my_sum(100, 2);

-- 함수 조회
SHOW FUNCTION STATUS;

-- 함수 삭제
DROP FUNCTION my_sum;
