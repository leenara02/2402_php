CREATE DATABASE first_tng;

USE first_tng;

CREATE TABLE users (
	id					INT				PRIMARY KEY AUTO_INCREMENT
	,name				VARCHAR(50)		NOT NULL 		
	,email			VARCHAR(100)	NOT NULL -- TODO : 유니크 지정
	,created_at		DATE				NOT NULL	DEFAULT CURRENT_TIMESTAMP()			
	,updated_at		DATE				NOT NULL	DEFAULT CURRENT_TIMESTAMP()
	,deleted_at		DATE				
);