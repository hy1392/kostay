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
  `hp` varchar(500) NULL DEFAULT NULL COMMENT 'hp',
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
  `hp` varchar(500)  COMMENT '전화번호',
  `contactemail` varchar(500)  COMMENT '이메일',
  `kakao` varchar(500)  COMMENT '카카오',
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='사용자 프로필' AUTO_INCREMENT=4 ;


--
-- 테이블 구조 `request_movein_list`
--

CREATE TABLE IF NOT EXISTS `request_movein_list` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(500) NOT NULL COMMENT '사용자아이디',
  `date` date  COMMENT '입주 가능일',
  `house_id` varchar(500) NOT NULL COMMENT '하우스 아이디(운영자아이디_숫자)',
  `bed_id` varchar(500) NOT NULL COMMENT '침대 아이디(방 아이디_숫자)',
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='입주요청 리스트' AUTO_INCREMENT=4 ;


--
-- 테이블 구조 `user_movein_list`
--

CREATE TABLE IF NOT EXISTS `user_movein_list` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(500) NOT NULL COMMENT '사용자아이디',
  `gender` varchar(500) NOT NULL COMMENT '성별 남자, 여자',
  `nationality` varchar(500) NOT NULL COMMENT '국적',
  `age` varchar(500) NOT NULL COMMENT '나이',
  `hp` varchar(500) NOT NULL COMMENT '핸드폰',
  `contact_email` varchar(500) NOT NULL COMMENT '연락용 이메일',
  `notify` varchar(500) NOT NULL COMMENT '연락처 공개 여부',
  `visit_date` datetime  COMMENT '방문 희망일',
  `movein_date` date  COMMENT '입주 희망일',
  `skip_visit` varchar(500) NOT NULL COMMENT '방문 희망일 생략',
  `description` varchar(500) NOT NULL COMMENT '인사말',
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
  `gender` varchar(500) NOT NULL COMMENT '성별 남자, 여자',
  `nationality` varchar(500) NOT NULL COMMENT '국적',
  `age` varchar(500) NOT NULL COMMENT '나이',
  `hp` varchar(500) NOT NULL COMMENT '핸드폰',
  `contact_email` varchar(500) NOT NULL COMMENT '연락용 이메일',
  `notify` varchar(500) NOT NULL COMMENT '연락처 공개 여부',
  `movein_date` date  COMMENT '입주 희망일',
  `description` varchar(500) NOT NULL COMMENT '인사말',
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
  `title` varchar(500) NULL COMMENT '제목',
  `receiver` varchar(500) NOT NULL COMMENT '받는사람',
  `content` varchar(500) NOT NULL COMMENT '내용',
  `sdeleted` int(11) NOT NULL COMMENT '수신자 삭제여부 일반:1 삭제된:0',
  `rdeleted` int(11) NOT NULL COMMENT '발신자 삭제여부 일반:1 삭제된:0',
  `sent_time` datetime NOT NULL COMMENT '발신시간',
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='메시지' AUTO_INCREMENT=4 ;



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
  `address_detail` varchar(500) COMMENT '상세주소',
  `address_detail_show` int(11) NOT NULL COMMENT '상세주소 공개여부 공개:1 비공개;2',
  `traffic` varchar(500) NOT NULL COMMENT '교통환경',
  `facilities` varchar(500) NOT NULL COMMENT '주변시설',
  `condition` varchar(500) NOT NULL COMMENT '계약조건',
  `register_time` datetime NOT NULL COMMENT '등록일',
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='하우스 기본정보' AUTO_INCREMENT=4 ;




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




--
-- 테이블 구조 `house_rooms`
--

CREATE TABLE IF NOT EXISTS `house_rooms` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `house_id` varchar(500) NOT NULL COMMENT '하우스 아이디(운영자아이디_숫자)',
  `room_id` varchar(500) NOT NULL COMMENT '방 아이디(하우스아이디_숫자)',
  `person` int(11) NOT NULL COMMENT '거주인원',
  `gender` int(11) NOT NULL COMMENT '거주가 성별 남:1 여:2 혼성:3 커플룸:4',
  `master` varchar(500) NOT NULL COMMENT '마스터룸 여부 맞다:1 아니다:2',
  `rule` int(11) NOT NULL COMMENT '모집단위 1명씩:1 커플(2인):2',
  `rent` int(11) NOT NULL COMMENT '렌트비',
  `guarantee` int(11) NOT NULL COMMENT '보증금',
  `manage` int(11) NOT NULL COMMENT '관리비',
  `goods` varchar(500) NOT NULL COMMENT '제공 물품',
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='방별 정보' AUTO_INCREMENT=4 ;


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



