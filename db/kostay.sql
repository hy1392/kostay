-- phpMyAdmin SQL Dump
-- version 3.2.3
-- http://www.phpmyadmin.net
--
-- 호스트: localhost
-- 처리한 시간: 16-12-14 20:16 
-- 서버 버전: 5.1.41
-- PHP 버전: 5.2.12

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 데이터베이스: `kostay`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(500) NOT NULL COMMENT '사용자이름',
  `email` varchar(500) NOT NULL COMMENT '사용자아이디',
  `pwd` varchar(500) NOT NULL COMMENT '사용자패스워드',
  `flag` int(11) NOT NULL COMMENT '0:승인대기 1:관리자 2:운영자 3:입주자',
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='사용자정보' AUTO_INCREMENT=4 ;

--
-- 테이블의 덤프 데이터 `users`
--

INSERT INTO `users` (`idx`, `username`, `email`, `pwd`, `flag`) VALUES
(1, '관리자', 'admin@admin.ac.kr', 'admin', 1),
(2, '박진태(입주)', 'user1@user.ac.kr', 'user', 3),
(3, '박진태(운영)', 'user2@user.ac.kr', 'user', 2);
