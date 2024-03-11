-- DCL
-- 계정 및 권한 관리
-- dcl 계정권한 tcl 트랜젝션권한으로 나누기도하고, 사람마다 다르게 나눈다.
-- root계정은 리더만 알고있다. 특정ip를 지정하여 관리

-- 권환확인
USE mysql;
SELECT *
FROM user;
-- 또는
SELECT * FROM mysql.user;

-- 계정생성, 어떤권한줄지설정
-- 계정생성
CREATE user 'user1'@'localhost' IDENTIFIED BY 'user1';

-- 계정에 권한 부여
GRANT SELECT, INSERT, UPDATE, DELETE ON employees.* TO 'user1'@'localhost';

-- 권한 삭제
REVOKE INSERT, UPDATE, DELETE ON employees.* FROM 'user1'@'localhost';

-- 계정 삭제
DROP user 'user1'@'localhost';