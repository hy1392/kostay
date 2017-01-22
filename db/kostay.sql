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

INSERT INTO `users` (`idx`, `username`, `email`, `pwd`, `flag`) VALUES
(1, '관리자', 'admin@admin.ac.kr', 'admin', 1),
(2, '박진태(입주)', 'user1@user.ac.kr', 'user', 3),
(3, '박진태(운영)', 'user2@user.ac.kr', 'user', 2);

--
-- 테이블 구조 `user_profile`
--

CREATE TABLE IF NOT EXISTS `user_profile` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(500) NOT NULL COMMENT '사용자아이디',
  `img` varchar(500)  COMMENT '프로필사진',
  `description` varchar(500)  COMMENT '자기소개',
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='사용자 프로필' AUTO_INCREMENT=4 ;


--
-- 테이블 구조 `user_movein_list`
--

CREATE TABLE IF NOT EXISTS `user_movein_list` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(500) NOT NULL COMMENT '사용자아이디',
  `house_id` varchar(500) NOT NULL COMMENT '하우스 아이디(운영자아이디_숫자)',
    `bed_id` varchar(500) NOT NULL COMMENT '침대 아이디(방 아이디_숫자)',
  `time` datetime NOT NULL COMMENT '요청시간',
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='사용자 입주대기' AUTO_INCREMENT=4 ;

--
-- 테이블 구조 `user_wait_list`
--

CREATE TABLE IF NOT EXISTS `user_wait_list` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(500) NOT NULL COMMENT '사용자아이디',
  `house_id` varchar(500) NOT NULL COMMENT '하우스 아이디(운영자아이디_숫자)',
    `bed_id` varchar(500) NOT NULL COMMENT '침대 아이디(방 아이디_숫자)',
  `time` datetime NOT NULL COMMENT '요청시간',
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='사용자 대기리스트' AUTO_INCREMENT=4 ;

--
-- 테이블 구조 `user_wish_list`
--

CREATE TABLE IF NOT EXISTS `user_wish_list` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(500) NOT NULL COMMENT '사용자아이디',
  `house_id` varchar(500) NOT NULL COMMENT '하우스 아이디(운영자아이디_숫자)',
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='사용자 찜리스트' AUTO_INCREMENT=4 ;


