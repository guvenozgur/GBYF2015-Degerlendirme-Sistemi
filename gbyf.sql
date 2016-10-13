

/*!40101 SET NAMES utf8 */;

#
# Structure for table "admin"
#

CREATE TABLE `admin` (
  `adminId` bigint(20) NOT NULL,
  `adminIsmi` varchar(255) NOT NULL,
  `adminSifre` varchar(255) NOT NULL,
  `adminEmail` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Structure for table "aktiflestirme"
#

CREATE TABLE `aktiflestirme` (
  `aktiflestirmeId` bigint(20) NOT NULL,
  `aktiflestirmeIsmi` varchar(255) NOT NULL,
  `onOff` bigint(20) NOT NULL,
  `degerlendirmeSinifi` bigint(20) NOT NULL,
  `degerlendirmeGrubu` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Structure for table "grup"
#

CREATE TABLE `grup` (
  `grupId` bigint(20) NOT NULL,
  `projeIsmi` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `katilimci1` varchar(255) COLLATE utf8_turkish_ci NOT NULL DEFAULT '',
  `katilimci1uni` varchar(255) COLLATE utf8_turkish_ci NOT NULL DEFAULT '',
  `katilimci1dep` varchar(255) COLLATE utf8_turkish_ci NOT NULL DEFAULT '',
  `katilimci2` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `katilimci2uni` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `katilimci2dep` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `katilimci3` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `katilimci3uni` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `katilimci3dep` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `katilimci4` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `katilimci4uni` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `katilimci4dep` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `katilimci5` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `katilimci5uni` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `katilimci5dep` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `grupEmail` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `degerlendirmeSinifi` bigint(20) NOT NULL,
  `degerlendirmeGrubu` bigint(20) NOT NULL,
  `ilkToplam` double(20,3) DEFAULT '0.000',
  `ikinciToplam` double(20,3) NOT NULL DEFAULT '0.000',
  `basari` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

#
# Structure for table "ikinciakademik"
#

CREATE TABLE `ikinciakademik` (
  `degerlendirmeId` bigint(20) NOT NULL DEFAULT '20',
  `juriId` bigint(20) NOT NULL,
  `grupId` bigint(20) NOT NULL,
  `projeIsmi` varchar(255) NOT NULL,
  `ozgunluk` double(20,3) DEFAULT NULL,
  `dogruluk` double(20,3) DEFAULT NULL,
  `potansiyel` double(20,3) DEFAULT NULL,
  `sistematik` double(20,3) DEFAULT NULL,
  `problem` double(20,3) DEFAULT NULL,
  `literaturTarama` double(20,3) DEFAULT NULL,
  `sunum` double(20,3) DEFAULT NULL,
  `not` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Structure for table "ikincifikir"
#

CREATE TABLE `ikincifikir` (
  `degerlendirmeId` bigint(20) NOT NULL,
  `juriId` bigint(20) NOT NULL,
  `grupId` bigint(20) NOT NULL,
  `projeIsmi` varchar(255) NOT NULL,
  `degerlendirme1` double(20,3) DEFAULT NULL,
  `degerlendirme2` double(20,3) DEFAULT NULL,
  `degerlendirme3` double(20,3) DEFAULT NULL,
  `degerlendirme4` double(20,3) DEFAULT NULL,
  `degerlendirme5` double(20,3) DEFAULT NULL,
  `degerlendirme6` double(20,3) DEFAULT NULL,
  `not` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Structure for table "ikincisektorel"
#

CREATE TABLE `ikincisektorel` (
  `degerlendirmeId` bigint(20) NOT NULL,
  `juriId` bigint(20) NOT NULL,
  `grupId` bigint(20) NOT NULL,
  `projeIsmi` varchar(255) NOT NULL,
  `yenilikcilik` double(20,3) NOT NULL DEFAULT '0.000',
  `surdurulebilirlik` double(20,3) NOT NULL DEFAULT '0.000',
  `cevreyeFayda` double(20,3) NOT NULL DEFAULT '0.000',
  `tasarim` double(20,3) NOT NULL DEFAULT '0.000',
  `gerceklesme` double(20,3) NOT NULL DEFAULT '0.000',
  `demo` double(20,3) NOT NULL DEFAULT '0.000',
  `not` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Structure for table "ilkakademik"
#

CREATE TABLE `ilkakademik` (
  `degerlendirmeId` bigint(20) NOT NULL,
  `degerlendirmeGrubu` bigint(20) NOT NULL,
  `juriId` bigint(20) NOT NULL,
  `grupId` bigint(20) NOT NULL,
  `projeIsmi` varchar(255) NOT NULL,
  `ozgunluk` double(20,3) DEFAULT NULL,
  `dogruluk` double(20,3) DEFAULT NULL,
  `potansiyel` double(20,3) DEFAULT NULL,
  `sistematik` double(20,3) DEFAULT NULL,
  `problem` double(20,3) DEFAULT NULL,
  `literaturTarama` double(20,3) DEFAULT NULL,
  `sunum` double(20,3) DEFAULT NULL,
  `not` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Structure for table "ilkfikir"
#

CREATE TABLE `ilkfikir` (
  `degerlendirmeId` bigint(20) NOT NULL,
  `degerlendirmeGrubu` bigint(20) NOT NULL,
  `juriId` bigint(20) NOT NULL,
  `grupId` bigint(20) NOT NULL,
  `projeIsmi` varchar(255) NOT NULL,
  `degerlendirme1` double(20,3) NOT NULL DEFAULT '0.000',
  `degerlendirme2` double(20,3) NOT NULL DEFAULT '0.000',
  `degerlendirme3` double(20,3) NOT NULL DEFAULT '0.000',
  `degerlendirme4` double(20,3) NOT NULL DEFAULT '0.000',
  `degerlendirme5` double(20,3) NOT NULL DEFAULT '0.000',
  `degerlendirme6` double(20,3) NOT NULL DEFAULT '0.000',
  `not` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Structure for table "ilksektorel"
#

CREATE TABLE `ilksektorel` (
  `degerlendirmeId` bigint(20) NOT NULL,
  `degerlendirmeGrubu` bigint(20) NOT NULL,
  `juriId` bigint(20) NOT NULL,
  `grupId` bigint(20) NOT NULL,
  `projeIsmi` varchar(255) NOT NULL,
  `yenilikcilik` double(20,3) NOT NULL DEFAULT '0.000',
  `surdurulebilirlik` double(20,3) NOT NULL DEFAULT '0.000',
  `cevreyeFayda` double(20,3) NOT NULL DEFAULT '0.000',
  `tasarim` double(20,3) NOT NULL DEFAULT '0.000',
  `gerceklesme` double(20,3) NOT NULL DEFAULT '0.000',
  `demo` double(20,3) NOT NULL DEFAULT '0.000',
  `not` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Structure for table "juri"
#

CREATE TABLE `juri` (
  `juriId` bigint(20) NOT NULL,
  `juriIsmi` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL DEFAULT '',
  `juriSoyismi` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL DEFAULT '',
  `juriSifre` varchar(255) NOT NULL,
  `juriEmail` varchar(255) DEFAULT NULL,
  `degerlendirmeSinifi` bigint(20) NOT NULL,
  `degerlendirmeGrubu` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Structure for table "log"
#

CREATE TABLE `log` (
  `logId` bigint(20) NOT NULL AUTO_INCREMENT,
  `kullaniciId` bigint(20) DEFAULT '0',
  `tarih` varchar(255) NOT NULL,
  `degisiklik` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `degiskenId` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`logId`)
) ENGINE=MyISAM AUTO_INCREMENT=722 DEFAULT CHARSET=utf8;

#
# Structure for table "moderator"
#

CREATE TABLE `moderator` (
  `moderatorId` bigint(20) NOT NULL,
  `moderatorIsmi` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL DEFAULT '',
  `moderatorSifre` varchar(255) NOT NULL,
  `moderatorEmail` varchar(255) NOT NULL,
  `moderatorSinifi` bigint(20) NOT NULL DEFAULT '0',
  `moderatorGrubu` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
