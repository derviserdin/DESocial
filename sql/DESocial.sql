-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Anamakine: 127.0.0.1
-- Üretim Zamaný: 18 Haz 2018, 19:03:00
-- Sunucu sürümü: 10.1.13-MariaDB
-- PHP Sürümü: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabaný: `ikinci_osmanli_db`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapýsý `bildirimler`
--

CREATE TABLE `bildirimler` (
  `id` int(11) NOT NULL,
  `user_gelen_id` int(11) NOT NULL,
  `bildirim_baglanti` varchar(255) NOT NULL,
  `bildirim_type` varchar(255) NOT NULL,
  `okundu_bilgisi` int(1) NOT NULL,
  `bildirim_giden_user` int(11) NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapýsý `hashtage`
--

CREATE TABLE `hashtage` (
  `id` int(11) NOT NULL,
  `adi` varchar(250) NOT NULL,
  `sayi` int(11) NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `hashtage`
--

INSERT INTO `hashtage` (`id`, `adi`, `sayi`, `tarih`) VALUES
(1, '**cccc', 1, '2018-06-18 14:15:01');

-- --------------------------------------------------------

--
-- Tablo için tablo yapýsý `paylasim`
--

CREATE TABLE `paylasim` (
  `paylasim_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `paylasim_icerik` text NOT NULL,
  `paylasim_url` varchar(255) NOT NULL,
  `paylasim_resim_id` varchar(255) NOT NULL,
  `paylasim_sayisi` int(11) NOT NULL,
  `paylasim_sahibi` int(11) NOT NULL,
  `paylasim_tarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `paylasim_guncelleme_tarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `paylasim_begeni_sayisi` int(11) NOT NULL,
  `paylasim_yorum_sayisi` int(11) NOT NULL,
  `paylasim_harici_link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapýsý `paylasim_begeni`
--

CREATE TABLE `paylasim_begeni` (
  `id` int(11) NOT NULL,
  `bg_user_id` int(11) NOT NULL,
  `bg_tarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bg_pay_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapýsý `paylasim_yorum`
--

CREATE TABLE `paylasim_yorum` (
  `yorum_id` int(11) NOT NULL,
  `paylasim_id` int(11) NOT NULL,
  `paylasim_yorum_user` int(11) NOT NULL,
  `yorum_icerik` text NOT NULL,
  `yorum_resim_id` varchar(255) NOT NULL,
  `yorum_tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `yorum_begeni_sayisi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapýsý `paylasim_yorum_begeni`
--

CREATE TABLE `paylasim_yorum_begeni` (
  `yorum_bg_id` int(11) NOT NULL,
  `paylasim_id` int(11) NOT NULL,
  `paylasim_yorum_id` int(11) NOT NULL,
  `paylasim_yorum_user` int(11) NOT NULL,
  `yorum_bg_tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapýsý `sikayet`
--

CREATE TABLE `sikayet` (
  `id` int(11) NOT NULL,
  `sikayet_eden_id` int(11) NOT NULL,
  `sikayet_user_id` int(11) NOT NULL,
  `paylasim_id` int(11) NOT NULL,
  `sikayet_type` varchar(255) NOT NULL,
  `aciklama` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapýsý `slider`
--

CREATE TABLE `slider` (
  `resim_id` int(11) NOT NULL,
  `resim_url` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `slider`
--

INSERT INTO `slider` (`resim_id`, `resim_url`) VALUES
(23, 'Diyarbakirspor-2009-2010-web.jpg'),
(24, 'Diyarbakirspor-2009-2010-web.jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapýsý `takip`
--

CREATE TABLE `takip` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `takip_edilen_id` int(11) NOT NULL,
  `takip_type` enum('takip','takipci') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapýsý `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_adi` varchar(255) NOT NULL,
  `user_soyadi` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_kayit_tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_giris_tarih` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_type` enum('uye','yetkili','superAd','editor') NOT NULL,
  `user_ulke` varchar(255) NOT NULL,
  `user_sehir` varchar(255) NOT NULL,
  `user_profil_resim` varchar(100) NOT NULL,
  `user_dogum_tarih` date NOT NULL,
  `user_takipci_sayi` int(11) NOT NULL,
  `user_takip_edilen_sayi` int(11) NOT NULL,
  `user_ip` varchar(255) NOT NULL,
  `user_aktivasyon` int(11) NOT NULL,
  `user_pay_gizle` varchar(1) NOT NULL DEFAULT 'a',
  `user_takip_durum` enum('a','b') NOT NULL DEFAULT 'a',
  `user_mesaj_durum` enum('a','b') DEFAULT 'a'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`user_id`, `user_adi`, `user_soyadi`, `username`, `password`, `user_email`, `user_kayit_tarih`, `user_giris_tarih`, `user_type`, `user_ulke`, `user_sehir`, `user_profil_resim`, `user_dogum_tarih`, `user_takipci_sayi`, `user_takip_edilen_sayi`, `user_ip`, `user_aktivasyon`, `user_pay_gizle`, `user_takip_durum`, `user_mesaj_durum`) VALUES
(1, 'Derviþ', 'Erdin', 'dervis', '1234', 'dervis.erdin@gmail.com', '2017-01-12 15:04:32', '2018-06-18 16:07:11', 'superAd', 'türkiye', 'Ýstanbul', '15b27bd63a0212.jpg', '1992-10-10', 93, 651, '::1', 1, 'a', 'b', 'b'),
(2, 'Mehmet', 'Tuna', 'mehmettuna', '1234', 'dervis.123123123@gmail.com', '2017-01-12 15:04:33', '0000-00-00 00:00:00', 'uye', '', '', '', '0000-00-00', 61, 1, '', 0, 'a', 'a', 'a'),
(4, 'Hürkan', 'Tuna', 'hurkan', '123', 'hurkantuna@gmail.com', '2017-01-12 15:04:34', '0000-00-00 00:00:00', 'yetkili', '', '', '15870c2f6e8e73.jpg', '0000-00-00', 70, 33, '95.14.75.13', 1, 'b', 'a', 'a'),
(5, 'Enes', 'Tuna', 'enestuna', '1234', 'eenestuna@gmail.com', '2017-01-14 14:19:29', '0000-00-00 00:00:00', 'yetkili', 'Türkiye', 'Ýstanbul', '15890a2c176f07.jpg', '1991-06-10', 103, 854, '84.51.52.9', 1, 'a', 'a', 'a'),
(6, 'osman', 'çamlý', 'osmancamli', 'Nurdan14Temmuz', 'osman.camli@vdk.gov.tr', '2017-01-14 09:16:35', '0000-00-00 00:00:00', 'yetkili', 'Türkiye', 'Kahramanmaraþ', '15870cf55817bd.jpg', '1978-04-02', 165, 880, '37.155.223.205', 1, 'a', 'a', 'a'),
(7, 'osman', 'ca', 'osmanca', 'Nurdan14Temmuz', 'osman_ca@mynet.com', '2017-01-14 09:16:50', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Ankara', '15870822a50b74.jpg', '1979-01-01', 149, 905, '88.227.213.138', 1, 'a', 'a', 'a'),
(8, 'Ahmet', 'Gören', 'agoren', '58956589', 'goren.ahmet@gmail.com', '2017-01-16 07:20:23', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Kahramanmaraþ', '158712eafc49f8.jpg', '1985-03-22', 97, 862, '46.154.32.207', 1, 'a', 'a', 'a'),
(10, 'Nuran', 'Çamlý', 'Nurdanca', '93472Subat21', 'nurannurdanca@gmail.com', '2017-01-13 08:02:53', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Ankara', '158e219735c65a.png', '1985-01-01', 134, 877, '88.227.213.138', 1, 'a', 'a', 'a'),
(11, 'Tuba', 'Gören', 'tgoren', 'tuba99', 'goren.tuuba@gmail.com', '2017-01-12 22:34:26', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Ankara', '158ce8f282d3bd.jpg', '1986-01-25', 120, 869, '46.154.230.102', 1, 'a', 'a', 'a'),
(12, 'Þevket', 'Çobanlar', '@ÞevketAyþegül', 'sevket46', 'sevketcobanlar01@gmail.com', '2017-01-12 22:34:26', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Kahramanmaraþ', '158876e1340999.png', '1981-02-01', 120, 871, '178.247.19.236', 1, 'a', 'a', 'a'),
(14, 'Ahmet ', 'Korkmaz ', 'Türkahmet', 'ahmet1ler', 'ahmet_2011_korkmaz@hotmail.com', '2017-01-12 15:04:43', '0000-00-00 00:00:00', 'uye', '', '', '', '0000-00-00', 53, 0, '', 0, 'a', 'a', 'a'),
(15, 'Hacý Mehmet', 'KODAZ', 'kodaz', '63463875', 'mehmetkodaz@yandex.com', '2017-01-12 15:04:44', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'kahramanmaraþ', '158722bf51b039.jpg', '1970-01-01', 60, 12, '', 0, 'a', 'a', 'a'),
(16, 'Bülent Ekrem', 'Uçan', 'bekrem', 'bekrem44', 'eskon44@gmail.com', '2017-01-12 15:04:46', '0000-00-00 00:00:00', 'uye', '', '', '', '0000-00-00', 50, 0, '', 0, 'a', 'a', 'a'),
(19, 'Ali', 'Aksu', 'Ali', '123456', 'aksuelektrikaksu@hotmail.com', '2017-01-12 15:04:45', '0000-00-00 00:00:00', 'uye', '', '', '', '0000-00-00', 51, 7, '', 0, 'a', 'a', 'a'),
(20, 'Mustafa', 'Turhan', 'mturhan51', '17234690686', 'trhn51@gmail.com', '2017-01-12 15:04:48', '0000-00-00 00:00:00', 'uye', '', '', '', '0000-00-00', 49, 0, '', 0, 'a', 'a', 'a'),
(21, 'mehmet', 'avcý', 'm.avci', '64464466', 'avcimeh@hotmail.com', '2017-01-12 15:04:49', '0000-00-00 00:00:00', 'uye', '', '', '', '0000-00-00', 49, 2, '', 0, 'a', 'a', 'a'),
(22, 'mehmet', 'avci', 'mehmetavci', '64464466', 'avcimeh1@gmail.com', '2017-01-12 15:04:49', '0000-00-00 00:00:00', 'uye', '', '', '', '0000-00-00', 51, 2, '', 0, 'a', 'a', 'a'),
(23, 'abdullah nadir', 'þiþman', 'abdullahnadir', '05522089046', 'eymn951@gmail.com', '2017-01-13 08:02:53', '0000-00-00 00:00:00', 'uye', '', '', '158b90ca0ee94e.jpg', '0000-00-00', 55, 69, '', 0, 'a', 'a', 'a'),
(24, 'Ali', 'Engizek', 'Engizek', 'alibaba', 'engali_46@hotmail.com', '2017-01-14 14:19:29', '0000-00-00 00:00:00', 'uye', '', '', '', '0000-00-00', 47, 1, '', 0, 'a', 'a', 'a'),
(25, 'Alim', 'Hatipgil', 'Alimhatipgil', 'bandocu1', 'alimhatipgil.ah@gmail.com', '2017-01-21 19:14:52', '0000-00-00 00:00:00', 'uye', '', '', '', '2017-01-21', 43, 0, '', 0, 'a', 'a', 'a'),
(26, 'Zekeriya', 'Koç', 'Zekeriyakoc', 'sanane61', 'kadir_zekeriya@hotmail.com', '2017-01-22 04:31:39', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Ardahan', '', '1998-12-10', 44, 15, '', 1, 'a', 'a', 'a'),
(27, 'turan', 'Þahin', 'turansahin', '7591163efsane58', 'turansahin_@hotmail.com', '2017-01-22 04:53:32', '0000-00-00 00:00:00', 'uye', '', '', '', '1985-12-25', 44, 0, '', 0, 'a', 'a', 'a'),
(28, 'tarýk', 'balaban', 'tarik.17', 'balabankk', 'tarikbalaban75@gmail.com', '2017-01-22 04:53:46', '0000-00-00 00:00:00', 'uye', 'türkiye', 'muðla', '', '1998-06-28', 44, 0, '', 0, 'a', 'a', 'a'),
(30, 'Halil ibrahim', 'Ceryan', 'Hic', '28subatozgem', 'halilibrahimceryan@hotmail.com', '2017-01-22 05:13:11', '0000-00-00 00:00:00', 'uye', '', '', '', '0000-00-00', 43, 0, '', 0, 'a', 'a', 'a'),
(31, 'Turkan', 'Dangac', 'Turkan', 'menzil', 'turkandngc@gmail.com', '2017-01-22 05:24:55', '0000-00-00 00:00:00', 'uye', '', '', '', '2022-01-20', 44, 2, '', 0, 'a', 'a', 'a'),
(32, 'Muhammed ', 'Sevmiþ ', 'Muhammed ', '386845', 'kervansaray_pasa@hotmail.com', '2017-01-22 05:25:44', '0000-00-00 00:00:00', 'uye', '', '', '', '2017-01-22', 42, 0, '', 0, 'a', 'a', 'a'),
(33, 'Muharrem', 'Tosun', 'MuharremTosun', '@mt3869693@', 'mtosun07@hotmail.com', '2017-01-22 05:31:35', '0000-00-00 00:00:00', 'uye', '', '', '', '1965-09-20', 43, 0, '', 1, 'a', 'a', 'a'),
(34, 'zeliha', 'soyak', 'kardelen', 'ikincibahar', 'soyakzeliha6@gmail.com', '2017-01-22 05:41:43', '0000-00-00 00:00:00', 'uye', 'Turkiye', 'Kayseri', '', '1989-05-18', 48, 0, '', 1, 'a', 'a', 'a'),
(35, 'barýþ', 'gel', 'barýþgel', '45mandemben', 'salakfocubuk32@mynet.com', '2017-01-22 05:50:47', '0000-00-00 00:00:00', 'uye', '', '', '', '2017-01-22', 44, 0, '', 0, 'a', 'a', 'a'),
(36, 'Kübra', ' Özer balcý', 'Kübra özer balcý', '12345678', 'kubrabalci@gmail.com', '2017-01-22 06:14:20', '0000-00-00 00:00:00', 'uye', '', '', '', '2017-01-22', 43, 0, '', 0, 'a', 'a', 'a'),
(37, 'Fahriye', 'Karakaþ ', 'Feriðim', 'fisa61', 'fahriye.hh@hotmail.com', '2017-01-23 06:37:50', '0000-00-00 00:00:00', 'uye', '', '', '', '2017-01-23', 43, 1, '', 1, 'a', 'a', 'a'),
(38, 'Coþkun', 'ÇOPUROÐLU', 'Çopur_46', 'Emiralp09', 'copurbc_46@hotmail.com', '2017-01-23 18:03:16', '0000-00-00 00:00:00', 'uye', '', '', '', '2017-01-23', 39, 2, '5.177.140.98', 0, 'a', 'a', 'a'),
(39, 'Orhan', 'Gökalp', 'Orhan', '19611966', 'fog_6166@hotmail.com', '2017-01-24 05:59:08', '0000-00-00 00:00:00', 'uye', 'türkiye', 'Antalya', '', '1966-07-14', 41, 0, '', 0, 'a', 'a', 'a'),
(41, 'Ali', 'Candan', 'Bozkýr', '4261865', 'alicandan42@mynet.com', '2017-01-25 07:58:10', '0000-00-00 00:00:00', 'uye', '', '', '', '1979-01-01', 39, 2, '', 0, 'a', 'a', 'a'),
(42, 'ali', 'gungor', 'aligungor', '1234', 'enestuna@windowslive.com', '2017-01-25 10:17:36', '0000-00-00 00:00:00', 'uye', 'türkiye', 'di', '', '1991-06-10', 38, 6, '', 1, 'a', 'a', 'a'),
(44, 'mehmet', 'aksu', 'osmanlicihandevleti', 'Ahmetmurat', 'mehmet-_-aksu@hotmail.com', '2017-01-28 15:19:25', '0000-00-00 00:00:00', 'uye', '', '', '', '2017-01-02', 39, 0, '', 0, 'a', 'a', 'a'),
(45, 'Ömer Faruk', 'Çaðlayan ', 'Turgutreis', '695394om', 'omer_gs38@windowslive.com', '2017-01-30 06:50:59', '0000-00-00 00:00:00', 'uye', '', '', '', '1999-03-31', 37, 0, '', 0, 'a', 'a', 'a'),
(46, 'Ali ihsan', 'Özer', 'Ozer046', 'avsaroglu46.', 'byozer46@gmail.com', '2017-01-30 20:21:07', '0000-00-00 00:00:00', 'uye', '', '', '', '1999-06-01', 37, 0, '', 0, 'a', 'a', 'a'),
(48, 'Güçlü ', 'Üçler', 'güçlüosmanlý', '3196326', 'guclucler@gmail.com', '2017-02-01 19:57:30', '0000-00-00 00:00:00', 'uye', '', '', '', '1982-01-01', 38, 1, '', 1, 'a', 'a', 'a'),
(49, 'Davut', 'YURT', 'Osmanlýcý', 'Ali.2016', 'yurtdavut@gmail.com', '2017-02-01 19:57:46', '0000-00-00 00:00:00', 'uye', '', '', '', '1981-00-01', 34, 1, '', 0, 'a', 'a', 'a'),
(50, 'Hilal', 'Þen', 'SezginHilal', '"1234"1234', 'sezginhilal99@gmail.com', '2017-02-01 23:27:21', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Kahramanmaraþ', '15891ed20808ba.jpg', '1993-01-24', 90, 857, '178.247.116.1', 1, 'a', 'a', 'a'),
(51, 'Sezgin', 'Þen', 'HilalSezgin', '"1234"1234', 'hilalsezgin99@gmail.com', '2017-02-02 00:26:26', '0000-00-00 00:00:00', 'uye', '', '', '15892206752e23.jpg', '1993-01-24', 76, 852, '178.247.116.1', 1, 'a', 'a', 'a'),
(52, 'Yusuf', 'Çamlý', 'YusufÇamlý', 'yusuf99', 'yusufcamli99@gmail.com', '2017-02-02 02:58:21', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Kahramanmaraþ', '1589219d16c7dc.jpg', '1956-07-24', 79, 852, '178.247.84.134', 1, 'a', 'a', 'a'),
(53, 'Fatma', 'Çamlý', 'FatmaÇamlý', '7894561230,', 'fatmacamli99@gmail.com', '2017-02-02 03:31:55', '0000-00-00 00:00:00', 'uye', '', '', '158921ff0b38c2.jpg', '1963-06-26', 89, 858, '178.247.84.134', 1, 'a', 'a', 'a'),
(54, 'Ayþegül', 'Çobanlar', 'AyþegülÞevket', 'aysegul99', 'aysegulcobanlar99@gmail.com', '2017-02-02 05:45:28', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Kahramanmaraþ', '158923dbdd0a8c.jpg', '1984-11-27', 70, 491, '151.135.8.144', 1, 'a', 'a', 'a'),
(55, 'Veli', 'Çelik', 'Cellat 71', '1299veli', 'veli.celik.7114@gmail.com', '2017-02-02 15:16:23', '0000-00-00 00:00:00', 'uye', '', '', '', '2000-05-14', 36, 0, '', 0, 'a', 'a', 'a'),
(56, 'Hatice ', 'Önmen', 'HaticeHarun', '28111987', 'haticeonmen87@gmail.com', '2017-02-02 19:53:43', '0000-00-00 00:00:00', 'uye', '', '', '15893031e223eb.jpg', '1987-11-28', 46, 76, '178.247.23.218', 1, 'a', 'a', 'a'),
(57, 'Evladý', 'Fatihan', '@Fatihan', 'sevket46', 'sevketcobanlar99@gmail.com', '2017-02-04 03:43:24', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Kahramanmaras', '15894c40d4c339.png', '1981-02-01', 88, 880, '178.247.133.132', 1, 'a', 'a', 'a'),
(58, 'oguzkagan', 'TÜRK ', 'ERTUÐRUL', 'kadirayhan', 'ertugtuloguzkagan@gmail.com', '2017-02-04 19:50:46', '0000-00-00 00:00:00', 'uye', '', '', '', '1981-07-15', 33, 0, '', 0, 'a', 'a', 'a'),
(59, 'oðuz Kaðan ', 'TÜRK ', 'ERTUGRUL1923', 'kadirayhan', 'ertugruloguzkagan@gmail.com', '2017-02-04 19:57:49', '0000-00-00 00:00:00', 'uye', '', '', '', '1981-07-15', 33, 0, '', 0, 'a', 'a', 'a'),
(60, 'Ertuðrul', 'Türk', 'OðuzErtuðrul', '7539510,', 'oguzertugrul99@gmail.com', '2017-02-04 20:14:57', '0000-00-00 00:00:00', 'uye', '', '', '', '1990-01-01', 33, 0, '', 1, 'a', 'a', 'a'),
(61, 'Yunus', 'Adýyaman', 'ynsemradymn', 'deneme123', 'yyunus44@hotmail.com', '2017-02-06 05:58:30', '0000-00-00 00:00:00', 'uye', '', '', '', '0000-00-00', 31, 0, '', 0, 'a', 'a', 'a'),
(62, 'Muhammed', 'Özdemir', 'ozdemir', 'ozdemir1834', 'mhmmdozdemir@outlook.com', '2017-02-06 18:57:34', '0000-00-00 00:00:00', 'uye', '', '', '', '1996-06-29', 30, 0, '', 0, 'a', 'a', 'a'),
(63, 'MUHAMMET OZAN', 'ÖZMEN', 'ABÜLHAMÝD', '0571osmanlý', 'osmanligayrimenkul1453@hotmail.com', '2017-02-08 18:38:21', '0000-00-00 00:00:00', 'uye', '', '', '', '1984-12-01', 30, 0, '', 0, 'a', 'a', 'a'),
(64, 'Emre', 'Ünal', 'Emrebey', 'emre2710', 'emreunaltr@gmail.com', '2017-02-14 19:59:48', '0000-00-00 00:00:00', 'uye', '', '', '', '1987-09-11', 31, 0, '', 0, 'a', 'a', 'a'),
(65, 'Ýsmet', 'Yanok', 'Toprak', 'ismtoprak', 'toprak_ism@hotmail.com', '2017-02-15 01:39:14', '0000-00-00 00:00:00', 'uye', '', '', '', '0000-01-15', 29, 0, '', 0, 'a', 'a', 'a'),
(66, 'Mahir', 'Gedik', 'Mahir', 'mahir6767', 'mahirgeduk@gmail.com', '2017-02-16 05:42:19', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Kocaeli', '158a4b00da4702.jpg', '1998-01-01', 30, 2, '', 0, 'a', 'a', 'a'),
(67, 'Ali', 'Baba', 'al23', 'vatanmilletdin', 'ali@gmail.com', '2017-02-18 05:34:52', '0000-00-00 00:00:00', 'uye', '', '', '', '1998-05-11', 29, 0, '', 0, 'a', 'a', 'a'),
(68, 'Emine ', 'Yüce ', 'Emine yüce', '123456', 'berra_sevgi@hotmail.com', '2017-02-18 06:53:33', '0000-00-00 00:00:00', 'uye', '', '', '', '1986-01-01', 38, 15, '', 0, 'a', 'a', 'a'),
(69, 'Hüseyin ', 'Erkek', 'Mazidekiler', 'Amasyalý', 'efeinci@gmx.de', '2017-02-19 06:02:24', '0000-00-00 00:00:00', 'uye', '', '', '', '1965-09-25', 29, 0, '', 0, 'a', 'a', 'a'),
(70, 'Ali', 'Adýgüzel ', 'Adgzelali', '183768', 'adgzwlali@gmail.com', '2017-03-02 03:16:33', '0000-00-00 00:00:00', 'uye', '', '', '', '1990-06-23', 29, 0, '', 0, 'a', 'a', 'a'),
(71, 'Esra', 'Gören', 'esra.grn', 'Esra.310007', 'esragr16@gmail.com', '2017-03-02 13:36:42', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Kahramanmaraþ', '158b7b2137206c.jpg', '1995-03-06', 42, 40, '46.154.32.60', 1, 'a', 'a', 'a'),
(72, 'ercanh', 'HARMANCI', 'ercanharmanci', 'HUNTER.123', 'ercanharmanci@hotmail.com', '2017-03-02 21:18:04', '0000-00-00 00:00:00', 'uye', '', '', '', '1974-01-01', 27, 0, '', 0, 'a', 'a', 'a'),
(73, 'Ozkan', 'Çiftçi', 'Vuslati', 'muhammed', 'vuslat_hassa@hotmail.com', '2017-03-03 01:56:15', '0000-00-00 00:00:00', 'uye', '', '', '', '1983-03-27', 31, 0, '', 0, 'a', 'a', 'a'),
(74, 'Rüstem ', 'Çetin ', 'Akhan ', '19740571', 'sakaryakocaalili@hotmail.com', '2017-03-03 03:19:52', '0000-00-00 00:00:00', 'uye', '', '', '', '1974-05-11', 30, 0, '', 0, 'a', 'a', 'a'),
(75, 'Esra', 'Akkaya', 'esraakkaya', 'galatasaray', 'isramirac@outlook.com', '2017-03-03 07:35:43', '0000-00-00 00:00:00', 'uye', '', '', '', '1983-01-18', 31, 0, '', 0, 'a', 'a', 'a'),
(76, 'Abdulmuttalip ', 'Ünal ', 'Abdülhamid ', '11022005', 'muttalip.unal@gmail.com', '2017-03-03 07:53:22', '0000-00-00 00:00:00', 'uye', '', '', '', '1983-05-23', 26, 0, '', 0, 'a', 'a', 'a'),
(77, 'sefa', 'tunoðlu', 'dedektor', '_123456_', 'inebolu_sefa37@hotmail.com', '2017-03-03 14:21:50', '0000-00-00 00:00:00', 'uye', '', '', '', '1990-04-06', 28, 4, '', 0, 'a', 'a', 'a'),
(78, 'Münire ', 'Tekten ', 'hale114@hotmail.com ', 'CANIMINCANIÖMRÜMM', 'kurtharun4646@gmail.com', '2017-03-03 19:06:48', '0000-00-00 00:00:00', 'uye', '', '', '', '1981-03-18', 29, 13, '', 0, 'a', 'a', 'a'),
(79, 'Yakub', 'Yorulmaz', 'Yakub', '.6410Yakub', 'Yakub46yorulmaz@gmail.com', '2017-03-03 21:46:48', '0000-00-00 00:00:00', 'uye', '', '', '', '1990-10-15', 25, 1, '', 0, 'a', 'a', 'a'),
(80, 'Veli', 'Akgun', 'Veliakgun', 'MoReaReTHe45', 'kapiciv3li@gmail.com', '2017-03-03 23:16:39', '0000-00-00 00:00:00', 'uye', '', '', '', '1986-11-06', 27, 2, '', 0, 'a', 'a', 'a'),
(81, 'Muhammet', 'Saçak', 'saçak46', '12345678..', 'mhmmdsacak@gmail.com', '2017-03-04 01:14:49', '0000-00-00 00:00:00', 'uye', '', '', '', '2003-04-06', 26, 3, '', 0, 'a', 'a', 'a'),
(82, 'Melahat', 'Yýlmaz ', 'Melahat YILMAZ', '11012016', 'melahatrabiayilmaz86@gmail.com', '2017-03-04 01:19:15', '0000-00-00 00:00:00', 'uye', '', '', '', '1986-05-10', 26, 0, '', 0, 'a', 'a', 'a'),
(83, 'Enes', 'CEYLAN', 'ENsCYlan', 'eneshoca', 'eneshocamat@gmail.com', '2017-03-04 03:07:57', '0000-00-00 00:00:00', 'uye', '', '', '', '2002-11-17', 26, 1, '', 0, 'a', 'a', 'a'),
(84, 'ali', 'veli', 'akparti', '147258369', 'alivelikonya35@gmail.com', '2017-03-04 03:50:11', '0000-00-00 00:00:00', 'uye', '', '', '', '1970-10-15', 28, 15, '', 0, 'a', 'a', 'a'),
(85, 'Murat', 'Yýlmaz', 'Antigaspcý', '123456.123456', 'zaman--x@hotmail.com', '2017-03-04 04:05:35', '0000-00-00 00:00:00', 'uye', '', '', '', '1980-09-12', 28, 8, '', 0, 'a', 'a', 'a'),
(86, 'Abdullah', 'Kamekçi', 'Akamekci18', 'akamekci18', 'akamekci18@gmail.com', '2017-03-04 16:08:08', '0000-00-00 00:00:00', 'uye', '', '', '158e557e5cdaa7.jpg', '1991-05-18', 26, 1, '176.42.70.40', 1, 'a', 'a', 'a'),
(87, 'Yakup', 'gök', 'yakupcan', 'yakup1542', 'yakupcan90@hotmail.com', '2017-03-04 16:30:40', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Kahramanmaraþ', '158baba1d29f2d.jpg', '1981-09-04', 28, 31, '81.215.40.73', 1, 'a', 'a', 'a'),
(88, 'hilmi', 'yýlmaz', 'hilmi', 'hzhe741741', 'havvaelifnaz.yilmaz@gmail.com', '2017-03-04 22:36:10', '0000-00-00 00:00:00', 'uye', 'türkiye', 'istanbul', '', '1973-08-25', 26, 0, '', 0, 'a', 'a', 'a'),
(89, 'Abdurrahman', 'Barstugan', 'abarstugan', '25mab0854', 'abdurrahmanbarstugan@gmail.com', '2017-03-04 22:51:25', '0000-00-00 00:00:00', 'uye', '', '', '', '1992-08-25', 26, 0, '', 0, 'a', 'a', 'a'),
(90, 'Mehmet', 'Dinçer', '5534Mehmet6448', '123asd789', 'gs10mehmet@hotmail.com', '2017-03-05 01:52:07', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Tekirdað', '158c5367d1f03c.jpg', '1999-01-24', 26, 3, '88.234.190.165', 1, 'a', 'a', 'a'),
(92, 'Þahsettin', 'BULUT', 'sahsettinbulut', '05378392338', 'sahsettinbulut@gmail.com', '2017-03-05 02:10:05', '0000-00-00 00:00:00', 'uye', '', '', '', '1978-08-17', 26, 0, '', 0, 'a', 'a', 'a'),
(93, 'Yunus', 'Destebaþý', 'yunusdestebasi', 'yunus1995', 'yunus_islam_ilim@hotmail.com', '2017-03-05 02:53:47', '0000-00-00 00:00:00', 'uye', '', '', '158c3684a88675.jpg', '1995-02-10', 32, 42, '95.10.230.187', 0, 'a', 'a', 'a'),
(94, 'Özkan', 'Ýnan', 'Özkan', 'ozkaninan', 'ozkaninanfener@gmail.com', '2017-03-05 15:49:54', '0000-00-00 00:00:00', 'uye', '', '', '', '0000-00-00', 26, 0, '', 0, 'a', 'a', 'a'),
(95, 'Ali', 'Öztürk', 'j.truva_2', '123456789asd', 'j.truva_2@hotmail.com', '2017-03-05 15:58:43', '0000-00-00 00:00:00', 'uye', '', '', '', '2000-01-01', 27, 0, '', 0, 'a', 'a', 'a'),
(96, 'Ersin', 'YILMAZ', 'Ersin', 'ackerman', 'ersinarb@gmail.com', '2017-03-05 16:09:49', '0000-00-00 00:00:00', 'uye', '', '', '', '1984-04-15', 27, 0, '', 0, 'a', 'a', 'a'),
(97, 'Þükran ', 'Demirtaþ', 'Maksadým vuslatýmdýr', 'Suko1973', 'demirtas-@hotmail.com', '2017-03-05 19:11:48', '0000-00-00 00:00:00', 'uye', '', '', '158bbf363508cc.jpg', '1973-07-26', 29, 0, '', 0, 'a', 'a', 'a'),
(98, 'AHMET', 'SIRLI', 'Suarre', 'hayalim', 'ahmetsirli@hotmail.com', '2017-03-06 17:43:36', '0000-00-00 00:00:00', 'uye', '', '', '158bd349e499eb.jpg', '1975-02-02', 29, 1, '', 1, 'a', 'a', 'a'),
(99, 'Ercan', 'Özben', 'Ercanozben', '320900', 'ercanozben11@gmail.com', '2017-03-07 17:19:08', '0000-00-00 00:00:00', 'uye', '', '', '', '1991-03-03', 25, 0, '', 0, 'a', 'a', 'a'),
(100, 'Adnan ', 'Keçeli ', 'Adnanmly', 'osman06', 'adnankeceli@gmail.com', '2017-03-07 20:34:21', '0000-00-00 00:00:00', 'uye', '', '', '', '1979-03-01', 25, 6, '', 0, 'a', 'a', 'a'),
(102, 'feride', 'kaya', 'feride', '12345678', 'feride@hotmail.com', '2017-03-09 00:00:37', '0000-00-00 00:00:00', 'uye', '', '', '', '1980-01-01', 27, 1, '', 0, 'a', 'a', 'a'),
(103, 'Hasan Hüseyin', 'Yerli ', 'Hasan_18', 'hs14531453+', 'nasah_1809@hotmail.com', '2017-03-09 23:49:54', '0000-00-00 00:00:00', 'uye', '', '', '158c17a34ab57d.jpg', '2002-01-30', 29, 28, '', 0, 'a', 'a', 'a'),
(104, 'Merve', 'Akca', 'Mrv.akc', 'mrvakcmb1994', 'Mrvakc1453@gmail.com', '2017-03-09 23:57:49', '0000-00-00 00:00:00', 'uye', '', '', '', '1994-07-16', 29, 0, '', 0, 'a', 'a', 'a'),
(106, 'Bekir', 'Ayaz', 'beacker_61', 'sagolera', 'kolpa1661@gmail.com', '2017-03-10 02:03:45', '0000-00-00 00:00:00', 'uye', '', '', '', '1993-01-03', 24, 0, '', 1, 'a', 'a', 'a'),
(107, 'Erdinç', 'Çelebi', 'Erdinç', '65866586', 'erdinccelebi5555@gmail.com', '2017-03-10 02:16:34', '0000-00-00 00:00:00', 'uye', '', '', '', '1985-05-17', 24, 0, '', 1, 'a', 'a', 'a'),
(108, 'Diriliþ', 'Vakti', 'DirilisVakti', 'Nurdan14Temmuz', 'dirilisvaktigeldi@gmail.com', '2017-03-10 02:32:23', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Ankara', '158c1a2245bf51.jpg', '1982-11-17', 128, 884, '37.155.223.205', 1, 'a', 'a', 'a'),
(109, 'Recep', 'Gokdeniz', 'Recep', 'delirecep', 'rcpgkdnz07@gmail.com', '2017-03-10 02:43:51', '0000-00-00 00:00:00', 'uye', '', '', '', '1985-06-25', 24, 0, '', 0, 'a', 'a', 'a'),
(110, 'Ümit Can ', 'Akay', 'yalnýz adam', 'þifrem05394642833', '05394642832@hotmail.com', '2017-03-10 04:00:09', '0000-00-00 00:00:00', 'uye', '', '', '', '1905-05-26', 24, 0, '', 0, 'a', 'a', 'a'),
(111, 'habibe', 'özçekmez', 'habibeozcekmez', 'konya4242', 'habibeozcekmez@yandex.com', '2017-03-10 08:06:55', '0000-00-00 00:00:00', 'uye', '', '', '158c1ee5801b5a.jpg', '1993-12-30', 31, 18, '', 0, 'a', 'a', 'a'),
(115, 'Mustafa', 'Hakyol', 'MHakyol', 'Mustafa111:)', 'm.hakyol111@gmail.com', '2017-03-10 18:53:11', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Kahramanmaras', '158c2888be02e2.jpg', '1997-09-22', 25, 13, '', 1, 'a', 'a', 'a'),
(116, 'Cevher izzet', 'Üzümcü', 'cvhr7', 'uzumcuc1327', 'cevherizzet123@gmail.com', '2017-03-10 18:56:47', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Aksaray', '158c289144e206.jpg', '1998-01-26', 25, 5, '', 1, 'a', 'a', 'a'),
(117, 'Adem', 'Oruç', 'Adem.oruç', 'trabzonlu', 'timurtimucin752@gmail.com', '2017-03-10 20:02:00', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Diyarbakýr', '158c2cbc4905d7.jpg', '1994-07-24', 24, 10, '188.57.139.18', 1, 'a', 'a', 'a'),
(118, 'Hasan Hüseyin ', 'Alýç ', '@Hasan Hüseyin ', 'sude2542', 'Hasanalic46@g.mail.com', '2017-03-10 20:42:42', '0000-00-00 00:00:00', 'uye', '', '', '', '1983-07-15', 29, 90, '46.221.172.127', 0, 'a', 'a', 'a'),
(119, 'Erdoðan ', 'Týnastepe', 'Osmanlý torunu', 'osm12991299', 'erdogantinastepe@hotmail.com', '2017-03-10 23:45:18', '0000-00-00 00:00:00', 'uye', '', '', '158c2cc74df2d2.png', '1975-02-02', 26, 15, '', 1, 'a', 'a', 'a'),
(120, 'Mehmed Efe ', 'Topaloðlu', 'mhmdfe_', '08082000', 'megi.efe.0808@gmail.com', '2017-03-10 23:50:13', '0000-00-00 00:00:00', 'uye', '', '', '', '2000-08-08', 24, 0, '', 1, 'a', 'a', 'a'),
(121, 'Muhammet mustafa', 'Karaman', 'Karaman', '133802008karaman', 'muhammedmustafakaraman@gmail.com', '2017-03-11 00:10:28', '0000-00-00 00:00:00', 'uye', '', '', '', '1995-05-05', 24, 1, '', 0, 'a', 'a', 'a'),
(122, 'ibrahim', 'yýlmaz', 'ibrahmylmz', 'sakarya54100', 'fecebook54@hotmail.com', '2017-03-11 01:01:16', '0000-00-00 00:00:00', 'uye', '', '', '', '1998-06-00', 24, 0, '', 0, 'a', 'a', 'a'),
(124, 'Ali', 'Ayan', 'Djent', 'yengeyengeyenge55', 'mortal._.love@hotmail.com', '2017-03-11 03:37:28', '0000-00-00 00:00:00', 'uye', '', '', '', '1992-09-28', 24, 0, '', 0, 'a', 'a', 'a'),
(125, 'Ertuðrul', 'Laloðlu', 'FarkTarz', '33157451784', 'cahit_78@hotmail.com', '2017-03-11 15:46:33', '0000-00-00 00:00:00', 'uye', '', '', '', '1999-01-28', 24, 0, '', 0, 'a', 'a', 'a'),
(126, 'Kudret ', 'Ercan ', 'Kudret ', '910211968', 'kudretercan@hotmail.com', '2017-03-11 23:03:15', '0000-00-00 00:00:00', 'uye', '', '', '', '1975-02-10', 24, 0, '', 0, 'a', 'a', 'a'),
(127, 'Ferdi', 'Þakýr', 'ferdi20', 'ariferdi.20', 'ferdisakir20@gmail.com', '2017-03-11 23:17:28', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Denizli', '', '1992-01-06', 24, 3, '', 1, 'a', 'a', 'a'),
(128, 'Yakup', 'Yýlmaz ', 'Ottoman ', '01234567', 'dimcayi_ozel@hotmail.com', '2017-03-11 23:58:50', '0000-00-00 00:00:00', 'uye', '', '', '', '1986-11-01', 25, 0, '', 0, 'a', 'a', 'a'),
(129, 'Enes', 'Özdemir', 'Nsözdmr', '2754666', 'e3637_46@hotmail.com', '2017-03-12 00:30:07', '0000-00-00 00:00:00', 'uye', '', '', '', '1987-05-08', 24, 0, '', 1, 'a', 'a', 'a'),
(130, 'orhan', 'ucak', 'orhanucak', '123456789', 'orhan_05221989@hotmail.com', '2017-03-12 00:52:15', '0000-00-00 00:00:00', 'uye', '', '', '', '1989-03-14', 24, 0, '', 0, 'a', 'a', 'a'),
(131, 'Mehmet ', 'Fýrat ', 'Mehmet Fýrat ', 'sanane', 'mf02341991@gmail.com', '2017-03-12 01:29:08', '0000-00-00 00:00:00', 'uye', '', '', '', '1991-01-20', 24, 0, '', 0, 'a', 'a', 'a'),
(132, 'Mustafa', 'Solmaz', 'Mustafasolmaz10', '49135112646ms', 'mustafasolmaz10@gmail', '2017-03-12 01:39:05', '0000-00-00 00:00:00', 'uye', '', '', '', '1986-09-05', 24, 0, '', 0, 'a', 'a', 'a'),
(133, 'Murathan', 'Yýldýrým ', 'Murathan', 'ydihs94ydyd', 'legend_of_murty@windowslive.com', '2017-03-12 12:11:13', '0000-00-00 00:00:00', 'uye', '', '', '', '1994-04-03', 24, 0, '', 0, 'a', 'a', 'a'),
(134, 'Mehmet ', 'Altýn ', 'Rte', '2002', 'Dortyol_kuruyemis@hotmail.com', '2017-03-12 13:43:55', '0000-00-00 00:00:00', 'uye', '', '', '', '1972-06-10', 24, 0, '', 0, 'a', 'a', 'a'),
(135, 'Hasan Hüseyin ', 'Bezci', 'Hasanhüseyin', '1572hhb', 'hasanbezci@gmail.com', '2017-03-12 13:51:12', '0000-00-00 00:00:00', 'uye', '', '', '', '1976-11-08', 24, 8, '', 0, 'a', 'a', 'a'),
(136, 'Ýkinci', 'Osmanlý', 'ikinciosmanli', 'Nurdan14Temmuz', 'ikinciosmanli@yahoo.com', '2017-03-12 14:50:11', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Ankara', '158c4fe82a981f.jpg', '1978-11-18', 103, 873, '37.155.223.205', 1, 'a', 'a', 'a'),
(137, 'Serdar', 'KURT', 'serdarkurtt', 'HAMpar134158', 'serdarkurtt@hotmail.com', '2017-03-12 15:43:34', '0000-00-00 00:00:00', 'uye', '', '', '', '1983-06-01', 25, 0, '', 0, 'a', 'a', 'a'),
(138, 'Kadir Can', 'dinçer ', 'Kadir  Can', 'Kadir24', 'dinerkadir@yahoo.com', '2017-03-12 16:54:30', '0000-00-00 00:00:00', 'uye', '', '', '', '1998-09-25', 24, 1, '', 0, 'a', 'a', 'a'),
(139, 'Mustafa', 'Kýlýncarslan', 'Ýlgab', 'Ab987654321', 'zamane1966@hotmail.com', '2017-03-12 17:58:32', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Antalya', '', '1971-11-05', 24, 0, '37.155.48.49', 0, 'a', 'a', 'a'),
(140, 'Nurullah', 'Kanik ', 'Kanikoglu', '14536165', 'kanikoglu616500@gmail.com', '2017-03-12 18:45:10', '0000-00-00 00:00:00', 'uye', '', '', '158c526f213f56.jpg', '1993-01-20', 24, 2, '', 1, 'a', 'a', 'a'),
(141, 'Murat', 'Can', 'Msgcan', 'msgcan1961', 'msgcan6161@gmail.com', '2017-03-12 18:52:36', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Ýstanbul', '158c52adebe06b.jpg', '1989-01-30', 24, 10, '', 1, 'a', 'a', 'a'),
(142, 'Erdal', 'Akkaya', 'faraklit', 'wx101137', 'eakkaya@msn.com', '2017-03-12 19:30:35', '0000-00-00 00:00:00', 'uye', '', '', '', '1969-10-05', 24, 0, '', 0, 'a', 'a', 'a'),
(143, 'Mehmet', 'Mehmet', 'mehmet1453', 'mehmet316004', 'memom3933@gmail.com', '2017-03-12 19:47:11', '0000-00-00 00:00:00', 'uye', 'Osmanlý devleti', 'Ýstanbul', '', '1980-09-15', 24, 0, '', 1, 'a', 'a', 'a'),
(144, 'Enes', 'Taþkaya', 'taskaya.7', 'm3m4t13r3n12', 'enesyusa2009@hotmail.com', '2017-03-12 20:30:11', '0000-00-00 00:00:00', 'uye', '', '', '', '1998-08-20', 24, 0, '', 0, 'a', 'a', 'a'),
(145, 'Yusuf', 'Günay', 'YusufBey1453', 'meryembetul', 'yusufgunay@gmail.com', '2017-03-12 20:31:31', '0000-00-00 00:00:00', 'uye', '', '', '158c5403dd6802.jpg', '2003-05-29', 24, 0, '', 0, 'a', 'a', 'a'),
(146, 'Mustafa ', 'Ercan ', 'Mustafa37', '98443437', 'uskudartesisat@gmail.com', '2017-03-12 21:34:25', '0000-00-00 00:00:00', 'uye', '', '', '', '1981-10-15', 24, 0, '', 1, 'a', 'a', 'a'),
(147, 'Alperen ', 'Yilmazer ', 'OÐUZ KAÐAN ', '17121985-1453', 'soner_ctn@hotmail', '2017-03-12 22:19:33', '0000-00-00 00:00:00', 'uye', '', '', '', '1985-11-02', 25, 0, '', 0, 'a', 'a', 'a'),
(148, 'muhsin', 'AÐIN', 'AkNesil', '07gs83ma', 'muhsinagin@gmail.com', '2017-03-12 23:32:47', '0000-00-00 00:00:00', 'uye', '', '', '', '1983-08-01', 24, 0, '', 0, 'a', 'a', 'a'),
(149, 'aliihsan', 'çaprak', 'ALÝÝHSAN ', '12341234', 'aliihsan111571@hotmail.com', '2017-03-13 00:19:52', '0000-00-00 00:00:00', 'uye', '', '', '', '1971-11-15', 24, 0, '', 0, 'a', 'a', 'a'),
(150, 'Zekeriya ', 'AKÇÝÇEK ', 'Zekeriya ', 'akcicek7489', 'zekeriyaaie@gmail', '2017-03-13 00:20:51', '0000-00-00 00:00:00', 'uye', '', '', '', '1989-10-04', 25, 0, '', 0, 'a', 'a', 'a'),
(151, 'savaþ', ' yýlmaz', 'sayýlmaz', 'savas1972', 'savas972@gmail', '2017-03-13 00:31:51', '0000-00-00 00:00:00', 'uye', '', '', '', '1972-10-22', 24, 0, '', 0, 'a', 'a', 'a'),
(152, 'resul', 'yýldýrým', 'pesimistdegiloptimist', 'dersimsen', 'hasiktirordanyalan@gmail.com', '2017-03-13 00:33:44', '0000-00-00 00:00:00', 'uye', '', '', '', '1997-02-10', 25, 0, '', 0, 'a', 'a', 'a'),
(153, 'isa', 'yilmaz', 'isa43', 'w167010w', 'sensizolmuyo571@hotmail.com', '2017-03-13 00:57:23', '0000-00-00 00:00:00', 'uye', '', '', '', '1982-11-23', 25, 2, '', 0, 'a', 'a', 'a'),
(154, 'Bilgehan', 'Öztürk', 'bilgehan', '3945474', 'abbasbalta795@gmail.com', '2017-03-13 01:31:35', '0000-00-00 00:00:00', 'uye', '', '', '', '1976-05-05', 25, 0, '', 0, 'a', 'a', 'a'),
(155, 'Yücel', 'Coþkun ', 'Yücel coþkun ', '1453', 'bafrayucel@gmail.com', '2017-03-13 01:38:36', '0000-00-00 00:00:00', 'uye', '', '', '', '1973-03-02', 24, 0, '', 1, 'a', 'a', 'a'),
(156, 'Mesut', 'Yalçýn', 'Mesut yalçýn', 'mihriban1', 'mesutmihriban1@gmail.com', '2017-03-13 01:56:01', '0000-00-00 00:00:00', 'uye', '', '', '', '1994-11-15', 24, 0, '', 0, 'a', 'a', 'a'),
(157, 'Abdulkadir', 'Çelebi ', 'Akç', 'akc027363602akc', 'a.kdrcelebi@hotmail.com', '2017-03-13 02:00:50', '0000-00-00 00:00:00', 'uye', '', '', '158c5914d14058.jpg', '1989-09-20', 26, 14, '176.54.126.73', 1, 'a', 'a', 'a'),
(158, 'ümit', 'çaðlar', 'umýd', 'erdoðan', 'umd_cglr@hotmail.com', '2017-03-13 02:04:35', '0000-00-00 00:00:00', 'uye', '', '', '', '1993-11-15', 24, 0, '', 0, 'a', 'a', 'a'),
(159, 'Betül Kezban', 'Çelebi', 'Kezban', 'Kezban536', 'kezbancelebi536@gmail.com', '2017-03-13 02:35:08', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Antalya', '158c5985aedb04.png', '1998-05-15', 27, 6, '79.123.141.17', 1, 'a', 'a', 'a'),
(160, 'serkan', 'ÖZGÜR', 'serkan', 'serkanozgur', 'serkan_albay_@hotmail.com', '2017-03-13 02:52:53', '0000-00-00 00:00:00', 'uye', 'turkiye', 'istanbul', '', '1981-02-21', 24, 0, '', 0, 'a', 'a', 'a'),
(161, 'þenol', 'hasýr', 'romantürk', '05439246574', 'AYKAN_l2@hotmail.com', '2017-03-13 02:56:03', '0000-00-00 00:00:00', 'uye', '', '', '', '1995-09-10', 24, 0, '', 0, 'a', 'a', 'a'),
(162, 'Ýbrahim ', 'Durmuþ ', 'Ýbocanvan65ak', '2818088287265199765', 'ibocan651997@gmail.com', '2017-03-13 02:56:29', '0000-00-00 00:00:00', 'uye', '', '', '', '0000-00-00', 25, 0, '', 0, 'a', 'a', 'a'),
(163, 'Ýhsan', 'Yazýcý', 'ihsanyazc ', '2.abdulhamit', 'ihsanyazc@hotmail.com', '2017-03-13 03:24:32', '0000-00-00 00:00:00', 'uye', '', '', '', '1990-07-18', 23, 0, '', 0, 'a', 'a', 'a'),
(164, 'Doðan', 'Doðan', 'Doðan', '89389871740', 'kralotel@hotmail.com', '2017-03-13 03:34:02', '0000-00-00 00:00:00', 'uye', '', '', '', '1972-10-14', 23, 0, '', 0, 'a', 'a', 'a'),
(165, 'Mehmet Ali', 'Boyun', 'Mehmet''S ', 'SüMeyram', 'mali7654321@hotmail.com', '2017-03-13 03:37:29', '0000-00-00 00:00:00', 'uye', '', '', '', '1991-12-15', 23, 0, '', 0, 'a', 'a', 'a'),
(166, 'Mustafa ', 'Alagöz', 'Mustafa ALAGÖZ', 'm1d2y3s4', 'mustafa-la-goz@hotmail.com', '2017-03-13 03:45:51', '0000-00-00 00:00:00', 'uye', '', '', '', '1978-08-09', 24, 0, '', 0, 'a', 'a', 'a'),
(167, 'Turan', 'Polat', '_Polat_', 'polat123', 'ekingen2018@yandex.com', '2017-03-13 04:12:48', '0000-00-00 00:00:00', 'uye', '', '', '', '2003-05-03', 24, 0, '', 0, 'a', 'a', 'a'),
(168, 'Ekrem', 'Gürün', 'SON OSMANLI', 'osmanli928', 'osmalibalko@gmail.com', '2017-03-13 04:32:27', '0000-00-00 00:00:00', 'uye', '', '', '', '1994-07-25', 24, 1, '', 0, 'a', 'a', 'a'),
(169, 'osman', 'aydýn', 'osman aydýn', '65906590', 'osmanydn10@gmail.com', '2017-03-13 04:48:56', '0000-00-00 00:00:00', 'uye', 'türkiye', 'balýkesir', '', '1968-06-14', 24, 13, '', 0, 'a', 'a', 'a'),
(170, 'yunus', 'Erdoðan', 'Akbeyaz', 'birsancak', 'yunuserdogan1313@gmail.com', '2017-03-13 04:49:18', '0000-00-00 00:00:00', 'uye', 'TÜRKÝYE', 'istanbul', '', '1987-07-12', 24, 57, '176.217.188.150', 1, 'a', 'a', 'a'),
(171, 'Yasar', 'Oral', 'Yok', 'oral9327', 'yasar.oral08@gmail.com', '2017-03-13 05:04:44', '0000-00-00 00:00:00', 'uye', '', '', '', '1964-11-19', 23, 0, '', 1, 'a', 'a', 'a'),
(172, 'Mehmet ', 'Güven', 'Hafýz', '91739173', 'memocan-19831@hotmail.com', '2017-03-13 05:41:18', '0000-00-00 00:00:00', 'uye', '', '', '', '1983-03-01', 23, 0, '', 0, 'a', 'a', 'a'),
(173, 'Metin', 'Kafkas', 'metinkafkas', '159874', 'metin.tapur@gmail.com', '2017-03-13 06:09:33', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Bursa', '158c5c8936be16.jpg', '1976-11-12', 24, 4, '', 1, 'a', 'a', 'a'),
(174, 'ozgur', 'Songan', 'Ozgurchef', '5418106143', 'ozgur_songan@hotmail.com', '2017-03-13 06:23:13', '0000-00-00 00:00:00', 'uye', '', '', '', '1991-07-01', 23, 0, '', 0, 'a', 'a', 'a'),
(175, 'Bünyamin', 'Koçak', 'Bünyamin Koçak', '123456789zeliþ', 'bunyamin_kocak36@hotmail.com', '2017-03-13 07:10:28', '0000-00-00 00:00:00', 'uye', '', '', '', '0000-00-00', 24, 0, '', 0, 'a', 'a', 'a'),
(176, 'Yasin', 'Koçtürk', 'Yasin koçtürk', 'yko2819320130', 'yasin_kocturk@hotmail.com', '2017-03-13 07:43:51', '0000-00-00 00:00:00', 'uye', '', '', '', '1976-08-29', 23, 0, '', 0, 'a', 'a', 'a'),
(177, 'Engin', 'Aydemir', 'Bozkurt', '1234567890', 'aydemir.pastrycook@outlook.com', '2017-03-13 11:44:36', '0000-00-00 00:00:00', 'uye', '', '', '158c7ed3b09aa5.jpg', '1998-05-25', 24, 0, '', 1, 'a', 'a', 'a'),
(178, 'Adem', 'SSaatçýoðlu ', 'Saatci76', '001976', 'saatci76@hotmail.com', '2017-03-13 13:16:16', '0000-00-00 00:00:00', 'uye', '', '', '', '1976-08-01', 23, 0, '', 0, 'a', 'a', 'a'),
(179, 'Halil ibrahim', 'GÜLÜNAY', 'HalilibrahimGÜLÜNAY', '06fuhhalil', 'gulunay05@gmail.com', '2017-03-13 14:12:22', '0000-00-00 00:00:00', 'uye', '', '', '', '1997-09-12', 23, 0, '', 0, 'a', 'a', 'a'),
(180, 'hayrullah', 'simsek', 'sensizim', 'sensizim', 'hay6666vatan_@hotmail.com', '2017-03-13 15:09:35', '0000-00-00 00:00:00', 'uye', '', '', '', '1988-10-10', 23, 0, '', 0, 'a', 'a', 'a'),
(181, 'Abdussamet', 'Kodalak', 'Hastaadam', '1328796', 'Kodalak25@hotmail.com', '2017-03-13 15:19:50', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Hatay kýrikhan', '158e06ec132e19.jpg', '1972-12-14', 24, 34, '85.98.51.243', 1, 'a', 'a', 'a'),
(182, 'Mehmet', 'Kýrbulut', 'Kýrbulut', 'deliler', 'mehmet543@hotmail.com', '2017-03-13 15:20:46', '0000-00-00 00:00:00', 'uye', '', '', '', '1998-02-09', 23, 0, '', 0, 'a', 'a', 'a'),
(183, 'sadýk ', 'mert', 'sadýk mert ', '5302124', 'sadik_mt_23@hotmail.com', '2017-03-13 15:24:53', '0000-00-00 00:00:00', 'uye', '', '', '', '1981-01-01', 23, 4, '', 0, 'a', 'a', 'a'),
(184, 'Mehtap ', 'Alter Üstünkaya ', 'MehtapAlterÜstünkaya', '14531453', 'mehtapalter@gmail.com', '2017-03-13 15:35:19', '0000-00-00 00:00:00', 'uye', '', '', '', '1978-04-09', 24, 0, '', 1, 'a', 'a', 'a'),
(185, 'Mehmet ali', 'Karaaslan', 'Karaaslan154', '963258s', 'meali345@mynet', '2017-03-13 15:40:32', '0000-00-00 00:00:00', 'uye', '', '', '', '1969-11-13', 23, 0, '', 0, 'a', 'a', 'a'),
(186, 'Mehmet semih', 'Batðý', 'Asýmýn nesli', 'm.semihim56', 'm.semih56@hotmail.com', '2017-03-13 15:41:27', '0000-00-00 00:00:00', 'uye', '', '', '', '1977-12-05', 23, 0, '', 1, 'a', 'a', 'a'),
(187, 'Mehmet ', 'Bedirhan', 'Mehmet Bedirhan', '67890', '12345tupgaz@gmail.com', '2017-03-13 16:06:04', '0000-00-00 00:00:00', 'uye', '', '', '', '1969-08-06', 23, 0, '', 0, 'a', 'a', 'a'),
(188, 'Fatmanur', 'Menteþ', 'Nur', '23215459944', 'psgfatmanur3553@gmail.com', '2017-03-13 17:41:22', '0000-00-00 00:00:00', 'uye', '', '', '', '1997-08-15', 26, 7, '46.154.148.19', 1, 'a', 'a', 'a'),
(189, 'Yusuf', 'Varsavaþ', 'Yusuf', '5311028277', 'yusuf12345@hotmail.com', '2017-03-13 17:45:31', '0000-00-00 00:00:00', 'uye', 'TÜRKÝYE', 'Osmaniye', '158c66bb027ad8.jpg', '1998-05-24', 23, 0, '', 0, 'a', 'a', 'a'),
(190, 'Ersin', 'Beceriklican', 'Ersin Beceriklican', '48246575eb', 'ersinberiklican@gmail.com', '2017-03-13 19:02:57', '0000-00-00 00:00:00', 'uye', '', '', '', '1988-01-30', 23, 0, '', 0, 'a', 'a', 'a'),
(191, 'Okan', 'TÜRKMEN', 'OKANTURKMEN66', 'bozkurt6658', 'okanturkmen66@gmai.com', '2017-03-13 20:09:53', '0000-00-00 00:00:00', 'uye', '', '', '158c68d4f2a1c9.jpg', '1985-12-04', 23, 1, '', 1, 'a', 'a', 'a'),
(192, 'Muhammet', 'Türkyýlmaz', 'mrasittrkylmz', 'RsTmtp1996,.adn01', 'rasit001@hotmail.com', '2017-03-13 20:24:37', '0000-00-00 00:00:00', 'uye', 'TÜRKÝYE', 'ADANA', '158c693725901a.jpg', '1995-05-30', 24, 19, '', 1, 'a', 'a', 'a'),
(193, 'Ahmet ', 'Baran', 'Ahmet Baran', 'ahmet4125', 'ahmetbaranofical@hotmail.com', '2017-03-13 20:46:04', '0000-00-00 00:00:00', 'uye', '', '', '', '1999-05-21', 23, 0, '', 0, 'a', 'a', 'a'),
(194, 'Ümit ', 'Pelit ', 'Ümit52', '49826299', 'umtkrgn1999@gmail.com', '2017-03-13 21:14:52', '0000-00-00 00:00:00', 'uye', '', '', '', '1997-06-20', 24, 9, '', 1, 'a', 'a', 'a'),
(195, 'hasan', 'yildiz', 'hasan', 'hasanacar', 'sen.ve.ben.19871987@gmail.com', '2017-03-13 21:36:03', '0000-00-00 00:00:00', 'uye', 'turkiye', 'tekirdag', '', '1987-05-05', 25, 9, '', 0, 'a', 'a', 'a'),
(196, 'Fatih', 'Günay', 'fthgny44', '2062143398844mlt', 'fthgny44@hotmail.com', '2017-03-13 21:48:10', '0000-00-00 00:00:00', 'uye', '', '', '', '1994-04-30', 24, 0, '', 0, 'a', 'a', 'a'),
(197, 'asim', 'elçi ', 'asimelci04', '197704', 'asimelci@hotmail.com', '2017-03-13 21:51:36', '0000-00-00 00:00:00', 'uye', '', '', '', '1977-11-17', 23, 0, '', 1, 'a', 'a', 'a'),
(198, 'Fatih', 'Büyük', 'FatihBüyük', 'muhammedali08', 'fatihbuyuk_08@hotmail.com', '2017-03-13 22:07:59', '0000-00-00 00:00:00', 'uye', '', '', '', '1987-11-22', 24, 0, '', 0, 'a', 'a', 'a'),
(199, 'poyraz', 'odabaþý', 'pyrz_aygn', '109146319.', 'cici_61@hotmail.com', '2017-03-13 22:19:06', '0000-00-00 00:00:00', 'uye', '', '', '', '1995-03-31', 24, 0, '', 0, 'a', 'a', 'a'),
(200, 'özcan ', 'Topçu', 'özcan', 'LYPE0591', 'ozcantopcu.1991@hotmail.com', '2017-03-13 22:43:49', '0000-00-00 00:00:00', 'uye', '', '', '', '1991-02-28', 23, 1, '', 0, 'a', 'a', 'a'),
(201, 'Ahmet Nuri', 'Özsoy', 'HanCeR', 'aa6512961', 'a.ozsoy23@gmail.com', '2017-03-13 23:06:20', '0000-00-00 00:00:00', 'uye', 'Tr', 'Elazig', '158c7f30ed21d3.jpg', '1981-04-10', 24, 20, '', 1, 'a', 'a', 'a'),
(202, 'Eyup', 'Albayrak', 'Rteyp albayrak', '221005eyup', 'eyupalbayrak49@gmail.com', '2017-03-13 23:14:07', '0000-00-00 00:00:00', 'uye', '', '', '', '1986-07-18', 23, 0, '', 1, 'a', 'a', 'a'),
(203, 'emrullah', 'Elmas', 'eelmas', '25462546', 'eeelmas13@gmail.com', '2017-03-13 23:16:53', '0000-00-00 00:00:00', 'uye', '', '', '', '1996-05-20', 23, 0, '', 1, 'a', 'a', 'a'),
(204, 'Mustafa', 'Bas', 'Pusuroglu', 'm45142Bas', 'basmustafa849@mail', '2017-03-13 23:44:57', '0000-00-00 00:00:00', 'uye', '', '', '', '1983-11-27', 25, 0, '', 0, 'a', 'a', 'a'),
(205, 'Osman', 'Karali', 'Karaliosman', 'ok1274', 'karaliosman@hotmail.com', '2017-03-14 00:03:51', '0000-00-00 00:00:00', 'uye', '', '', '158c6c516044b9.png', '1982-01-01', 24, 0, '94.122.94.90', 0, 'a', 'a', 'a'),
(206, 'Cihat', 'Yiðit', 'CihatHoca', 'imamhatip', 'vuslatkervanim@hotmail.com', '2017-03-14 00:11:35', '0000-00-00 00:00:00', 'uye', '', '', '', '1988-01-02', 23, 0, '', 1, 'a', 'a', 'a'),
(207, 'Recep', 'MIRDIK', 'Recep555', 'samsun55', 'recep55546@gmail.com', '2017-03-14 00:21:47', '0000-00-00 00:00:00', 'uye', '', '', '', '1995-12-16', 23, 0, '', 0, 'a', 'a', 'a'),
(208, 'Cafer', 'Yuvak', 'Cafer', '26012013', 'ccaaffeerryyuuvvaakk@hotmail.com', '2017-03-14 00:22:16', '0000-00-00 00:00:00', 'uye', '', '', '', '1988-08-16', 23, 0, '151.135.40.193', 0, 'a', 'a', 'a'),
(209, 'Emrah', 'Kekilli', 'Emrah0107', 'merve123', 'emrah.kk01@gmail.com', '2017-03-14 00:29:45', '0000-00-00 00:00:00', 'uye', '', '', '', '1994-08-26', 23, 76, '178.18.201.111', 1, 'a', 'a', 'a'),
(210, 'Abdullah ', 'Özcan ', 'Yeniçeri ', '5456911400', 'madein_apo@hotmail.com', '2017-03-14 00:32:47', '0000-00-00 00:00:00', 'uye', '', '', '', '1988-06-03', 23, 0, '', 0, 'a', 'a', 'a'),
(211, 'Göksel', 'Kýr', 'Gokselkir', 'goksel7489.', 'gokselkir@gmail.com', '2017-03-14 00:33:24', '0000-00-00 00:00:00', 'uye', '', '', '', '1976-06-05', 24, 2, '', 1, 'a', 'a', 'a'),
(212, 'Abdulhamid', 'Akýncý', '34abdlhmd', '2809199819051905', '93avcyasin@gmail.com', '2017-03-14 00:42:54', '0000-00-00 00:00:00', 'uye', '', '', '', '1997-09-22', 23, 0, '', 0, 'a', 'a', 'a'),
(213, 'Serhad', 'SARIBOÐA', 'sariboga55', '14531453', 'serhatsariboga55@gmail.com', '2017-03-14 00:43:00', '0000-00-00 00:00:00', 'uye', '', '', '158c6ce13d2eb4.png', '1982-11-23', 25, 3, '', 1, 'a', 'a', 'a'),
(214, 'Mehmet', 'Yaktý', 'Gurbanss', 'm760905042881', 'kocakafa.76@gmail.com', '2017-03-14 00:44:44', '0000-00-00 00:00:00', 'uye', '', '', '', '1976-06-25', 23, 0, '', 1, 'a', 'a', 'a'),
(215, 'Erþen ', 'Çakayev', 'ersen.cakayev', 'sanane???', 'ersen.cakayev@hotmail.com', '2017-03-14 00:47:42', '0000-00-00 00:00:00', 'uye', '', '', '', '1996-11-20', 24, 0, '', 0, 'a', 'a', 'a'),
(216, 'Faruk', 'Yilmaz', 'Diriliþ', 'elif', 'torniston_06@hotmail.com', '2017-03-14 00:55:28', '0000-00-00 00:00:00', 'uye', '', '', '158c6d35ab4947.png', '1983-11-05', 23, 0, '', 0, 'a', 'a', 'a'),
(217, 'Ömer ', 'Özuslu ', 'Ömer ', '107112991453202320716870', 'zeybek6870@hotmail.com', '2017-03-14 01:00:26', '0000-00-00 00:00:00', 'uye', '', '', '', '1982-06-03', 24, 0, '', 0, 'a', 'a', 'a'),
(218, 'Enes ', 'Karslý ', 'Enes36', '1234567893636k', 'eneskarsli6@gmail.co', '2017-03-14 01:14:30', '0000-00-00 00:00:00', 'uye', '', '', '', '1996-04-14', 23, 0, '', 0, 'a', 'a', 'a'),
(219, 'Ali', 'Þahan ', 'alisahan', '123456', 'ali-s77@yandex.com', '2017-03-14 01:18:31', '0000-00-00 00:00:00', 'uye', '', '', '', '2000-05-04', 23, 0, '', 0, 'a', 'a', 'a'),
(220, 'Cihan', 'Pir', 'Cihanpir24', 'cihan05372057321', 'chn_024@hotmail.com', '2017-03-14 01:21:18', '0000-00-00 00:00:00', 'uye', '', '', '', '1988-09-01', 23, 0, '', 0, 'a', 'a', 'a'),
(221, 'Turan', 'Polat', '_ulkucu_', 'polat123', 'turanpolat062@gmail.com', '2017-03-14 01:41:20', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Kýz.maraþ', '158c6df9074c60.jpg', '2003-05-03', 23, 2, '', 1, 'a', 'a', 'a'),
(222, 'FARUK ', 'Coþkun ', 'FARUKcoþkun', 'fc1231453', 'farukfaruk34_04@hotmail.com', '2017-03-14 01:45:56', '0000-00-00 00:00:00', 'uye', '', '', '', '1967-10-13', 24, 0, '', 0, 'a', 'a', 'a'),
(223, 'Adnan', 'Acet', 'CENKER adnan', '361234', 'acetadnan@hotmail.com', '2017-03-14 01:56:11', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Ýstanbul sultanbeyli', '', '1988-01-15', 23, 4, '', 0, 'a', 'a', 'a'),
(224, 'Adil', 'Yaðcý ', 'Adil1453', 'aþkýmsýn', 'adil_baba_2536@hotmail.com', '2017-03-14 01:57:15', '0000-00-00 00:00:00', 'uye', '', '', '', '1988-07-24', 24, 3, '', 0, 'a', 'a', 'a'),
(225, 'Mehmet', 'Horasan', 'Akýncý', 'fetih1453', 'mehmet_horasan@hotmail.com', '2017-03-14 02:44:00', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Ýstanbul', '', '1984-06-16', 23, 0, '', 0, 'a', 'a', 'a'),
(226, 'Numan Kerem', 'Çevikler ', 'NumanKerem', 'kerem13131', 'numankeremc@g.mail.com', '2017-03-14 03:42:22', '0000-00-00 00:00:00', 'uye', '', '', '', '2000-03-13', 24, 5, '188.57.150.81', 0, 'a', 'a', 'a'),
(227, 'Muhammed', 'Iþýn', 'Þeyhzade', '11956311195631', 'seyhzade_muhammed_@hotmail.com', '2017-03-14 04:02:43', '0000-00-00 00:00:00', 'uye', '', '', '', '1994-07-01', 23, 0, '', 0, 'a', 'a', 'a'),
(228, 'Selcuk ', 'Ustundag ', 'Selcuk1453', 'anam1071', 'selcuk8383han@hotmail.com', '2017-03-14 04:08:37', '0000-00-00 00:00:00', 'uye', '', '', '', '1983-12-03', 23, 0, '', 0, 'a', 'a', 'a'),
(229, 'Serkan', 'Tc', 'Serkan1453', 'serkan1453', 'serkan.mhp@hotmail.com', '2017-03-14 04:12:31', '0000-00-00 00:00:00', 'uye', '', '', '158c6fe600ce3b.jpg', '1998-08-09', 23, 0, '', 0, 'a', 'a', 'a'),
(230, 'Hakan Bayram', 'yilmaz', 'HAKAN', 'q1w2e3r4', 'teknikmalzemecim@hotmail.com', '2017-03-14 04:21:07', '0000-00-00 00:00:00', 'uye', '', '', '', '1981-07-27', 23, 0, '', 0, 'a', 'a', 'a'),
(231, 'Mehmet Hasan', 'Duran', 'mehmethasand', 'Hasan0644', 'mehmethasan44@hotmail.com', '2017-03-14 04:21:20', '0000-00-00 00:00:00', 'uye', '', '', '', '1996-04-10', 23, 0, '', 0, 'a', 'a', 'a'),
(232, 'Sukru', 'Altýnok', 'yolcu', 'sukru0640143225', 'sukrualtinok@hotmail.com', '2017-03-14 04:33:12', '0000-00-00 00:00:00', 'uye', '', '', '', '1984-11-01', 23, 0, '', 1, 'a', 'a', 'a'),
(233, 'Yaþar', 'AYYILDIZ', 'Pusar61', 'yasar6161', 'yasar.ayyildiz@hotmail.com', '2017-03-14 04:47:47', '0000-00-00 00:00:00', 'uye', '', '', '', '1979-10-06', 25, 1, '', 1, 'a', 'a', 'a'),
(234, 'Fatih', 'Altýn', 'seyyahh', 'xxxfatihxxx', 'seyyah6060@hotmail.com', '2017-03-14 05:06:39', '0000-00-00 00:00:00', 'uye', '', '', '', '1983-08-15', 25, 3, '', 1, 'a', 'a', 'a'),
(235, 'Kürþad', 'Ayyýldýz', 'MeteHan', 'k042244278a', 'ayyildizkursad@hotmail.com', '2017-03-14 05:19:51', '0000-00-00 00:00:00', 'uye', '', '', '158c70e507eca2.png', '0000-00-03', 24, 0, '', 0, 'a', 'a', 'a'),
(236, 'suat', 'andic', 'suad1071', '14531299', 'suatandic1453@gmail.com', '2017-03-14 05:38:08', '0000-00-00 00:00:00', 'uye', '', '', '', '1991-09-30', 24, 1, '', 0, 'a', 'a', 'a'),
(237, 'Cavit ', 'Alan ', 'Cavit ', 'bizimsite', 'cavitten@gmail.com', '2017-03-14 05:49:16', '0000-00-00 00:00:00', 'uye', '', '', '', '1969-12-26', 24, 0, '', 0, 'a', 'a', 'a'),
(238, 'Þuayip', 'Özdemir', 'ÝslamFedaisi', 'kartall19', 'kartal199019@gmail.com', '2017-03-14 07:40:31', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Çorum', '', '1999-06-27', 23, 0, '', 1, 'a', 'a', 'a'),
(239, 'Hasan', 'Gündüz ', 'Serazet', '25252525a', 'hasan.gunduz.25@outlook.com', '2017-03-14 08:53:56', '0000-00-00 00:00:00', 'uye', '', '', '', '1994-01-30', 23, 0, '', 0, 'a', 'a', 'a'),
(240, 'Rüstem', 'Ayrýç', 'Rüstem34', 'rustem34', 'rustemayric@gmail.com', '2017-03-14 09:25:26', '0000-00-00 00:00:00', 'uye', '', '', '', '1966-08-10', 25, 13, '', 1, 'a', 'a', 'a'),
(241, 'Hamit', 'Aslan', 'Hamit ', 'hamit7449', 'burak_63200@hotmail.com', '2017-03-14 12:31:24', '0000-00-00 00:00:00', 'uye', '', '', '', '1992-01-20', 23, 0, '', 0, 'a', 'a', 'a'),
(242, 'Heysuf ', 'Mýdray ', 'Heysufum', '02yusufuM.', '02heysufum@gmail.com', '2017-03-14 12:50:31', '0000-00-00 00:00:00', 'uye', '', '', '', '1982-11-06', 23, 1, '37.155.183.152', 1, 'a', 'a', 'a'),
(243, 'Muhlis', 'Þýk ', 'Muhlis', 'muhlis1453', 'grafakirimm@gmail.com', '2017-03-14 13:15:30', '0000-00-00 00:00:00', 'uye', '', '', '', '1984-11-10', 23, 0, '', 1, 'a', 'a', 'a'),
(244, 'Naim', 'Kýrdaþ', 'NaimKýrdaþ', 'ikinciosmanlý', 'naimkirdas@gmail.com', '2017-03-14 13:15:36', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Samsun', '', '1990-00-00', 23, 3, '', 1, 'a', 'a', 'a'),
(245, 'Ercan', 'Barýþ', 'Adýöte', 'Muhabbetet', 'ercan.baris54@gmail.com', '2017-03-14 13:35:22', '0000-00-00 00:00:00', 'uye', '', '', '', '1996-07-06', 24, 0, '', 1, 'a', 'a', 'a'),
(246, 'SELÝM', 'ÖZTÜRK', 'KALBÝSELÝM', '23temmuz1953', 'BAZLAMAC88', '2017-03-14 14:23:53', '0000-00-00 00:00:00', 'uye', '', '', '', '0000-00-00', 23, 0, '', 0, 'a', 'a', 'a'),
(247, 'Mahmut', 'Arslan', 'Son osmanlý 33', 'gelisim6333', 'teknik_servis63@hotmail.com', '2017-03-14 15:00:42', '0000-00-00 00:00:00', 'uye', '', '', '158c79579c5b48.jpg', '1985-05-12', 23, 0, '', 0, 'a', 'a', 'a'),
(248, 'Ahmet fatih', 'Kurþuncu', 'Ahmetfatih ', 'reis2017', 'Ahmetfatih93@gmail.com', '2017-03-14 16:06:00', '0000-00-00 00:00:00', 'uye', '', '', '', '1989-05-28', 23, 0, '', 0, 'a', 'a', 'a'),
(249, 'Bayram', 'Küpeli ', 'Gezgindost ', 'baha1453', 'bayramglobal@gmail.com', '2017-03-14 16:47:02', '0000-00-00 00:00:00', 'uye', '', '', '', '1974-06-15', 23, 0, '', 1, 'a', 'a', 'a'),
(250, 'Mert', 'Yazýcý', 'Þaleya61', '987654', 'yazmert@hotmail.com', '2017-03-14 18:29:30', '0000-00-00 00:00:00', 'uye', '', '', '', '1979-01-15', 23, 0, '', 0, 'a', 'a', 'a'),
(251, 'Ýlyas', 'Akkaya', 'Ýlyas', '05317673360im', 'ilyasakkaya14@gmail.com', '2017-03-14 18:36:21', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Eskipazar Karabük', '158c7c92be8faa.jpg', '1989-02-07', 24, 1, '', 1, 'a', 'a', 'a'),
(252, 'Semih', 'Akpancar', 'Abdulhamit Han', '123321s', 'akpancarsemih@gmail.com', '2017-03-14 19:07:07', '0000-00-00 00:00:00', 'uye', '', '', '158c7d2f9b49d7.jpg', '1997-11-16', 26, 24, '', 0, 'a', 'a', 'a'),
(253, 'Ýbrahim', 'Pýnar', 'Ýbofrkn4525', 'ibrahim2142001145', 'ibofrkn4525@gmail.com', '2017-03-14 19:25:53', '0000-00-00 00:00:00', 'uye', '', '', '158c7d3a2d2fa9.jpg', '1997-01-15', 23, 0, '176.54.175.222', 0, 'a', 'a', 'a'),
(254, 'Kemal ', 'Bozkurt ', 'Kemal ', '1789kbut', 'kem.boz@hotmail.com', '2017-03-14 19:37:50', '0000-00-00 00:00:00', 'uye', '', '', '', '1972-02-03', 23, 0, '', 0, 'a', 'a', 'a'),
(255, 'metin', 'taç', 'kocayavuz', '8695612', 'metintac@hotmail.com', '2017-03-14 19:46:55', '0000-00-00 00:00:00', 'uye', '', '', '158c7d852623ed.jpg', '1987-10-26', 25, 13, '', 1, 'a', 'a', 'a'),
(256, 'Ahmet', 'Uzun', 'Ahmet uzun', 'ahmet2534', 'uzunahmet550@gmail.com', '2017-03-14 20:03:53', '0000-00-00 00:00:00', 'uye', '', '', '', '1995-04-20', 23, 0, '', 0, 'a', 'a', 'a'),
(257, 'Paþa ', 'Þahin ', 'EsiNTi ', '258852', 'ByEsinti@Asktanem.net', '2017-03-14 20:11:43', '0000-00-00 00:00:00', 'uye', '', '', '', '1987-02-15', 23, 1, '', 0, 'a', 'a', 'a'),
(258, 'Ahmet', 'Tuncel', 'Togarma', 'ahmet1234', 'laser.81_81@hotmail.com', '2017-03-14 20:14:38', '0000-00-00 00:00:00', 'uye', '', '', '158c7ed529d93c.jpg', '1994-08-07', 24, 11, '', 1, 'a', 'a', 'a'),
(259, 'Erhan', 'Gülgün', 'Erhan', 'Erh3165568', 'erhanglgn67@gmail.com', '2017-03-14 21:39:27', '0000-00-00 00:00:00', 'uye', '', '', '', '1984-10-02', 23, 0, '', 0, 'a', 'a', 'a'),
(260, 'Ömer', 'Sarýyýldýz', 'desidero', '1323512008desi', 'desidero123@outlook.com', '2017-03-14 22:30:51', '0000-00-00 00:00:00', 'uye', '', '', '', '1994-04-22', 23, 0, '', 0, 'a', 'a', 'a'),
(261, 'Ömür ', 'Seyrek ', 'Öm65r', '87458745o', 'omurseyrek@gmail.com', '2017-03-14 22:50:18', '0000-00-00 00:00:00', 'uye', '', '', '', '1980-09-17', 23, 0, '', 1, 'a', 'a', 'a'),
(262, 'Hamza', 'Þirin', 'Hmzsrn', '164236', 'hmzsrn@gmail.com', '2017-03-14 23:11:41', '0000-00-00 00:00:00', 'uye', '', '', '', '1986-04-23', 24, 0, '', 1, 'a', 'a', 'a'),
(263, 'Abdullah', 'Top', 'Abdullah Top', '19788211', 'abdullahtop33@gmail.com', '2017-03-14 23:36:25', '0000-00-00 00:00:00', 'uye', '', '', '', '0000-00-00', 23, 0, '', 1, 'a', 'a', 'a'),
(264, 'Harun', 'Sakartepe', 'Sancak03', 'harun1995', 'harun-03@hotmail.com', '2017-03-14 23:38:18', '0000-00-00 00:00:00', 'uye', '', '', '', '1995-10-20', 23, 0, '', 0, 'a', 'a', 'a'),
(265, 'abd', 'abd', 'abdsu', 'sonKaz60', 'abdsu2005@yahoo.com', '2017-03-14 23:54:37', '0000-00-00 00:00:00', 'uye', '', '', '', '1960-01-02', 23, 0, '', 1, 'a', 'a', 'a'),
(266, 'Osman', 'Gamsýz', 'Osmanoglu', 'osmanlilar123??', 'ogamsiz@hotmail.com', '2017-03-14 23:57:17', '0000-00-00 00:00:00', 'uye', '', '', '', '1972-04-01', 23, 0, '', 0, 'a', 'a', 'a'),
(267, 'Recep', 'CUKUROREN', 'osm torunu', '145353', 'recepcukurorenn@gmail.com', '2017-03-15 00:44:55', '0000-00-00 00:00:00', 'uye', '', '', '', '1980-11-25', 23, 0, '', 0, 'a', 'a', 'a'),
(268, 'Ertan', 'Öz', 'Parola78', '05710632', 'hattatertan@hotmail.com', '2017-03-15 00:54:14', '0000-00-00 00:00:00', 'uye', '', '', '', '1978-04-23', 23, 0, '', 1, 'a', 'a', 'a'),
(269, 'Gökhan', 'Kaya', 'gokhan44.35', '443531982', 'gokhan_44.35@hotmail.com', '2017-03-15 01:04:56', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Ýzmir', '', '1982-08-20', 23, 0, '', 1, 'a', 'a', 'a');
INSERT INTO `users` (`user_id`, `user_adi`, `user_soyadi`, `username`, `password`, `user_email`, `user_kayit_tarih`, `user_giris_tarih`, `user_type`, `user_ulke`, `user_sehir`, `user_profil_resim`, `user_dogum_tarih`, `user_takipci_sayi`, `user_takip_edilen_sayi`, `user_ip`, `user_aktivasyon`, `user_pay_gizle`, `user_takip_durum`, `user_mesaj_durum`) VALUES
(270, 'Yunus erol ', 'Özyavuz ', 'Pars5561', 'erol12345', 'rabbim_affet@outlook.com', '2017-03-15 01:12:12', '0000-00-00 00:00:00', 'uye', '', '', '158cadf7f77931.jpg', '1995-06-10', 24, 24, '46.154.194.80', 1, 'a', 'a', 'a'),
(271, 'Cevahir', 'GençTürk', 'LazÇavuþ08', 'marvel908008', 'djcevo_karizma@hotmail.com', '2017-03-15 01:21:10', '0000-00-00 00:00:00', 'uye', '', '', '', '1995-11-06', 23, 0, '', 1, 'a', 'a', 'a'),
(272, 'Asil', 'Özçelik', 'Asilane', '03130007', 'asil_ozcelik@hotmail.com', '2017-03-15 01:28:23', '0000-00-00 00:00:00', 'uye', '', '', '', '1971-02-27', 23, 0, '', 0, 'a', 'a', 'a'),
(273, 'Feyyaz', 'Urtekin ', 'feyyazurtekin', 'feyti_1903', 'feyyazurtekin@icloud.com', '2017-03-15 01:36:02', '0000-00-00 00:00:00', 'uye', '', '', '158c82b3850638.jpg', '1991-02-23', 23, 10, '', 1, 'a', 'a', 'a'),
(274, 'Kadir', 'Çýnar', 'Kadir', '221979', 'kadir.acinar@gmail.com', '2017-03-15 02:02:42', '0000-00-00 00:00:00', 'uye', '', '', '', '1979-06-05', 24, 3, '', 1, 'a', 'a', 'a'),
(275, 'Ýsmail', 'Arslan', 'Ýsmail', '70417102260233448', 'arslanbey6699@hotmail.com', '2017-03-15 02:18:32', '0000-00-00 00:00:00', 'uye', '', '', '', '1998-11-07', 23, 0, '', 0, 'a', 'a', 'a'),
(276, 'Kenan', 'KIRK', 'Kenan40', '31401453', 'kenanbiby@gmail.com', '2017-03-15 02:25:13', '0000-00-00 00:00:00', 'uye', '', '', '158c836bc88226.png', '1986-04-14', 23, 0, '', 1, 'a', 'a', 'a'),
(277, 'Gürhan ', 'Gökay ', 'Gurhan350@gmail.com ', 'gurhan57', 'gurhan350@gmail.com', '2017-03-15 02:40:42', '0000-00-00 00:00:00', 'uye', '', '', '', '1986-01-20', 23, 1, '', 0, 'a', 'a', 'a'),
(278, 'Abdullah', ' Turan', ' turanabdul', 'apo123123', 'turanabdul@hotmail.com', '2017-03-15 02:49:26', '0000-00-00 00:00:00', 'uye', '', '', '', '1974-12-15', 24, 6, '', 0, 'a', 'a', 'a'),
(279, 'Ýlhami', 'Tubal', 'Sancaktar', '0449zehra', 'keremefe2016@hotmail.com', '2017-03-15 04:26:41', '0000-00-00 00:00:00', 'uye', 'Osmanlý iparatorluðu', 'KÜTAHYA', '158cafa5ea5a97.jpg', '1973-00-01', 23, 9, '46.155.2.159', 0, 'a', 'a', 'a'),
(280, 'Celil', 'Dayýoðlu', 'Celil Dayýoðlu', 'casaa5461', 'dayioglukardesler@hotmail.com', '2017-03-15 05:06:59', '0000-00-00 00:00:00', 'uye', '', '', '', '1978-04-05', 23, 0, '', 0, 'a', 'a', 'a'),
(281, 'Mehmet', 'YAVUZ', 'Zuvay_m', 'Myvz1453', 'yvz_m@hotmail.com', '2017-03-15 05:24:49', '0000-00-00 00:00:00', 'uye', '', '', '', '1990-04-17', 23, 0, '', 0, 'a', 'a', 'a'),
(282, 'Türkeþ', 'Doðru', 'Trksdogru90', 'waylicsany123', 'trksdogru90@hotmail.com', '2017-03-15 05:26:09', '0000-00-00 00:00:00', 'uye', '', '', '', '1990-07-12', 24, 0, '', 0, 'a', 'a', 'a'),
(283, 'Hüseyin', 'Tank', 'Dostinsaniyiz', '34606034', 'huseyintang@gmail.com', '2017-03-15 05:28:52', '0000-00-00 00:00:00', 'uye', '', '', '', '1977-07-19', 24, 0, '', 1, 'a', 'a', 'a'),
(284, 'MUHAMMED ümid ', 'önerge', 'HÝRADAÐI', 'topcuonb', 'umitgfb_080@hotmail.com', '2017-03-15 05:58:05', '0000-00-00 00:00:00', 'uye', '', '', '158c868ae85a8a.jpg', '1995-04-12', 24, 32, '', 0, 'a', 'a', 'a'),
(285, 'NÝÐDE ÇAYIRLILAR', 'DERNEÐÝ', 'NÝÐ.ÇAY.DER', '751meyra', 'nigcay_der51@hotmail.com', '2017-03-15 05:58:52', '0000-00-00 00:00:00', 'uye', 'TÜRKÝYE', 'ÝZMÝR', '', '1999-12-15', 23, 1, '', 0, 'a', 'a', 'a'),
(286, 'Yakup', 'Temizsu', 'Kayi', '1453', 'yakup_temizsu@hotmail.com', '2017-03-15 06:03:59', '0000-00-00 00:00:00', 'uye', '', '', '', '1977-04-19', 23, 0, '', 0, 'a', 'a', 'a'),
(287, 'Bünyamin', 'Soydemir', 'Bünyamin', 'psf1553695755', 'posof_1623@hotmail.com', '2017-03-15 07:16:18', '0000-00-00 00:00:00', 'uye', '', '', '', '1989-08-30', 23, 0, '', 0, 'a', 'a', 'a'),
(288, 'Mesut Kamil', 'Atmaca', 'Mesut41', '34an4686', 'kelmesit@gmail.com', '2017-03-15 10:41:33', '0000-00-00 00:00:00', 'uye', '', '', '158cee660bec1c.jpg', '1973-08-14', 24, 17, '', 1, 'a', 'a', 'a'),
(289, 'ömriye', 'atmaca', 'omrytmc', '5271429', 'omrytmc41@gmail.com', '2017-03-15 12:50:29', '0000-00-00 00:00:00', 'uye', '', '', '', '1976-04-06', 23, 0, '', 0, 'a', 'a', 'a'),
(290, 'Ali', 'ALtunbaþ', 'altunbas27', 'altunbas27', 'furkan_altunbas@hotmail.com', '2017-03-15 13:08:25', '0000-00-00 00:00:00', 'uye', '', '', '', '1994-04-03', 24, 0, '', 0, 'a', 'a', 'a'),
(291, 'Ýsa', 'Demir', 'Asigunes', '987654321', 'demirisa439932@hotmail.com', '2017-03-15 18:07:56', '0000-00-00 00:00:00', 'uye', '', '', '', '1970-06-01', 23, 0, '', 0, 'a', 'a', 'a'),
(292, 'Concord', 'Venekli', 'Reis', 'venekli53', 'concord5334@mynet.com', '2017-03-16 19:32:29', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Ýstanbul', '158ca79b5c1ee3.jpg', '1980-09-30', 24, 4, '', 1, 'a', 'a', 'a'),
(293, 'Asya', 'Ayyýldýz', 'AsyaAy', '7539510,', 'asyaayyildiz99@gmail.com', '2017-03-17 01:32:10', '0000-00-00 00:00:00', 'uye', '', '', '158cad0e78b208.jpg', '1993-01-01', 86, 854, '178.247.116.1', 1, 'a', 'a', 'a'),
(294, 'Yasin', 'Ýpekel', 'Yasin', '1981190505331364022', 'ihsanipekel@gmail.com', '2017-03-17 02:39:53', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Ýstanbul', '158cade4de50ce.jpg', '1982-11-18', 25, 7, '', 1, 'a', 'a', 'a'),
(295, 'Hayrettin', 'Gedik', 'BarbarosHayrettinPaþa', 'hg123456', 'hayrettingedik@msn.com', '2017-03-17 02:46:06', '0000-00-00 00:00:00', 'uye', '', '', '', '1985-08-14', 23, 0, '', 0, 'a', 'a', 'a'),
(296, 'Abdullah', 'Alibaz', 'a.alibaz', '2738.fca', 'abdullah.alibaz@hotmail.com', '2017-03-17 03:19:17', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Erzurum', '', '1994-03-08', 24, 9, '78.168.42.200', 1, 'a', 'a', 'a'),
(297, 'Murathan', 'Yýldýrým', 'murathanyildirim', 'ydihs94ydyd', 'murathanyildirim60@gmail.com', '2017-03-17 03:37:43', '0000-00-00 00:00:00', 'uye', 'Osmanlý Ýmparatorluðu', 'Eskiþehir', '158cbfe15cfce4.jpg', '1994-04-03', 35, 297, '', 1, 'a', 'a', 'a'),
(298, 'haydar', 'güler', 'alpbaþý', 'burakhan19', 'Gulerhaydar@msn.com', '2017-03-17 04:48:29', '0000-00-00 00:00:00', 'uye', '', '', '', '1977-03-09', 23, 0, '', 0, 'a', 'a', 'a'),
(299, 'ayþegül ', 'mersinli', 'aysegul', 'eren', 'e.mersinli46@gmail.com', '2017-03-17 22:32:59', '0000-00-00 00:00:00', 'uye', '', '', '', '1979-03-17', 24, 0, '', 0, 'a', 'a', 'a'),
(300, 'Öner', 'Albay', 'Öner halit albay', '02090209', 'onerhalitalbay@gmail.com', '2017-03-18 00:01:13', '0000-00-00 00:00:00', 'uye', '', '', '', '1986-04-20', 23, 1, '', 0, 'a', 'a', 'a'),
(302, 'Ali', 'Aydin', 'Aliaydin42', 'yurdagul', 'aliaydin42.aan@gmail.com', '2017-03-18 00:07:15', '0000-00-00 00:00:00', 'uye', '', '', '', '1966-02-01', 24, 0, '', 0, 'a', 'a', 'a'),
(303, 'Ömer', 'Düzgün', 'Samsunlu', 'rapciomer', 'samsunlugenc55@hotmail.com', '2017-03-18 00:11:27', '0000-00-00 00:00:00', 'uye', '', '', '', '1998-09-23', 24, 7, '', 0, 'a', 'a', 'a'),
(304, 'Bulent', 'Kaplan', 'Bulentt', 'kap06lan', 'senicok_06@hotmail.com', '2017-03-18 00:26:30', '0000-00-00 00:00:00', 'uye', '', '', '', '1983-03-06', 23, 0, '', 0, 'a', 'a', 'a'),
(305, 'Yasin', 'Eroðlu', 'Osmanlý2461', 'eymen8456', 'yasineroglu2461@gmail.com', '2017-03-18 00:38:52', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Ýstanbul', '158cc17ac12104.jpg', '1984-06-26', 23, 0, '', 1, 'a', 'a', 'a'),
(306, 'Kadir', 'Fidan', 'Kadirfidan99', 'kf25524', 'kadirfidan99@hotmail.com', '2017-03-18 00:39:36', '0000-00-00 00:00:00', 'uye', '', '', '', '1981-01-01', 23, 0, '', 0, 'a', 'a', 'a'),
(307, 'mehmet', 'uðurlu', 'mhmt1312', '17273563712', 'mehmetugurlu1312@gmail.com', '2017-03-18 01:06:41', '0000-00-00 00:00:00', 'uye', '', '', '158d039341d47d.jpg', '1992-01-15', 24, 68, '151.135.206.172', 1, 'a', 'a', 'a'),
(308, 'Ali', 'Almaz', 'Alibaba', 'soli1972', 'Soliali54@gmail.com', '2017-03-18 01:26:26', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Sakarya', '158de91953f828.jpg', '1972-06-25', 23, 16, '95.5.253.30', 1, 'a', 'a', 'a'),
(309, 'mahmut', 'çelik', 'Mahmut ', 'Mc.14344', 'mahmut1976@gmail.com', '2017-03-18 01:32:56', '0000-00-00 00:00:00', 'uye', '', '', '', '1976-01-01', 22, 0, '', 1, 'a', 'a', 'a'),
(310, 'Mücahit ', 'Kaya', 'Mücahit ', 'ulandeveler', 'mucahitkaya2121@gmail.com', '2017-03-18 01:40:27', '0000-00-00 00:00:00', 'uye', '', '', '', '1995-05-06', 22, 0, '', 1, 'a', 'a', 'a'),
(311, 'Furkan ', 'Özsarý', 'Furkan', '05531582432f', 'ozsarfurkan99@gmail.com', '2017-03-18 01:45:18', '0000-00-00 00:00:00', 'uye', '', '', '', '1995-07-05', 22, 0, '', 1, 'a', 'a', 'a'),
(312, 'Hacire', 'Caymaz', 'FatiHacire', 'hasan1234.', 'hcr.fthcymz2701@gmail.com', '2017-03-18 01:59:08', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Gaziantep', '158cc35b276426.jpg', '1993-09-07', 31, 31, '88.231.28.172', 1, 'a', 'a', 'a'),
(313, 'Ýsmail', 'Yýldýz', 'SmlYldz', 'Qqqwww5858#', 'smlyldz58@gmail.con', '2017-03-18 02:01:45', '0000-00-00 00:00:00', 'uye', '', '', '', '1970-01-01', 22, 0, '', 0, 'a', 'a', 'a'),
(314, 'Rafi', 'Bosnalý', 'rafibosnalý', '80808080', 'rafibosnali1@gmail.com', '2017-03-18 02:03:43', '0000-00-00 00:00:00', 'uye', 'türkiye', 'antalya', '', '1980-09-10', 22, 5, '', 1, 'a', 'a', 'a'),
(315, 'Süleyman', 'Özdemir', 'Süleyman61', 'suleyman61', 'yalaguzusak.61@hotmail.com', '2017-03-18 02:13:48', '0000-00-00 00:00:00', 'uye', '', '', '', '1994-06-10', 22, 0, '', 0, 'a', 'a', 'a'),
(316, 'Veysel', 'Küçük', 'veysel.kck', 'veysel55', 'kucukveysel55@gmail.com', '2017-03-18 03:01:38', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Samsun', '158cc36d1bd415.jpg', '1996-07-16', 25, 51, '46.154.197.23', 0, 'a', 'a', 'a'),
(317, 'zafer', 'Önal ', 'zafer.onal@Outlook.com.tr', '1966refaniye1964', 'zafer.onal@Outlook.com.tr', '2017-03-18 03:03:22', '0000-00-00 00:00:00', 'uye', '', '', '', '1966-01-01', 22, 0, '', 0, 'a', 'a', 'a'),
(318, 'Ömer Ali', 'Çakmak', 'Ömer Ali', '42zeynebkibar42', 'omeralickmk@gmail.com', '2017-03-18 03:13:28', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Ereðli', '158cc47cf2da14.jpg', '1964-08-29', 23, 12, '46.104.28.247', 1, 'a', 'a', 'a'),
(319, 'Mustafa', 'Karayiðit', 'Mustafa', 'yavuz2016', 'mustafakarayigit87@gmail.com', '2017-03-18 03:35:45', '0000-00-00 00:00:00', 'uye', '', '', '158cc3fef25936.jpg', '1986-04-26', 22, 7, '', 0, 'a', 'a', 'a'),
(320, 'Hasan', 'Ünal', 'Hasan_79', '05539822023', 'unal92217@gmail.com', '2017-03-18 03:38:29', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Kilis', '', '1988-11-01', 23, 20, '', 0, 'a', 'a', 'a'),
(321, 'Büyük', 'Baron', 'buyukbaron', '1647225825', 'chtdilki@gmail.com', '2017-03-18 03:48:26', '0000-00-00 00:00:00', 'uye', '', '', '158cc3ebc7bae2.jpg', '1987-05-05', 22, 0, '', 1, 'a', 'a', 'a'),
(322, 'Hafýz', 'GEYLANÝ', 'hafýzgeylani', 'hg13579', 'hafizgeylani793@gmail.co.', '2017-03-18 03:53:25', '0000-00-00 00:00:00', 'uye', '', '', '', '1979-04-23', 22, 0, '', 0, 'a', 'a', 'a'),
(323, 'Mesut', 'Babadað', 'mesut.babadag', 'Mesut1000', 'mesut.babadag@hotmail.com', '2017-03-18 03:55:21', '0000-00-00 00:00:00', 'uye', '', '', '', '1970-11-09', 22, 0, '', 0, 'a', 'a', 'a'),
(324, 'Mustafa', 'Koçar', 'nyc06', 'Mk2717480', 'petraurun@gmail.com', '2017-03-18 03:58:42', '0000-00-00 00:00:00', 'uye', '', '', '', '1971-04-10', 22, 7, '', 1, 'a', 'a', 'a'),
(325, 'Faruk', 'Cebeci', 'Faruk', 'farukc1575', 'fr_cebeci@hotmail.com', '2017-03-18 04:07:15', '0000-00-00 00:00:00', 'uye', '', '', '158edda9ae35b1.jpg', '1972-10-10', 29, 157, '212.156.222.8', 1, 'a', 'a', 'a'),
(326, 'Abdulkadir ramazan', 'GÖZÜKIZIL', 'Abdulkadir1453', '05398948352', 'shov_1999@hotmail.com', '2017-03-18 04:20:12', '0000-00-00 00:00:00', 'uye', '', '', '', '1999-01-01', 22, 0, '', 0, 'a', 'a', 'a'),
(327, 'ERDEM', 'ARABACI', 'eraline', '104045', 'era-46@hotmail.com', '2017-03-18 04:34:04', '0000-00-00 00:00:00', 'uye', '', '', '', '1983-03-25', 22, 0, '', 0, 'a', 'a', 'a'),
(328, 'Hüseyin ', 'Kaykil', 'Siyah sancak', '05365646317', 'yasindekorasyon@mynet.com', '2017-03-18 04:40:20', '0000-00-00 00:00:00', 'uye', '', '', '158cc5341e7ecb.jpg', '1974-06-01', 22, 1, '', 1, 'a', 'a', 'a'),
(329, 'misafi', 'misafi', 'degetloo1', '123123123asd', 'sadas@hotmail.com', '2017-03-18 04:51:15', '0000-00-00 00:00:00', 'uye', '', '', '', '1992-07-09', 22, 0, '', 0, 'a', 'a', 'a'),
(330, 'Murat', 'Kandemir', 'Birincisoz', '135642mk', 'muratkandemir86@gmail.com', '2017-03-18 04:53:41', '0000-00-00 00:00:00', 'uye', '', '', '158cd70252d660.jpg', '1986-05-09', 23, 12, '', 1, 'a', 'a', 'a'),
(331, 'Mehmet', 'Mutlu', 'Merdumgiriz', '985656', 'dorukmemet60@hotmail.com', '2017-03-18 05:02:34', '0000-00-00 00:00:00', 'uye', '', '', '', '1996-05-19', 23, 0, '', 0, 'a', 'a', 'a'),
(332, 'Musa', 'Kurt', 'musakurttt', '05413304283', 'musakurttt@gmail.com', '2017-03-18 05:35:49', '0000-00-00 00:00:00', 'uye', '', '', '', '1998-11-20', 22, 0, '', 0, 'a', 'a', 'a'),
(333, 'Yunus Emre', 'RECBER', 'RTEAKDOST', 'madam35', 'piqaxlady@gmail.com', '2017-03-18 05:48:44', '0000-00-00 00:00:00', 'uye', '', '', '', '1989-05-04', 22, 0, '', 0, 'a', 'a', 'a'),
(334, 'Aytekin', 'Güney', 'Aytekin Güney', '3454g6145a', 'aytekin_net@61hotmail.com', '2017-03-18 08:37:27', '0000-00-00 00:00:00', 'uye', '', '', '', '1988-09-30', 22, 0, '', 0, 'a', 'a', 'a'),
(335, 'Erkan', 'Sarýkaya', 'Anahyess', 'sarikaya418', 'anahyess@hotmail.com', '2017-03-18 12:28:27', '0000-00-00 00:00:00', 'uye', '', '', '', '1990-12-10', 22, 0, '', 0, 'a', 'a', 'a'),
(336, 'Mehmet', 'BAYIRHAN', 'Diyarbakýr', '2bir560.memoli', 'saril-da_sarsinene@hotmail.com', '2017-03-18 13:01:43', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Diyarbakýr', '158ccc19934838.jpg', '1990-12-06', 22, 2, '', 0, 'a', 'a', 'a'),
(337, 'Sema', 'Boran', 'Semabrn@hotmail.com', 'selim16', 'semabrn@gmail.com', '2017-03-18 14:01:53', '0000-00-00 00:00:00', 'uye', '', '', '', '1980-07-11', 24, 3, '', 0, 'a', 'a', 'a'),
(338, 'Özgür ', 'Gür ', 'Vatansanacanimfeda', 'poyraz54', 'istanbulun_mankeni@hotmail.com', '2017-03-18 14:25:46', '0000-00-00 00:00:00', 'uye', '', '', '', '1987-02-08', 22, 1, '', 0, 'a', 'a', 'a'),
(339, 'Mubarek', 'Cersel', 'MbrkCrsl', 'mubarek_cersel', 'mbrkcrsl47@hotmail.com', '2017-03-18 14:29:09', '0000-00-00 00:00:00', 'uye', '', '', '158d60b96de0b1.jpg', '1996-08-07', 23, 9, '', 1, 'a', 'a', 'a'),
(340, 'Hüseyin', ' çekiç', ' husoben13', '13131313', 'altinelek@hotmail.com', '2017-03-18 14:40:41', '0000-00-00 00:00:00', 'uye', '', '', '', '1982-04-15', 22, 0, '', 1, 'a', 'a', 'a'),
(341, 'Ayþenur', 'YILMAZ', 'AYÞENUR', '00001994', 'aysee-ylmz@hotmail.com', '2017-03-18 14:46:59', '0000-00-00 00:00:00', 'uye', '', '', '', '1994-03-05', 24, 0, '', 1, 'a', 'a', 'a'),
(342, 'Berkant', 'Parlak', 'BERKANT PARLAK', '147852369bp', 'berkantparlak@hotmail.com', '2017-03-18 14:54:44', '0000-00-00 00:00:00', 'uye', 'TÜRKÝYE', 'DÜZCE', '', '1985-01-20', 22, 5, '', 0, 'a', 'a', 'a'),
(343, 'Mahir', 'Ülker', 'MahirÜlker', 'rivana123', 'zeko_mh34@hotmail.com', '2017-03-18 15:02:47', '0000-00-00 00:00:00', 'uye', '', '', '', '1997-04-17', 22, 0, '', 0, 'a', 'a', 'a'),
(344, 'himmet', 'kýrlý', 'yamtar', '1991..h', 'himmet.kirli@gmail.com', '2017-03-18 15:11:57', '0000-00-00 00:00:00', 'uye', '', '', '', '1991-10-09', 22, 0, '', 1, 'a', 'a', 'a'),
(345, 'Yunus', 'Keskin', 'yunuskeskin', '41158211610', 'ynskskn25@gmail.com', '2017-03-18 15:41:07', '0000-00-00 00:00:00', 'uye', '', '', '158d589ed5f6b5.jpg', '2000-01-15', 23, 17, '', 1, 'a', 'a', 'a'),
(346, 'Hasan', 'ZEYBEK', 'HasanZeyy', 'hasanreis45', 'multimermimm@gmail.com', '2017-03-18 15:44:07', '0000-00-00 00:00:00', 'uye', '', '', '', '2002-01-01', 22, 0, '', 1, 'a', 'a', 'a'),
(347, 'Ýbrahim', 'Özçelik', 'Ýbrahim Özçelik', '41ibo1732', 'ozcelik_6443@hotmail.com', '2017-03-18 15:44:39', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Uþak', '', '1975-08-20', 22, 0, '78.174.146.73', 0, 'a', 'a', 'a'),
(348, 'Hacý Osman', 'YANIK', 'OSMAN', 'opamatika157', 'haciosmanyanik@gmail.com', '2017-03-18 15:56:09', '0000-00-00 00:00:00', 'uye', '', '', '', '1992-06-04', 23, 6, '46.221.199.170', 1, 'a', 'a', 'a'),
(349, 'Birol', 'Aydin', 'Birol', 'hilal007', 'birolaydin58@hotmail.cm', '2017-03-18 16:08:09', '0000-00-00 00:00:00', 'uye', '', '', '', '1978-01-01', 22, 0, '', 0, 'a', 'a', 'a'),
(350, 'mehmet', 'yazar', 'müverrihmehmet', '05325494407', 'yazarmehmet1071@gmail.com', '2017-03-18 16:46:36', '0000-00-00 00:00:00', 'uye', '', '', '', '1988-02-15', 23, 0, '', 0, 'a', 'a', 'a'),
(351, 'Yusuf ', 'Çevik', 'Çevikyusuf ', 'yusufyusuf', 'y.u.s.u.f.1905@windowslive.com', '2017-03-18 17:01:12', '0000-00-00 00:00:00', 'uye', '', '', '', '1983-10-28', 22, 0, '', 0, 'a', 'a', 'a'),
(352, 'Ferhat', 'Kan', 'Ferati', 'f1q8w6x3', 'f4868f@gmail.com', '2017-03-18 17:14:50', '0000-00-00 00:00:00', 'uye', '', '', '', '1980-01-01', 22, 0, '', 0, 'a', 'a', 'a'),
(353, 'Metin ', 'Aynalý', 'Metin aynalý', '6342255', 'clevermetin@hotmail.com', '2017-03-18 17:15:27', '0000-00-00 00:00:00', 'uye', '', '', '', '1990-01-10', 22, 0, '', 0, 'a', 'a', 'a'),
(354, 'Mehmet ali', 'Küçük', 'Mehmet ali', 'Neydiki25', 'Erzurum1570@Outlook.com', '2017-03-18 17:20:27', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Erzurum', '158ce305d71168.jpg', '1997-06-17', 23, 14, '', 0, 'a', 'a', 'a'),
(355, 'ercü', 'özc', 'rteerc', '4094203', 'ozcanercu@hotmail.com', '2017-03-18 17:26:16', '0000-00-00 00:00:00', 'uye', '', '', '', '1974-06-21', 23, 16, '', 0, 'a', 'a', 'a'),
(356, 'Abdurrahman', 'Öner ', 'Edo', '14531453', 'edooner237@gmail.com', '2017-03-18 17:43:22', '0000-00-00 00:00:00', 'uye', '', '', '', '1978-11-11', 23, 0, '', 0, 'a', 'a', 'a'),
(357, 'Aykut', 'Doðan', 'aykutdgn1', 'ottoman1453', 'aykutdgn1@gmail.com', '2017-03-18 18:12:50', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Nevþehir', '158cd0876e5d86.jpg', '1996-08-13', 23, 3, '81.214.81.36', 1, 'a', 'a', 'a'),
(358, 'Fadime', 'Küçük', 'Fatma can küçük', 'taktatakfado', 'fadoimoc@hotmail.com', '2017-03-18 18:19:19', '0000-00-00 00:00:00', 'uye', '', '', '', '1965-09-18', 23, 0, '', 0, 'a', 'a', 'a'),
(359, 'Sinan', 'Küçük', 'SinanBey55', '05465615729', 'beysinan55@gmail.com', '2017-03-18 18:24:09', '0000-00-00 00:00:00', 'uye', 'Türkiye ', 'Samsun', '', '1998-04-18', 22, 1, '', 0, 'a', 'a', 'a'),
(360, 'Abdurrahman', 'Ateþ ', 'Selçuklu', '281105', 'aates@outlook.com', '2017-03-18 18:55:36', '0000-00-00 00:00:00', 'uye', '', '', '', '1979-03-30', 23, 0, '', 0, 'a', 'a', 'a'),
(361, 'Cafer ömer ', 'Fidan ', 'ilayý kelimatullah ', 'omergmail', 'cengizaleynaomer@gmail.com', '2017-03-18 19:02:22', '0000-00-00 00:00:00', 'uye', '', '', '', '1976-12-22', 22, 0, '', 0, 'a', 'a', 'a'),
(362, 'Tarýk', 'Aydoðdu', 'Takomako', 'time1453', 'tarikaydogdu@gmail.com', '2017-03-18 19:47:11', '0000-00-00 00:00:00', 'uye', '', '', '', '1981-07-15', 22, 0, '', 1, 'a', 'a', 'a'),
(363, 'Yasin', 'Akbey', 'Yasin51', '05464670051', 'abrek_51@hotmail.com', '2017-03-18 20:27:01', '0000-00-00 00:00:00', 'uye', '', '', '', '1985-02-20', 22, 0, '', 0, 'a', 'a', 'a'),
(364, 'kamuran ', 'erden', 'muallim', 'mae4g1969', 'kmrnerden@gmail.com', '2017-03-18 22:58:48', '0000-00-00 00:00:00', 'uye', '', '', '', '1969-07-07', 22, 0, '', 0, 'a', 'a', 'a'),
(365, 'Bülent ', 'Bozat ', 'Osmanlý Bülent ', 'fenerbahce1907', 'bulentbozat2@gmail.com', '2017-03-18 23:04:28', '0000-00-00 00:00:00', 'uye', '', '', '158cd4e3c2b44a.jpg', '1987-11-07', 23, 11, '', 0, 'a', 'a', 'a'),
(366, 'Mehmet', 'Han', 'vetmehmet', 'Mehmet-44', 'vetmehmet44@gmail.com', '2017-03-18 23:06:10', '0000-00-00 00:00:00', 'uye', '', '', '', '1983-01-01', 22, 0, '', 1, 'a', 'a', 'a'),
(367, 'Murat', 'Dönmez', 'Hacimuro43', 'murat4343', 'donmezmurat45@gmail.com', '2017-03-18 23:08:20', '0000-00-00 00:00:00', 'uye', '', '', '', '1990-07-23', 23, 0, '', 0, 'a', 'a', 'a'),
(368, 'Özgür', 'Özdoðan', 'ozdoganozgur', 'oooo1234', 'oozdogan32@gmail.com', '2017-03-18 23:24:54', '0000-00-00 00:00:00', 'uye', '', '', '', '2001-07-19', 23, 0, '', 1, 'a', 'a', 'a'),
(369, 'mustafa ', 'yalçýn ', 'birlix', 'keskin77', 'birlix1@gmail.com', '2017-03-18 23:36:55', '0000-00-00 00:00:00', 'uye', '', '', '', '1987-05-20', 22, 2, '', 0, 'a', 'a', 'a'),
(370, 'halil ibrahim', 'eroglu', 'h.i.e', '737433', 'halil_8541@birsancak.com', '2017-03-18 23:40:04', '0000-00-00 00:00:00', 'uye', '', '', '', '1994-10-29', 22, 0, '', 0, 'a', 'a', 'a'),
(371, 'Fatih', 'Dinç', 'Osmanlý50', '123456852', 'bortecine50@hotmail.com', '2017-03-18 23:53:34', '0000-00-00 00:00:00', 'uye', '', '', '158cd5940d99c3.jpg', '1979-11-16', 22, 0, '', 1, 'a', 'a', 'a'),
(372, 'Durdu Mehmet ', 'Badem ', 'erdoðan ', 'taha', 'eslemserradmb@hotmail', '2017-03-18 23:55:18', '0000-00-00 00:00:00', 'uye', '', '', '', '1979-11-16', 22, 0, '', 0, 'a', 'a', 'a'),
(373, 'Yüce', 'Laik', 'Laik', 'laik123', 'laik@gmail.com', '2017-03-19 00:14:10', '0000-00-00 00:00:00', 'uye', '', '', '', '1923-04-23', 21, 0, '', 0, 'a', 'a', 'a'),
(374, 'Muhammed', 'Sýrdaþ', 'byGöLGe', 'quaresma', 'baygolge9@gmail.com', '2017-03-19 00:47:52', '0000-00-00 00:00:00', 'uye', '', '', '', '1993-11-11', 22, 0, '', 1, 'a', 'a', 'a'),
(375, 'Naim', 'Kýrdaþ', 'Naim Kýrdaþ', '479532488dhþhfdkgkbc', 'msaid9843@gmail.com', '2017-03-19 01:00:14', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Samsun', '', '1990-11-02', 26, 95, '188.57.136.67', 1, 'a', 'a', 'a'),
(376, 'yusuf berkay', 'saglam', 'yusufbsaglam', '08101995', 'jamesborealis@gmail.com', '2017-03-19 01:09:54', '0000-00-00 00:00:00', 'uye', '', '', '', '1995-10-08', 22, 0, '', 0, 'a', 'a', 'a'),
(377, 'Hakan', 'Türk ', 'Hakan türk ', '123165527265gh', 'hakanturk_32@hotmail.com', '2017-03-19 01:20:47', '0000-00-00 00:00:00', 'uye', '', '', '', '1978-00-01', 23, 0, '', 0, 'a', 'a', 'a'),
(378, 'ali', 'ibiþ', 'aliibiþ', '923267sibi', 'aliibis50@gmail.com', '2017-03-19 01:23:36', '0000-00-00 00:00:00', 'uye', '', '', '', '1976-11-20', 23, 0, '', 1, 'a', 'a', 'a'),
(379, 'Ýsa', 'Dalgaci', 'Ýsa ', '1234isa4321', 'isadalgaci@gmail.com', '2017-03-19 01:46:01', '0000-00-00 00:00:00', 'uye', '', '', '', '1984-12-26', 22, 0, '', 0, 'a', 'a', 'a'),
(380, 'Burak', 'YAÞAR', 'Burak yaþar', '05458263445', 'svd.brk.252015@hotmail.com', '2017-03-19 01:53:16', '0000-00-00 00:00:00', 'uye', 'TÜRKÝYE', 'ERZURUM', '', '1993-05-20', 22, 0, '', 0, 'a', 'a', 'a'),
(381, 'Seyfettin', 'AYDIN', 'Seyfettin', '20m@rt1979***', 'info@aydin-bilgisayar.com', '2017-03-19 02:03:38', '0000-00-00 00:00:00', 'uye', '', '', '158cd781cf387b.jpg', '1979-03-20', 24, 2, '', 1, 'a', 'a', 'a'),
(382, 'Kutadgu', 'BÝLÝG', 'Kutadgubilig', 'ktdgblg', 'kutadgubilig36@yandex.ru', '2017-03-19 02:03:57', '0000-00-00 00:00:00', 'uye', '', '', '158cd776aa2c58.jpg', '1923-10-29', 23, 2, '', 0, 'a', 'a', 'a'),
(383, 'Metin', 'Soycan', 'Metin', '27731983', 'm.laynex@gmail.com', '2017-03-19 02:09:41', '0000-00-00 00:00:00', 'uye', '', '', '', '1983-01-31', 22, 6, '46.154.195.33', 1, 'a', 'a', 'a'),
(384, 'Ahmet', 'Bakýrcýoðlu', 'BALIKÇI', 'AB2463834', 'bakirci037@hotmail.com', '2017-03-19 02:15:59', '0000-00-00 00:00:00', 'uye', '', '', '', '1955-12-01', 22, 0, '', 0, 'a', 'a', 'a'),
(385, 'Samet', 'Karaçomak', 'Samet40', 'diriliþ1997', 'kaman_samet_1997@hotmail.con', '2017-03-19 02:17:19', '0000-00-00 00:00:00', 'uye', '', '', '', '1997-05-14', 22, 0, '', 0, 'a', 'a', 'a'),
(386, 'Mehmet', 'Oktaþ', 'Mehmetoktas', '88917070.', 'afm_oktas@hotmail.com', '2017-03-19 02:37:12', '0000-00-00 00:00:00', 'uye', '', '', '', '2011-06-07', 22, 0, '', 0, 'a', 'a', 'a'),
(387, 'cihat', 'simsek', 'simsek25', 'cihatcevriye4153037', 'cevriyesimsek23@gmail.com', '2017-03-19 02:38:42', '0000-00-00 00:00:00', 'uye', '', '', '', '0000-00-00', 22, 1, '', 1, 'a', 'a', 'a'),
(388, 'Sercan', 'Bulut', 'Buluut', 'serkan', 'sekho.ozt84@gmail.com', '2017-03-19 02:39:12', '0000-00-00 00:00:00', 'uye', '', '', '', '1985-01-01', 22, 0, '', 0, 'a', 'a', 'a'),
(389, 'Abdülkerim', ' Gürel', ' akgur', 'akg165432', 'akgurel@gmail.com', '2017-03-19 02:39:52', '0000-00-00 00:00:00', 'uye', '', '', '', '1969-10-08', 22, 0, '', 1, 'a', 'a', 'a'),
(390, 'Ali Emre ', 'ATEÞ', 'Ali@mre', '13erme13', 'cavus7042@gmail.com', '2017-03-19 02:44:57', '0000-00-00 00:00:00', 'uye', '', '', '', '1994-09-15', 22, 1, '', 1, 'a', 'a', 'a'),
(392, 'Kürþat', 'KALELÝ', 'kaleli', 'kursat235', 'ahmetkursatciftci98@gmail.com', '2017-03-19 02:54:55', '0000-00-00 00:00:00', 'uye', '', '', '', '1998-11-05', 23, 0, '', 0, 'a', 'a', 'a'),
(393, 'Mehmet þahin', 'Erem', 'Þahin', 'Adliye02', 'sahinerem@hotmail.com', '2017-03-19 03:45:32', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Gaziantep', '', '1974-09-08', 22, 0, '', 0, 'a', 'a', 'a'),
(394, 'mehmet', 'alkan', 'm54683a', 'alkan157252981', 'alkan_mehmet63@hotmail.com', '2017-03-19 03:46:06', '0000-00-00 00:00:00', 'uye', '', '', '', '1983-09-10', 24, 0, '', 0, 'a', 'a', 'a'),
(396, 'Reþit', 'Ortak', 'Baran', '4112748', 'cexmoris_25@hotmail.com', '2017-03-19 04:16:07', '0000-00-00 00:00:00', 'uye', '', '', '', '1987-04-14', 22, 0, '', 0, 'a', 'a', 'a'),
(397, 'ümit', 'önal', 'umutonal', '7434831', 'umutonal_28@hotmail.com', '2017-03-19 04:24:57', '0000-00-00 00:00:00', 'uye', '', '', '', '1992-03-09', 22, 0, '', 0, 'a', 'a', 'a'),
(398, 'Hasan', 'Yörük', 'Hasan_yoruk68', 'hasandilara', 'hasanyoruuk123@hotmail.com', '2017-03-19 04:45:14', '0000-00-00 00:00:00', 'uye', '', '', '', '1990-11-12', 25, 2, '', 0, 'a', 'a', 'a'),
(399, 'Gamze', 'Fazýl', 'Adalet', '333444k.', 'glsmn-99@hotmail.com', '2017-03-19 04:52:53', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Kudüs', '', '1991-01-01', 23, 0, '', 0, 'a', 'a', 'a'),
(400, 'Mustafa', 'Akkoç', 'Mrdni', 'mrdnii', 'akkoclaras@hotmail.com', '2017-03-19 05:18:07', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Ýstanbul', '158cda77d0a9a6.jpg', '1982-01-20', 27, 31, '', 0, 'a', 'a', 'a'),
(401, 'Ahmet', 'Baran', 'RTEAhmet', 'ahmet4125', 'ahmet.barann@hotmail.com', '2017-03-19 06:02:22', '0000-00-00 00:00:00', 'uye', '', '', '', '1998-05-21', 21, 0, '', 0, 'a', 'a', 'a'),
(402, 'Ahmet', 'HAN', 'ahmet_h4n', 'Ahmet2071@', 'hanahmet2071@gmail.com', '2017-03-19 08:24:47', '0000-00-00 00:00:00', 'uye', '', '', '', '1997-08-20', 21, 0, '', 0, 'a', 'a', 'a'),
(403, 'Ahmet', 'kabasakal', 'ahoka06', 'angara06', 'ahoka06@gmail.com', '2017-03-19 09:13:54', '0000-00-00 00:00:00', 'uye', '', '', '', '1994-04-05', 22, 0, '', 0, 'a', 'a', 'a'),
(404, 'Ilhan', 'Þen', 'Ilhan', 'fener1907', 'ilhan_sen1977@hotmail.com', '2017-03-19 09:23:56', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Sakarya', '158cddf6130d55.jpg', '1977-05-11', 21, 0, '', 0, 'a', 'a', 'a'),
(405, 'ABDÝL ', 'ÇELÝK ', 'abdil2023', 'abdilfundam', 'abdilcelik19@gmail.com', '2017-03-19 09:52:58', '0000-00-00 00:00:00', 'uye', '', '', '158cde72356dee.jpg', '1996-10-10', 24, 7, '95.12.116.194', 1, 'a', 'a', 'a'),
(406, 'adem', 'gümüþsuyu', 'mete', 'adem17sevda', 'polat-264@hotmail.com', '2017-03-19 10:13:10', '0000-00-00 00:00:00', 'uye', '', '', '', '1987-09-14', 21, 0, '5.176.205.97', 0, 'a', 'a', 'a'),
(407, 'uza', 'net', 'uzadan@hotmail.com', '15963214', 'uzadan@hotmail.com', '2017-03-19 10:29:19', '0000-00-00 00:00:00', 'uye', '', '', '', '1982-01-01', 21, 0, '', 0, 'a', 'a', 'a'),
(408, 'Volkan', 'Boz', 'Volkan898', '3669vb898', 'hatay_volkan@hotmail.com', '2017-03-19 12:05:49', '0000-00-00 00:00:00', 'uye', '', '', '', '1996-07-19', 21, 0, '', 0, 'a', 'a', 'a'),
(409, 'Abuzer', 'Er', 'DURE ', 'abuzer0541', 'DURE_07_1905@hotmail.com', '2017-03-19 12:19:09', '0000-00-00 00:00:00', 'uye', '', '', '', '1990-12-04', 21, 0, '', 0, 'a', 'a', 'a'),
(411, 'mustafa', 'ilhan', 'mustafa ilhan', '.-644-biga', 'mustafailhan1979@gmail.com', '2017-03-19 13:33:52', '0000-00-00 00:00:00', 'uye', '', '', '', '1979-01-15', 21, 0, '', 1, 'a', 'a', 'a'),
(412, 'Ahmet', 'ÇINAR', 'Cinarahmet46', '1357946726263', 'receptionist_0746@hotmail.com', '2017-03-19 13:37:24', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Antalya', '158ce1c196c95f.jpg', '1987-07-30', 21, 0, '', 1, 'a', 'a', 'a'),
(413, 'salih', 'saðlam', 'salih', 'kadir456325', 'salih.2551@hotmail.com', '2017-03-19 13:53:25', '0000-00-00 00:00:00', 'uye', '', '', '', '1976-06-18', 22, 1, '', 1, 'a', 'a', 'a'),
(414, 'Numan ', 'Usta ', 'Baybars ', 'baycan1987', 'ben_numan@hotmail.com', '2017-03-19 14:12:41', '0000-00-00 00:00:00', 'uye', '', '', '', '1984-01-02', 22, 0, '', 0, 'a', 'a', 'a'),
(415, 'muhsin', 'akgün', 'Muhsin', '2473724737', 'muhsinakgn@gmail.com', '2017-03-19 14:22:14', '0000-00-00 00:00:00', 'uye', '', '', '', '0000-00-00', 21, 0, '', 0, 'a', 'a', 'a'),
(416, 'ahmet', 'atak', 'ahmetusta', 'CabliCabli31', 'executuve_chef@outlook.com.tr', '2017-03-19 14:33:22', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Ankara', '158e7e0126f483.jpg', '1983-10-12', 22, 3, '46.154.226.61', 0, 'a', 'a', 'a'),
(417, 'Aynur', 'Ölmez', 'Aynur ölmez', '12345', 'gamzeekrks@gmail.com', '2017-03-19 15:00:28', '0000-00-00 00:00:00', 'uye', '', '', '', '1972-00-12', 21, 0, '', 0, 'a', 'a', 'a'),
(418, 'Utku', 'Yýldýz', 'UtkuYldz', '20022002', 'bora007_ask@hotmail.com', '2017-03-19 15:15:53', '0000-00-00 00:00:00', 'uye', '', '', '', '2000-05-05', 23, 0, '', 0, 'a', 'a', 'a'),
(419, 'Haþim', 'Öztürk ', 'Kaligraf', '27272', 'ehlihat@gmail.com', '2017-03-19 16:09:42', '0000-00-00 00:00:00', 'uye', '', '', '', '1980-02-10', 22, 0, '', 1, 'a', 'a', 'a'),
(420, 'Fuat', 'Bilge', 'fuatbilge', 'ankara', 'fuatbilge@man.com', '2017-03-19 16:45:23', '0000-00-00 00:00:00', 'uye', '', '', '', '1969-01-01', 21, 0, '', 0, 'a', 'a', 'a'),
(421, 'Fýrat', 'Tanýk ', 'Fýrat', '12101979', 'firattanik@gmail.com', '2017-03-19 17:14:57', '0000-00-00 00:00:00', 'uye', '', '', '', '1979-10-12', 21, 0, '', 0, 'a', 'a', 'a'),
(422, 'Nurullah ', 'ÖZTÜRK ', 'Manyaq7221 ', '123456789', 'ztrk7221@hotmail.com', '2017-03-19 17:32:43', '0000-00-00 00:00:00', 'uye', '', '', '', '2000-09-30', 22, 0, '', 0, 'a', 'a', 'a'),
(423, 'BuRak', 'KILIÇ', 'BuRak', '19051996burak', 'brkklc_27@hotmail.com', '2017-03-19 17:43:50', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Gaziantep', '158ce546570888.jpg', '1996-06-29', 24, 12, '176.217.57.34', 1, 'a', 'a', 'a'),
(424, 'Ahmet', 'Kaya', 'Anadolu38_38', '11alperen11.', '14alperen12@gmail.com', '2017-03-19 17:56:41', '0000-00-00 00:00:00', 'uye', '', '', '', '1987-11-11', 22, 0, '', 1, 'a', 'a', 'a'),
(425, 'Hasan', 'Çaðlar', 'Caglar28', '28725**++', 'hsn_fb_1907@hormail.com', '2017-03-19 17:56:48', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Konya', '158ce569b2754e.jpg', '1997-05-30', 22, 1, '', 0, 'a', 'a', 'a'),
(426, 'Seyithan', 'Durmaz', 'Seyithan', 'xxccderik.3434', 'Seyithan4734@hotmail.com', '2017-03-19 18:14:57', '0000-00-00 00:00:00', 'uye', '', '', '', '1985-00-24', 21, 0, '', 0, 'a', 'a', 'a'),
(427, 'Sanane', 'Sanane', 'Sanane', 'sananeoc', 'sanane@sanane.com', '2017-03-19 18:30:02', '0000-00-00 00:00:00', 'uye', '', '', '', '2014-04-27', 22, 0, '', 0, 'a', 'a', 'a'),
(428, 'Nuriye', 'Köylüoðlu', 'ionantha', '21802180', 'nurkýyluoglu@gmail.com', '2017-03-19 18:55:18', '0000-00-00 00:00:00', 'uye', '', '', '', '1988-03-26', 21, 0, '', 0, 'a', 'a', 'a'),
(429, 'Eral', 'Erim', 'Eral', 'meae885298', 'eralerim@gmail.com', '2017-03-19 19:01:56', '0000-00-00 00:00:00', 'uye', '', '', '', '1983-11-28', 21, 0, '', 0, 'a', 'a', 'a'),
(430, 'Atatürk', 'torunu', 'AtatürkTorunu', '14591459', 'karakatil111@gmail.com', '2017-03-19 19:24:33', '0000-00-00 00:00:00', 'uye', '', '', '158ce6ae0591f0.png', '1993-10-13', 19, 0, '', 0, 'a', 'a', 'a'),
(431, 'Burhan', 'Bilgi', 'Burhan Bilgi ', 'saidnursi064', 'burhanbilgiank@gmail.com', '2017-03-19 20:38:14', '0000-00-00 00:00:00', 'uye', '', '', '', '1992-03-14', 21, 0, '', 0, 'a', 'a', 'a'),
(432, 'Ýsmail ', 'Kaba ', 'Abdulhamit37', 'kamyoncudev37', 'kabaismail37@hotmail.com', '2017-03-19 21:14:44', '0000-00-00 00:00:00', 'uye', '', '', '', '1993-06-13', 23, 3, '', 0, 'a', 'a', 'a'),
(433, 'Azra ', 'Altundal ', 'Azra', 'Merhaba', 'aalagoz@360.com', '2017-03-19 21:24:29', '0000-00-00 00:00:00', 'uye', '', '', '', '1998-07-11', 21, 0, '', 0, 'a', 'a', 'a'),
(434, 'Aykut', 'Güney', 'Güney45', '2722030040', 'aykut_guney__@hotmail.com', '2017-03-19 21:45:00', '0000-00-00 00:00:00', 'uye', '', '', '', '1991-01-14', 21, 0, '', 0, 'a', 'a', 'a'),
(435, 'cebrail', 'elçi', 'cebrail', '7829707cebrail', 'cebrail_elci@hotmail.com', '2017-03-19 22:27:30', '0000-00-00 00:00:00', 'uye', '', '', '', '1982-09-01', 22, 0, '', 0, 'a', 'a', 'a'),
(436, 'Ahmet', 'Akdað', 'Ahmet', '35221950568', 'malatya-441979@hotmail.com', '2017-03-19 22:32:08', '0000-00-00 00:00:00', 'uye', '', '', '', '1979-09-15', 21, 0, '', 0, 'a', 'a', 'a'),
(437, 'Ýnan', 'Tekinda?', 'Yusufinan50', 'emirberk2017', 'i.tekin.350@hotmail.com', '2017-03-19 22:37:20', '0000-00-00 00:00:00', 'uye', '', '', '', '1976-03-10', 21, 0, '78.175.106.186', 1, 'a', 'a', 'a'),
(438, 'Halil', 'Duru', 'ozdeozne', 'Duru3838.', 'halil640@icloud.com', '2017-03-19 22:44:10', '0000-00-00 00:00:00', 'uye', '', '', '158ce9a8f5d87d.jpg', '1997-04-12', 21, 0, '', 1, 'a', 'a', 'a'),
(439, 'Azra ', 'Altundal ', 'Aazra', 'Merhaba', 'aynuralagoz80@gmail', '2017-03-19 23:08:40', '0000-00-00 00:00:00', 'uye', '', '', '', '0000-00-00', 22, 4, '', 0, 'a', 'a', 'a'),
(440, 'Melih', 'Boyraz', 'B''oyraz_M''elih1453', 'Xhwlf.tms,1', 'mboyraz113@gmail.com', '2017-03-19 23:39:36', '0000-00-00 00:00:00', 'uye', '', '', '', '1997-07-03', 21, 0, '', 0, 'a', 'a', 'a'),
(441, 'Muhammed ', 'Yýlmaz ', 'Muhammed YILMAZ ', '41754175', 'mhdcandadas@hotmail.com', '2017-03-19 23:41:38', '0000-00-00 00:00:00', 'uye', '', '', '', '1978-08-25', 22, 4, '94.55.38.166', 1, 'a', 'a', 'a'),
(442, 'Uður', 'Yýlmaz', 'ugrylmz18', '52ft94652', 'ugrylmz_52@outlook.com', '2017-03-19 23:42:50', '0000-00-00 00:00:00', 'uye', '', '', '', '1998-06-11', 21, 0, '', 1, 'a', 'a', 'a'),
(443, 'Hayati', 'YILMAZ', 'dünya 5-den büyük-tür-rte', '09031234', 'hayati.yilmaz63@gmail.com', '2017-03-19 23:51:55', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Ankara', '158cfc85798549.jpg', '1963-03-05', 22, 16, '', 1, 'a', 'a', 'a'),
(444, 'Tanju', 'Gurbuz', 'TANJU', '1453', 'tanjugurbuz601@gmail.com', '2017-03-19 23:59:30', '0000-00-00 00:00:00', 'uye', '', '', '', '1988-03-28', 21, 0, '', 0, 'a', 'a', 'a'),
(445, 'Gazi', 'Aydýn', 'Gazi Muhtar', '2009selim', 'gazi_aydin@windowslive.com', '2017-03-20 00:07:00', '0000-00-00 00:00:00', 'uye', '', '', '', '1979-04-07', 21, 0, '', 0, 'a', 'a', 'a'),
(446, 'halil', 'yüksel', 'hyuksel15', '5112025', 'h.yuksel15@hotmail.com', '2017-03-20 00:08:56', '0000-00-00 00:00:00', 'uye', '', '', '', '2000-07-19', 22, 42, '', 0, 'a', 'a', 'a'),
(447, 'Furkan Samet ', 'KÖÇE', 'furkansametkoce', 'hebelehubele.1', 'furkansametkoce27@gmail.com', '2017-03-20 00:26:48', '0000-00-00 00:00:00', 'uye', '', '', '', '1996-08-19', 21, 0, '', 0, 'a', 'a', 'a'),
(448, 'Blue', 'Code', 'BlueCode', '81000303', 'tolgatancan@gmail.com', '2017-03-20 00:27:14', '0000-00-00 00:00:00', 'uye', '', '', '', '1990-03-30', 21, 0, '', 0, 'a', 'a', 'a'),
(449, 'Mehmet Akif', 'KARA', 'poseidoN', 'Akif0770', 'akifuss.77@gmail.com', '2017-03-20 00:43:30', '0000-00-00 00:00:00', 'uye', '', '', '', '2002-01-11', 22, 0, '', 0, 'a', 'a', 'a'),
(450, 'Abdullah', 'Yildirim', 'kazabatli', '155353', 'kazabatli05@hotmail.com', '2017-03-20 00:54:57', '0000-00-00 00:00:00', 'uye', '', '', '', '1975-05-07', 22, 0, '', 1, 'a', 'a', 'a'),
(451, 'Lütfullah ', 'Lafcý ', 'Lutfu', 'lutfugram', 'ankaralilutfu_0619@hotmail.com', '2017-03-20 00:55:20', '0000-00-00 00:00:00', 'uye', '', '', '', '1996-11-10', 21, 0, '', 0, 'a', 'a', 'a'),
(452, 'abdullah', 'demir', 'ofluapo77', 'apo953751', 'abdullahdemir.of77@gmail.com', '2017-03-20 01:08:58', '0000-00-00 00:00:00', 'uye', 'turkiye', 'antalya', '158cecbf3e33b1.jpg', '1977-05-15', 23, 26, '176.240.65.37', 1, 'a', 'a', 'a'),
(453, 'petro', 'deula', 'petrodeula', 'Fatih.61', 'fatihozcan61_61@yandex.com', '2017-03-20 01:18:02', '0000-00-00 00:00:00', 'uye', '', '', '', '1982-05-03', 21, 0, '', 0, 'a', 'a', 'a'),
(455, 'Sinan ', 'Kayaner', 'Sinan Kayaner ', 'Sinan.65410', 'kayanersinan@gmail.com', '2017-03-20 01:27:55', '0000-00-00 00:00:00', 'uye', '', '', '', '1992-05-05', 21, 0, '', 0, 'a', 'a', 'a'),
(456, 'Fatih', 'Akyol', 'Fat48', '411fatih', 'fatih45025@gmail.com', '2017-03-20 02:18:42', '0000-00-00 00:00:00', 'uye', '', '', '', '1990-12-04', 21, 0, '', 1, 'a', 'a', 'a'),
(457, 'Semih ', 'Ede', 'Napolyon', 'hacker27', 'karizma_x27@hotmail.com', '2017-03-20 02:19:47', '0000-00-00 00:00:00', 'uye', '', '', '', '1991-07-12', 21, 0, '', 1, 'a', 'a', 'a'),
(458, 'Mustafa ', 'Þua ', 'Suakin', '3948baba', 'fahrettin-cocuk@hotmail.com', '2017-03-20 02:26:56', '0000-00-00 00:00:00', 'uye', '', '', '', '2000-05-10', 21, 0, '', 0, 'a', 'a', 'a'),
(459, 'kerim', 'Erol', 'TURKMEN', '2008gpk2012', 'kerim_erol06@hotmail.com', '2017-03-20 02:43:41', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Ankara', '', '1981-03-03', 21, 0, '', 0, 'a', 'a', 'a'),
(460, 'Muhammed Fettah ', 'Akarsu ', 'Fettah', '5fettah5', 'dumlupinarli@yahoo.com.tr', '2017-03-20 02:51:10', '0000-00-00 00:00:00', 'uye', '', '', '', '1976-12-20', 21, 0, '', 0, 'a', 'a', 'a'),
(461, 'orhan', 'polat', 'orhan_58', 'orhanpolat58', 'orhan5822@gmail.com', '2017-03-20 02:53:36', '0000-00-00 00:00:00', 'uye', 'türkiye', 'bitlis', '', '1991-02-00', 21, 0, '', 0, 'a', 'a', 'a'),
(462, 'Fatma', 'Yýlmaz', 'fatma.yilmaz.1453', 'eo4u38vtx3', 'n1689403@mvrht.com', '2017-03-20 03:06:15', '0000-00-00 00:00:00', 'uye', '', '', '', '1979-06-05', 22, 0, '', 1, 'a', 'a', 'a'),
(463, 'Devran', 'Uzundað', 'DevranUzundað', 'devran.89', 'devran_58_@hotmail.com', '2017-03-20 03:26:30', '0000-00-00 00:00:00', 'uye', '', '', '', '1989-09-15', 21, 0, '', 0, 'a', 'a', 'a'),
(464, 'Muhammed', 'Sevinç', 'Evladý Osmanlý', '145381', 'muhammed_sevinc@mynet.com.tr', '2017-03-20 03:58:53', '0000-00-00 00:00:00', 'uye', '', '', '', '1981-09-01', 22, 33, '', 1, 'a', 'a', 'a'),
(465, 'Yahya', 'Yýldýrým', 'Yahya', 'ahmet1834', 'Yahya_mrg@hotmail.com', '2017-03-20 03:59:31', '0000-00-00 00:00:00', 'uye', '', '', '', '1975-09-01', 21, 0, '', 0, 'a', 'a', 'a'),
(466, 'Kamil', 'Kamil', 'Ottoman4149', '352687aaa', 'murgullu_1986@hotmail.com', '2017-03-20 04:01:12', '0000-00-00 00:00:00', 'uye', '', '', '', '1988-08-12', 21, 0, '', 1, 'a', 'a', 'a'),
(467, 'Þarzým ', 'Akman ', 'akman0619@outlook.com', '571korkma2009', 'akman0619@outlook.com', '2017-03-20 04:14:06', '0000-00-00 00:00:00', 'uye', '', '', '', '1994-02-24', 21, 0, '', 1, 'a', 'a', 'a'),
(468, 'Uður', 'Bölük', 'Uður', 'bölük82', 'ugurboluk004@gamil.com', '2017-03-20 04:16:19', '0000-00-00 00:00:00', 'uye', '', '', '', '1992-12-05', 22, 0, '', 0, 'a', 'a', 'a'),
(469, 'Ahmet', 'Kocatürk', 'Pehliwayn', '141186ak', 'pehliwayn_1988@hotmail.com', '2017-03-20 04:17:26', '0000-00-00 00:00:00', 'uye', '', '', '', '1986-11-14', 22, 7, '176.220.177.41', 1, 'a', 'a', 'a'),
(470, 'Kapucu ', 'Matbaa ', 'Kapucu,mabaa', 'orhan444', 'kapucu.matbaa.@hotmail.com', '2017-03-20 04:46:17', '0000-00-00 00:00:00', 'uye', '', '', '', '1973-12-05', 21, 0, '', 0, 'a', 'a', 'a'),
(471, 'A''Samet', 'Erdem', 'A''SametErdem', '12afe44c', 'asameterdemm@yandex.com', '2017-03-20 04:46:55', '0000-00-00 00:00:00', 'uye', '', '', '', '1993-09-19', 21, 0, '', 1, 'a', 'a', 'a'),
(473, 'Mehmet Fatih ', 'ARI ', 'MFA', '1625', 'mefar.16@gmail.com', '2017-03-20 05:38:20', '0000-00-00 00:00:00', 'uye', '', '', '', '1994-12-13', 21, 0, '', 0, 'a', 'a', 'a'),
(474, 'Bilal', 'Acat', 'pesimistbilal1453', 'holypesimist1453', 'zula_pesimist@outlook.com', '2017-03-20 05:50:29', '0000-00-00 00:00:00', 'uye', '', '', '', '1998-08-02', 21, 0, '', 1, 'a', 'a', 'a'),
(475, 'Hüseyin', 'Hoþel', 'hosel37', '15l73337', 'hosel.37@gmail.com', '2017-03-20 06:08:52', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Ýstanbul', '158cf031f5e7e6.jpg', '1987-10-09', 24, 14, '', 1, 'a', 'a', 'a'),
(476, 'Eren', 'Kement', 'makarlak', '7445615', 'erenkement1907@gmail.com', '2017-03-20 06:32:09', '0000-00-00 00:00:00', 'uye', '', '', '', '1998-10-10', 21, 0, '', 0, 'a', 'a', 'a'),
(478, 'Mevlüt', 'Topçu', 'mevluttpc', '530175-Ordu', 'karadeniz_li_yim@hotmail.com', '2017-03-20 07:55:43', '0000-00-00 00:00:00', 'uye', '', '', '', '1993-03-18', 21, 0, '', 0, 'a', 'a', 'a'),
(479, 'Kemal', 'Aslan', 'kmlsln42', '012ka012.', 'kemalaslan92@hotmail.com', '2017-03-20 08:42:31', '0000-00-00 00:00:00', 'uye', '', '', '', '2000-02-02', 21, 0, '', 0, 'a', 'a', 'a'),
(480, 'Feridun', 'Kibar', 'Uzman', '000319', 'feridunk81@gmail.com', '2017-03-20 12:52:25', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Düzce', '158f6aec3bbb4a.jpg', '1964-12-15', 21, 31, '178.241.115.206', 1, 'a', 'a', 'a'),
(481, 'Selahattin', 'Akýn', 'selo_54', '112233', 'selocan267b@hotmail.com', '2017-03-20 12:55:24', '0000-00-00 00:00:00', 'uye', '', '', '', '2001-12-28', 21, 0, '', 0, 'a', 'a', 'a'),
(482, 'Selcuk', 'Uncuoglu', 'kementer', 'baskan2023', 'kementer@gmail.com', '2017-03-20 12:57:14', '0000-00-00 00:00:00', 'uye', '', '', '', '1971-01-10', 21, 0, '', 1, 'a', 'a', 'a'),
(483, 'hikmet', 'DEMÝRDÖVER', 'hikmet', 'seyma778707', 'ahmet.furkan778707@gmail.com', '2017-03-20 13:15:36', '0000-00-00 00:00:00', 'uye', 'TÜRKÝYE', 'ÞANLIURFA', '', '1979-01-15', 21, 17, '', 1, 'a', 'a', 'a'),
(484, 'Halil', 'Dogan', 'Aliyar', '123456Do', 'doganhalil1986@gmail.com', '2017-03-20 13:43:50', '0000-00-00 00:00:00', 'uye', '', '', '', '1986-06-22', 23, 54, '', 1, 'a', 'a', 'a'),
(485, 'Abdulkadir', 'Akçay', 'Abdulkadirakcay', 'akcay405', 'akcay.256@gmail.com', '2017-03-20 14:27:06', '0000-00-00 00:00:00', 'uye', '', '', '', '1994-06-03', 21, 0, '', 0, 'a', 'a', 'a'),
(486, 'Bahtiyar ', 'OÐUR ', 'bahtiyarogur', '19781978', 'bahtiyarogur.29@hotmail.com', '2017-03-20 14:34:00', '0000-00-00 00:00:00', 'uye', '', '', '', '1978-02-25', 21, 0, '', 0, 'a', 'a', 'a'),
(487, 'Nejmi', 'TÜRKEÐÝLMEZ ', 'Nejmi', 'nejmi68leyla67', 'nejmiturkegilmez@hotmail.com', '2017-03-20 15:05:28', '0000-00-00 00:00:00', 'uye', '', '', '', '1968-04-25', 23, 0, '', 0, 'a', 'a', 'a'),
(488, 'SEDA', 'BOZ', 's.sdabz', '17743418016annem', 'ss.sdabz@gmail.com', '2017-03-20 15:06:08', '0000-00-00 00:00:00', 'uye', '', '', '158cf7fa249c4e.jpg', '1996-01-12', 22, 0, '', 0, 'a', 'a', 'a'),
(489, 'Alperen', 'Demirhan', 'AlperenDemirhan', 'Alperen.1652', 'sagopa_alperen98@hotmail.com', '2017-03-20 15:07:11', '0000-00-00 00:00:00', 'uye', '', '', '', '1998-10-14', 21, 0, '', 0, 'a', 'a', 'a'),
(491, 'mustafa', 'Özdeniz', 'Mustafaozdeniz', 'Mustafa42', 'mus42_42@outlook.com', '2017-03-20 16:41:37', '0000-00-00 00:00:00', 'uye', '', '', '', '1997-01-03', 22, 0, '', 0, 'a', 'a', 'a'),
(492, 'Zeynep', 'Dinç', 'ZynoDnc', 'tekerlek55', 'hayaliezrag@gmail.com', '2017-03-20 16:41:42', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Samsun', '', '1985-05-19', 21, 0, '', 1, 'a', 'a', 'a'),
(493, 'ozal', 'veziroglu', 'veziroglu', '123456tolgabey', 'vezirogluozal@outlook.com', '2017-03-20 16:55:28', '0000-00-00 00:00:00', 'uye', '', '', '', '1976-06-05', 21, 0, '', 0, 'a', 'a', 'a'),
(494, 'Muhammed Raþit', 'Ataman', 'SrLesT', 'saman1234', 'kingofsrlest@gmail.com', '2017-03-20 17:11:13', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Ýstanbul', '', '1998-04-08', 21, 0, '', 0, 'a', 'a', 'a'),
(495, 'Ali', 'Acar', 'aliacar92', '816501', 'aliacar53@hotmail.com', '2017-03-20 17:37:17', '0000-00-00 00:00:00', 'uye', '', '', '', '1992-06-15', 21, 0, '', 0, 'a', 'a', 'a'),
(496, 'Aziz', 'Yaðcý', 'Theredline', 'sananeee12', 'jelberikaaziz@gmail.com', '2017-03-20 17:44:20', '0000-00-00 00:00:00', 'uye', '', '', '', '1998-12-26', 21, 0, '', 0, 'a', 'a', 'a'),
(497, 'bayram', 'ayas', 'NurluYol', 'sonycdQ80b', 'bayramayas@gmail.com', '2017-03-20 18:51:16', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Trabzon', '158cfb5b624fad.jpg', '1977-10-09', 22, 20, '46.154.214.120', 1, 'a', 'a', 'a'),
(498, 'MALÝK', 'BAYRAK', 'baymalik1453', 'mb163542', 'baymalik@gmail.com', '2017-03-20 19:50:04', '0000-00-00 00:00:00', 'uye', 'TÜRKÝYE', 'HATAY', '', '1983-10-25', 24, 22, '', 1, 'a', 'a', 'a'),
(499, 'Taner', 'Dogan', 'Taner36', 't36413641', 'tanerdgn36@gmail.com', '2017-03-20 21:08:46', '0000-00-00 00:00:00', 'uye', '', '', '', '1978-11-02', 22, 1, '', 1, 'a', 'a', 'a'),
(500, 'Osman', 'Bayar', 'Osman bayar1998', 'bayarbayar', 'osmanohlu@gmail.com', '2017-03-20 21:27:39', '0000-00-00 00:00:00', 'uye', '', '', '', '1998-09-23', 21, 0, '', 1, 'a', 'a', 'a'),
(501, 'Turgut', 'Gökmen', 'Cayklon', 'tekirdagli59', 'Cayklon@gmail.com', '2017-03-20 22:42:16', '0000-00-00 00:00:00', 'uye', '', '', '', '1969-11-13', 21, 0, '', 1, 'a', 'a', 'a'),
(503, 'Ýsmail', 'Güngör', 'Ýsmailgngr', 'Asd159357460', 'Gngr.gngr@hotmail.com', '2017-03-21 00:01:34', '0000-00-00 00:00:00', 'uye', '', '', '', '1993-06-15', 21, 0, '', 0, 'a', 'a', 'a'),
(504, 'Hasan Basri', 'CEVHER', 'Hasan6263', 'hbc9006263', 'Hasan6263@outlook.com', '2017-03-21 00:43:25', '0000-00-00 00:00:00', 'uye', '', '', '', '1962-05-06', 21, 0, '', 0, 'a', 'a', 'a'),
(505, 'Hüseyin', 'Çankaya', 'hcankaya', '001966', 'hcankaya77@hotmail.com', '2017-03-21 03:02:01', '0000-00-00 00:00:00', 'uye', '', '', '', '1966-02-24', 21, 0, '', 0, 'a', 'a', 'a'),
(506, 'Orhan', 'Karasu ', 'Orhan Karasu ', '29051453', 'ummetceokuyoruz@gmail.com', '2017-03-21 18:42:57', '0000-00-00 00:00:00', 'uye', '', '', '', '1992-04-05', 22, 1, '', 1, 'a', 'a', 'a'),
(507, 'kerem', 'karagöz', '#GwcmistenGelenAdam', 'server05m', 'kkaragoz85@gmail.com', '2017-03-21 23:21:54', '0000-00-00 00:00:00', 'uye', '', '', '', '1985-03-15', 24, 17, '', 1, 'a', 'a', 'a'),
(508, 'Þehitcan', 'Kutel', 'Þehitcan', 'gta1491966', 'sehitcan@gmail.com', '2017-03-22 00:51:22', '0000-00-00 00:00:00', 'uye', '', '', '', '1993-11-21', 22, 2, '212.253.113.239', 1, 'a', 'a', 'a'),
(509, 'Fatih', 'Adalan', 'fatihadalan', 'fatihadalan1984', 'fatih_adalan@hotmail.com', '2017-03-22 03:28:05', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Ýstanbul', '158d17fc5cba0b.jpg', '1984-03-22', 21, 0, '78.180.150.12', 1, 'a', 'a', 'a'),
(510, 'Murat ', 'Yalçýndað ', 'M.yalcindag1', 'tenzileyuruk0311-', 'murar66yalcindag66@gmail.com', '2017-03-22 05:28:33', '0000-00-00 00:00:00', 'uye', '', '', '', '1995-08-03', 21, 0, '', 0, 'a', 'a', 'a'),
(511, 'musa', 'elmas', 'þaþkýn', 'HAYýrlýsý', 'musa_elmas-1993@hotmail.com', '2017-03-22 07:24:50', '0000-00-00 00:00:00', 'uye', '', '', '', '1993-03-23', 21, 0, '', 0, 'a', 'a', 'a'),
(512, 'Ramazan', 'Akbal', 'Andromeda', 'Nsjshshshh', 'ramoisoo.50@gmail.com', '2017-03-22 21:05:47', '0000-00-00 00:00:00', 'uye', '', '', '', '2003-11-07', 22, 1, '176.54.64.28', 1, 'a', 'a', 'a'),
(513, 'yavuz ', 'kocbey', 'yvzkcby', 'assf1010', 'ersinersin.35@hotmail.com', '2017-03-23 12:04:04', '0000-00-00 00:00:00', 'uye', '', '', '158d701422be5f.jpg', '1988-08-08', 22, 3, '176.54.199.118', 0, 'a', 'a', 'a'),
(514, 'Þiir', 'Sokaðý', 'Þiir', '93472Subat21', 'nurannurdanca1@gmail.com', '2017-03-24 03:09:28', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Ankara', '158ea68c5d32be.png', '1985-11-16', 72, 868, '88.227.213.138', 1, 'a', 'a', 'a'),
(515, 'Ahmet', 'Oruç', 'crazzy1453', 'ertfre3443', 'crazzy1453@gmail.com', '2017-03-24 03:16:47', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Ýstanbul', '158d4206b7da79.jpg', '1987-09-04', 21, 0, '', 1, 'a', 'a', 'a'),
(516, 'Aliseydi', 'Yetgin', 'Aliseydi yetgin', 'osmanlý', 'yetginaliseydi@gmail.com', '2017-03-25 00:39:24', '0000-00-00 00:00:00', 'uye', '', '', '', '1968-05-05', 22, 0, '', 0, 'a', 'a', 'a'),
(517, 'Bilal ', 'karpuz ', 'Bilal Karpuz ', '5395026326', 'bllkrpuz@gmail.com', '2017-03-25 00:40:52', '0000-00-00 00:00:00', 'uye', '', '', '', '1969-04-02', 21, 0, '', 0, 'a', 'a', 'a'),
(518, 'Abdullah', 'Han', 'HAN', '15241041', 'abdurrahman.han.161@gmail.com', '2017-03-25 00:52:05', '0000-00-00 00:00:00', 'uye', '', '', '158d54ff59d2d6.jpg', '1997-11-29', 24, 15, '95.2.9.6', 1, 'a', 'a', 'a'),
(519, 'ARÝF', 'SEZGÝN', 'Osmanlýtorunlarý22', '69749799', 'arif_sezgin@mynet.com', '2017-03-25 01:20:11', '0000-00-00 00:00:00', 'uye', '', '', '', '1969-04-21', 21, 0, '', 1, 'a', 'a', 'a'),
(520, 'Ünal', 'Tiryaki', 'Ünal tiryaki', 'arsinliakrep1', 'akrepunal@gmail.com', '2017-03-25 01:30:19', '0000-00-00 00:00:00', 'uye', '', '', '', '1996-05-01', 21, 0, '', 0, 'a', 'a', 'a'),
(521, 'adem', 'demir', 'ademdemir', '182600', 'ademdemir0435@hotmail.com', '2017-03-25 02:05:39', '0000-00-00 00:00:00', 'uye', 'turkiye', 'izmir', '', '1987-05-05', 24, 23, '151.135.209.60', 0, 'a', 'a', 'a'),
(522, 'Ahmet ', 'Arý', 'mstfdnyl@outlook.com', '123mustafa123', 'mstfdnyl@outlook.com', '2017-03-25 02:19:26', '0000-00-00 00:00:00', 'uye', '', '', '', '2001-05-14', 21, 0, '', 0, 'a', 'a', 'a'),
(523, 'Hakan', 'Iþýk', 'Hakan ýþýk', '91169116', '35hrbdhakan@gmail.com', '2017-03-25 02:38:13', '0000-00-00 00:00:00', 'uye', '', '', '', '1969-06-04', 21, 0, '', 0, 'a', 'a', 'a'),
(524, 'minire ', 'ýþýk', 'ýþýk', 'minire87.', 'munire_isik@hotmail.com', '2017-03-25 03:07:20', '0000-00-00 00:00:00', 'uye', '', '', '', '1987-07-09', 21, 0, '', 0, 'a', 'a', 'a'),
(525, 'Aziz', 'Belli', 'Loplopab ', '5555480007', 'loplopab@hotmail.com', '2017-03-25 03:35:17', '0000-00-00 00:00:00', 'uye', '', '', '', '1983-01-01', 21, 0, '', 0, 'a', 'a', 'a'),
(526, 'AYHAN', 'Sari', 'Tuðralý Osmanlý', 'ayhan35...', 'ayhan.sari@hotmail.com', '2017-03-25 03:43:42', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Ýzmir', '', '1975-07-17', 21, 0, '', 0, 'a', 'a', 'a'),
(527, 'Abdulkadir', 'HARMANCI', 'Abdulkadir', 'pnkmn2208', 'abdulkadirpnkmn@gmail.com', '2017-03-25 04:29:52', '0000-00-00 00:00:00', 'uye', '', '', '', '1996-07-09', 22, 2, '46.154.15.10', 1, 'a', 'a', 'a'),
(528, 'Muhammed', 'Türegün', 'Muhammed türegün', 'konyakaratay', 'yarali_galp_42@hotmail.com', '2017-03-25 04:46:42', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Konya', '', '1994-02-06', 22, 2, '', 0, 'a', 'a', 'a'),
(529, 'Cengiz ', 'Kösem ', 'Alperen ', 'cengiz03.', 'alperen_000@hotmail.com', '2017-03-25 04:52:58', '0000-00-00 00:00:00', 'uye', '', '', '', '1984-03-29', 21, 0, '', 0, 'a', 'a', 'a'),
(530, 'NEVZAT ', 'POLAT', 'Nevzat Polat', 'mfurkann', 'nnpolat@gmail.com', '2017-03-25 05:07:22', '0000-00-00 00:00:00', 'uye', '', '', '', '1976-01-01', 21, 0, '', 1, 'a', 'a', 'a'),
(532, 'her', 'telden', 'hertelden', 'Nurdan14Temmuz', 'hertelden0646@gmail.com', '2017-03-25 12:18:39', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Ankara', '158d97eb42a585.jpg', '1980-01-18', 59, 870, '88.227.213.138', 1, 'a', 'a', 'a'),
(533, 'Abdurrahman', 'Babatürk', 'Ababaturk', 'bursa85', 'ababaturk@hotmail.com', '2017-03-25 12:45:50', '0000-00-00 00:00:00', 'uye', '', '', '', '0000-00-00', 21, 0, '', 0, 'a', 'a', 'a'),
(534, 'Özcan ', 'Baloðlu ', 'HAR', '24H35A27R', 'ozcanbaloglu@hotmail.com', '2017-03-25 14:13:56', '0000-00-00 00:00:00', 'uye', '', '', '', '1983-09-23', 21, 0, '', 0, 'a', 'a', 'a');
INSERT INTO `users` (`user_id`, `user_adi`, `user_soyadi`, `username`, `password`, `user_email`, `user_kayit_tarih`, `user_giris_tarih`, `user_type`, `user_ulke`, `user_sehir`, `user_profil_resim`, `user_dogum_tarih`, `user_takipci_sayi`, `user_takip_edilen_sayi`, `user_ip`, `user_aktivasyon`, `user_pay_gizle`, `user_takip_durum`, `user_mesaj_durum`) VALUES
(537, 'Adem', 'Er', 'Ademer', '19847991553', 'ademer27@gmail.com', '2017-03-25 17:00:10', '0000-00-00 00:00:00', 'uye', '', '', '', '1983-07-06', 21, 0, '', 1, 'a', 'a', 'a'),
(538, 'Muharrem', 'Kara', 'Malum 2534', 'Ahmet.123', 'muharremkara2534@gmail.com', '2017-03-25 17:04:30', '0000-00-00 00:00:00', 'uye', '', '', '', '1973-04-12', 21, 0, '', 0, 'a', 'a', 'a'),
(539, 'Arafat', 'Dutaðacý', 'Sefiralp', '811sefir', 'arafatdutagaci@hotmail.com', '2017-03-25 17:09:36', '0000-00-00 00:00:00', 'uye', '', '', '', '1981-03-18', 22, 0, '', 1, 'a', 'a', 'a'),
(540, 'Yasin', 'YILMAZ', 'Testimo', 'testimo1453', 'ysnylmz@outlook.com.tr', '2017-03-25 17:47:15', '0000-00-00 00:00:00', 'uye', '', '', '', '1990-01-23', 21, 0, '', 0, 'a', 'a', 'a'),
(541, 'Sinan', 'Peksoy', 'sinanpeksoy', 'autocad123', 'kokarca26@gmail.com', '2017-03-25 18:58:45', '0000-00-00 00:00:00', 'uye', '', '', '', '1997-09-18', 21, 0, '', 0, 'a', 'a', 'a'),
(542, 'Mehmet', 'Akbulut', 'II.Mehmet', 'Mehmet.69', '69.bayburtlumehmet.91@gmail.com', '2017-03-25 19:10:44', '0000-00-00 00:00:00', 'uye', '', '', '', '1991-11-21', 22, 0, '', 1, 'a', 'a', 'a'),
(543, 'Abidin', 'Baran', 'Abidin Baran ', 'alis4434', 'abidinbaran@hotmail.com', '2017-03-25 19:23:53', '0000-00-00 00:00:00', 'uye', '', '', '', '1973-02-03', 22, 6, '', 1, 'a', 'a', 'a'),
(544, 'LEYLA', 'SARI', 'LEYLASARI', '0001983', 'leylasari1730@mynet.com', '2017-03-25 19:42:37', '0000-00-00 00:00:00', 'uye', '', '', '158d6601bda7ff.jpg', '1983-12-15', 23, 12, '85.109.236.24', 0, 'a', 'a', 'a'),
(545, 'Ahmet', 'Akbýyýk', 'mikail', 'ahmet1988', 'mikail5142@gmail.com', '2017-03-25 20:22:19', '0000-00-00 00:00:00', 'uye', '', '', '', '1988-00-28', 22, 1, '', 1, 'a', 'a', 'a'),
(546, 'Ulaþ', 'Aydemir', 'Ulasaydemir314.ua', 'emal314', 'Ulasaydemir314.ua@gmail.com', '2017-03-25 20:31:23', '0000-00-00 00:00:00', 'uye', '', '', '', '1999-09-23', 21, 0, '', 1, 'a', 'a', 'a'),
(547, 'Ahmad', 'Ajjan', 'ahmadajjantr', 'ajjan30jan', 'ahmadajjan@gmail.com', '2017-03-25 21:12:27', '0000-00-00 00:00:00', 'uye', '', '', '', '1979-01-30', 22, 0, '', 1, 'a', 'a', 'a'),
(548, 'Hatice', 'Durak', 'Eþrefunnisa Hatice', 'sarayfatih', 'hdurak421@gmail.com', '2017-03-25 21:35:25', '0000-00-00 00:00:00', 'uye', '', '', '', '0000-00-00', 22, 0, '', 1, 'a', 'a', 'a'),
(549, 'mustafa', 'yýldýz', 'maçkalý', 'zeynebsare', 'ylmz1361@gmail.com', '2017-03-25 21:36:44', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Yalova', '', '1978-04-23', 21, 0, '94.55.39.115', 1, 'a', 'a', 'a'),
(550, 'Ahmet ', 'Öneþ', 'bafrali', '123456123456', 'hercai_caki08@hotmail.com', '2017-03-25 21:44:41', '0000-00-00 00:00:00', 'uye', '', '', '', '1990-01-01', 21, 0, '', 0, 'a', 'a', 'a'),
(551, 'Ömer', 'SÖZER', 'VATANSEVER', '1453130250571', 'fo_5461@hotmail.com', '2017-03-25 21:53:55', '0000-00-00 00:00:00', 'uye', '', '', '', '1994-03-07', 22, 1, '', 0, 'a', 'a', 'a'),
(552, 'Mubarrem', 'Baran', 'Hur adam', 'baran0531', 'Muharrem.baran.72@gmail.com', '2017-03-25 22:25:08', '0000-00-00 00:00:00', 'uye', '', '', '', '1994-03-13', 21, 0, '', 0, 'a', 'a', 'a'),
(553, 'Yyy', '7667', '35780', 'n', '679@wib', '2017-03-25 22:37:13', '0000-00-00 00:00:00', 'uye', '', '', '', '2014-04-04', 21, 0, '', 0, 'a', 'a', 'a'),
(554, 'Arif', 'Yýldýran', 'gsbaba2001', 'necip12345', 'gs_baba.arif@msn.com', '2017-03-25 22:43:21', '0000-00-00 00:00:00', 'uye', '', '', '', '2001-01-07', 21, 0, '', 1, 'a', 'a', 'a'),
(555, 'Özcan', 'Yücel', 'ByCrueL', 'ozcanbaba1532', 'ozcanyucel34@gmail.com', '2017-03-25 22:48:44', '0000-00-00 00:00:00', 'uye', '', '', '', '1985-09-06', 21, 0, '', 0, 'a', 'a', 'a'),
(556, 'battal', 'gazi', 'dadaþ', '10711453', 'battalmizrak25@gmail.com', '2017-03-25 23:00:23', '0000-00-00 00:00:00', 'uye', '', '', '', '1986-06-24', 21, 0, '', 1, 'a', 'a', 'a'),
(557, 'Yusuf', 'Dogan', 'Osmanl-evladi', 'menzil-sohbet', 'dj_yusufdogan@hotmail.com', '2017-03-26 00:23:19', '0000-00-00 00:00:00', 'uye', '', '', '', '1988-09-15', 22, 1, '', 1, 'a', 'a', 'a'),
(558, 'Hadis', 'Hadis', 'Hadis', 'hadis7315', 'hadishuseynov1997@gmail.com', '2017-03-26 00:34:42', '0000-00-00 00:00:00', 'uye', '', '', '', '0000-00-00', 21, 0, '', 0, 'a', 'a', 'a'),
(559, 'Sener', 'Avci', 'Alemdar', 'mert2011', 'sener.betul.avci@outlook.com', '2017-03-26 00:47:21', '0000-00-00 00:00:00', 'uye', '', '', '', '1983-05-25', 21, 0, '', 0, 'a', 'a', 'a'),
(560, 'Mesut', 'Ozkomec', 'Mesut', 'seydam2525', 'mesut.ozkomec79@gmail.com', '2017-03-26 01:01:06', '0000-00-00 00:00:00', 'uye', '', '', '', '1979-07-05', 22, 1, '5.176.31.205', 1, 'a', 'a', 'a'),
(561, 'Kerem', 'Gegek', 'krm_6790', 'gegek9876kerem', 'kgegek@hotmail.com', '2017-03-26 01:09:53', '0000-00-00 00:00:00', 'uye', '', '', '', '1991-05-05', 21, 0, '', 0, 'a', 'a', 'a'),
(562, 'Ýbrahim Halil', 'Tekin', 'ibootekin', '05427364127', 'ibootekin@outlook.com', '2017-03-26 01:24:22', '0000-00-00 00:00:00', 'uye', '', '', '', '1997-09-10', 22, 1, '', 0, 'a', 'a', 'a'),
(563, 'ilyas', 'çekin ', 'ilyasçekin ', 'ilyas1965', 'ilyascekin@hotmail.com', '2017-03-26 01:52:13', '0000-00-00 00:00:00', 'uye', '', '', '', '1965-01-01', 22, 18, '', 1, 'a', 'a', 'a'),
(564, 'Fedai', 'Demirci', 'Demirci46', '123456789fd', 'azrail_46_meda@hotmail.com', '2017-03-26 02:25:57', '0000-00-00 00:00:00', 'uye', '', '', '', '1994-04-01', 21, 0, '', 0, 'a', 'a', 'a'),
(565, 'Tevfik', 'AKGEYiK', 'Tefo', '6049324', 'tevfikakgeyik@gmail.com', '2017-03-26 02:54:47', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Ankara', '158d6e183cf400.jpg', '1979-07-07', 23, 19, '178.241.88.106', 1, 'a', 'a', 'a'),
(566, 'Duran ', 'Karabaþ ', 'DuranK', 'qwer1965qwerr', 'duran104@outlook.com', '2017-03-26 02:55:58', '0000-00-00 00:00:00', 'uye', '', '', '', '1998-08-26', 21, 0, '', 0, 'a', 'a', 'a'),
(567, 'Hatice ', 'Akgeyik', 'Hatice', 'haticetyeh', 'cazgircan@hotmail.com', '2017-03-26 03:04:58', '0000-00-00 00:00:00', 'uye', '', '', '158d6c09963dfd.jpg', '1981-10-24', 23, 1, '', 0, 'a', 'a', 'a'),
(568, 'Elif', 'Cakmk', 'ElifÇakmak', 'beratburakmetin', 'Elif--cakmak@hotmail.com', '2017-03-26 03:41:38', '0000-00-00 00:00:00', 'uye', '', '', '', '1996-06-10', 23, 7, '176.233.164.120', 0, 'a', 'a', 'a'),
(569, 'Vefa', 'Kuþçu', 'Vefa kuþçu', '12345678kere8', 'kuscuvefa@mail.com', '2017-03-26 04:44:15', '0000-00-00 00:00:00', 'uye', '', '', '158d6d8b147717.jpg', '1984-03-20', 22, 3, '', 0, 'a', 'a', 'a'),
(570, 'Ömer ', 'Ak', 'Ömer ak', 'MACUNCUomer55', 'aslan_kartal_1903@windowslive.com', '2017-03-26 05:16:01', '0000-00-00 00:00:00', 'uye', '', '', '', '2000-03-22', 21, 0, '', 0, 'a', 'a', 'a'),
(571, 'zekeriya', 'kose', 'zekeriya_kose', 'zeko2515', 'harg.sarg@gmail.com', '2017-03-26 06:12:59', '0000-00-00 00:00:00', 'uye', '', '', '', '1993-07-15', 20, 0, '', 0, 'a', 'a', 'a'),
(572, 'Ali', 'Arslan', 'aliarslan', '527233649', 'aliarslanxyz@gmail.com', '2017-03-26 06:56:28', '0000-00-00 00:00:00', 'uye', '', '', '', '1994-01-22', 21, 0, '', 1, 'a', 'a', 'a'),
(573, 'Cihat', 'Ülker', 'Cihat Ülker ', 'cihat ülker', 'cihatulker25@gmail.com', '2017-03-26 12:18:54', '0000-00-00 00:00:00', 'uye', '', '', '', '1991-09-23', 21, 0, '', 0, 'a', 'a', 'a'),
(574, 'Yasin', 'Þengül', '', '4297', 'yasinsengul86@gmail.com', '2017-03-26 12:31:21', '0000-00-00 00:00:00', 'uye', '', '', '', '1997-06-20', 21, 0, '', 0, 'a', 'a', 'a'),
(575, 'Ahmet Alper', 'Bilgehan', 'A.Alper', '05069338522', 'bahmetalper@gmail.com', '2017-03-26 14:00:24', '0000-00-00 00:00:00', 'uye', '', '', '', '1998-08-04', 22, 0, '', 0, 'a', 'a', 'a'),
(576, 'Metin', 'Tahirler', 'Metin Tahirler', 'metin432', 'metin_tahirler@hotmail.com', '2017-03-26 14:53:51', '0000-00-00 00:00:00', 'uye', '', '', '', '1978-06-06', 21, 0, '', 0, 'a', 'a', 'a'),
(577, 'Ali', 'Doðan', 'Kýþlalý', 'alidogan1983', 'aldgn02@gmail.com', '2017-03-26 14:58:57', '0000-00-00 00:00:00', 'uye', '', '', '', '1983-03-03', 21, 0, '', 1, 'a', 'a', 'a'),
(578, 'Mustafa', 'Bayrak', 'MustafaBayrak', '5535696199', 'mstfabayrak@gmail.com', '2017-03-26 15:02:09', '0000-00-00 00:00:00', 'uye', '', '', '158d7680be9e7e.jpg', '1998-05-13', 21, 1, '', 1, 'a', 'a', 'a'),
(579, 'Fatih', 'Güler', 'Fatih48537', '.adgjmptw_1', 'fatih48537@hotmail.com', '2017-03-26 15:24:28', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Adana', '158d76ec23ab7a.jpg', '1991-01-01', 21, 0, '46.221.216.245', 1, 'a', 'a', 'a'),
(580, 'Ahmet ', 'Baran', 'AhmetBaran', 'ahmet4125', 'ahmetsurname@hotmail.com', '2017-03-26 15:48:36', '0000-00-00 00:00:00', 'uye', '', '', '', '1999-05-21', 23, 3, '', 0, 'a', 'a', 'a'),
(581, 'Hüseyin Mansur', 'Güieç', 'Ebuhureyre', 'mg1217', 'mansurgulec@hotmail.com', '2017-03-26 16:05:36', '0000-00-00 00:00:00', 'uye', 'TÜRKÝYE', 'Eskiþehir', '158d8a54724cc3.jpg', '1972-09-23', 25, 50, '5.177.140.88', 1, 'a', 'a', 'a'),
(582, 'Kadircan ', 'Kendirci ', 'Deepwebghost', 'DEEPWEBGHOST', 'kadircankendirci@gmail.com', '2017-03-26 16:43:44', '0000-00-00 00:00:00', 'uye', '', '', '', '1998-02-25', 21, 0, '', 1, 'a', 'a', 'a'),
(583, 'Amina', 'Gümüþ ', 'Aggumus', 'aminagumus19', 'aminagumus0@gmail.com', '2017-03-26 16:55:07', '0000-00-00 00:00:00', 'uye', '', '', '', '1992-11-19', 21, 0, '', 1, 'a', 'a', 'a'),
(584, 'Durdu ', 'DAÞCI ', 'Dasci46', '46dasci46', 'dasci51@gmail.com', '2017-03-26 17:17:38', '0000-00-00 00:00:00', 'uye', '', '', '', '1994-03-15', 22, 5, '', 1, 'a', 'a', 'a'),
(585, 'sefer', 'sabirdan', 'sefer', 'nisafatima', 'sefer.sabirdan@gmail.com', '2017-03-26 17:23:35', '0000-00-00 00:00:00', 'uye', '', '', '', '1981-05-08', 21, 1, '', 0, 'a', 'a', 'a'),
(586, 'Mutlu', 'Koc', 'Efsane', '05465402498', 'sekilse_sekil@hotmail.com', '2017-03-26 17:34:24', '0000-00-00 00:00:00', 'uye', '', '', '', '1986-06-01', 1, 10, '151.135.129.6', 0, 'a', 'a', 'a'),
(587, 'Ahmet', 'Akay', 'Ahmetakay', 'rambo35', 'tero3456@hotmail.com', '2017-03-26 17:39:43', '0000-00-00 00:00:00', 'uye', '', '', '', '2002-06-06', 1, 0, '', 0, 'a', 'a', 'a'),
(588, 'Ahmet', 'Odaci', 'osmanlý', 'a13579z', 'odaci76@hotmail.com', '2017-03-26 17:45:55', '0000-00-00 00:00:00', 'uye', '', '', '', '1990-01-01', 1, 0, '', 1, 'a', 'a', 'a'),
(589, 'Yusuf furkan', 'Seyhan', 'yusuffurkanq', 'Furkan21', 'yusufq1920@gmail.com', '2017-03-26 17:50:30', '0000-00-00 00:00:00', 'uye', '', '', '', '1995-05-24', 1, 0, '176.54.66.6', 1, 'a', 'a', 'a'),
(590, 'Ýmam', 'Ok', 'Ýmamok', 'urfa6363', 'iok6363@hotmail.com', '2017-03-26 19:31:06', '0000-00-00 00:00:00', 'uye', '', '', '', '1998-02-20', 1, 0, '', 0, 'a', 'a', 'a'),
(591, 'osmanlý', 'diriliþ', 'osmanlýdiriliþ', '12345trewq', 'osmanlidirilisvakti@gmail.com', '2017-03-26 19:35:02', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Ankara', '158d7a7e0802d8.jpg', '1979-02-18', 57, 871, '37.155.223.205', 1, 'a', 'a', 'a'),
(592, 'Mehmet ', 'ablak ', 'gölgeharamisi', 'saadet', 'mehmetablak5@gmail.com', '2017-03-26 20:39:17', '0000-00-00 00:00:00', 'uye', '', '', '', '1998-09-03', 1, 0, '', 0, 'a', 'a', 'a'),
(593, 'Komedi', 'Hanem', 'Komedihane', '123654123654', 'mucahit.dogru@hotmail.com', '2017-03-26 20:43:06', '0000-00-00 00:00:00', 'uye', 'Turkiye', 'Tekirdag', '158d7baf6165bb.png', '1996-10-12', 22, 2, '5.176.242.124', 0, 'a', 'a', 'a'),
(595, 'gürbüz ', 'aksu', 'gürbüz ', 'gurbuz', 'gurbuzaksu@gmail.com', '2017-03-26 21:21:59', '0000-00-00 00:00:00', 'uye', '', '', '158d7c460b3da0.jpg', '1983-02-18', 22, 0, '', 1, 'a', 'a', 'a'),
(596, 'Serkan', 'Tomak', 'serkan.tomak72', 'emekli28', 'serkantomak72serkan@hotmail.com', '2017-03-26 21:28:26', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Tekirdað/Çorlu', '158d7c23b2acf5.jpg', '1972-10-29', 22, 5, '', 0, 'a', 'a', 'a'),
(597, 'abdulhalýk', 'demirdað', 'Haluk4782', 'estelli47', 'demirdagcan21@gmail.com', '2017-03-26 22:17:12', '0000-00-00 00:00:00', 'uye', '', '', '', '1966-03-06', 1, 0, '', 0, 'a', 'a', 'a'),
(598, 'yunus', 'tancan', 'TC Yunus', '27012701', 'tancanyunus15@gmail.com', '2017-03-26 22:45:09', '0000-00-00 00:00:00', 'uye', '', '', '', '1985-06-16', 1, 0, '', 1, 'a', 'a', 'a'),
(599, 'AYKUT', 'AYHAN', 'AYKUTAYHAN', 'furkan01', 'aykutmtsk@gmail.com', '2017-03-26 23:12:04', '0000-00-00 00:00:00', 'uye', 'TR', 'Uþak', '', '1980-04-26', 1, 2, '', 1, 'a', 'a', 'a'),
(600, 'samet', 'kaplan', 'hudut_kartalý', 'samet8119', 'tgez.19@gmail.com', '2017-03-26 23:23:12', '0000-00-00 00:00:00', 'uye', 'turkiye', 'istanbul', '158d7de56d2fa1.jpg', '1996-02-23', 22, 2, '46.154.144.99', 1, 'a', 'a', 'a'),
(601, 'Osman', 'Urgun', 'Urgun', 'Denetmen7', 'urgun1979@mynet.com', '2017-03-26 23:33:48', '0000-00-00 00:00:00', 'uye', '', '', '', '1979-01-01', 22, 1, '', 0, 'a', 'a', 'a'),
(602, 'Recep ', 'Býçak', 'Recobaba', '05428288728', 'recepbicak07@gmail.com', '2017-03-27 01:41:45', '0000-00-00 00:00:00', 'uye', '', '', '', '1993-01-20', 22, 0, '178.243.12.179', 0, 'a', 'a', 'a'),
(603, 'Ayça', 'Er', 'ayçaer', '"7894561230,', 'bizimkigeldi@gmail.com', '2017-03-27 02:18:34', '0000-00-00 00:00:00', 'uye', '', '', '158da152d17f35.jpg', '1993-09-02', 53, 850, '178.247.84.134', 1, 'a', 'a', 'a'),
(604, 'ayþe', 'Türk', 'Oriflame', 'sadeceben', 'ayseturk46@hotmail.com', '2017-03-28 15:41:11', '0000-00-00 00:00:00', 'uye', '', '', '', '1985-11-04', 22, 0, '', 0, 'a', 'a', 'a'),
(605, 'alper', 'bali', 'alperbali', 'alper14531453', 'alptrans@gmail.com', '2017-03-28 19:15:09', '0000-00-00 00:00:00', 'uye', '', '', '158da47bac7964.jpg', '2017-01-01', 23, 2, '212.156.206.95', 1, 'a', 'a', 'a'),
(606, 'Mahmud', 'Özbaðdat', 'mahmudoz', 'Hasan1965', 'mahmud.ozbagdat.05@gmail.com', '2017-03-28 23:35:50', '0000-00-00 00:00:00', 'uye', '', '', '', '1999-05-09', 21, 0, '', 0, 'a', 'a', 'a'),
(609, 'Ferhat', 'Can', 'Ferhatcan', 'f1q8w6x3', 'ff4868ff@gmail.com', '2017-03-30 23:11:50', '0000-00-00 00:00:00', 'uye', '', '', '', '1980-02-01', 22, 0, '', 0, 'a', 'a', 'a'),
(610, 'Dursun', 'Memiþ', 'discovererdursun', 'turan.1', 'discovererdursun@gmail.com', '2017-03-30 23:54:12', '0000-00-00 00:00:00', 'uye', 'Büyük Türkiye', 'Ýzmir', '158dd2af32955c.jpg', '1987-03-18', 22, 15, '176.220.160.202', 1, 'a', 'a', 'a'),
(611, 'Sait ', 'Yilmaz', 'Doganayby', '826600', 'doganayby@gmail.com', '2017-04-01 01:45:02', '0000-00-00 00:00:00', 'uye', '', '', '', '1969-06-05', 22, 20, '46.221.135.84', 1, 'a', 'a', 'a'),
(612, 'BOZDOÐANLI', 'ÝMAM', 'BOZDOÐANLI ÝMAM', '25151740semerkand', 'sert_adam_610@hotmail.com', '2017-04-01 01:45:10', '0000-00-00 00:00:00', 'uye', 'TÜRKÝYE', 'AYDIN', '', '1993-12-27', 21, 0, '92.45.79.203', 0, 'a', 'a', 'a'),
(613, 'Abdullah', 'Karabulut', 'Karabulut', '2121028916', 'abdullahkarabulut195@gmai.com', '2017-04-01 01:50:25', '0000-00-00 00:00:00', 'uye', '', '', '', '0000-00-00', 22, 0, '', 1, 'a', 'a', 'a'),
(614, 'Mehmet', 'Taþkýn', 'Mehmet_1729', 'mehmet1729', 'mehmet_1729@hotmail.com', '2017-04-01 01:55:05', '0000-00-00 00:00:00', 'uye', '', '', '', '1990-03-12', 22, 2, '', 0, 'a', 'a', 'a'),
(615, 'Serkan ', 'Ýmat ', 'Hendekli', '1981srkn', 'srkn-gly-ygmr@hotmail.com', '2017-04-01 02:00:09', '0000-00-00 00:00:00', 'uye', '', '', '', '1981-11-20', 21, 0, '', 0, 'a', 'a', 'a'),
(616, 'Turan', 'Karabulut', 'Ertuuýýýý', '123456', 'drn.cm042@gmailcom', '2017-04-01 02:04:49', '0000-00-00 00:00:00', 'uye', '', '', '', '0000-00-00', 22, 1, '', 0, 'a', 'a', 'a'),
(617, 'Mehmet', 'Çohadar', 'Karýncakararýnca', 'hem07189', 'mehmetcohadar79@gmail.com', '2017-04-01 02:13:36', '0000-00-00 00:00:00', 'uye', '', '', '', '1979-06-01', 22, 2, '31.206.206.20', 1, 'a', 'a', 'a'),
(618, 'Songül', 'Özcan', 'Songul07', 'sonnur12345', 'songulozcan07@hotmail.com', '2017-04-01 02:23:28', '0000-00-00 00:00:00', 'uye', '', '', '', '1983-12-20', 21, 0, '', 0, 'a', 'a', 'a'),
(619, 'Huseyin', 'Onal', 'microgazi', 'm123456789', '4m4bilisim@gmail.com', '2017-04-01 02:35:29', '0000-00-00 00:00:00', 'uye', '', '', '', '1975-01-01', 21, 0, '46.197.63.192', 1, 'a', 'a', 'a'),
(620, 'Esra ', 'taþ', 'Esra Taþ', 'esra0224', 'tesra1633@gmail.com', '2017-04-01 02:45:40', '0000-00-00 00:00:00', 'uye', '', '', '', '1994-02-24', 21, 1, '5.176.164.85', 1, 'a', 'a', 'a'),
(621, 'ersin', 'kurhan', 'emir', '131319761313', 'ersinkurhan.13@hotmail.com', '2017-04-01 02:49:58', '0000-00-00 00:00:00', 'uye', '', '', '', '1976-09-02', 20, 0, '', 0, 'a', 'a', 'a'),
(622, 'ÝBRAHIM', 'KAYA', 'IBRAHIM Kaya ', '05061227647', 'ibo_kaya123@hotmail.com', '2017-04-01 03:03:36', '0000-00-00 00:00:00', 'uye', '', '', '', '1998-07-03', 22, 2, '', 0, 'a', 'a', 'a'),
(623, 'Ahmet murat', 'Çýrak', 'Ahmet murat', '7941406', 'cirakmurat19@gmail.com', '2017-04-01 03:14:35', '0000-00-00 00:00:00', 'uye', '', '', '', '1987-07-20', 20, 0, '', 1, 'a', 'a', 'a'),
(624, 'Mustafa Kamil', 'Coþkun', 'Mustafaofficial', '35rec12', 'hayaldi_bitti042@hotmail.com', '2017-04-01 03:18:09', '0000-00-00 00:00:00', 'uye', '', '', '', '2000-01-01', 21, 0, '88.241.38.112', 0, 'a', 'a', 'a'),
(626, 'Nurcan', 'Karakuþ', 'Nur Can', '1453fsm', 'karakusnurcan@gmail.com', '2017-04-01 03:33:15', '0000-00-00 00:00:00', 'uye', '', '', '', '1981-05-22', 20, 0, '46.104.39.247', 1, 'a', 'a', 'a'),
(627, 'Âþk-î', 'Vuslât', 'Edep.ile.aþk', '104014531071', 'kaanaktan78@gmail.com', '2017-04-01 03:34:29', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Ankara', '158deb3239ec7a.jpg', '1997-04-10', 22, 9, '81.213.47.234', 1, 'a', 'a', 'a'),
(629, 'Tuðba', 'Caner Oluk', 'Tugba', '30041994', 'tugbacaneroluk@gmail.com', '2017-04-01 04:07:53', '0000-00-00 00:00:00', 'uye', '', '', '', '1981-04-23', 20, 0, '', 0, 'a', 'a', 'a'),
(630, 'Esat', 'Karadeniz ', 'eskar5', '290282', 'eskar5@hotmail.com', '2017-04-01 04:14:04', '0000-00-00 00:00:00', 'uye', '', '', '', '1983-08-25', 20, 0, '5.176.221.62', 0, 'b', 'a', 'a'),
(631, 'Ahmet', 'Erol', 'aerols', 'ahmeterol', 'erolahmet47@gmail.com', '2017-04-01 04:24:46', '0000-00-00 00:00:00', 'uye', '', '', '', '1996-06-08', 20, 7, '', 0, 'a', 'a', 'a'),
(632, 'Mücahit', 'Gürdal', 'Gürdal', '35895814', 'freechild_32@hotmail.com', '2017-04-01 04:24:54', '0000-00-00 00:00:00', 'uye', '', '', '', '1987-11-01', 20, 0, '37.155.56.2', 1, 'a', 'a', 'a'),
(633, 'Abdurrahman', 'Cevher', 'cevhera', '51109715234', 'abdurrahmancevher@hotmail.com', '2017-04-01 04:35:25', '0000-00-00 00:00:00', 'uye', '', '', '', '1991-11-24', 20, 0, '', 0, 'a', 'a', 'a'),
(634, 'Metin', 'Akçokrak', 'nopainnogain', '05324949511', 'metinakcokrak@gmail.com', '2017-04-01 04:44:58', '0000-00-00 00:00:00', 'uye', '', '', '', '1963-07-12', 21, 0, '', 1, 'a', 'a', 'a'),
(635, 'Mehmet kadri', 'Tayfan', 'Tayfan033', '123456789_', 'Melo_gs_73@hotmail.com', '2017-04-01 04:58:01', '0000-00-00 00:00:00', 'uye', '', '', '', '1999-03-28', 21, 0, '', 0, 'a', 'a', 'a'),
(636, 'Engin', 'Bayrak', 'Enjean ', 'djakman147', 'kopix45@gmail.com', '2017-04-01 05:01:17', '0000-00-00 00:00:00', 'uye', '', '', '', '1987-01-05', 20, 0, '', 0, 'a', 'a', 'a'),
(637, 'Metin', 'Güngör ', 'elif2015', 'yigit2009', 'metingungor_71@hotmail.com', '2017-04-01 06:06:41', '0000-00-00 00:00:00', 'uye', '', '', '', '1971-07-29', 21, 0, '', 0, 'a', 'a', 'a'),
(638, 'Ömer', 'Özdemir', 'omerozdemir', '341340133', 'ecdajans@gmail.com', '2017-04-01 06:49:04', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Mersin', '158deddf733af6.jpg', '1987-08-01', 21, 19, '46.221.188.94', 1, 'a', 'a', 'a'),
(639, 'Mahmut ', 'Çakýr ', 'Çakýr mahmut ', '12345678986', 'mahmut_145342@hotmail.com', '2017-04-01 07:24:24', '0000-00-00 00:00:00', 'uye', '', '', '', '1986-04-22', 21, 0, '', 0, 'a', 'a', 'a'),
(640, 'Murat ', 'Biner', 'Onur', '587132', 'mrt5871@hotmail.com', '2017-04-01 08:12:38', '0000-00-00 00:00:00', 'uye', '', '', '', '1971-06-15', 21, 0, '78.182.102.86', 1, 'a', 'a', 'a'),
(641, 'Mustafa', 'Yakuz', 'Mustafayakuz', 'himmetgavs', 'mehesfettah@gmail.com', '2017-04-01 08:26:49', '0000-00-00 00:00:00', 'uye', '', '', '', '1991-08-06', 21, 0, '', 0, 'a', 'a', 'a'),
(642, 'Yavuz ', 'Can', 'YavuzcanRte', '456_yavuz', 'yaaavuz.18.yavuz@hotmail.com', '2017-04-01 13:24:22', '0000-00-00 00:00:00', 'uye', '', '', '', '1996-10-22', 21, 0, '', 0, 'a', 'a', 'a'),
(643, 'mesut', 'eker', 'mesut2337', '965me2337', 'mesuteker2009@hotmail.com', '2017-04-01 13:29:36', '0000-00-00 00:00:00', 'uye', '', '', '', '1970-09-23', 21, 0, '5.176.204.46', 0, 'a', 'a', 'a'),
(644, 'Erol', 'Urgun', 'Erol', '1968', 'e.urgun42@hotmail.com', '2017-04-01 13:47:59', '0000-00-00 00:00:00', 'uye', '', '', '', '1970-10-17', 20, 0, '', 0, 'a', 'a', 'a'),
(645, 'Ali ekber', 'Þeren', 'Aliekbersrnn', 'ali123', 'serenaliekber@gmail.com', '2017-04-01 13:56:50', '0000-00-00 00:00:00', 'uye', '', '', '', '0000-00-00', 20, 0, '', 0, 'a', 'a', 'a'),
(646, 'Ebru', 'Arslaner', 'Ebru22', '.bismillah.', 'ebruarslaner77@gmail.com', '2017-04-01 14:09:11', '0000-00-00 00:00:00', 'uye', '', '', '', '1997-07-22', 20, 0, '', 0, 'a', 'a', 'a'),
(647, 'Eyüp', 'Yurttutan', 'eyup.yrtutn', 'zxcvbnm12', 'yurttutaneyup@gmail.com', '2017-04-01 14:18:22', '0000-00-00 00:00:00', 'uye', '', '', '', '1998-08-08', 20, 0, '', 0, 'a', 'a', 'a'),
(648, 'Halil', 'Kont', 'Hlirhmknttrk1', 'halil0987654', 'hlirhmknttrk1@gmail.com', '2017-04-01 14:20:19', '0000-00-00 00:00:00', 'uye', '', '', '', '2000-02-14', 20, 0, '', 0, 'a', 'a', 'a'),
(649, 'Fenerbahçe', '1907', 'Feneronline', '129919221923', 'baysan258@gmail.com', '2017-04-01 14:30:26', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Kadiköy', '158df4af17a01c.jpg', '1997-07-11', 22, 43, '88.224.231.177', 1, 'a', 'a', 'a'),
(651, 'Mehmet', 'Dereli', 'cicekappas1992', 'haha1992', 'bjk_12341@hotmail.com', '2017-04-01 15:01:16', '0000-00-00 00:00:00', 'uye', '', '', '', '1997-01-29', 20, 0, '', 0, 'a', 'a', 'a'),
(652, 'Mertcan', 'Cakirhan ', 'Mrt34', 'mrt34', 'songulozer0606@hotmail.com', '2017-04-01 15:21:56', '0000-00-00 00:00:00', 'uye', '', '', '', '1980-05-21', 20, 0, '', 0, 'a', 'a', 'a'),
(653, 'zehra', 'zengin', 'zehra7634', 'yeniþifremzehra', 'zehra_zengin76@hotmail.com', '2017-04-01 15:22:28', '0000-00-00 00:00:00', 'uye', '', '', '', '2005-02-25', 20, 0, '', 0, 'a', 'a', 'a'),
(654, 'ömer faruk', 'torba', 'ömrfrk', '1234567890', 'ofttorba@gmail.com', '2017-04-01 16:01:29', '0000-00-00 00:00:00', 'uye', 'TÜRKÝYE', 'Bursa', '', '1997-11-15', 22, 8, '', 1, 'a', 'a', 'a'),
(655, 'Tardis', 'Okan', 'Tardisokan', 'okanbaba23451', 'okanyamula2344@gmail.com', '2017-04-01 16:11:38', '0000-00-00 00:00:00', 'uye', '', '', '', '1999-06-09', 20, 0, '', 0, 'a', 'a', 'a'),
(656, 'bir', 'katre', 'birkatre', 'Nurdan14Temmuz', 'birkatresaadet@gmail.com', '2017-04-01 16:25:17', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Ankara', '158e28bf3f0e83.png', '1986-02-17', 56, 872, '37.155.223.205', 1, 'a', 'a', 'a'),
(657, 'Burak', 'Kurt', 'Burakkurt', 'burak1234', 'kurtburak261@gmail.com', '2017-04-01 16:27:29', '0000-00-00 00:00:00', 'uye', '', '', '', '1994-05-11', 20, 0, '', 0, 'a', 'a', 'a'),
(658, 'Halil', 'Karadað', 'HalilKrdTR', '+1456258369', 'halilkaradagtr@gmail.com', '2017-04-01 16:35:49', '0000-00-00 00:00:00', 'uye', '', '', '', '1997-10-10', 20, 0, '46.154.64.234', 1, 'a', 'a', 'a'),
(659, 'Huriye ', 'Doðan', 'Allah birdir', 'genetik', 'hiriyedogan1962@hotmail.com', '2017-04-01 16:48:16', '0000-00-00 00:00:00', 'uye', '', '', '', '1962-01-04', 20, 0, '', 0, 'a', 'a', 'a'),
(660, 'Bahadýr', 'Öztürk ', 'Bahadýr Öztürk', 'manisa31', 'baholegendary@gmail.com', '2017-04-01 16:59:13', '0000-00-00 00:00:00', 'uye', '', '', '', '2000-09-18', 21, 0, '31.177.243.11', 0, 'a', 'a', 'a'),
(661, 'Hüseyin', 'kýlýç', 'Hüseyin.kýlýç', 'sananee', 'ecan_617_42@hotmail.com', '2017-04-01 17:21:36', '0000-00-00 00:00:00', 'uye', '', '', '', '1999-03-15', 21, 1, '', 0, 'a', 'a', 'a'),
(662, 'ilker', 'aslan', 'ilker', 'Aslan.2014', 'dj_burak50@hotmail.com', '2017-04-01 17:59:17', '0000-00-00 00:00:00', 'uye', '', '', '', '1983-05-28', 20, 0, '', 0, 'a', 'a', 'a'),
(663, 'ibrahim ', 'Karademir', 'ibrahimkarademir', 'kara.demir123', 'kara.demir@hotmail.com', '2017-04-01 18:22:29', '0000-00-00 00:00:00', 'uye', '', '', '', '1992-10-02', 21, 0, '', 0, 'a', 'a', 'a'),
(664, 'meryem', 'mete', 'Meryem. mete', 'damla123', 'meryemmete1626@gmail.com', '2017-04-01 18:28:31', '0000-00-00 00:00:00', 'uye', '', '', '', '0000-00-07', 20, 0, '', 0, 'a', 'a', 'a'),
(665, 'Ahmet', 'Bozkurt', 'Nothingman.ahmet', 'aslan11', 'kdr_ikn_amt@hotmail.com', '2017-04-01 18:48:48', '0000-00-00 00:00:00', 'uye', '', '', '', '2003-12-18', 20, 0, '', 0, 'a', 'a', 'a'),
(666, 'suzan', 'çakal', 'suzan', 'askvesen', 'suzan cakal4343@outlook.com', '2017-04-01 18:50:42', '0000-00-00 00:00:00', 'uye', '', '', '', '2006-01-17', 20, 0, '', 0, 'a', 'a', 'a'),
(667, 'Volkan ', 'Akkaya ', 'Volkan akkaya ', '5953610', 'volkan_esmanur@hotmail.com', '2017-04-01 18:58:06', '0000-00-00 00:00:00', 'uye', '', '', '', '1999-03-06', 21, 0, '', 0, 'a', 'a', 'a'),
(668, 'Muhammed', 'Elmacýoðlu', 'Kader Kuþaðý', '1050112398+ARD+mel', 'alemdarsultanhazretleri84@gmail.com', '2017-04-01 19:05:34', '0000-00-00 00:00:00', 'uye', '', '', '', '1978-01-01', 20, 0, '', 0, 'a', 'a', 'a'),
(669, 'Namýk', 'Yýlmaz', 'Namýk5252', '14456799364', 'siktir.git.2012@hotmail.com', '2017-04-01 20:06:19', '0000-00-00 00:00:00', 'uye', '', '', '', '1997-05-18', 20, 0, '', 0, 'a', 'a', 'a'),
(670, 'Mustafa', ' AYDIN', ' maydin491', '28grs1967', 'maydin491@gmail.com', '2017-04-01 22:29:04', '0000-00-00 00:00:00', 'uye', '', '', '', '1992-08-04', 20, 0, '5.47.200.45', 1, 'a', 'a', 'a'),
(671, 'Abdullah', 'YILMAZ', 'iCompact', 'apo60apo.', 'abdul_bar_2@hotmail.com', '2017-04-01 22:36:30', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Tokat', '158dfbbffe31e7.jpg', '2001-03-26', 21, 0, '5.46.87.100', 0, 'a', 'a', 'a'),
(672, 'taner', 'bagatarhan', 'tanerbagatarhan', 'ebamervan', 'taner_bagatarhan@hotmail.com', '2017-04-01 22:48:16', '0000-00-00 00:00:00', 'uye', '', '', '', '1985-02-18', 21, 0, '', 1, 'a', 'a', 'a'),
(675, 'Aasdasd', 'Aasdasd', 'asdasd', 'asdasd', 'asdasd@hotmail.com', '2017-04-01 23:48:22', '0000-00-00 00:00:00', 'uye', '', '', '', '1999-12-19', 21, 0, '', 0, 'a', 'a', 'a'),
(676, 'Abdullah', 'Zencirci', 'ZNCRC2023', 'Mukadderat527.', 'zencirci576@gmail.com', '2017-04-02 00:14:17', '0000-00-00 00:00:00', 'uye', '', '', '', '1980-08-07', 20, 0, '78.165.121.49', 1, 'a', 'a', 'a'),
(677, 'Muhammet Can', 'Çiftçi', 'M.can0', 'kendim548', 'ustayi55@gmail.com', '2017-04-02 00:20:19', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Tekirdað', '158dfd40abd7ad.png', '2000-09-14', 21, 0, '', 1, 'a', 'a', 'a'),
(679, 'Ýbrahim Ethem', ' Özbek', 'ibrahim 6623', '66ieö66', 'ozbekibrahimethem@gmail.com.tr', '2017-04-02 01:36:58', '0000-00-00 00:00:00', 'uye', '', '', '', '1998-04-27', 20, 0, '', 0, 'a', 'a', 'a'),
(680, 'erol', 'didikoglu', 'merhabaerol', '02322431718-', 'didikogluerol@gmail.com', '2017-04-02 01:39:01', '0000-00-00 00:00:00', 'uye', 'türkiye', 'izmir', '', '1974-07-06', 21, 0, '176.220.176.21', 1, 'a', 'a', 'a'),
(681, 'Sümeyye', 'Barut', 'Latahzen', 'beyzanur', 'sumeyyedemirel@mynet.com', '2017-04-02 01:52:49', '0000-00-00 00:00:00', 'uye', '', '', '', '1975-01-01', 21, 0, '', 0, 'a', 'a', 'a'),
(682, 'Bayram', 'Çetin', 'Bayram ', 'bayram1997', 'bayram_1997@hotmail', '2017-04-02 02:22:50', '0000-00-00 00:00:00', 'uye', '', '', '', '1997-06-00', 20, 5, '88.241.38.73', 0, 'a', 'a', 'a'),
(683, 'Ekrem', 'yýldýz', 'esy_58', 'said.123456', 'e.said_yildiz_58@hotmail.com', '2017-04-02 02:23:13', '0000-00-00 00:00:00', 'uye', '', '', '', '2000-11-29', 20, 0, '', 0, 'a', 'a', 'a'),
(684, 'Yusuf', 'KARA', 'KARA', 'karayusuf', 'yusufkara67@outlook.com', '2017-04-02 02:29:01', '0000-00-00 00:00:00', 'uye', '', '', '', '1984-04-15', 20, 0, '', 0, 'a', 'a', 'a'),
(685, 'Abdusamed', 'Duran', 'Hafýz4242', '05058805411bs', 'photographyadrn@gamil.com', '2017-04-02 02:32:12', '0000-00-00 00:00:00', 'uye', '', '', '', '1999-01-01', 21, 1, '', 0, 'a', 'a', 'a'),
(686, 'Denem', 'E', 'Deneme', 'ahmetyusa23', 'deneme23232323@gmail.com', '2017-04-02 02:36:44', '0000-00-00 00:00:00', 'uye', '', '', '', '1996-05-05', 20, 0, '', 0, 'a', 'a', 'a'),
(688, 'ResuL', 'yýldýrým', 'evsizbarksýzçocuksuz', 'dersimsen', 'yildirimaricilik21@gmail.com', '2017-04-02 02:42:52', '0000-00-00 00:00:00', 'uye', '', '', '', '1995-02-10', 20, 0, '', 0, 'a', 'a', 'a'),
(689, 'Elif', 'Gertel', 'elifgertel', 'seviyorumgel', 'gertelelif3@gmail.com', '2017-04-02 02:45:29', '0000-00-00 00:00:00', 'uye', '', '', '', '1996-03-21', 22, 1, '24.133.51.241', 1, 'a', 'a', 'a'),
(690, 'Serkan', 'Zivlak', 'Serkanzivlak', 'serkan1999serkan**', 'serkanzivlak@gmail.com', '2017-04-02 02:59:24', '0000-00-00 00:00:00', 'uye', '', '', '', '1999-08-04', 22, 3, '46.104.40.209', 0, 'a', 'a', 'a'),
(691, 'Kadir', 'Koramaz', 'Ka dir', 'sigaraiçme', 'kadir_koramaz@hotmail.com', '2017-04-02 03:02:19', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Kayseri', '158dff9e6e6b6d.jpg', '1996-02-03', 22, 1, '', 0, 'a', 'a', 'a'),
(692, 'Türk kürt', 'Kardestir', 'Urfalý', '05321749787', 'allahvargamyok@gmail.com', '2017-04-02 03:09:13', '0000-00-00 00:00:00', 'uye', '', '', '', '1995-10-29', 20, 0, '', 0, 'a', 'a', 'a'),
(695, 'Sudenaz', 'Horzumlu', 'SudenazTRhorzumlu', 'sdnz123hrzmlu123', 'sudenazhorzumlu@gmail.com', '2017-04-02 03:41:01', '0000-00-00 00:00:00', 'uye', '', '', '', '2004-10-06', 21, 0, '', 0, 'a', 'a', 'a'),
(696, 'Arda', 'Sarýkamýþ', 'Sarýkamýþ.##', '05375051647', 'mardinlim.47.@hotmail.com', '2017-04-02 03:54:24', '0000-00-00 00:00:00', 'uye', '', '', '', '1999-08-13', 21, 3, '176.238.6.183', 0, 'a', 'a', 'a'),
(697, 'Azime', 'özen', 'ahmetaAzime', '2142', 'Azimeozen', '2017-04-02 04:10:55', '0000-00-00 00:00:00', 'uye', '', '', '', '1985-03-01', 21, 0, '', 0, 'a', 'a', 'a'),
(698, 'Polat ', 'Þükür ', 'Poladabbas361@gmail.com ', '9372492', 'poladabbas361@gmail.com', '2017-04-02 04:11:16', '0000-00-00 00:00:00', 'uye', '', '', '', '1994-08-23', 21, 0, '176.238.11.88', 1, 'a', 'a', 'a'),
(699, 'Fatih', 'Mirza', 'FatihMÝRZA', 'yandex123', 'fatihmirza18@hotmail.com', '2017-04-02 04:22:01', '0000-00-00 00:00:00', 'uye', '', '', '', '2003-08-18', 20, 0, '176.233.111.191', 0, 'b', 'a', 'a'),
(700, 'Arda', 'Bayram', 'Bayramarda', 'yarram.13', 'highqualtyfiveteen@gmail.com', '2017-04-02 04:24:31', '0000-00-00 00:00:00', 'uye', '', '', '', '1987-12-19', 20, 0, '178.241.194.227', 1, 'a', 'a', 'a'),
(701, 'Veysel', 'YILMAZ', 'Veysel1973', 'vy6485', 'veyselyilmaz1973@yahoo.com', '2017-04-02 04:31:38', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'ESKÝÞEHÝR', '', '1974-01-18', 21, 9, '46.154.35.199', 1, 'a', 'a', 'a'),
(702, 'Mursel', 'Eylül ', 'Mursel', '0222830', 'murscell@gmail.com', '2017-04-02 04:40:37', '0000-00-00 00:00:00', 'uye', '', '', '', '1983-02-01', 21, 0, '', 0, 'a', 'a', 'a'),
(704, 'Emre', 'Aslan', 'emreasln', 'Mutluyum0', 'asklar.parayla.033@gmail.com', '2017-04-02 04:56:14', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Afyonkarahisar', '158e01557ef9e4.jpg', '1998-09-21', 22, 4, '37.155.39.35', 1, 'a', 'a', 'a'),
(705, 'Enes', 'Öztekin', 'ns-tuldila', '730120.e', 'enes@abactstudio.com', '2017-04-02 05:37:18', '0000-00-00 00:00:00', 'uye', '', '', '', '2002-05-03', 20, 0, '', 0, 'a', 'a', 'a'),
(706, 'Burakcan', 'Yýldýz', 'Burakcanayyýldýz', 'asdasd123', 'bburakcan611@gmail.com', '2017-04-02 05:44:12', '0000-00-00 00:00:00', 'uye', '', '', '', '1991-04-09', 20, 0, '', 0, 'a', 'a', 'a'),
(707, 'Ali', 'Çabukcan', 'Ali42', 'mca5143092', 'co786069@gmsil.com', '2017-04-02 05:57:04', '0000-00-00 00:00:00', 'uye', '', '', '', '0000-00-00', 20, 0, '', 0, 'a', 'a', 'a'),
(708, 'Fikret Þenol', 'Önal', 'Þenol', 'asdf345672asdg', 'senol4556@gmail.com', '2017-04-02 06:13:25', '0000-00-00 00:00:00', 'uye', '', '', '158e7ea3d91c48.jpg', '1985-10-12', 21, 0, '151.135.116.87', 1, 'a', 'a', 'a'),
(709, 'Ergün', 'Çakýr ', 'Ergün ', 'eren1453', 'erguncakir5@gmail.com', '2017-04-02 06:27:19', '0000-00-00 00:00:00', 'uye', '', '', '', '1984-03-22', 20, 0, '212.252.100.164', 1, 'a', 'a', 'a'),
(710, 'Erkan', 'Erel', 'ErkanErel', '49064906', 'erkan_erel@hotmail.com', '2017-04-02 09:43:10', '0000-00-00 00:00:00', 'uye', '', '', '', '1984-11-01', 20, 0, '', 0, 'a', 'a', 'a'),
(711, 'Ümit Can', 'Keskin', '06mtcnkskn', 'yanlýþ', 'umitgs_19051@hotmail.com', '2017-04-02 09:52:38', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Ankara', '158e05b89e3ee1.jpg', '1997-07-30', 21, 6, '', 1, 'a', 'a', 'a'),
(712, 'mert', 'doðru', 'xmert16', '12345678mert', 'meto20042004@gmail.com', '2017-04-02 13:27:59', '0000-00-00 00:00:00', 'uye', '', '', '', '1997-01-01', 20, 0, '', 0, 'a', 'a', 'a'),
(713, 'Nejdet', 'Çeri', 'Nejdet--CERI', 'hakolanallah', 'nejdet444ceri@gmail.com', '2017-04-02 13:40:42', '0000-00-00 00:00:00', 'uye', '', '', '', '1998-09-14', 20, 0, '', 0, 'a', 'a', 'a'),
(714, 'Halit', 'Kayabaþý', 'Samsat4242', 'pala4242', 'samsat_kral42@outlook.com', '2017-04-02 14:02:09', '0000-00-00 00:00:00', 'uye', '', '', '', '1998-08-08', 22, 3, '', 0, 'a', 'a', 'a'),
(715, 'Aysenur', 'Cakar', 'Ay''senur Ay''senur', 'serseri123456789', '05468042672', '2017-04-02 15:16:14', '0000-00-00 00:00:00', 'uye', '', '', '', '2004-04-14', 20, 0, '', 0, 'a', 'a', 'a'),
(716, 'Samet', 'Gülcan', 'Samet', 'samsun', 'samet.gl5546@gmail.com', '2017-04-02 15:21:27', '0000-00-00 00:00:00', 'uye', '', '', '', '1988-07-08', 20, 0, '46.1.1.132', 1, 'a', 'a', 'a'),
(717, 'Harun', 'Özdemir', 'Byfacia', 'harun6776', 'harun_aslan479@hotmail.com', '2017-04-02 15:38:28', '0000-00-00 00:00:00', 'uye', '', '', '', '1995-10-08', 20, 0, '', 0, 'a', 'a', 'a'),
(718, 'mehmet ', 'güler ', 'mmthlr42', '32165498700mg1', 'mmtglr62@gmail.com', '2017-04-02 15:39:44', '0000-00-00 00:00:00', 'uye', '', '', '', '2000-01-09', 20, 0, '', 1, 'a', 'a', 'a'),
(719, 'Ömer', 'Özaydýn', 'esesli99', '25fd2d85a', 'eseslee_2013@hotmail.com', '2017-04-02 15:54:57', '0000-00-00 00:00:00', 'uye', '', '', '', '2001-10-23', 20, 0, '81.213.254.125', 1, 'a', 'a', 'a'),
(720, 'ismail', 'buðdaycý', 'ismailbuðdaycý', 'ismail9246', 'spreyci_92_44@hotmail.com', '2017-04-02 16:50:02', '0000-00-00 00:00:00', 'uye', '', '', '', '1991-03-12', 23, 15, '85.106.252.222', 0, 'a', 'a', 'a'),
(721, 'Muhammed', 'Yeneroglu', 'Muhammed Yeneroglu', 'eyfer1902', 'mehmet63610@hotmail.com', '2017-04-02 17:15:58', '0000-00-00 00:00:00', 'uye', '', '', '', '2005-07-19', 20, 0, '', 0, 'a', 'a', 'a'),
(722, 'Ali', 'ERTEN', 'Akefese', '2002756', 'erten-ali@hotmail.com', '2017-04-02 17:17:51', '0000-00-00 00:00:00', 'uye', '', '', '', '1980-04-07', 20, 0, '151.135.219.16', 1, 'a', 'a', 'a'),
(723, 'Mehmet Emin ', 'Aslan', 'Osmnlýyý seviyorum ', 'eminemin', 'akigo_emin45@hotmail.com', '2017-04-02 17:20:12', '0000-00-00 00:00:00', 'uye', '', '', '', '1989-03-20', 22, 42, '151.135.227.103', 0, 'a', 'a', 'a'),
(724, 'Ali', 'Emre', 'Emre', 'kjnbkjnb', 'e-obosna@outlook.com', '2017-04-02 17:24:54', '0000-00-00 00:00:00', 'uye', '', '', '', '1982-10-26', 21, 2, '88.241.45.68', 1, 'a', 'a', 'a'),
(725, 'ferhat ', 'tuna', 'ferhat tuna', 'koyluguzeli', 'ferhat_tuna_355@Hotmail.com', '2017-04-02 17:26:11', '0000-00-00 00:00:00', 'uye', '', '', '158e0c89c866ae.jpg', '1997-10-15', 22, 4, '176.54.174.125', 0, 'a', 'a', 'a'),
(726, 'Fatih', 'Dönmez', 'Maraz', '19861986gs', 'maraz_gs_1986@hotmail.com', '2017-04-02 17:29:42', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Ýzmir', '', '1986-08-31', 20, 8, '', 0, 'a', 'a', 'a'),
(727, 'Murat', 'Kondu', 'izmirx', 'enkaramurat58', 'barbar5835@outlook.com', '2017-04-02 17:34:30', '0000-00-00 00:00:00', 'uye', '', '', '', '1974-04-06', 20, 0, '151.135.227.225', 1, 'a', 'a', 'a'),
(728, 'Ferhat Talha', 'Bayramoglu', 'Ferhat Talha', 'fermat12', 'ferhat_talha@hotmail.com', '2017-04-02 17:50:53', '0000-00-00 00:00:00', 'uye', '', '', '', '1977-09-27', 20, 0, '', 1, 'a', 'a', 'a'),
(729, 'Ertuðrul ', 'Erdoðan ', 'eto16', '12345678e', 'eto16@outlook.com', '2017-04-02 18:09:40', '0000-00-00 00:00:00', 'uye', '', '', '', '1997-04-13', 21, 0, '', 0, 'a', 'a', 'a'),
(730, 'Fatih', 'Kurt', 'Fatih661kurt', '19671996', 'fatih661kurt@gmail.com', '2017-04-02 18:25:45', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Istanbul', '', '1998-05-22', 21, 0, '178.243.56.235', 1, 'a', 'a', 'a'),
(731, 'Rasim', 'Öztürk', 'rasimoz', '2363873', 'rasim46@gmail.com', '2017-04-02 18:40:42', '0000-00-00 00:00:00', 'uye', '', '', '158e0d6f5c76c2.jpg', '1963-10-20', 22, 11, '46.1.84.252', 1, 'a', 'a', 'a'),
(732, 'Mustafa', 'DEMÝRCÝ', 'Mr.Blacsmith', '265365298741', 'MUSTAFA_D1999@hotmail.com', '2017-04-02 18:48:06', '0000-00-00 00:00:00', 'uye', '', '', '158e0d7d4c7e1e.jpg', '1999-10-15', 22, 1, '195.174.24.74', 1, 'a', 'a', 'a'),
(733, 'Yunus', 'Dereli', 'Yunus dereli', 'yunus789789', 'hudutnamustur_yunus57@hotmail.com', '2017-04-02 19:17:03', '0000-00-00 00:00:00', 'uye', '', '', '', '1996-04-05', 21, 0, '', 0, 'a', 'a', 'a'),
(734, 'mustafa', 'bayat', 'Mustafa bayat', 'uskuburt', 'gaccik24@gmail.com', '2017-04-02 19:19:16', '0000-00-00 00:00:00', 'uye', '', '', '', '1996-07-10', 20, 0, '', 0, 'a', 'a', 'a'),
(736, 'Doðukan', 'Delikkaya', 'Doðukan', '091453', 'dogukandlkkaya@gmail.com', '2017-04-02 19:44:16', '0000-00-00 00:00:00', 'uye', '', '', '', '2000-05-16', 22, 0, '5.176.24.210', 0, 'a', 'a', 'a'),
(738, 'Murat', 'Yaþar', 'Murat.Yaþar', '1234567890', 'islamiyet@gmail.com', '2017-04-02 21:18:05', '0000-00-00 00:00:00', 'uye', '', '', '', '2002-03-21', 26, 0, '', 0, 'a', 'a', 'a'),
(739, 'Okan', 'Kesme', 'Okank', 'kesmen38', 'hakikesmen@gmail.com', '2017-04-02 21:23:40', '0000-00-00 00:00:00', 'uye', '', '', '', '1994-04-04', 22, 0, '', 0, 'a', 'a', 'a'),
(740, 'Eyup', 'ASLAN', 'aslaneyup', 'kertenkele', 'eyupaslan683@gmail.com', '2017-04-02 21:35:41', '0000-00-00 00:00:00', 'uye', '', '', '', '1996-05-07', 20, 0, '', 1, 'a', 'a', 'a'),
(741, 'Þevval ', 'Emuce ', 'Þ.emuce.61', 'sev45100898140', 'swl_61@hotmail.com', '2017-04-02 21:59:31', '0000-00-00 00:00:00', 'uye', '', '', '', '2002-01-02', 20, 0, '', 0, 'a', 'a', 'a'),
(742, 'Ahmet ', 'Gökmen ', 'Yesevi 55', 'ahmet55', 'Ahmet_55_1453@hotmail.com', '2017-04-02 22:01:26', '0000-00-00 00:00:00', 'uye', '', '', '', '1995-01-00', 20, 0, '', 0, 'a', 'a', 'a'),
(743, 'Turgut', 'Arslan', 'dragut', '145090278', 'dragut1450@gmail.com', '2017-04-02 22:02:45', '0000-00-00 00:00:00', 'uye', '', '', '', '1972-02-25', 20, 0, '', 0, 'a', 'a', 'a'),
(744, 'Ahmet', 'Altan', 'ahmetaltan2727@birsancak.com', 'forevirum', 'ahmetaltan2727@birsancak.com', '2017-04-02 22:03:32', '0000-00-00 00:00:00', 'uye', '', '', '', '1984-11-20', 20, 0, '', 0, 'a', 'a', 'a'),
(745, 'aburrahim', 'ek', 'a.rahim', 'vaiz89', 'arahim.72@hotmail.com', '2017-04-02 22:13:42', '0000-00-00 00:00:00', 'uye', '', '', '', '1989-11-16', 20, 0, '', 0, 'a', 'a', 'a'),
(746, 'Ugur Can', 'Alan', 'Uður Bkcc ', '05466062569', 'Bkccugur@gmail.com', '2017-04-02 22:16:51', '0000-00-00 00:00:00', 'uye', '', '', '', '1996-01-05', 20, 0, '', 0, 'a', 'a', 'a'),
(748, 'Özgür', 'ÇAÐIL', 'Cundullah', 'ozgur1071', 'ceronimo_kral@hotmail.com', '2017-04-02 22:39:35', '0000-00-00 00:00:00', 'uye', '', '', '', '1993-02-01', 20, 0, '', 0, 'a', 'a', 'a'),
(749, 'Ümit', 'Öztürk', 'umitozturk58', 'akhisarMYO', 'b.umitozturk@hotmail.com', '2017-04-02 22:54:00', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Bandýrma', '158e1117e2bd36.jpg', '1995-06-25', 21, 0, '176.238.4.236', 0, 'a', 'a', 'a'),
(750, 'Bülent', 'Kaplan', 'kaplan46', 'kaplan4601', 'bulentkaplan46@gmail.com', '2017-04-02 23:04:06', '0000-00-00 00:00:00', 'uye', '', '', '158e1144a82bd5.jpg', '1990-03-20', 23, 6, '85.110.244.70', 1, 'a', 'a', 'a'),
(751, 'Veysel', 'Kaplan', 'Veyselkaplan46', 'kaplan4601', 'veyselkaplan46@gmail.com', '2017-04-02 23:06:55', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Kahramanmaraþ', '', '1999-03-22', 23, 2, '', 0, 'a', 'a', 'a'),
(752, 'kemal', 'gecer', 'kemalgecer1907', '14360157366', 'k.gecer79000@gmail.com', '2017-04-02 23:07:14', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'kilis', '158e115f5c71a3.jpg', '2002-04-05', 22, 1, '95.7.38.226', 1, 'a', 'a', 'a'),
(753, 'Sedat ', 'Sarýkaya', 'Sedatturkey ', 'sedat506', 'Yangmail@yandex.com', '2017-04-02 23:11:35', '0000-00-00 00:00:00', 'uye', '', '', '', '1930-01-31', 19, 0, '', 0, 'a', 'a', 'a'),
(754, 'Fatih', 'Özsoy', 'Fatihözsoy', 'Fatih.1453', 'fatiozsoy@gmail.com', '2017-04-02 23:40:51', '0000-00-00 00:00:00', 'uye', '', '', '', '1992-03-20', 20, 0, '46.221.137.66', 1, 'a', 'a', 'a'),
(755, 'Hüseyin', 'Yeþil', 'Hüseyin yesil', 'hüso001992', 'orhan_mecit331@hotmail.com', '2017-04-03 00:11:56', '0000-00-00 00:00:00', 'uye', '', '', '', '1994-05-10', 21, 0, '', 0, 'a', 'a', 'a'),
(756, 'Selman', 'Üstünel', 'Selman ÜSTÜNEL', '032902064', 'selman.ustunel@gmail.com', '2017-04-03 00:19:08', '0000-00-00 00:00:00', 'uye', '', '', '', '1986-08-04', 20, 0, '', 0, 'a', 'a', 'a'),
(757, 'özkan ', 'doyuran', 'Tuðhan', 'zeldamzeldam', 'himmet_sultanim28@hotmail.com', '2017-04-03 00:24:39', '0000-00-00 00:00:00', 'uye', '', '', '', '1980-01-01', 20, 0, '', 0, 'a', 'a', 'a'),
(758, 'Ercan', 'öztürk', 'bu_oztrkk', 'jercan57', 'ercanozturk577@gmail.com', '2017-04-03 00:29:49', '0000-00-00 00:00:00', 'uye', '', '', '', '1996-03-04', 20, 0, '', 0, 'a', 'a', 'a'),
(759, 'abdullah', 'karacizmeli', 'abdllh.63', 'birsancak', 'abdllh63.63@hotmail.com', '2017-04-03 00:39:31', '0000-00-00 00:00:00', 'uye', '', '', '', '1997-02-01', 20, 0, '', 0, 'a', 'a', 'a'),
(760, 'denmee', 'denne', 'denem', 'Nsjshshshh', 'andromedagamers.50@gmail.com', '2017-04-03 00:51:49', '0000-00-00 00:00:00', 'uye', '', '', '', '1937-06-06', 20, 0, '', 1, 'a', 'a', 'a'),
(763, 'Ýrfan', 'Afþar', 'irfanafsar', 'i1r2f3a4n5', 'irfan43684@gmail.com', '2017-04-03 01:04:10', '0000-00-00 00:00:00', 'uye', '', '', '', '2000-01-31', 20, 0, '', 1, 'a', 'a', 'a'),
(764, 'Lala', 'Kaþ', 'Lala', '67496749', 'lala1616@hotmail.com', '2017-04-03 02:12:32', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Bursa', '', '1971-07-27', 21, 17, '95.10.17.116', 0, 'a', 'a', 'a'),
(766, 'Yusuf', 'Cebeci', 'hafýz42', 'galatasaray', 'yusuf_cebeci_42@hotmail.com', '2017-04-03 12:44:33', '0000-00-00 00:00:00', 'uye', '', '', '', '1999-06-18', 20, 0, '', 0, 'a', 'a', 'a'),
(767, 'serkan', 'genç', 'serkangenc', 'serkan1976', 'serkangenc.61@Hotmail.com', '2017-04-03 15:16:08', '0000-00-00 00:00:00', 'uye', '', '', '', '1976-05-27', 20, 0, '', 0, 'a', 'a', 'a'),
(768, 'Murat', 'Mert', 'Murat.16hotmail.com', '0123456789.', 'murat.16@hotmail.com', '2017-04-04 00:03:23', '0000-00-00 00:00:00', 'uye', '', '', '', '1992-08-02', 21, 5, '176.238.16.158', 0, 'a', 'a', 'a'),
(769, 'Ömer', 'Gök', 'Ömer Gök', '15891589', 'omergok_99@hotmail.com', '2017-04-04 07:40:15', '0000-00-00 00:00:00', 'uye', '', '', '', '1996-04-24', 21, 1, '', 0, 'a', 'a', 'a'),
(770, 'Aslýhan', 'Ardýç', 'ardicaslihan', 'lavinia.', 'ardicaslihan046@gmail.com', '2017-04-04 20:12:47', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Kahramanmaraþ', '158e38df8122df.jpg', '1998-04-07', 22, 29, '188.57.158.36', 0, 'a', 'a', 'a'),
(771, 'Selcuk', 'Oncu', 'Asker', 'baskan2023', 'kement.er@hitmail.com', '2017-04-05 02:20:12', '0000-00-00 00:00:00', 'uye', '', '', '', '1971-01-10', 20, 0, '', 0, 'a', 'a', 'a'),
(772, 'Kasim', 'Turkan', 'Ayyildizkasim ', '00000178', 'ksmtrkn2@gmail.com', '2017-04-05 04:04:01', '0000-00-00 00:00:00', 'uye', '', '', '', '1985-06-06', 21, 0, '', 0, 'a', 'a', 'a'),
(773, 'Furkan', 'Salman', 'frkn-slmn', 'frskll1331', 'salmanfurkan28@gmail.com', '2017-04-06 02:54:23', '0000-00-00 00:00:00', 'uye', '', '', '', '2002-04-17', 21, 1, '', 1, 'a', 'a', 'a'),
(775, 'Ergün ', 'Parsova ', 'Eparsova', 'pars2746', 'ergunparsova@gmail.com', '2017-04-08 01:51:25', '0000-00-00 00:00:00', 'uye', '', '', '158e7d2bc84e7b.jpg', '1976-01-29', 23, 4, '176.55.108.192', 1, 'b', 'a', 'a'),
(776, 'Levent', 'TUFAN', 'Evcilerli', '2680239//', 'leventtufan65@gmail.com', '2017-04-08 02:35:13', '0000-00-00 00:00:00', 'uye', '', '', '', '1965-11-08', 20, 0, '', 1, 'a', 'a', 'a'),
(777, 'Hamza ', 'Koç ', 'Hamza koç ', 'hk28k5757', 'kochamza15@gmail.com', '2017-04-08 02:40:02', '0000-00-00 00:00:00', 'uye', '', '', '', '1974-08-20', 21, 26, '', 0, 'a', 'a', 'a'),
(778, 'Mehmet', 'Kandemir', 'kandemir55', 'kandemir', 'kandemirelektronik@hotmail.com', '2017-04-08 02:40:21', '0000-00-00 00:00:00', 'uye', '', '', '', '1990-01-01', 21, 0, '82.222.199.250', 1, 'a', 'a', 'a'),
(779, 'kemal', 'ballý ', 'kemal.balli838', '05376614159', 'kemal.balli38@gmail.com', '2017-04-08 03:59:43', '0000-00-00 00:00:00', 'uye', '', '', '', '1998-07-07', 21, 0, '', 0, 'a', 'a', 'a'),
(780, 'Muhammed', 'Gelin', 'Mhmdgln', '6886303', 'muhammedgelin@gmail.com', '2017-04-08 05:35:06', '0000-00-00 00:00:00', 'uye', '', '', '', '1995-10-30', 20, 0, '', 1, 'a', 'a', 'a'),
(781, 'hakan ', 'çakmak ', 'hakan çakmak@hotmail ', 'ben27sen27', 'hakan@hotmail.com', '2017-04-08 05:42:11', '0000-00-00 00:00:00', 'uye', '', '', '', '1991-10-10', 22, 4, '', 0, 'a', 'a', 'a'),
(782, 'Recep', 'Yýldýz', 'Recep yýldýz', '2727', 'recep_05@hotmail.com', '2017-04-08 06:56:49', '0000-00-00 00:00:00', 'uye', '', '', '', '1988-12-30', 20, 0, '', 0, 'a', 'a', 'a'),
(783, 'Mesut ', 'Altuntaþ ', 'Hazýr kýta ', 'volgagrad', '_mesut_@windowslive.com', '2017-04-08 07:08:15', '0000-00-00 00:00:00', 'uye', '', '', '', '1987-11-22', 21, 1, '', 0, 'a', 'a', 'a'),
(784, 'Resul ', 'Altun ', 'Kuzeyli', '751310', 'north25star@gmail.com', '2017-04-08 11:04:36', '0000-00-00 00:00:00', 'uye', '', '', '', '1976-10-17', 20, 0, '', 0, 'a', 'a', 'a'),
(785, 'Hasan ', 'Kýlýnç ', 'DevletiSancak', '45693782', 'towsend_2032@hotmail.com', '2017-04-08 14:49:47', '0000-00-00 00:00:00', 'uye', '', '', '', '1992-02-02', 21, 1, '', 0, 'a', 'a', 'a'),
(786, 'ibrahim', 'gökalp', 'hatayliibo', 'pisikopatserseri', 'ibrahim-can_31@hotmail.com', '2017-04-08 16:00:47', '0000-00-00 00:00:00', 'uye', '', '', '', '1996-08-23', 20, 0, '', 0, 'a', 'a', 'a'),
(787, 'ibrahim', 'zorlu', 'ibrahim', '7261215', 'ibrahim06zorlu@gmail.com', '2017-04-08 18:11:40', '0000-00-00 00:00:00', 'uye', '', '', '', '1967-03-06', 20, 0, '', 0, 'a', 'a', 'a'),
(788, 'Lazofi', 'Moto', 'Lazofimoto', '04642234583', 'samiulas@gmail.com', '2017-04-08 19:00:22', '0000-00-00 00:00:00', 'uye', '', '', '', '1976-08-15', 20, 0, '176.54.68.255', 1, 'a', 'a', 'a'),
(789, 'Yasar', 'Durmus', 'Tulbilge', 'arz1993324', 'yakuza1919@hotmail.com', '2017-04-08 19:07:04', '0000-00-00 00:00:00', 'uye', '', '', '', '1970-04-01', 21, 0, '', 0, 'a', 'a', 'a'),
(790, 'Rahim', 'Þimþek', 'Kizilelma', 'meryemsu', 'kars363116@gmail.com', '2017-04-08 20:10:46', '0000-00-00 00:00:00', 'uye', '', '', '', '1982-10-15', 21, 1, '151.135.76.111', 1, 'a', 'a', 'a'),
(791, 'Bekir Yavuz ', 'GÜZEL ', 'Bekir Yavuz', 'Bekiron5', 'bekiryavuz07@hotmail.com.tr', '2017-04-08 21:48:53', '0000-00-00 00:00:00', 'uye', '', '', '', '0000-00-00', 20, 0, '', 0, 'a', 'a', 'a'),
(792, 'Hamza', 'Aktý', 'Hamza', '7332637936', 'bulentakt62@gmail.com', '2017-04-08 22:10:22', '0000-00-00 00:00:00', 'uye', '', '', '', '1982-03-03', 20, 0, '', 1, 'a', 'a', 'a'),
(793, 'ÝSMAÝL', 'YILMAZ', 'Ýsylmaz', 'mihRAB-3246', 'isylmaz3246@gmail.com', '2017-04-08 23:01:16', '0000-00-00 00:00:00', 'uye', '', '', '', '1973-07-27', 20, 0, '', 0, 'a', 'a', 'a'),
(794, 'Okan', 'Gulenc', 'Glnc74', 'turkhas74', 'gulencokan1@gmail.com', '2017-04-08 23:01:44', '0000-00-00 00:00:00', 'uye', '', '', '', '1991-05-04', 21, 1, '', 0, 'a', 'a', 'a'),
(795, 'Bekir ', 'Sabirdan ', 'Sivereklo', '1231231', 'bsabirdan@mynet.com', '2017-04-09 00:13:59', '0000-00-00 00:00:00', 'uye', '', '', '', '1994-04-01', 20, 0, '', 0, 'a', 'a', 'a'),
(796, 'elifnur', 'acar', 'elifnur acar', 'Havva acar', 'rsevimli@list.ru', '2017-04-09 00:42:11', '0000-00-00 00:00:00', 'uye', '', '', '', '2004-04-26', 20, 0, '', 0, 'a', 'a', 'a'),
(797, 'Al', 'Alperen', 'Sosyal Cihad', 'ra123456', 'resulaltin_61@hotmail.com', '2017-04-09 01:28:56', '0000-00-00 00:00:00', 'uye', '', '', '', '1990-01-01', 21, 4, '', 0, 'a', 'a', 'a'),
(798, 'Ercan', 'ZENBÝLLÝ ', 'ercanznbll', '14532013', 'ercanznbll@gmail.com', '2017-04-09 02:13:44', '0000-00-00 00:00:00', 'uye', '', '', '', '1993-08-02', 20, 0, '', 0, 'a', 'a', 'a'),
(799, 'Fahri ', 'dokur ', 'fdokur ', '9564713', 'Fahri-uncle@hotmail.com', '2017-04-09 02:34:11', '0000-00-00 00:00:00', 'uye', '', '', '', '1973-03-17', 20, 0, '', 0, 'a', 'a', 'a'),
(800, 'Orhan', 'Arapoðlu', 'el-turco', 'ozanemre', 'orhanarapoglu@hotmail.com', '2017-04-09 03:06:52', '0000-00-00 00:00:00', 'uye', '', '', '', '1969-12-12', 20, 0, '176.220.148.43', 0, 'a', 'a', 'a'),
(801, 'Mücahit', 'Faruk', 'Osas', 'mfkdkakak', '18mfk18@hotmail.com', '2017-04-09 03:47:11', '0000-00-00 00:00:00', 'uye', '', '', '', '2000-08-02', 20, 0, '151.135.75.0', 0, 'a', 'a', 'a'),
(802, 'Halil', 'Bertan', 'Bertan Salih Kerim', '517240', 'salih.kerim.2013@gmail.com', '2017-04-09 03:58:19', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Kýrþehir', '158e94331a27db.jpg', '1988-03-08', 21, 12, '5.177.181.227', 1, 'a', 'a', 'a'),
(803, 'Galip ', 'Karakuþ ', 'Galip', '211004', 'galipkarakus@gmail.com', '2017-04-09 04:23:07', '0000-00-00 00:00:00', 'uye', '', '', '', '1973-08-21', 20, 0, '88.226.118.15', 1, 'a', 'a', 'a'),
(804, 'Erhan ', 'Özdemir', 'Vatandelisi', '3365817', 'seckin_3365818@hotmail.com', '2017-04-09 04:23:38', '0000-00-00 00:00:00', 'uye', '', '', '', '1981-09-14', 20, 0, '', 0, 'a', 'a', 'a'),
(805, 'Ýbrahim', 'Azmaz', 'Ýbrahim azmaz', '15061970ibrahimazmaz', 'ibrahim_azmaz06@hotmail.com', '2017-04-09 04:49:31', '0000-00-00 00:00:00', 'uye', '', '', '', '1970-06-15', 20, 0, '', 0, 'b', 'a', 'a'),
(806, 'Berkant ', 'Balta', 'Komando', 'komando77', 'berkant_55_2007@gmail.com', '2017-04-09 05:32:50', '0000-00-00 00:00:00', 'uye', '', '', '', '2007-01-12', 20, 0, '', 0, 'a', 'a', 'a'),
(807, 'Yasin', 'Aslan', 'Thebye', '16444461', 'thebye@gmail.com', '2017-04-09 05:38:32', '0000-00-00 00:00:00', 'uye', '', '', '', '1982-05-14', 20, 0, '', 1, 'a', 'a', 'a'),
(808, 'can', 'yigit', 'can.yigit', '........AB', 'yigitcan862@yandex.com', '2017-04-09 05:45:16', '0000-00-00 00:00:00', 'uye', '', '', '158e95b997c2bc.png', '1974-02-01', 21, 6, '31.223.39.171', 1, 'a', 'a', 'a'),
(809, 'Zeynep', 'Pisgin', 'Hazan', 'gorkem', 'hikmetpisgin@hotmail.com', '2017-04-09 06:37:03', '0000-00-00 00:00:00', 'uye', '', '', '', '1975-07-16', 20, 0, '', 0, 'a', 'a', 'a'),
(810, 'Eren', 'Öztürk', 'erenozturk37', 'erenozturk', 'akgozserhat52@gmail.com', '2017-04-09 08:20:24', '0000-00-00 00:00:00', 'uye', '', '', '', '1987-06-04', 21, 1, '92.44.103.22', 1, 'a', 'a', 'a');
INSERT INTO `users` (`user_id`, `user_adi`, `user_soyadi`, `username`, `password`, `user_email`, `user_kayit_tarih`, `user_giris_tarih`, `user_type`, `user_ulke`, `user_sehir`, `user_profil_resim`, `user_dogum_tarih`, `user_takipci_sayi`, `user_takip_edilen_sayi`, `user_ip`, `user_aktivasyon`, `user_pay_gizle`, `user_takip_durum`, `user_mesaj_durum`) VALUES
(811, 'Selahattin', 'OZSEVGEC', 'Selo.6i42', '25051998selo', 'fark_yapmaz68400@hotmail.com', '2017-04-09 08:37:37', '0000-00-00 00:00:00', 'uye', '', '', '', '1998-05-25', 20, 0, '', 0, 'a', 'a', 'a'),
(812, 'Adem', 'BAÐATEMUR', 'Adem', '23121989', 'medanarut@hotmail.com', '2017-04-09 11:53:26', '0000-00-00 00:00:00', 'uye', '', '', '', '0000-00-00', 21, 0, '46.221.142.143', 0, 'a', 'a', 'a'),
(813, 'Melikþah', 'Yýldýrým', 'meliksah', 'arhavili08', 'meliksah.yildirim@msn.com', '2017-04-09 12:10:02', '0000-00-00 00:00:00', 'uye', '', '', '', '1986-12-06', 20, 0, '', 0, 'a', 'a', 'a'),
(814, 'Lefveff', 'Byges', 'Nerdesenrte', 'bukalemun2', 'bugshheswr@hotmail.com', '2017-04-09 12:18:47', '0000-00-00 00:00:00', 'uye', '', '', '', '2001-05-04', 20, 0, '', 0, 'a', 'a', 'a'),
(815, 'Osm ', 'Ttl', 'Dombýra', '20886273', 'tutumlu@gmail.com', '2017-04-09 12:53:39', '0000-00-00 00:00:00', 'uye', '', '', '', '1973-00-30', 20, 0, '', 0, 'b', 'a', 'a'),
(816, 'Hanife', 'CAN', 'Hanife CAN', 'can197878', 'hanifecan28@gmail.com', '2017-04-09 13:02:53', '0000-00-00 00:00:00', 'uye', '', '', '', '1978-02-25', 21, 1, '88.253.70.95', 1, 'a', 'a', 'a'),
(818, 'Samet', 'Cenikli', 'Samet Cenikli', '14539652as', 'ceniklis@yahoo.com', '2017-04-09 13:38:04', '0000-00-00 00:00:00', 'uye', '', '', '', '1994-09-08', 20, 0, '', 0, 'a', 'a', 'a'),
(819, 'Fatih', 'Yýldýz', 'Fatihyildiz', '2002alp352', '5ealperenozdemir@gmail.com', '2017-04-09 15:21:41', '0000-00-00 00:00:00', 'uye', '', '', '', '1991-11-03', 20, 0, '', 1, 'a', 'a', 'a'),
(820, 'gökhan', 'yamqn', 'gökhanyaman', 'evet', 'ayse85yaman@gmail.com', '2017-04-09 15:59:47', '0000-00-00 00:00:00', 'uye', '', '', '', '1993-01-14', 20, 0, '', 0, 'a', 'a', 'a'),
(822, 'Enes can ', 'Sarkýn ', 'Enescan19', '16984820480', 'enescansarkin@gmail.com', '2017-04-09 16:40:45', '0000-00-00 00:00:00', 'uye', '', '', '', '2002-01-09', 20, 0, '', 0, 'a', 'a', 'a'),
(823, 'Mecnun', 'Avuoðlu', 'Mecnun', 'tahminet8', 'my.net@hotmail.com', '2017-04-09 17:21:55', '0000-00-00 00:00:00', 'uye', '', '', '', '1991-10-16', 21, 0, '', 0, 'a', 'a', 'a'),
(824, 'Rüstem', 'GARÝP', 'smile66', '001981rg', 'bin981@gmail.com', '2017-04-09 17:44:48', '0000-00-00 00:00:00', 'uye', '', '', '158eb1b01b521c.jpg', '1981-09-06', 20, 0, '95.9.216.221', 1, 'a', 'a', 'a'),
(825, 'Atakan', 'Çýkýn', 'Atakan1209', 'atakanbade', 'atakancikin1@gmail.com', '2017-04-09 18:03:51', '0000-00-00 00:00:00', 'uye', '', '', '', '2002-12-15', 20, 0, '', 0, 'a', 'a', 'a'),
(826, 'Ýbrahim Ethem', 'Akkaya', 'Ýbrahim_Ethem', 'öleceðizhaberimizyok', 'ethemakkaya46@hotmail.com', '2017-04-09 18:34:50', '0000-00-00 00:00:00', 'uye', '', '', '', '1998-08-21', 20, 0, '', 0, 'a', 'a', 'a'),
(828, 'Selami', 'Türk', 'Selami', '201268xx', 'selamiturk1968@hotmail.com', '2017-04-09 19:22:30', '0000-00-00 00:00:00', 'uye', '', '', '', '1968-12-20', 21, 0, '', 0, 'a', 'a', 'a'),
(829, 'Hasan', 'ÇAÐLAR', 'caglarr28', '28725**++', 'hsn_fb_1907@hotmail.com', '2017-04-09 20:46:22', '0000-00-00 00:00:00', 'uye', '', '', '', '1997-05-30', 22, 3, '46.154.67.135', 1, 'a', 'a', 'a'),
(830, 'Doðan', 'Ekinci', 'Mekansýz', 'efsane0063', 'Nizipli_.-27@hotmail.com', '2017-04-09 21:42:13', '0000-00-00 00:00:00', 'uye', '', '', '', '1988-12-17', 20, 0, '46.221.181.163', 1, 'a', 'a', 'a'),
(831, 'Deneme', 'Deneme', 'Denemedeneme', 'deneme123', 'denemedeneme@gmail.com', '2017-04-09 21:42:34', '0000-00-00 00:00:00', 'uye', '', '', '', '2017-01-01', 20, 0, '', 0, 'a', 'a', 'a'),
(832, 'osmanlý torunu ', 'Kaplan ', 'Süleyman ', 'as040302', 'suleymankaplan06@hotmail.com', '2017-04-09 21:51:51', '0000-00-00 00:00:00', 'uye', '', '', '', '1978-02-19', 20, 0, '', 0, 'a', 'a', 'a'),
(833, 'Abdullah', 'Tekcan', 'Dede', 'dedem1333', 'aksa_4268@hotmail.com', '2017-04-09 22:19:07', '0000-00-00 00:00:00', 'uye', '', '', '', '1963-11-09', 21, 0, '', 0, 'a', 'a', 'a'),
(834, 'Özay', 'Üðe', '07ozay_pw', 'afyok0123', 'ozayuge07@outlook.com', '2017-04-09 22:58:31', '0000-00-00 00:00:00', 'uye', '', '', '', '1998-09-17', 20, 0, '', 1, 'a', 'a', 'a'),
(835, 'Nugman', 'özcan', ' nugman ozcan', '12344321', 'danger_424242@hotmail.com', '2017-04-09 22:59:03', '0000-00-00 00:00:00', 'uye', '', '', '', '1984-02-15', 20, 0, '', 0, 'a', 'a', 'a'),
(836, 'Sefer', 'Sabirdan', 'Zafer', 'sefersefer', 'sefer.sabirdan@gmail.com.tr', '2017-04-09 23:38:30', '0000-00-00 00:00:00', 'uye', '', '', '', '1981-05-08', 20, 0, '', 0, 'a', 'a', 'a'),
(837, 'Ismail ', 'DURAK ', '«™ MuhammeDuraK »?', '2991*161', 'muhammedurak@gmail.com', '2017-04-10 00:09:51', '0000-00-00 00:00:00', 'uye', '', '', '158ea68e8cbaf8.jpg', '1992-02-23', 20, 0, '78.175.30.134', 1, 'b', 'a', 'a'),
(838, 'Görkem', 'yazar', 'gorkembey', '123456789', 'gorkembeyx1@gmail.com', '2017-04-10 00:56:03', '0000-00-00 00:00:00', 'uye', '', '', '', '1999-07-05', 21, 0, '46.252.99.254', 1, 'a', 'a', 'a'),
(839, 'Erdi ', 'Görmüþ ', 'Erdi.grms', 'eliferdi123', 'erdi.grms@hotmail.com', '2017-04-10 02:31:45', '0000-00-00 00:00:00', 'uye', '', '', '', '1994-01-03', 20, 0, '', 0, 'a', 'a', 'a'),
(840, 'Ahmet ', 'Alp', 'Ceyþullah', 'qweewq', 'ahmetalp79@gmail.com', '2017-04-10 03:10:03', '0000-00-00 00:00:00', 'uye', '', '', '', '1979-02-24', 21, 14, '178.241.130.241', 1, 'a', 'a', 'a'),
(841, 'Selim', 'Ertürk', 'S.ERTÜRK', '615534sert7378', 'selimerturk@hotmail.com.tr', '2017-04-10 03:10:34', '0000-00-00 00:00:00', 'uye', '', '', '', '1983-03-13', 21, 3, '94.122.115.59', 1, 'a', 'a', 'a'),
(842, 'Ömer', 'Kaya', 'FatihinFedaisi', 'fatihinfethi1453_', 'omar_kaya_2000@hotmail.com', '2017-04-10 03:20:29', '0000-00-00 00:00:00', 'uye', '', '', '', '2000-11-13', 20, 0, '88.224.76.39', 1, 'a', 'a', 'a'),
(843, 'Mehmet', 'Yalçýn', 'mylcn38', '12848560', 'mhmt11241@gmail.com', '2017-04-10 03:21:29', '0000-00-00 00:00:00', 'uye', 'Ýskeletler Diyarý', 'Kayseri', '', '1998-12-09', 20, 0, '', 0, 'a', 'a', 'a'),
(844, 'Eren', 'Bozkaya', 'erenbozkaya', 'b2624458', 'erenbozkaya1@gmail.com', '2017-04-10 03:29:47', '0000-00-00 00:00:00', 'uye', '', '', '', '1999-11-22', 22, 0, '31.145.156.82', 1, 'a', 'a', 'a'),
(845, 'Murat ', 'Özdemir ', 'Sancak', 'ankara06', 'mrtozd66@hotmail.com', '2017-04-10 04:06:50', '0000-00-00 00:00:00', 'uye', '', '', '', '1971-02-22', 20, 0, '', 0, 'a', 'a', 'a'),
(846, 'Vahdettin', 'Çoðalan', 'vcogalan', '3652', 'vcogalan@hotmail.com', '2017-04-10 04:07:26', '0000-00-00 00:00:00', 'uye', '', '', '', '1967-06-13', 20, 0, '', 0, 'b', 'a', 'a'),
(847, 'Ýsmail', 'Þapaloglu ', 'sapaloglu', '959974as', 'sapaloglu@gmail.com', '2017-04-10 04:41:05', '0000-00-00 00:00:00', 'uye', '', '', '', '1984-09-05', 20, 0, '', 0, 'a', 'a', 'a'),
(850, 'Engin', 'DELER ', 'Engin1453', 'Komando1453', 'Komandoengin1982@hotmail.com', '2017-04-10 06:41:33', '0000-00-00 00:00:00', 'uye', '', '', '', '1982-07-25', 20, 0, '', 0, 'b', 'a', 'a'),
(851, 'Ramazan', 'Kaya', 'Ramazan0534', 'amasya0358', 'ramazankaya199077@gmail.com', '2017-04-10 06:44:16', '0000-00-00 00:00:00', 'uye', '', '', '', '1990-04-04', 20, 0, '', 0, 'a', 'a', 'a'),
(852, 'Cengiz', 'Kar', 'cngzkar', 'ck943671', 'cngzkar@gmail.com', '2017-04-10 07:52:26', '0000-00-00 00:00:00', 'uye', '', '', '', '1976-12-14', 20, 0, '', 1, 'a', 'a', 'a'),
(853, 'Emre', 'Aslan', 'aslanmakina', 'Ya951753', 'aslanmakina@windowslive.com', '2017-04-10 08:10:32', '0000-00-00 00:00:00', 'uye', '', '', '', '1985-09-21', 21, 0, '', 0, 'a', 'a', 'a'),
(854, 'Ahmet', 'Öztaþ', 'ahmetoztas', '01530539', 'Ahmet5000@mynet.com', '2017-04-10 12:12:57', '0000-00-00 00:00:00', 'uye', '', '', '', '1983-01-01', 21, 7, '', 1, 'a', 'a', 'a'),
(855, 'Serdar', 'Erenler', 'Erenlers', 'melisa4488', 'serdar@bareksbarkod.com', '2017-04-10 13:53:54', '0000-00-00 00:00:00', 'uye', '', '', '', '1980-04-12', 20, 0, '', 1, 'a', 'a', 'a'),
(856, 'Suat', 'Buzdaðlý', 'Sýatbuzdaðlý', 'meryem15', 'ersuat15@göail.com', '2017-04-10 13:56:08', '0000-00-00 00:00:00', 'uye', '', '', '', '1973-05-17', 20, 0, '', 0, 'a', 'a', 'a'),
(857, 'Aslan ', 'Þengezer ', 'aslan...', '123_321', 'aslan.sengezer.13@gmail.com', '2017-04-10 13:57:05', '0000-00-00 00:00:00', 'uye', '', '', '', '1993-11-08', 20, 0, '', 0, 'a', 'a', 'a'),
(858, 'Recep', 'Yaramýþ ', 'Recep mustafa ', '37724955', 'yaramisrecep9@gmail.com', '2017-04-10 14:16:04', '0000-00-00 00:00:00', 'uye', '', '', '', '1994-04-16', 20, 1, '', 0, 'a', 'a', 'a'),
(859, 'Þadi ', 'ileri', 'muhafazakâr ', 'alacamsamsun5516', 'alacamsamsun27@gmail.com', '2017-04-10 14:20:05', '0000-00-00 00:00:00', 'uye', '', '', '', '1996-05-04', 20, 0, '37.155.255.187', 1, 'a', 'a', 'a'),
(860, 'Selda', 'Bulut', 'evladiosmanli2053__', '@@248@@', 'seldabulut881@gmail.com', '2017-04-10 14:34:55', '0000-00-00 00:00:00', 'uye', 'Türkiye', 'Konya', '158eb2871c50de.jpg', '1988-08-29', 22, 22, '24.133.139.7', 1, 'a', 'a', 'a'),
(862, 'Yasel', 'Girgin', 'yaselgirgin', '28071979', 'yaselgirgin@gmail.com', '2017-04-10 14:46:15', '0000-00-00 00:00:00', 'uye', '', '', '', '1979-07-28', 20, 0, '78.190.124.238', 1, 'a', 'a', 'a'),
(863, 'Oguzhan', 'Demir', 'Oguzhan Demir', 'qalpplaq', 'azdemir51@gmail.com', '2017-04-10 15:26:19', '0000-00-00 00:00:00', 'uye', '', '', '', '1999-11-24', 21, 1, '188.57.46.160', 1, 'a', 'a', 'a'),
(864, 'gundi', 'fýrfýr', 'gundi', '123456', 'gundi@gmail.com', '2017-04-10 15:41:24', '0000-00-00 00:00:00', 'uye', '', '', '', '2004-04-07', 20, 0, '', 0, 'a', 'a', 'a'),
(865, 'Faruk', 'Osmanlý ', 'Farukosmanli', '51285128nur.', 'lokmancoskunn@gmail.com', '2017-04-10 16:05:15', '0000-00-00 00:00:00', 'uye', '', '', '', '1987-02-14', 21, 1, '176.55.81.34', 1, 'a', 'a', 'a'),
(866, 'Ubeydullah', 'Özbey', 'Ubydullah_ozbey', 'hadibecanimkardes', 'ubeydullah.ozbey@outlook.com', '2017-04-10 17:04:52', '0000-00-00 00:00:00', 'uye', '', '', '', '1998-04-08', 20, 0, '', 0, 'a', 'a', 'a'),
(867, 'Faruk', 'Bingöl ', 'FARUK BÝNGÖL ', '19981998', 'farukbingol1@gmail.com', '2017-04-10 18:47:01', '0000-00-00 00:00:00', 'uye', '', '', '', '1998-05-14', 20, 0, '', 0, 'a', 'a', 'a'),
(868, 'Onur', 'Gülmez', 'Onrglmez', 'onur2525', 'karizma1996_onur@hotmail.com', '2017-04-10 19:55:55', '0000-00-00 00:00:00', 'uye', '', '', '', '1996-05-01', 20, 0, '', 0, 'a', 'a', 'a'),
(869, 'Hale', 'Asma', 'Halee55h', 'Halee55h.', 'Halee55h@gmail.com', '2017-04-10 20:19:31', '0000-00-00 00:00:00', 'uye', '', '', '', '1998-05-10', 20, 0, '', 0, 'a', 'a', 'a'),
(870, 'Cahit', 'þimþek', 'cahit', 'erzurum25', 'cahitie25@gmail.com', '2017-04-10 20:41:22', '0000-00-00 00:00:00', 'uye', '', '', '', '1992-11-01', 21, 2, '151.135.89.116', 1, 'a', 'a', 'a'),
(871, 'Fatih ', 'Ýþgören', 'MenzileDoðru', 'fth2534', 'fatihmenzil@hotmail.com', '2017-04-10 20:41:54', '0000-00-00 00:00:00', 'uye', '', '', '', '1985-07-19', 20, 0, '', 0, 'a', 'a', 'a'),
(872, 'Ahmet', 'Ada', 'Ais35', '96q58rg9', 'ahmetada3535@gmail.com', '2017-04-10 20:53:07', '0000-00-00 00:00:00', 'uye', '', '', '', '2000-01-01', 20, 0, '', 0, 'a', 'a', 'a'),
(873, 'Umut', 'Aydin', 'UmutAydin', 'parola6161', 'trabzonerdogdu@gmail.com', '2017-04-10 21:12:26', '0000-00-00 00:00:00', 'uye', '', '', '', '1997-02-07', 21, 0, '91.93.54.136', 1, 'a', 'a', 'a'),
(874, 'Ýsmail', 'Koç', '38-MEKAN-38', '3006814', 'koc_0038@hotmail.com', '2017-04-10 23:00:06', '0000-00-00 00:00:00', 'uye', '', '', '', '1977-08-01', 20, 0, '', 0, 'a', 'a', 'a'),
(876, 'Hakan', 'Güney ', 'Hkngny', 'erquanbey+1', 'hakangunex@gmail.com', '2017-04-11 00:28:43', '0000-00-00 00:00:00', 'uye', '', '', '', '1984-12-31', 20, 0, '188.57.24.227', 1, 'a', 'a', 'a'),
(877, 'Arzu', 'Babal', 'tairigelini', '35679772', 'tairigelini@gmail.com', '2017-04-11 01:21:13', '0000-00-00 00:00:00', 'uye', '', '', '158f637212f9d4.jpg', '1977-04-13', 23, 7, '178.245.85.122', 1, 'a', 'a', 'a'),
(878, 'barýþ', 'erdogan', 'bariserdogan', '16582272b', 'tc-bariserdogan@hotmail.com', '2017-04-11 01:31:24', '0000-00-00 00:00:00', 'uye', '', '', '', '1998-06-28', 20, 0, '', 0, 'a', 'a', 'a'),
(879, 'erkan', 'ateþ', 'erkanates', 'erkan123', 'trfurkan1@gmail.com', '2017-04-11 01:35:58', '0000-00-00 00:00:00', 'uye', '', '', '', '1923-12-16', 20, 0, '', 0, 'a', 'a', 'a'),
(880, 'muhammet', 'hasar', 'ekselans', '803320"""', 'muhammethasar21@gmail.com', '2017-04-11 03:19:37', '0000-00-00 00:00:00', 'uye', '', '', '', '1987-04-15', 20, 0, '', 1, 'a', 'a', 'a'),
(882, '1', '1', 'utthuvdd', 'g00dPa$$w0rD', 'sample@email.tst', '2017-04-12 00:09:04', '0000-00-00 00:00:00', 'uye', '', '', '', '0000-00-00', 20, 0, '', 0, 'a', 'a', 'a'),
(883, 'Tugba ', 'Duvan ', 'Miray', '868908', 'tugba_gokhan_2008@hotmail.com', '2017-04-12 04:33:14', '0000-00-00 00:00:00', 'uye', '', '', '', '1989-05-09', 21, 2, '', 0, 'a', 'a', 'a'),
(884, 'Emrah', 'Atmaca', 'Atmacaemrah5711453@gmail.com', '19971997', 'atmacaemrah5711453@gmail.com', '2017-04-12 18:25:52', '0000-00-00 00:00:00', 'uye', '', '', '', '1997-11-11', 20, 0, '', 0, 'a', 'a', 'a'),
(885, 'Tahayildiz', 'Taha', 'Taha jaar', '123456', 'tahayildiz70@htoil.com', '2017-04-13 02:03:15', '0000-00-00 00:00:00', 'uye', '', '', '', '2007-01-26', 20, 1, '', 0, 'a', 'a', 'a'),
(886, 'Tahayildiz', 'Taha', 'Taha is', '123456', 'tahayildiz00@hotmail.com', '2017-04-13 07:35:49', '0000-00-00 00:00:00', 'uye', '', '', '', '2017-01-25', 15, 0, '', 0, 'a', 'a', 'a'),
(887, 'Batuhan', 'Öztürk', 'btoz1903', 'Patronn27', 'bto1903@icloud.com', '2017-04-13 12:45:25', '0000-00-00 00:00:00', 'uye', '', '', '', '1997-05-05', 15, 0, '46.196.134.196', 0, 'a', 'a', 'a'),
(888, 'Mehmet Ali ', 'Emek', 'Mehmetali', '4263261719mali', 'emekmali1719@gmail.com', '2017-04-13 20:29:38', '0000-00-00 00:00:00', 'uye', '', '', '', '1992-11-16', 14, 15, '178.241.4.64', 1, 'a', 'a', 'a'),
(889, 'Seyyit Ali', 'Bayýndýr', 'S.a bayindýr', '111aaa111eee', 'seyit-ali1907@hotmail.com', '2017-04-13 20:35:21', '0000-00-00 00:00:00', 'uye', '', '', '', '1992-05-18', 13, 0, '', 0, 'a', 'a', 'a'),
(890, 'Ramazan', 'Uður', 'Malatyalý ramazan ', 'malatyaspor44', 'ramazanuguur@gmail.com', '2017-04-15 00:23:28', '0000-00-00 00:00:00', 'uye', '', '', '', '1962-02-21', 15, 0, '', 0, 'a', 'a', 'a'),
(891, 'Sezgin ', 'Yalçýn', 'SezginYalçýn', '20nsn571', 'sade-sezge@hotmail.com', '2017-04-15 02:17:36', '0000-00-00 00:00:00', 'uye', '', '', '', '1986-05-04', 13, 0, '85.105.50.16', 1, 'a', 'a', 'a'),
(892, 'Huriye', 'Doðan', 'ZehraSude', 'genetik', 'huriyedogan1962@hotmail.com', '2017-04-15 04:26:32', '0000-00-00 00:00:00', 'uye', '', '', '', '1962-01-04', 13, 0, '', 0, 'a', 'a', 'a'),
(893, 'vatan', 'sevdalýsý', 'ülkücü', 'nenehatun', 'kfatih882@gmail.com', '2017-04-15 10:36:52', '0000-00-00 00:00:00', 'uye', '', '', '', '0000-00-00', 13, 0, '46.221.215.17', 1, 'a', 'a', 'a'),
(894, 'Recep', 'Münzevi', 'Münzevi ', '321613b', 'recist@gmail.com', '2017-04-15 14:22:10', '0000-00-00 00:00:00', 'uye', '', '', '', '1982-04-27', 13, 0, '37.154.180.197', 1, 'a', 'a', 'a'),
(895, 'bir', 'dost', '#Bir_dost', 'b5454968530', 'abdefg@hotmail.com', '2017-04-15 19:34:03', '0000-00-00 00:00:00', 'uye', '', '', '158f217af5368b.png', '1985-01-01', 13, 0, '85.96.210.153', 0, 'b', 'a', 'a'),
(896, 'Okan', 'Demir', 'okan3358', '16899861', 'okandemir3358@gmail.com', '2017-04-15 21:08:39', '0000-00-00 00:00:00', 'uye', '', '', '', '1990-03-09', 13, 0, '', 0, 'a', 'a', 'a'),
(897, 'ismet', 'Akýncý', 'Reisin fedaileri', '05393157990x', 'ismetak4792@hotmail.com', '2017-04-19 01:08:19', '0000-00-00 00:00:00', 'uye', '', '', '', '1992-10-10', 10, 3, '2.132.180.229', 0, 'a', 'a', 'a'),
(898, 'Fahri', 'Hakyemezoglu', 'Doðrucu Davut', 'Reyhan24', 'fahri-tokat@hotmail.com', '2017-04-19 02:58:40', '0000-00-00 00:00:00', 'uye', '', '', '', '0000-00-06', 10, 0, '', 0, 'a', 'a', 'a'),
(899, 'Mehmet', 'Evran', 'Özkanefe', '2311047', 'm_h_t_e_v_r_a_n1991@hotmail.com', '2017-04-19 03:02:27', '0000-00-00 00:00:00', 'uye', '', '', '', '1991-07-07', 10, 0, '', 0, 'a', 'a', 'a'),
(900, 'ali', 'acar', 'ali1453', 'Aliacar70', 'Ali-46-acar70@hotmail.com', '2017-04-19 03:20:02', '0000-00-00 00:00:00', 'uye', '', '', '', '1998-01-10', 11, 0, '', 0, 'a', 'a', 'a'),
(902, 'Uður', 'Günal', 'Vesselam', '5453350553', 'Ugurgunal@msn.com', '2017-04-19 04:44:41', '0000-00-00 00:00:00', 'uye', '', '', '', '0000-00-00', 10, 0, '', 0, 'a', 'a', 'a'),
(903, 'kazým', 'doðan', 'kazým', '19311931+', 'sofdagi_2727@hotmail.com', '2017-04-19 05:25:09', '0000-00-00 00:00:00', 'uye', '', '', '', '1992-03-14', 10, 0, '178.241.143.70', 0, 'a', 'a', 'a'),
(904, 'Halil', 'Yalçýn', 'ihalilyalcn', 's3axo4eyx', 'pohalil@hotmail.com', '2017-04-19 17:13:35', '0000-00-00 00:00:00', 'uye', '', '', '158f72df15cdcb.jpg', '1996-05-01', 1, 0, '', 0, 'a', 'a', 'a');

-- --------------------------------------------------------

--
-- Tablo için tablo yapýsý `users_delete`
--

CREATE TABLE `users_delete` (
  `user_id` int(11) NOT NULL,
  `eski_id` int(11) NOT NULL,
  `user_adi` varchar(255) NOT NULL,
  `user_soyadi` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_kayit_tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_giris_tarih` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_type` enum('uye','yetkili','superAd','editor') NOT NULL,
  `user_ulke` varchar(255) NOT NULL,
  `user_sehir` varchar(255) NOT NULL,
  `user_profil_resim` varchar(100) NOT NULL,
  `user_dogum_tarih` date NOT NULL,
  `user_takipci_sayi` int(11) NOT NULL,
  `user_takip_edilen_sayi` int(11) NOT NULL,
  `user_ip` varchar(255) NOT NULL,
  `user_aktivasyon` int(11) NOT NULL,
  `user_pay_gizle` varchar(1) NOT NULL DEFAULT 'a'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dökümü yapýlmýþ tablolar için indeksler
--

--
-- Tablo için indeksler `bildirimler`
--
ALTER TABLE `bildirimler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `hashtage`
--
ALTER TABLE `hashtage`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `paylasim`
--
ALTER TABLE `paylasim`
  ADD PRIMARY KEY (`paylasim_id`),
  ADD UNIQUE KEY `paylasim_id` (`paylasim_id`);

--
-- Tablo için indeksler `paylasim_begeni`
--
ALTER TABLE `paylasim_begeni`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Tablo için indeksler `paylasim_yorum`
--
ALTER TABLE `paylasim_yorum`
  ADD PRIMARY KEY (`yorum_id`),
  ADD UNIQUE KEY `yorum_id` (`yorum_id`);

--
-- Tablo için indeksler `paylasim_yorum_begeni`
--
ALTER TABLE `paylasim_yorum_begeni`
  ADD PRIMARY KEY (`yorum_bg_id`),
  ADD UNIQUE KEY `yorum_bg_id` (`yorum_bg_id`);

--
-- Tablo için indeksler `sikayet`
--
ALTER TABLE `sikayet`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Tablo için indeksler `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`resim_id`);

--
-- Tablo için indeksler `takip`
--
ALTER TABLE `takip`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Tablo için indeksler `users_delete`
--
ALTER TABLE `users_delete`
  ADD PRIMARY KEY (`user_id`);

--
-- Dökümü yapýlmýþ tablolar için AUTO_INCREMENT deðeri
--

--
-- Tablo için AUTO_INCREMENT deðeri `bildirimler`
--
ALTER TABLE `bildirimler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Tablo için AUTO_INCREMENT deðeri `hashtage`
--
ALTER TABLE `hashtage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT deðeri `paylasim`
--
ALTER TABLE `paylasim`
  MODIFY `paylasim_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Tablo için AUTO_INCREMENT deðeri `paylasim_begeni`
--
ALTER TABLE `paylasim_begeni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT deðeri `paylasim_yorum`
--
ALTER TABLE `paylasim_yorum`
  MODIFY `yorum_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT deðeri `paylasim_yorum_begeni`
--
ALTER TABLE `paylasim_yorum_begeni`
  MODIFY `yorum_bg_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT deðeri `sikayet`
--
ALTER TABLE `sikayet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT deðeri `slider`
--
ALTER TABLE `slider`
  MODIFY `resim_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- Tablo için AUTO_INCREMENT deðeri `takip`
--
ALTER TABLE `takip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Tablo için AUTO_INCREMENT deðeri `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=905;
--
-- Tablo için AUTO_INCREMENT deðeri `users_delete`
--
ALTER TABLE `users_delete`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