--
-- 테이블 구조 `house_main_image`
--

CREATE TABLE IF NOT EXISTS `house_main_image` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(500) NOT NULL COMMENT '사용자아이디',
  `img` varchar(500)  COMMENT '하우스 사진',
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='하우스 사진' AUTO_INCREMENT=4 ;


--
-- 테이블 구조 `search`
--

CREATE TABLE IF NOT EXISTS `search` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `house_id` varchar(500) NOT NULL COMMENT ' 집 아이디',
  `address` varchar(500) NOT NULL COMMENT ' 주소',
  `gender` varchar(500) NOT NULL  COMMENT '성별',
  `house_type` varchar(500) NOT NULL  COMMENT '주택유형',
  `type` varchar(500) NOT NULL  COMMENT '룸타입',
  `min_rent` int(11) NOT NULL  COMMENT '렌트비 최소',
  `max_rent` int(11) NOT NULL  COMMENT '렌트비 최대',
  `person` int(11) NOT NULL  COMMENT '거주인원',
  `park` varchar(500) NOT NULL  COMMENT '주차',
  `date` date  COMMENT '입주가능일',
  `register_time` datetime NOT NULL  COMMENT '등록일',
  `ad` varchar(500) NOT NULL DEFAULT '1' COMMENT '광고',
  `pay` date NULL COMMENT '결제',
  `pay_count` int NULL DEFAULT '0' COMMENT '결제 누적 횟수',
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='검색용 디비' AUTO_INCREMENT=4 ;


--
-- 테이블 구조 `search_result`
--

CREATE TABLE IF NOT EXISTS `search_result` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(500) COMMENT '운영자 아이디',
  `house_id` varchar(500) COMMENT '하우스 아이디(운영자아이디_숫자)',
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='하우스 기본정보' AUTO_INCREMENT=4 ;


--
-- 테이블 구조 `alarm`
--

CREATE TABLE IF NOT EXISTS `alarm` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(500)  COMMENT ' 유저 아이디',
  `alarm_id` varchar(500)  COMMENT ' 알람 아이디',
  `alarm_title` varchar(500) COMMENT ' 알람 제목',
  `alarm_loc` varchar(500)  COMMENT ' 알람 기준',
  `alarm_param` varchar(500)  COMMENT '알람 상세 값',
  `address` varchar(500)  COMMENT ' 주소',
  `gender` varchar(500)   COMMENT '성별',
  `house_type` varchar(500)   COMMENT '주택유형',
  `type` varchar(500)   COMMENT '룸타입',
  `min_rent` int(11)  COMMENT '렌트비 최소',
  `max_rent` int(11)  COMMENT '렌트비 최대',
  `person` int(11)  COMMENT '거주인원',
  `park` varchar(500)  COMMENT '주차',
  `date` date  COMMENT '입주가능일',
  `date_condition` varchar(500)  COMMENT '이전 이후 무관',
  `contact` varchar(500)  COMMENT '연락받을 이메일',
  `cont` varchar(500)  COMMENT '연락 받을지 여부',
  `register_time` datetime  COMMENT '등록일',
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='알람' AUTO_INCREMENT=4 ;


--
-- 테이블 구조 `station`
--

CREATE TABLE IF NOT EXISTS `station` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL COMMENT '역 이름',
  `city` varchar(500) NOT NULL  COMMENT '주소',
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='역 정보' AUTO_INCREMENT=4 ;