--
-- 테이블 구조 `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `sent_id` varchar(500) NOT NULL COMMENT '보낸사람',
  `title` varchar(500) NOT NULL COMMENT '제목',
  `receiver` varchar(500) NOT NULL COMMENT '받는사람',
  `content` varchar(500) NOT NULL COMMENT '내용',
  `sdeleted` int(11) NOT NULL COMMENT '수신자 삭제여부 일반:1 삭제된:0',
  `rdeleted` int(11) NOT NULL COMMENT '발신자 삭제여부 일반:1 삭제된:0',
  `sent_time` datetime NOT NULL COMMENT '발신시간',
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='메시지' AUTO_INCREMENT=4 ;

INSERT INTO `message` (`idx`, `sent_id`, `title`, `receiver`, `content`, `sdeleted`, `rdeleted`,`sent_time`) VALUES
(1, 'admin@admin.ac.kr','제목입니다1', 'user1@user.ac.kr', '안녕하세요 관리자입니다. 메시지 기능 테스트 중입니다. 1 안녕하세요 관리자입니다. 메시지 기능 테스트 중입니다. 1 안녕하세요 관리자입니다. 메시지 기능 테스트 중입니다. 1', 1, 1, now());
INSERT INTO `message` (`idx`, `sent_id`, `title`, `receiver`, `content`, `sdeleted`, `rdeleted`,`sent_time`) VALUES
(2, 'admin@admin.ac.kr','제목입니다2', 'user1@user.ac.kr', '안녕하세요 관리자입니다. 메시지 기능 테스트 중입니다. 2 안녕하세요 관리자입니다. 메시지 기능 테스트 중입니다. 1 안녕하세요 관리자입니다. 메시지 기능 테스트 중입니다. 1', 1, 1, now());
INSERT INTO `message` (`idx`, `sent_id`, `title`, `receiver`, `content`, `sdeleted`, `rdeleted`,`sent_time`) VALUES
(3, 'admin@admin.ac.kr','제목입니다3', 'user1@user.ac.kr', '안녕하세요 관리자입니다. 메시지 기능 테스트 중입니다. 3 안녕하세요 관리자입니다. 메시지 기능 테스트 중입니다. 1 안녕하세요 관리자입니다. 메시지 기능 테스트 중입니다. 1', 1, 1, now());

--
-- 테이블 구조 `house_main`
--

CREATE TABLE IF NOT EXISTS `house_main` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(500) NOT NULL COMMENT '운영자 아이디',
  `house_id` varchar(500) NOT NULL COMMENT '하우스 아이디(운영자아이디_숫자)',
  `house_title` varchar(500) NOT NULL COMMENT '하우스 제목',
  `resident_gender` int(11) NOT NULL COMMENT '거주자 성별 남:1 여:2 혼성:3 커플:4',
  `house_type` int(11) NOT NULL COMMENT '주택유형 공동:1 단독:2',
  `number_of_rooms` int(11) NOT NULL COMMENT '방 개수',
  `number_of_toilet` int(11) NOT NULL COMMENT '화장실 개수',
  `live_master` int(11) NOT NULL COMMENT '운영자거주여부 거주:1 미거주:2',
  `parking` int(11) NOT NULL COMMENT '주차 가능:1 불가능:2',
  `pet` int(11) NOT NULL COMMENT '애완동물 가눙:1 불가능:2',
  `address` varchar(500) NOT NULL COMMENT '주소',
  `address_detail` varchar(500) NOT NULL COMMENT '상세주소',
  `address_detail_show` int(11) NOT NULL COMMENT '상세주소 공개여부 공개:1 비공개;2',
  `traffic` varchar(500) NOT NULL COMMENT '교통환경',
  `facilities` varchar(500) NOT NULL COMMENT '주변시설',
  `condition` varchar(500) NOT NULL COMMENT '계약조건',
  `register_time` date NOT NULL COMMENT '등록일',
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='하우스 기본정보' AUTO_INCREMENT=4 ;

INSERT INTO `house_main` (`idx`, `user_id`, `house_id`, `house_title`, `resident_gender`, `house_type`, `number_of_rooms`, `number_of_toilet`, `live_master`, `parking`, `pet`, `address`, `address_detail`, `address_detail_show`, `traffic`, `facilities`, `condition`, `register_time`) VALUES
(1, 'user2@user.ac.kr', 'user2@user.ac.kr_1', '매일밤 야식파티 벌어지는 즐거운 하우스. 의리로 뭉쳤다.매일밤 야식파티 벌어지는 즐거운 하우스. 의리로 뭉쳤다.111', 1, 1, 5, 2, 1, 1, 1, '31253) 충청남도 천안시 동남구 병천면 충절로 1600 (가전리, 한국기술교육대학교)', '상세주소입니다.', 1, '달링하버에서 3분거리, 시티에서 10분거리, 달링하버역에서 5분', '수영장 있는 아파트. 인근에 대형슈퍼(cols)가 있음. 달링하버 근처로 식당가 많아 살기 편함', '흡연불가, 애완동물 불가, 친구초대 불가, 2주 노티스, 쌀제공, 모든 공과금 포함', now());
INSERT INTO `house_main` (`idx`, `user_id`, `house_id`, `house_title`, `resident_gender`, `house_type`, `number_of_rooms`, `number_of_toilet`, `live_master`, `parking`, `pet`, `address`,`address_detail`, `address_detail_show`, `traffic`, `facilities`, `condition`, `register_time`) VALUES
(2, 'user2@user.ac.kr', 'user2@user.ac.kr_1', '매일밤 야식파티 벌어지는 즐거운 하우스. 의리로 뭉쳤다.매일밤 야식파티 벌어지는 즐거운 하우스. 의리로 뭉쳤다.222', 2, 2, 2, 1, 1, 2, 1, '31253) 충청남도 천안시 동남구 병천면 충절로 1600 (가전리, 한국기술교육대학교)', '상세주소입니다.', 1, '달링하버에서 3분거리, 시티에서 10분거리, 달링하버역에서 5분', '수영장 있는 아파트. 인근에 대형슈퍼(cols)가 있음. 달링하버 근처로 식당가 많아 살기 편함', '흡연불가, 애완동물 불가, 친구초대 불가, 2주 노티스, 쌀제공, 모든 공과금 포함', now());
INSERT INTO `house_main` (`idx`, `user_id`, `house_id`, `house_title`, `resident_gender`, `house_type`, `number_of_rooms`, `number_of_toilet`, `live_master`, `parking`, `pet`, `address`,`address_detail`, `address_detail_show`, `traffic`, `facilities`, `condition`, `register_time`) VALUES
(3, 'user2@user.ac.kr', 'user2@user.ac.kr_1', '매일밤 야식파티 벌어지는 즐거운 하우스. 의리로 뭉쳤다.매일밤 야식파티 벌어지는 즐거운 하우스. 의리로 뭉쳤다.333', 3, 2, 3, 3, 1, 1, 2, '31253) 충청남도 천안시 동남구 병천면 충절로 1600 (가전리, 한국기술교육대학교)', '상세주소입니다.', 1, '달링하버에서 3분거리, 시티에서 10분거리, 달링하버역에서 5분', '수영장 있는 아파트. 인근에 대형슈퍼(cols)가 있음. 달링하버 근처로 식당가 많아 살기 편함', '흡연불가, 애완동물 불가, 친구초대 불가, 2주 노티스, 쌀제공, 모든 공과금 포함', now());


--
-- 테이블 구조 `house_public`
--

CREATE TABLE IF NOT EXISTS `house_public` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `house_id` varchar(500) NOT NULL COMMENT '하우스 아이디(운영자아이디_숫자)',
  `description` varchar(500) NOT NULL COMMENT '소개',
  `services` varchar(500) NOT NULL COMMENT '제공 서비스',
  `goods` varchar(500) NOT NULL COMMENT '제공 물품',
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='공용공간 정보' AUTO_INCREMENT=4 ;

INSERT INTO `house_public` (`idx`, `house_id`, `description`, `services`, `goods`) VALUES (1, "user2@user.ac.kr_1", "소개입니다.소개입니다.소개입니다.소개입니다.", "제공 서비스입니다.제공 서비스입니다.제공 서비스입니다.제공 서비스입니다.", "제공 물품입니다.제공 물품입니다.제공 물품입니다.");


--
-- 테이블 구조 `house_rooms`
--

CREATE TABLE IF NOT EXISTS `house_rooms` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `house_id` varchar(500) NOT NULL COMMENT '하우스 아이디(운영자아이디_숫자)',
  `room_id` varchar(500) NOT NULL COMMENT '방 아이디(하우스아이디_숫자)',
  `person` int(11) NOT NULL COMMENT '거주인원',
  `gender` int(11) NOT NULL COMMENT '거주가 성별 남:1 여:2 혼성:3 커플룸:4',
  `master` int(11) NOT NULL COMMENT '마스터룸 여부 맞다:1 아니다:2',
  `rule` int(11) NOT NULL COMMENT '모집단위 1명씩:1 커플(2인):2',
  `rent` int(11) NOT NULL COMMENT '렌트비',
  `guarantee` int(11) NOT NULL COMMENT '보증금',
  `manage` int(11) NOT NULL COMMENT '관리비',
  `goods` varchar(500) NOT NULL COMMENT '제공 물품',
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='방별 정보' AUTO_INCREMENT=4 ;

INSERT INTO `house_rooms` (`idx`, `house_id`, `room_id`, `person`, `gender`, `master`, `rule`, `rent`, `guarantee`, `manage`, `goods`) VALUES (1, "user2@user.ac.kr_1", "user2@user.ac.kr_1_0", 5, 1, 1, 1, 200000, 300000, 50000, "1,2,3" );


--
-- 테이블 구조 `house_beds`
--

CREATE TABLE IF NOT EXISTS `house_beds` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `room_id` varchar(500) NOT NULL COMMENT '방 아이디(하우스아이디_숫자)',
  `bed_id` varchar(500) NOT NULL COMMENT '침대 아이디(방 아이디_숫자)',
  `condition` int(11) NOT NULL COMMENT '입주상황 만실:1 공실예정:2 공실:3',
  `vacant` date COMMENT '공실예정일',
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='침대별 정보' AUTO_INCREMENT=4 ;

INSERT INTO `house_beds` (`idx`, `room_id`, `bed_id`, `condition`, `vacant`) VALUES (1, "user2@user.ac.kr_1_0", "user2@user.ac.kr_1_0_0", 1, now());
