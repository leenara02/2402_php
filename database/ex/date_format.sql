SELECT *
FROM employees
WHERE
	birth_date <=19700101
AND birth_date >=19650101
;

SELECT *
FROM employees
WHERE
	(birth_date BETWEEN 19650101 AND 19700101)
	AND birth_date 라이크 어쩌구
ORDER BY birth_date DESC;

-- 8월이 생일인사람 찾기 (데이트포멧)
SELECT 
	birth_date
FROM employees
WHERE 
	DATE_FORMAT(birth_date, '%y-%m-%d') = '08';