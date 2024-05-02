CREATE DATABASE mini_multi_board;
USE mini_multi_board;

CREATE TABLE users(
	u_id				INT				PRIMARY KEY AUTO_INCREMENT
	, u_email		VARCHAR(50) 	NOT NULL
	, u_pw			VARCHAR(256)	BINARY   NOT NULL 
	, u_name			VARCHAR(50)		NOT NULL 
	,created_at		DATETIME			NOT NULL DEFAULT CURRENT_TIMESTAMP()				
	,updated_at		DATETIME			NOT NULL DEFAULT CURRENT_TIMESTAMP()
	,deleted_at		DATETIME			
);

CREATE TABLE boards(
	b_id				INT 				PRIMARY KEY AUTO_INCREMENT
	,u_id				INT				NOT NULL
	,b_type			CHAR(1)			NOT NULL
	,b_title			VARCHAR(50)		NOT NULL
	,b_content		VARCHAR(1000)	NOT NULL
	,b_img			VARCHAR(256)	
	,created_at		DATETIME			NOT NULL DEFAULT CURRENT_TIMESTAMP()				
	,updated_at		DATETIME			NOT NULL DEFAULT CURRENT_TIMESTAMP()
	,deleted_at		DATETIME
);

-- 개발자가 미리 세팅하는 테이블이기 때문에 날짜는 x
CREATE TABLE boardsname(
	bn_id				INT				PRIMARY KEY AUTO_INCREMENT
	,b_type			CHAR(1)			NOT NULL UNIQUE
	,bn_name			VARCHAR(30)		NOT NULL
);

-- FK 추가
ALTER TABLE boards ADD CONSTRAINT fk_boards_u_id FOREIGN KEY (u_id) REFERENCES users(u_id);
ALTER TABLE boards ADD CONSTRAINT fk_boardsname_b_type FOREIGN KEY (b_type) REFERENCES boardsname(b_type);

-- 게시판이름 테이블 정보 삽입
INSERT INTO boardsname(b_type,bn_name)
VALUES ('0', '자유게시판')
,('1', '질문게시판');

-- test용 유저 추가
INSERT INTO users(u_email, u_pw, u_name)
VALUES ('admin@admin.com', 'qwer1234!', '관리자');

-- 테스트용 게시글 추가
INSERT INTO boards(u_id,b_type, b_title, b_content, b_img)
VALUES('1','0','자유2','자유 내용1', '/view/img/sum02.png')
,('1','0','자유3','자유 내용1', '/view/img/sum03.png')
,('1','1','질문1','질문 내용1', '/view/img/sum04.png')
,('1','1','질문2','질문 내용2', '/view/img/sum01.png');