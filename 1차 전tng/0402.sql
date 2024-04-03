-- 1. 탈퇴한 회원의 정보를 출력해 주세요.
SELECT *
FROM users
WHERE deleted_at IS NOT NULL;

-- 강사님 쿼리
SELECT *
FROM users
WHERE deleted_at IS NOT NULL;


-- 2. 삭제 되지 않은 게시글을 조회수가 높은 순서(조회수가 같을 경우 작성일이 최신순으로)대로 출력해 주세요.
SELECT *
FROM boards
WHERE 
	deleted_at IS NULL
ORDER BY views DESC, created_at DESC;

-- 강사님 쿼리
SELECT *
FROM boards
WHERE delted_at IS NULL;
ORDER BY views DESC, created_at DESC;

-- ...

-- 3. 찜한 게시글이 3개 이상인 회원의 번호를 출력해 주세요.
SELECT user_id
FROM wishlists
GROUP BY user_id HAVING COUNT(user_id) >= 3;

-- 강사님 쿼리
SELECT user_id 
FROM wishlists
GROUP BY user_id HAVING COUNT(*) >= 3;


-- 4. 이메일이 'test_35@green.com'인 회원가 작성한 게시글의 정보를 수정일자가 최신순으로 출력해 주세요.
-- 삭제한 게시물을 제외하는 경우
SELECT
	bo.*
FROM users us
	JOIN boards bo
	ON us.id = bo.user_id
	AND us.email = 'test_35@green.com'
	AND bo.deleted_at IS NULL
ORDER BY updated_at DESC;

-- 삭제한 게시물과 함께 출력할 경우
SELECT
	bo.*
FROM users us
	JOIN boards bo
	ON us.id = bo.user_id
	AND us.email = 'test_35@green.com'
ORDER BY updated_at DESC;

-- 강사님 쿼리 (삭제한 게시물과 함께 출력함)
SELECT bo.*
FROM boards bo
	JOIN users us
	ON bo.user_id = us.id
	AND us.email = 'test_35@green.com' 
ORDER BY bo.updated_at DESC
;

-- join 할때 꼭 fk로 묶을 필요는 없지만, 1대1또는 1대다수 관계여야한다. 다수대다수는 중복된데이터가 나옴.

-- 5. 탈퇴한 회원이 작성했던 게시글의 pk를 출력해 주세요.
SELECT	
	bo.id
FROM users us
	JOIN boards bo
	ON us.id = bo.user_id
	AND us.deleted_at IS NOT NULL
ORDER BY us.id ASC;

-- 강사님 쿼리
SELECT bo.id
FROM boards bo
	JOIN users us
	ON bo.user_id = us.id
	AND us.deleted_at IS NOT NULL;



-- 6. 이름이 '사람_173'이 작성한 게시글과 찜목록을 모두 삭제처리 해주세요.

-- 게시글 삭제
UPDATE boards bo JOIN users us ON us.id = bo.user_id
SET bo.deleted_at = NOW()
WHERE us.name = '사람_173';
-- 찜목록 삭제
UPDATE wishlists wi JOIN users us ON us.id = wi.user_id
SET wi.deleted_at = NOW()
WHERE us.name = '사람_173';

-- 강사님 쿼리
UPDATE boards bo
SET 
	deleted_at = NOW()
WHERE user_id IN (SELECT id FROM users WHERE name='사람_173');

UPDATE wishlists wi
SET 
	deleted_at = NOW()
WHERE user_id IN (SELECT id FROM users WHERE name='사람_173');


-- 7. 탈퇴한 회원이 작성했던 게시글을 모두 삭제처리 해주세요.

UPDATE boards bo JOIN users us ON us.id = bo.user_id
SET bo.deleted_at = NOW()
WHERE us.deleted_at IS NOT NULL;
    
-- 강사님 쿼리
UPDATE boards bo
SET
	deleted_at = NOW()
WHERE user_id IN (SELECT id FROM users WHERE deleted_at IS NOT NULL);


-- 8. 가입일이 2020년 이후인 회원이 찜한 게시글의 제목과 내용을 출력해 주세요.

SELECT DISTINCT bo.title, bo.content 
FROM boards bo
	JOIN wishlists wi
	ON bo.id = wi.board_id
WHERE wi.board_id IN(
SELECT wi.board_id
FROM wishlists wi
	JOIN users us
	ON wi.user_id = us.id
	AND us.created_at >= 20200101000000
	AND us.deleted_at IS NULL);

-- 강사님 쿼리
SELECT DISTINCT
	bo.title
	,bo.content 
FROM users us
	JOIN wishlists wi
		ON us.id = wi.user_id
		AND us.created_at >= 20200101000000
	JOIN boards bo
		ON wi.board_id = bo.id
;

-- SELECT wi.user_id , wi.board_id
-- FROM wishlists wi 
-- WHERE id IN (SELECT id FROM users us WHERE created_at >= '2020-01-01' AND deleted_at IS NULL);
-- 
-- SELECT wi.user_id, wi.board_id, bo.title, bo.content
-- FROM users us JOIN boards bo ON us.id = bo.user_id JOIN wishlists wi ON us.id = wi.user_id
-- WHERE us.created_at >= '2020-01-01' AND wi.board_id ;
