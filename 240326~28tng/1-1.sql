-- 1. 1-1 문제
CREATE DATABASE first_tng;

USE first_tng;

CREATE TABLE users (
	id				INT				PRIMARY KEY AUTO_INCREMENT
	,name			VARCHAR(50)		NOT NULL 		
	,email			VARCHAR(100)	NOT NULL
	,created_at		DATE			NOT NULL	DEFAULT CURRENT_TIMESTAMP()			
	,updated_at		DATE			NOT NULL	DEFAULT CURRENT_TIMESTAMP()
	,deleted_at		DATE				
	,UNIQUE KEY uk_email (email)
);

-- 1. 2-1 문제
CREATE TABLE boards (
	id				INT 			PRIMARY KEY AUTO_INCREMENT 
	,user_id		INT 			NOT NULL
	,title			VARCHAR(100)	NOT NULL
	,content 		VARCHAR(1000)	NOT NULL
	,created_at		DATE			NOT NULL	DEFAULT CURRENT_TIMESTAMP()
	,updated_at		DATE			NOT NULL	DEFAULT CURRENT_TIMESTAMP()
	,deleted_at		DATE
);

ALTER TABLE boards ADD CONSTRAINT fk_boards_user_id FOREIGN KEY (user_id) REFERENCES users(id);

--1. 3-1 문제
CREATE TABLE wishlists (
	id				INT				PRIMARY KEY AUTO_INCREMENT	
	,user_id		INT				NOT NULL	
	,board_id		INT				NOT NULL	
	,created_at		DATE			NOT NULL	DEFAULT CURRENT_TIMESTAMP()
	,updated_at		DATE			NOT NULL	DEFAULT CURRENT_TIMESTAMP()
	,deleted_at		DATE	
);

ALTER TABLE wishlists ADD CONSTRAINT fk_wishlists_user_id FOREIGN KEY (user_id) REFERENCES users(id);
ALTER TABLE wishlists ADD CONSTRAINT fk_wishlists_board_id FOREIGN KEY (board_id) REFERENCES boards(id);

-- 2번 문제
ALTER TABLE boards ADD COLUMN views	INT	NOT NULL DEFAULT '0';

-- 3번 문제
INSERT INTO users (name	,email)
VALUES ("홍길동", "hong@hong.com")
		,("갑돌이", "doll@doll.com")
		,("갑순이", "mild@mild.com");

-- 4번문제
INSERT INTO boards ( user_id, title, content)
VALUES (1, "안녕", "홍길동이다")
		,(1, "나는", "홍길동이야")
		,(1, "홍길동", "어쩌구")
		,(1, "집가고싶어", "너도?")
		,(2, "안녕2", "갑돌이다")
		,(2, "나는2", "갑돌이야")
		,(2, "밥먹고싶어", "너도??")
		,(3, "안녕3", "갑순이다")
		,(3, "나는3", "갑순이야");

-- 5번문제

INSERT INTO wishlists (user_id, board_id)
VALUES (1, 1), (1, 2)
		,(2, 1), (2, 2), (2, 3), (2, 4), (2, 5)
		,(3, 1), (3, 2), (3, 3), (3, 4), (3, 5), (3, 6), (3, 7), (3, 8), (3, 9);

-- 6번문제
UPDATE users
SET
	deleted_at = NOW()
WHERE id = 1;
	
-- 7번문제
TRUNCATE TABLE wishlists;

-- 8번문제
DROP TABLE wishlists,boards, users;