INSERT INTO `station` (`name`, `city`) VALUES ("Allawah Station", "Allawah");
INSERT INTO `station` (`name`, `city`) VALUES ("Arncliffe Station", "Arncliffe");
INSERT INTO `station` (`name`, `city`) VALUES ("Artarmon Station", "Artarmon");
INSERT INTO `station` (`name`, `city`) VALUES ("Ashfield Station", "Ashfield");
INSERT INTO `station` (`name`, `city`) VALUES ("Asquith Station", "Asquith");
INSERT INTO `station` (`name`, `city`) VALUES ("Auburn Station", "Auburn");
INSERT INTO `station` (`name`, `city`) VALUES ("Banksia Station", "Banksia");
INSERT INTO `station` (`name`, `city`) VALUES ("Bankstown Station", "Bankstown");
INSERT INTO `station` (`name`, `city`) VALUES ("Bardwell Park Station", "Bardwell Park");
INSERT INTO `station` (`name`, `city`) VALUES ("Beecroft Station", "Beecroft");
INSERT INTO `station` (`name`, `city`) VALUES ("Belmore Station", "Belmore");
INSERT INTO `station` (`name`, `city`) VALUES ("Berala Station", "Berala");
INSERT INTO `station` (`name`, `city`) VALUES ("Berowra Station", "Berowra");
INSERT INTO `station` (`name`, `city`) VALUES ("Beverly Hills Station", "Beverly Hills");
INSERT INTO `station` (`name`, `city`) VALUES ("Bexley North Station", "Bexley North");
INSERT INTO `station` (`name`, `city`) VALUES ("Birrong Station", "Birrong");
INSERT INTO `station` (`name`, `city`) VALUES ("Blacktown Station", "Blacktown");
INSERT INTO `station` (`name`, `city`) VALUES ("Bondi Junction Station", "Bondi Junction");
INSERT INTO `station` (`name`, `city`) VALUES ("Burwood Station", "Burwood");
INSERT INTO `station` (`name`, `city`) VALUES ("Cabramatta Station", "Cabramatta");
INSERT INTO `station` (`name`, `city`) VALUES ("Camellia Station", "Camellia");
INSERT INTO `station` (`name`, `city`) VALUES ("Campbelltown Station", "Campbelltown");
INSERT INTO `station` (`name`, `city`) VALUES ("Campsie Station", "Campsie");
INSERT INTO `station` (`name`, `city`) VALUES ("Canley Vale Station", "Canley Vale");
INSERT INTO `station` (`name`, `city`) VALUES ("Canterbury Station", "Canterbury");
INSERT INTO `station` (`name`, `city`) VALUES ("Caringbah Station", "Caringbah");
INSERT INTO `station` (`name`, `city`) VALUES ("Carlingford Station", "Carlingford");
INSERT INTO `station` (`name`, `city`) VALUES ("Carlton Station", "Carlton");
INSERT INTO `station` (`name`, `city`) VALUES ("Carramar Station", "Carramar");
INSERT INTO `station` (`name`, `city`) VALUES ("Casula Station", "Casula");
INSERT INTO `station` (`name`, `city`) VALUES ("Central Station", "Haymarket ");
INSERT INTO `station` (`name`, `city`) VALUES ("Chatswood Station", "Chatswood");
INSERT INTO `station` (`name`, `city`) VALUES ("Cheltenham Station", "Cheltenham");
INSERT INTO `station` (`name`, `city`) VALUES ("Chester Hill Station", "Chester Hill");
INSERT INTO `station` (`name`, `city`) VALUES ("Circular Quay Station", "Circular Quay");
INSERT INTO `station` (`name`, `city`) VALUES ("Clarendon Station", "Clarendon");
INSERT INTO `station` (`name`, `city`) VALUES ("Clyde Station", "Clyde");
INSERT INTO `station` (`name`, `city`) VALUES ("Como Station", "Como");
INSERT INTO `station` (`name`, `city`) VALUES ("Concord West Station", "Concord West");
INSERT INTO `station` (`name`, `city`) VALUES ("Cronulla Station", "Cronulla");
INSERT INTO `station` (`name`, `city`) VALUES ("Croydon Station", "Croydon");
INSERT INTO `station` (`name`, `city`) VALUES ("Denistone Station", "Denistone");
INSERT INTO `station` (`name`, `city`) VALUES ("Domestic Airport Station", "Mascot");
INSERT INTO `station` (`name`, `city`) VALUES ("Doonside Station", "Doonside");
INSERT INTO `station` (`name`, `city`) VALUES ("Dulwich Hill Station", "Dulwich Hill");
INSERT INTO `station` (`name`, `city`) VALUES ("Dundas Station", "Dundas");
INSERT INTO `station` (`name`, `city`) VALUES ("East Hills Station", "East Hills");
INSERT INTO `station` (`name`, `city`) VALUES ("East Richmond Station", "Richmond");
INSERT INTO `station` (`name`, `city`) VALUES ("Eastwood Station", "Eastwood");
INSERT INTO `station` (`name`, `city`) VALUES ("Edgecliff Station", "Edgecliff");
INSERT INTO `station` (`name`, `city`) VALUES ("Edmondson Park Station", "Edmondson Park");
INSERT INTO `station` (`name`, `city`) VALUES ("Emu Plains Station", "Emu Plains");
INSERT INTO `station` (`name`, `city`) VALUES ("Engadine Station", "Engadine");
INSERT INTO `station` (`name`, `city`) VALUES ("Epping Station", "Epping");
INSERT INTO `station` (`name`, `city`) VALUES ("Erskineville Station", "Erskineville");
INSERT INTO `station` (`name`, `city`) VALUES ("Fairfield Station", "Fairfield");
INSERT INTO `station` (`name`, `city`) VALUES ("Flemington Station", "Flemington");
INSERT INTO `station` (`name`, `city`) VALUES ("Glenfield Station", "Glenfield");
INSERT INTO `station` (`name`, `city`) VALUES ("Gordon Station", "Gordon");
INSERT INTO `station` (`name`, `city`) VALUES ("Granville Station", "Granville");
INSERT INTO `station` (`name`, `city`) VALUES ("Green Square Station", " Alexandria");
INSERT INTO `station` (`name`, `city`) VALUES ("Guildford Station", "Guildford");
INSERT INTO `station` (`name`, `city`) VALUES ("Gymea Station", "Gymea");
INSERT INTO `station` (`name`, `city`) VALUES ("Harris Park Station", "Harris Park");
INSERT INTO `station` (`name`, `city`) VALUES ("Heathcote Station", "Heathcote");
INSERT INTO `station` (`name`, `city`) VALUES ("Holsworthy Station", "Holsworthy");
INSERT INTO `station` (`name`, `city`) VALUES ("Homebush Station", "Homebush");
INSERT INTO `station` (`name`, `city`) VALUES ("Hornsby Station", "Hornsby");
INSERT INTO `station` (`name`, `city`) VALUES ("Hurlstone Park Station", "Hurlstone Park");
INSERT INTO `station` (`name`, `city`) VALUES ("Hurstville Station", "Hurstville");
INSERT INTO `station` (`name`, `city`) VALUES ("Ingleburn Station", "Ingleburn");
INSERT INTO `station` (`name`, `city`) VALUES ("International Airport Station", "Mascot");
INSERT INTO `station` (`name`, `city`) VALUES ("Jannali Station", "Jannali");
INSERT INTO `station` (`name`, `city`) VALUES ("Killara Station", "Killara");
INSERT INTO `station` (`name`, `city`) VALUES ("Kings Cross Station", "Potts Point");
INSERT INTO `station` (`name`, `city`) VALUES ("Kingsgrove Station", "Kingsgrove");
INSERT INTO `station` (`name`, `city`) VALUES ("Kingswood Station", "Kingswood");
INSERT INTO `station` (`name`, `city`) VALUES ("Kirrawee Station", "Kirrawee");
INSERT INTO `station` (`name`, `city`) VALUES ("Kogarah Station", "Kogarah");
INSERT INTO `station` (`name`, `city`) VALUES ("Lakemba Station", "Lakemba");
INSERT INTO `station` (`name`, `city`) VALUES ("Leightonfield Station", "Villawood");
INSERT INTO `station` (`name`, `city`) VALUES ("Leppington Station", "Leppington");
INSERT INTO `station` (`name`, `city`) VALUES ("Leumeah Station", "Leumeah");
INSERT INTO `station` (`name`, `city`) VALUES ("Lewisham Station", "Lewisham");
INSERT INTO `station` (`name`, `city`) VALUES ("Lidcombe Station", "Lidcombe");
INSERT INTO `station` (`name`, `city`) VALUES ("Lindfield Station", "Lindfield");
INSERT INTO `station` (`name`, `city`) VALUES ("Liverpool Station", "Liverpool");
INSERT INTO `station` (`name`, `city`) VALUES ("Loftus Station", "Loftus");
INSERT INTO `station` (`name`, `city`) VALUES ("Macarthur Station", "Campbelltown");
INSERT INTO `station` (`name`, `city`) VALUES ("Macdonaldtown Station", "Eveleigh");
INSERT INTO `station` (`name`, `city`) VALUES ("Macquarie Fields Station", "Macquarie Fields");
INSERT INTO `station` (`name`, `city`) VALUES ("Macquarie Park Station", "Macquarie Park");
INSERT INTO `station` (`name`, `city`) VALUES ("Macquarie University Station", "Macquarie Park");
INSERT INTO `station` (`name`, `city`) VALUES ("Marayong Station", "Marayong");
INSERT INTO `station` (`name`, `city`) VALUES ("Marrickville Station", "Marrickville");
INSERT INTO `station` (`name`, `city`) VALUES ("Martin Place Station", "Sydney");
INSERT INTO `station` (`name`, `city`) VALUES ("Mascot Station", "Mascot");
INSERT INTO `station` (`name`, `city`) VALUES ("Meadowbank Station", "Meadowbank");
INSERT INTO `station` (`name`, `city`) VALUES ("Merrylands Station", "Merrylands");
INSERT INTO `station` (`name`, `city`) VALUES ("Milsons Point Station", "Milsons Point");
INSERT INTO `station` (`name`, `city`) VALUES ("Minto Station", "Minto");
INSERT INTO `station` (`name`, `city`) VALUES ("Miranda Station", "Miranda");
INSERT INTO `station` (`name`, `city`) VALUES ("Mortdale Station", "Mortdale");
INSERT INTO `station` (`name`, `city`) VALUES ("Mount Colah Station", "Mount Colah");
INSERT INTO `station` (`name`, `city`) VALUES ("Mount Druitt Station", "Mount Druitt");
INSERT INTO `station` (`name`, `city`) VALUES ("Mount Kuring-gai Station", "Mount Kuring-gai");
INSERT INTO `station` (`name`, `city`) VALUES ("Mulgrave Station", "Mulgrave");
INSERT INTO `station` (`name`, `city`) VALUES ("Museum Station", "Sydney");
INSERT INTO `station` (`name`, `city`) VALUES ("Narwee Station", "Narwee");
INSERT INTO `station` (`name`, `city`) VALUES ("Newtown Station", "Newtown");
INSERT INTO `station` (`name`, `city`) VALUES ("Normanhurst Station", "Normanhurst");
INSERT INTO `station` (`name`, `city`) VALUES ("North Ryde Station", "North Ryde");
INSERT INTO `station` (`name`, `city`) VALUES ("North Strathfield Station", "North Strathfield");
INSERT INTO `station` (`name`, `city`) VALUES ("North Sydney Station", "North Sydney");
INSERT INTO `station` (`name`, `city`) VALUES ("Oatley Station", "Oatley");
INSERT INTO `station` (`name`, `city`) VALUES ("Olympic Park Station", "Sydney");
INSERT INTO `station` (`name`, `city`) VALUES ("Padstow Station", "Padstow");
INSERT INTO `station` (`name`, `city`) VALUES ("Panania Station", "Panania");
INSERT INTO `station` (`name`, `city`) VALUES ("Parramatta Station", "Parramatta");
INSERT INTO `station` (`name`, `city`) VALUES ("Pendle Hill Station", "Pendle Hill");
INSERT INTO `station` (`name`, `city`) VALUES ("Pennant Hills Station", "Pennant Hills");
INSERT INTO `station` (`name`, `city`) VALUES ("Penrith Station", "Penrith");
INSERT INTO `station` (`name`, `city`) VALUES ("Penshurst Station", "Penshurst");
INSERT INTO `station` (`name`, `city`) VALUES ("Petersham Station", "Petersham");
INSERT INTO `station` (`name`, `city`) VALUES ("Punchbowl Station", "Punchbowl");
INSERT INTO `station` (`name`, `city`) VALUES ("Pymble Station", "Pymble");
INSERT INTO `station` (`name`, `city`) VALUES ("Quakers Hill Station", "Quakers Hill");
INSERT INTO `station` (`name`, `city`) VALUES ("Regents Park Station", "Regents Park");
INSERT INTO `station` (`name`, `city`) VALUES ("Revesby Station", "Revesby");
INSERT INTO `station` (`name`, `city`) VALUES ("Rhodes Station", "Rhodes");
INSERT INTO `station` (`name`, `city`) VALUES ("Richmond Station", "Richmond");
INSERT INTO `station` (`name`, `city`) VALUES ("Riverstone Station", "Riverstone");
INSERT INTO `station` (`name`, `city`) VALUES ("Riverwood Station", "Riverwood");
INSERT INTO `station` (`name`, `city`) VALUES ("Rockdale Station", "Rockdale");
INSERT INTO `station` (`name`, `city`) VALUES ("Rooty Hill Station", "Rooty Hill");
INSERT INTO `station` (`name`, `city`) VALUES ("Rosehill Station", "Rosehill");
INSERT INTO `station` (`name`, `city`) VALUES ("Roseville Station", "Roseville");
INSERT INTO `station` (`name`, `city`) VALUES ("Rydalmere Station", "Rydalmere");
INSERT INTO `station` (`name`, `city`) VALUES ("Schofields Station", "Schofields");
INSERT INTO `station` (`name`, `city`) VALUES ("Sefton Station", "Sefton");
INSERT INTO `station` (`name`, `city`) VALUES ("Seven Hills Station", "Seven Hills");
INSERT INTO `station` (`name`, `city`) VALUES ("St James Station", "Sydney");
INSERT INTO `station` (`name`, `city`) VALUES ("St Leonards Station", "St Leonards");
INSERT INTO `station` (`name`, `city`) VALUES ("St Marys Station", "St Marys");
INSERT INTO `station` (`name`, `city`) VALUES ("St Peters Station", "St Peters");
INSERT INTO `station` (`name`, `city`) VALUES ("Stanmore Station", "Stanmore");
INSERT INTO `station` (`name`, `city`) VALUES ("Strathfield Station", "Strathfield");
INSERT INTO `station` (`name`, `city`) VALUES ("Summer Hill Station", "Summer Hill");
INSERT INTO `station` (`name`, `city`) VALUES ("Sutherland Station", "Sutherland");
INSERT INTO `station` (`name`, `city`) VALUES ("Sydenham Station", "Sydenham");
INSERT INTO `station` (`name`, `city`) VALUES ("Telopea Station", "Telopea");
INSERT INTO `station` (`name`, `city`) VALUES ("Tempe Station", "Tempe");
INSERT INTO `station` (`name`, `city`) VALUES ("Thornleigh Station", "Thornleigh");
INSERT INTO `station` (`name`, `city`) VALUES ("Toongabbie Station", "Toongabbie");
INSERT INTO `station` (`name`, `city`) VALUES ("Town Hall Station", "Sydney");
INSERT INTO `station` (`name`, `city`) VALUES ("Turramurra Station", "Turramurra");
INSERT INTO `station` (`name`, `city`) VALUES ("Turrella Station", "Turrella");
INSERT INTO `station` (`name`, `city`) VALUES ("Villawood Station", "Villawood");
INSERT INTO `station` (`name`, `city`) VALUES ("Vineyard Station", "Vineyard");
INSERT INTO `station` (`name`, `city`) VALUES ("Wahroonga Station", "Wahroonga");
INSERT INTO `station` (`name`, `city`) VALUES ("Waitara Station", "Waitara");
INSERT INTO `station` (`name`, `city`) VALUES ("Warrawee Station", "Warrawee");
INSERT INTO `station` (`name`, `city`) VALUES ("Warwick Farm Station", "Warwick Farm");
INSERT INTO `station` (`name`, `city`) VALUES ("Waterfall Station", "Waterfall");
INSERT INTO `station` (`name`, `city`) VALUES ("Waverton Station", "Waverton");
INSERT INTO `station` (`name`, `city`) VALUES ("Wentworthville Station", "Wentworthville");
INSERT INTO `station` (`name`, `city`) VALUES ("Werrington Station", "Werrington");
INSERT INTO `station` (`name`, `city`) VALUES ("West Ryde Station", "West Ryde");
INSERT INTO `station` (`name`, `city`) VALUES ("Westmead Station", "Westmead");
INSERT INTO `station` (`name`, `city`) VALUES ("Wiley Park Station", "Wiley Park");
INSERT INTO `station` (`name`, `city`) VALUES ("Windsor Station", "Windsor");
INSERT INTO `station` (`name`, `city`) VALUES ("Wolli Creek Station", "Wolli Creek");
INSERT INTO `station` (`name`, `city`) VALUES ("Wollstonecraft Station", "Wollstonecraft");
INSERT INTO `station` (`name`, `city`) VALUES ("Woolooware Station", "Woolooware");
INSERT INTO `station` (`name`, `city`) VALUES ("Wynyard Station", "Sydney");
INSERT INTO `station` (`name`, `city`) VALUES ("Yagoona Station", "Yagoona");
INSERT INTO `station` (`name`, `city`) VALUES ("Yennora Station", "Yennora");
