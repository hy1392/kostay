-- 
-- 데이터베이스: `SMS`
-- 

-- --------------------------------------------------------

-- 
-- 테이블 구조 `SMS_DATA`
-- 

CREATE TABLE `SMS_DATA` (
  `MSG_SEQ` int(10) unsigned NOT NULL auto_increment,
  `CUR_STATE` int(10) unsigned default NULL,
  `SEND_DATE` datetime default NULL,
  `RSLT_DATE` datetime default NULL,
  `RSLT_CODE` int(10) unsigned default NULL,
  `RSV_DATE` varchar(8) default NULL,
  `RSV_TIME` varchar(6) default NULL,
  `CALL_TO` varchar(13) NOT NULL default '',
  `CALL_FROM` varchar(13) NOT NULL default '',
  `CALL_NAME` varchar(16) NOT NULL default '',
  `URL` varchar(50) default NULL,
  `MSG_TXT` varchar(80) default NULL,
  PRIMARY KEY  (`MSG_SEQ`,`CALL_TO`,`CALL_FROM`),
  UNIQUE KEY `MSG_SEQ` (`MSG_SEQ`)
) TYPE=MyISAM COMMENT='SMS 저장테이블' AUTO_INCREMENT=1 ;