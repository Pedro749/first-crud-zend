/*
 SQLyog Ultimate v13.1.1 (64 bit)
 MySQL - 10.3.17-MariaDB-log 
 *********************************************************************
 */
/*!40101 SET NAMES utf8 */
;
create table `pessoa` (
	`id` varchar (189),
	`name` varchar (765),
	`email` varchar (765),
	`status` varchar (189),
	`created_at` datetime,
	`updated_at` datetime
);
insert into `_pessoa` (
		`id`,
		`name`,
		`email`,
		`status`,
		`created_at`,
		`updated_at`
	)
values(
		'1f5572f9-d0dc-457a-923d-e3f168bca83d',
		'paula',
		'paula@teste.com',
		'active',
		'2023-07-12 07:40:54',
		NULL
	);
insert into `_pessoa` (
		`id`,
		`name`,
		`email`,
		`status`,
		`created_at`,
		`updated_at`
	)
values(
		'28b97e11-6d0b-4f98-80fc-f5f229019703',
		'jose',
		'jose@teste.com',
		'active',
		'2023-07-12 07:41:21',
		NULL
	);
insert into `_pessoa` (
		`id`,
		`name`,
		`email`,
		`status`,
		`created_at`,
		`updated_at`
	)
values(
		'4410a76b-4f00-4bed-97ad-e0ea365d1350',
		'teste',
		'pedro@teste.com.br',
		'active',
		'2023-07-12 13:34:43',
		NULL
	);