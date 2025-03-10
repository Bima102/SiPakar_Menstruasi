-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Feb 2025 pada 12.16
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipakar`
--

--
-- Dumping data untuk tabel `aturan`
--

INSERT INTO `aturan` (`id`, `kode_penyakit`, `kode_gejala`, `nilai`) VALUES
(100, 'P01', 'G01', 1.0),
(101, 'P01', 'G02', 1.0),
(102, 'P01', 'G03', 0.6),
(103, 'P01', 'G04', 0.0),
(104, 'P01', 'G05', 0.6),
(105, 'P01', 'G06', 0.0),
(106, 'P01', 'G07', 0.4),
(107, 'P01', 'G08', 0.0),
(108, 'P01', 'G09', 0.0),
(109, 'P01', 'G10', 0.4),
(110, 'P01', 'G11', 0.4),
(111, 'P01', 'G12', 0.0),
(112, 'P01', 'G13', 0.8),
(113, 'P01', 'G14', 1.0),
(114, 'P01', 'G15', 0.4),
(115, 'P01', 'G16', 0.0),
(116, 'P01', 'G17', 0.4),
(117, 'P01', 'G18', 0.4),
(118, 'P01', 'G19', 0.0),
(119, 'P01', 'G20', 0.4),
(120, 'P01', 'G21', 0.4),
(121, 'P01', 'G22', 1.0),
(122, 'P01', 'G23', 0.4),
(123, 'P01', 'G24', 0.0),
(124, 'P01', 'G25', 0.4),
(125, 'P01', 'G26', 0.4),
(126, 'P01', 'G27', 0.0),
(127, 'P01', 'G28', 0.0),
(128, 'P01', 'G29', 0.4),
(129, 'P01', 'G30', 0.6),
(130, 'P01', 'G31', 0.0),
(131, 'P01', 'G32', 0.4),
(132, 'P01', 'G33', 0.0),
(133, 'P01', 'G34', 0.6),
(134, 'P01', 'G35', 0.0),
(135, 'P01', 'G36', 0.6),
(136, 'P01', 'G37', 0.4),
(137, 'P01', 'G38', 0.6),
(138, 'P01', 'G39', 0.6),
(139, 'P01', 'G40', 0.6),
(140, 'P01', 'G41', 0.4),
(141, 'P01', 'G42', 0.6),
(142, 'P01', 'G43', 0.4),
(143, 'P01', 'G44', 0.0),
(144, 'P01', 'G45', 0.6),
(145, 'P01', 'G46', 0.0),
(146, 'P01', 'G47', 0.0),
(147, 'P02', 'G01', 0.0),
(148, 'P02', 'G02', 0.0),
(149, 'P02', 'G03', 0.0),
(150, 'P02', 'G04', 1.0),
(151, 'P02', 'G05', 0.6),
(152, 'P02', 'G06', 0.0),
(153, 'P02', 'G07', 0.4),
(154, 'P02', 'G08', 0.0),
(155, 'P02', 'G09', 0.0),
(156, 'P02', 'G10', 0.4),
(157, 'P02', 'G11', 0.0),
(158, 'P02', 'G12', 1.0),
(159, 'P02', 'G13', 0.0),
(160, 'P02', 'G14', 0.0),
(161, 'P02', 'G15', 0.4),
(162, 'P02', 'G16', 0.6),
(163, 'P02', 'G17', 0.4),
(164, 'P02', 'G18', 0.4),
(165, 'P02', 'G19', 0.0),
(166, 'P02', 'G20', 0.6),
(167, 'P02', 'G21', 0.4),
(168, 'P02', 'G22', 0.0),
(169, 'P02', 'G23', 0.4),
(170, 'P02', 'G24', 0.6),
(171, 'P02', 'G25', 0.0),
(172, 'P02', 'G26', 0.4),
(173, 'P02', 'G27', 0.0),
(174, 'P02', 'G28', 0.0),
(175, 'P02', 'G29', 0.4),
(176, 'P02', 'G30', 0.4),
(177, 'P02', 'G31', 0.0),
(178, 'P02', 'G32', 0.0),
(179, 'P02', 'G33', 0.0),
(180, 'P02', 'G34', 0.0),
(181, 'P02', 'G35', 0.0),
(182, 'P02', 'G36', 0.4),
(183, 'P02', 'G37', 0.0),
(184, 'P02', 'G38', 0.4),
(185, 'P02', 'G39', 0.4),
(186, 'P02', 'G40', 0.0),
(187, 'P02', 'G41', 0.0),
(188, 'P02', 'G42', 0.4),
(189, 'P02', 'G43', 0.0),
(190, 'P02', 'G44', 0.0),
(191, 'P02', 'G45', 0.0),
(192, 'P02', 'G46', 0.0),
(193, 'P02', 'G47', 0.0),
(194, 'P03', 'G01', 0.0),
(195, 'P03', 'G02', 0.6),
(196, 'P03', 'G03', 0.6),
(197, 'P03', 'G04', 0.0),
(198, 'P03', 'G05', 0.6),
(199, 'P03', 'G06', 1.0),
(200, 'P03', 'G07', 0.6),
(201, 'P03', 'G08', 0.0),
(202, 'P03', 'G09', 0.0),
(203, 'P03', 'G10', 0.4),
(204, 'P03', 'G11', 0.0),
(205, 'P03', 'G12', 0.0),
(206, 'P03', 'G13', 0.0),
(207, 'P03', 'G14', 0.6),
(208, 'P03', 'G15', 0.0),
(209, 'P03', 'G16', 0.0),
(210, 'P03', 'G17', 0.4),
(211, 'P03', 'G18', 0.0),
(212, 'P03', 'G19', 0.4),
(213, 'P03', 'G20', 0.4),
(214, 'P03', 'G21', 0.4),
(215, 'P03', 'G22', 0.6),
(216, 'P03', 'G23', 0.4),
(217, 'P03', 'G24', 0.0),
(218, 'P03', 'G25', 0.0),
(219, 'P03', 'G26', 0.4),
(220, 'P03', 'G27', 0.0),
(221, 'P03', 'G28', 0.0),
(222, 'P03', 'G29', 0.4),
(223, 'P03', 'G30', 0.4),
(224, 'P03', 'G31', 0.0),
(225, 'P03', 'G32', 0.0),
(226, 'P03', 'G33', 0.0),
(227, 'P03', 'G34', 0.4),
(228, 'P03', 'G35', 0.0),
(229, 'P03', 'G36', 0.4),
(230, 'P03', 'G37', 0.0),
(231, 'P03', 'G38', 0.4),
(232, 'P03', 'G39', 0.0),
(233, 'P03', 'G40', 0.4),
(234, 'P03', 'G41', 0.4),
(235, 'P03', 'G42', 0.0),
(236, 'P03', 'G43', 0.0),
(237, 'P03', 'G44', 0.0),
(238, 'P03', 'G45', 0.0),
(239, 'P03', 'G46', 0.0),
(240, 'P03', 'G47', 0.0),
(241, 'P04', 'G01', 0.0),
(242, 'P04', 'G02', 0.0),
(243, 'P04', 'G03', 0.0),
(244, 'P04', 'G04', 0.0),
(245, 'P04', 'G05', 0.4),
(246, 'P04', 'G06', 0.0),
(247, 'P04', 'G07', 0.4),
(248, 'P04', 'G08', 1.0),
(249, 'P04', 'G09', 0.0),
(250, 'P04', 'G10', 0.6),
(251, 'P04', 'G11', 0.4),
(252, 'P04', 'G12', 0.8),
(253, 'P04', 'G13', 0.0),
(254, 'P04', 'G14', 0.0),
(255, 'P04', 'G15', 0.0),
(256, 'P04', 'G16', 0.0),
(257, 'P04', 'G17', 0.4),
(258, 'P04', 'G18', 0.0),
(259, 'P04', 'G19', 0.0),
(260, 'P04', 'G20', 0.6),
(261, 'P04', 'G21', 0.4),
(262, 'P04', 'G22', 0.0),
(263, 'P04', 'G23', 0.4),
(264, 'P04', 'G24', 0.8),
(265, 'P04', 'G25', 0.8),
(266, 'P04', 'G26', 0.4),
(267, 'P04', 'G27', 0.0),
(268, 'P04', 'G28', 0.0),
(269, 'P04', 'G29', 0.0),
(270, 'P04', 'G30', 0.0),
(271, 'P04', 'G31', 0.0),
(272, 'P04', 'G32', 0.0),
(273, 'P04', 'G33', 0.0),
(274, 'P04', 'G34', 0.0),
(275, 'P04', 'G35', 0.0),
(276, 'P04', 'G36', 0.0),
(277, 'P04', 'G37', 0.0),
(278, 'P04', 'G38', 0.0),
(279, 'P04', 'G39', 0.0),
(280, 'P04', 'G40', 0.0),
(281, 'P04', 'G41', 0.0),
(282, 'P04', 'G42', 0.0),
(283, 'P04', 'G43', 0.0),
(284, 'P04', 'G44', 0.0),
(285, 'P04', 'G45', 0.0),
(286, 'P04', 'G46', 0.0),
(287, 'P04', 'G47', 0.0),
(288, 'P05', 'G01', 0.0),
(289, 'P05', 'G02', 0.0),
(290, 'P05', 'G03', 0.4),
(291, 'P05', 'G04', 0.0),
(292, 'P05', 'G05', 0.8),
(293, 'P05', 'G06', 0.0),
(294, 'P05', 'G07', 0.6),
(295, 'P05', 'G08', 0.0),
(296, 'P05', 'G09', 1.0),
(297, 'P05', 'G10', 0.6),
(298, 'P05', 'G11', 0.6),
(299, 'P05', 'G12', 0.0),
(300, 'P05', 'G13', 0.0),
(301, 'P05', 'G14', 0.0),
(302, 'P05', 'G15', 0.6),
(303, 'P05', 'G16', 0.4),
(304, 'P05', 'G17', 0.4),
(305, 'P05', 'G18', 0.0),
(306, 'P05', 'G19', 0.0),
(307, 'P05', 'G20', 0.6),
(308, 'P05', 'G21', 0.6),
(309, 'P05', 'G22', 0.0),
(310, 'P05', 'G23', 0.8),
(311, 'P05', 'G24', 0.0),
(312, 'P05', 'G25', 0.0),
(313, 'P05', 'G26', 0.4),
(314, 'P05', 'G27', 0.0),
(315, 'P05', 'G28', 0.0),
(316, 'P05', 'G29', 0.0),
(317, 'P05', 'G30', 0.0),
(318, 'P05', 'G31', 0.6),
(319, 'P05', 'G32', 0.0),
(320, 'P05', 'G33', 0.0),
(321, 'P05', 'G34', 0.6),
(322, 'P05', 'G35', 0.0),
(323, 'P05', 'G36', 0.4),
(324, 'P05', 'G37', 0.4),
(325, 'P05', 'G38', 0.0),
(326, 'P05', 'G39', 0.0),
(327, 'P05', 'G40', 0.4),
(328, 'P05', 'G41', 0.4),
(329, 'P05', 'G42', 0.0),
(330, 'P05', 'G43', 0.0),
(331, 'P05', 'G44', 0.0),
(332, 'P05', 'G45', 0.0),
(333, 'P05', 'G46', 0.0),
(334, 'P05', 'G47', 0.0),
(336, 'P06', 'G14', 0.0),
(337, 'P06', 'G15', 0.0),
(338, 'P06', 'G01', 0.0),
(339, 'P06', 'G02', 0.0),
(340, 'P06', 'G03', 0.4),
(341, 'P06', 'G04', 0.0),
(342, 'P06', 'G05', 0.4),
(343, 'P06', 'G06', 0.0),
(344, 'P06', 'G07', 0.4),
(345, 'P06', 'G08', 0.0),
(346, 'P06', 'G09', 0.0),
(347, 'P06', 'G10', 0.0),
(348, 'P06', 'G11', 0.0),
(349, 'P06', 'G12', 0.0),
(350, 'P06', 'G13', 0.0),
(353, 'P06', 'G16', 0.0),
(354, 'P06', 'G17', 0.6),
(355, 'P06', 'G18', 0.0),
(356, 'P06', 'G19', 1.0),
(357, 'P06', 'G20', 0.0),
(358, 'P06', 'G21', 0.0),
(359, 'P06', 'G22', 0.0),
(360, 'P06', 'G23', 0.4),
(361, 'P06', 'G24', 0.0),
(362, 'P06', 'G25', 0.0),
(363, 'P06', 'G26', 0.8),
(364, 'P06', 'G27', 0.4),
(365, 'P06', 'G28', 0.4),
(366, 'P06', 'G29', 0.0),
(367, 'P06', 'G30', 0.0),
(368, 'P06', 'G31', 0.0),
(369, 'P06', 'G32', 0.0),
(370, 'P06', 'G33', 0.0),
(371, 'P06', 'G34', 0.0),
(372, 'P06', 'G35', 0.0),
(373, 'P06', 'G36', 0.0),
(374, 'P06', 'G37', 0.0),
(375, 'P06', 'G38', 0.0),
(376, 'P06', 'G39', 0.0),
(377, 'P06', 'G40', 0.0),
(378, 'P06', 'G41', 0.4),
(379, 'P06', 'G42', 0.0),
(380, 'P06', 'G43', 0.0),
(381, 'P06', 'G44', 0.0),
(382, 'P06', 'G45', 0.0),
(383, 'P06', 'G46', 0.0),
(384, 'P06', 'G47', 0.0),
(385, 'P07', 'G01', 0.0),
(386, 'P07', 'G02', 0.0),
(387, 'P07', 'G03', 0.0),
(388, 'P07', 'G04', 0.0),
(389, 'P07', 'G05', 0.6),
(390, 'P07', 'G06', 0.0),
(391, 'P07', 'G07', 0.6),
(392, 'P07', 'G08', 0.0),
(393, 'P07', 'G09', 0.0),
(394, 'P07', 'G10', 0.0),
(395, 'P07', 'G11', 0.0),
(396, 'P07', 'G12', 0.0),
(397, 'P07', 'G13', 0.0),
(398, 'P07', 'G14', 0.8),
(399, 'P07', 'G15', 0.0),
(400, 'P07', 'G16', 0.0),
(401, 'P07', 'G17', 0.4),
(402, 'P07', 'G18', 0.4),
(403, 'P07', 'G19', 1.0),
(404, 'P07', 'G20', 0.0),
(405, 'P07', 'G21', 0.4),
(406, 'P07', 'G22', 0.8),
(407, 'P07', 'G23', 0.4),
(408, 'P07', 'G24', 0.0),
(409, 'P07', 'G25', 0.0),
(410, 'P07', 'G26', 0.4),
(411, 'P07', 'G27', 0.0),
(412, 'P07', 'G28', 0.0),
(413, 'P07', 'G29', 0.4),
(414, 'P07', 'G30', 0.6),
(415, 'P07', 'G31', 0.0),
(416, 'P07', 'G32', 0.4),
(417, 'P07', 'G33', 0.0),
(418, 'P07', 'G34', 0.0),
(419, 'P07', 'G35', 0.0),
(420, 'P07', 'G36', 0.6),
(421, 'P07', 'G37', 0.0),
(422, 'P07', 'G38', 0.4),
(423, 'P07', 'G39', 0.0),
(424, 'P07', 'G40', 0.0),
(425, 'P07', 'G41', 0.4),
(426, 'P07', 'G42', 0.0),
(427, 'P07', 'G43', 0.0),
(428, 'P07', 'G44', 0.0),
(429, 'P07', 'G45', 0.0),
(430, 'P07', 'G46', 0.0),
(431, 'P07', 'G47', 0.0),
(432, 'P08', 'G01', 0.0),
(433, 'P08', 'G02', 0.0),
(434, 'P08', 'G03', 1.0),
(435, 'P08', 'G04', 0.0),
(436, 'P08', 'G05', 0.6),
(437, 'P08', 'G06', 0.0),
(438, 'P08', 'G07', 0.0),
(439, 'P08', 'G08', 0.0),
(440, 'P08', 'G09', 0.0),
(441, 'P08', 'G10', 0.0),
(442, 'P08', 'G11', 0.0),
(443, 'P08', 'G12', 0.0),
(444, 'P08', 'G13', 0.0),
(445, 'P08', 'G14', 0.0),
(446, 'P08', 'G15', 0.0),
(447, 'P08', 'G16', 0.4),
(448, 'P08', 'G17', 0.0),
(449, 'P08', 'G18', 0.4),
(450, 'P08', 'G19', 0.0),
(451, 'P08', 'G20', 0.0),
(452, 'P08', 'G21', 0.0),
(453, 'P08', 'G22', 0.0),
(454, 'P08', 'G23', 0.0),
(455, 'P08', 'G24', 0.0),
(456, 'P08', 'G25', 0.0),
(457, 'P08', 'G26', 0.0),
(458, 'P08', 'G27', 0.0),
(459, 'P08', 'G28', 0.0),
(460, 'P08', 'G29', 0.0),
(461, 'P08', 'G30', 0.0),
(462, 'P08', 'G31', 0.0),
(463, 'P08', 'G32', 0.0),
(464, 'P08', 'G33', 0.4),
(465, 'P08', 'G34', 0.8),
(466, 'P08', 'G35', 0.6),
(467, 'P08', 'G36', 0.8),
(468, 'P08', 'G37', 0.6),
(469, 'P08', 'G38', 0.6),
(470, 'P08', 'G39', 0.0),
(471, 'P08', 'G40', 0.8),
(472, 'P08', 'G41', 0.6),
(473, 'P08', 'G42', 0.0),
(474, 'P08', 'G43', 0.0),
(475, 'P08', 'G44', 0.0),
(476, 'P08', 'G45', 0.0),
(477, 'P08', 'G46', 0.0),
(478, 'P08', 'G47', 0.0),
(479, 'P09', 'G01', 0.0),
(480, 'P09', 'G02', 0.0),
(481, 'P09', 'G03', 0.0),
(482, 'P09', 'G04', 0.0),
(483, 'P09', 'G05', 0.8),
(484, 'P09', 'G06', 0.0),
(485, 'P09', 'G07', 0.6),
(486, 'P09', 'G08', 0.0),
(487, 'P09', 'G09', 0.0),
(488, 'P09', 'G10', 0.4),
(489, 'P09', 'G11', 0.0),
(490, 'P09', 'G12', 0.0),
(491, 'P09', 'G13', 0.0),
(492, 'P09', 'G14', 0.0),
(493, 'P09', 'G15', 0.0),
(494, 'P09', 'G16', 0.0),
(495, 'P09', 'G17', 0.0),
(496, 'P09', 'G18', 0.0),
(497, 'P09', 'G19', 0.0),
(498, 'P09', 'G20', 0.0),
(499, 'P09', 'G21', 0.0),
(500, 'P09', 'G22', 0.0),
(501, 'P09', 'G23', 0.0),
(502, 'P09', 'G24', 0.0),
(503, 'P09', 'G25', 0.0),
(504, 'P09', 'G26', 0.0),
(505, 'P09', 'G27', 0.0),
(506, 'P09', 'G28', 0.0),
(507, 'P09', 'G29', 0.0),
(508, 'P09', 'G30', 0.8),
(509, 'P09', 'G31', 0.0),
(510, 'P09', 'G32', 0.0),
(511, 'P09', 'G33', 0.4),
(512, 'P09', 'G34', 0.0),
(513, 'P09', 'G35', 0.0),
(514, 'P09', 'G36', 0.8),
(515, 'P09', 'G37', 0.0),
(516, 'P09', 'G38', 0.8),
(517, 'P09', 'G39', 0.8),
(518, 'P09', 'G40', 0.8),
(519, 'P09', 'G41', 0.8),
(520, 'P09', 'G42', 0.8),
(521, 'P09', 'G43', 0.6),
(522, 'P09', 'G44', 0.0),
(523, 'P09', 'G45', 0.0),
(524, 'P09', 'G46', 0.0),
(525, 'P09', 'G47', 0.0),
(526, 'P10', 'G01', 0.0),
(527, 'P10', 'G02', 0.0),
(528, 'P10', 'G03', 0.0),
(529, 'P10', 'G04', 0.0),
(530, 'P10', 'G05', 0.8),
(531, 'P10', 'G06', 0.0),
(532, 'P10', 'G07', 0.6),
(533, 'P10', 'G08', 0.0),
(534, 'P10', 'G09', 0.6),
(535, 'P10', 'G10', 0.0),
(536, 'P10', 'G11', 0.0),
(537, 'P10', 'G12', 0.0),
(538, 'P10', 'G13', 0.0),
(539, 'P10', 'G14', 0.0),
(540, 'P10', 'G15', 0.0),
(541, 'P10', 'G16', 0.4),
(542, 'P10', 'G17', 0.0),
(543, 'P10', 'G18', 0.4),
(544, 'P10', 'G19', 0.0),
(545, 'P10', 'G20', 0.0),
(546, 'P10', 'G21', 0.8),
(547, 'P10', 'G22', 0.0),
(548, 'P10', 'G23', 0.0),
(549, 'P10', 'G24', 0.0),
(550, 'P10', 'G25', 0.4),
(551, 'P10', 'G26', 0.0),
(552, 'P10', 'G27', 0.0),
(553, 'P10', 'G28', 0.0),
(554, 'P10', 'G29', 0.0),
(555, 'P10', 'G30', 0.0),
(556, 'P10', 'G31', 0.0),
(557, 'P10', 'G32', 0.0),
(558, 'P10', 'G33', 0.0),
(559, 'P10', 'G34', 0.0),
(560, 'P10', 'G35', 0.0),
(561, 'P10', 'G36', 0.8),
(562, 'P10', 'G37', 0.0),
(563, 'P10', 'G38', 0.0),
(564, 'P10', 'G39', 0.4),
(565, 'P10', 'G40', 0.0),
(566, 'P10', 'G41', 0.0),
(567, 'P10', 'G42', 0.6),
(568, 'P10', 'G43', 0.0),
(569, 'P10', 'G44', 0.8),
(570, 'P10', 'G45', 0.0),
(571, 'P10', 'G46', 0.8),
(572, 'P10', 'G47', 0.8);

--
-- Dumping data untuk tabel `diagnosa`
--

INSERT INTO `diagnosa` (`id_diagnosa`, `kode_user`, `kode_penyakit`, `total_bobot`, `gejala_pilih`, `created_at`) VALUES
(1, '', 'P09', 0.08, '[\"G39\"]', '2025-02-24 00:27:01'),
(2, '', 'P01', 0, '[\"G29\",\"G30\",\"G31\"]', '2025-02-24 00:32:04'),
(3, '', 'P08', 0.0192, '[\"G33\",\"G34\",\"G35\"]', '2025-02-24 00:36:03'),
(4, '', 'P01', 0, '[\"G01\",\"G15\",\"G35\"]', '2025-02-24 01:10:03'),
(5, '', 'P01', 0.016, '[\"G01\",\"G02\",\"G21\",\"G23\"]', '2025-02-24 01:17:31'),
(6, '', 'P01', 0, '[\"G01\",\"G02\",\"G06\",\"G40\",\"G41\"]', '2025-02-24 01:18:14'),
(7, '', 'P01', 0, '[\"G02\",\"G11\",\"G12\"]', '2025-02-24 01:43:47'),
(8, '', 'P01', 0, '[\"G01\",\"G02\",\"G11\",\"G12\",\"G33\",\"G34\"]', '2025-02-24 02:40:25'),
(9, '', 'P01', 0.032, '[\"G13\",\"G14\",\"G41\"]', '2025-02-24 09:43:24'),
(10, '', 'P01', 0, '[\"G01\",\"G08\",\"G18\"]', '2025-02-24 13:15:15'),
(11, '', 'P01', 0.1, '[\"G01\",\"G02\"]', '2025-02-24 14:15:15'),
(12, '', 'P01', 0, '[\"G04\",\"G05\",\"G06\",\"G42\",\"G43\"]', '2025-02-24 17:32:50'),
(13, '', 'P01', 0, '[\"G04\",\"G05\",\"G06\",\"G42\",\"G43\"]', '2025-02-24 17:36:12');

--
-- Dumping data untuk tabel `gejala`
--

INSERT INTO `gejala` (`kode_gejala`, `nama_gejala`) VALUES
('G01', 'Perdarahan haid lebih lama dari normal (lebih dari 7 hari)'),
('G02', 'Darah haid keluar berlebihan'),
('G03', 'Nyeri atau kram pada bagian bawah perut'),
('G04', 'Perdarahan haid lebih pendek dari normal (kurang dari 3 hari)'),
('G05', 'Mengalami gangguan hormonal'),
('G06', 'Siklus haid lebih pendek dari normal (kurang dari 21 hari)'),
('G07', 'Mengalami stres mental, depresi atau stres fisik'),
('G08', 'Siklus haid lebih panjang dari normal (lebih dari 35 hari)'),
('G09', 'Pernah mengalami haid namun berhenti berturut-turut selama beberapa bulan'),
('G10', 'Mengalami gangguan gizi/nutrisi'),
('G11', 'Kehilangan nafsu makan'),
('G12', 'Darah haid keluar sedikit'),
('G13', 'Siklus haid berjalan normal'),
('G14', 'Sering mengganti pembalut per harinya'),
('G15', 'Lemak pada tubuh rendah (kurus)'),
('G16', 'Mempunyai penyakit keturunan'),
('G17', 'Memakai kontrasepsi darurat'),
('G18', 'Mengalami kelelahan'),
('G19', 'Terjadinya perdarahan diluar masa haid'),
('G20', 'Mempunyai penyakit kronis'),
('G21', 'Obesitas'),
('G22', 'Gumpalan darah yang dikeluarkan lebih besar dari biasanya'),
('G23', 'Memakai obat tertentu (seperti KB)'),
('G24', 'Mengalami haid hanya 8-9 kali dalam setahun'),
('G25', 'Keluarnya darah haid tidak teratur'),
('G26', 'Sedang mengubah pemakaian obat'),
('G27', 'Kelainan pada vagina'),
('G28', 'Cedera pada vagina'),
('G29', 'Sering kesemutan'),
('G30', 'Sulit untuk konsentrasi'),
('G31', 'Sedang mengalami kehamilan'),
('G32', 'Suhu tubuh turun'),
('G33', 'Mengalami diare'),
('G34', 'Sering mual dan muntah'),
('G35', 'Sensitif terhadap suara dan cahaya'),
('G36', 'Pusing atau sakit kepala'),
('G37', 'Sakit punggung'),
('G38', 'Sering merasa cemas'),
('G39', 'Susah tidur'),
('G40', 'Sakit perut'),
('G41', 'Sakit pada payudara'),
('G42', 'Suasana hati cepat berubah'),
('G43', 'Kelaparan berlebihan'),
('G44', 'Pertumbuhan rambut yang tidak diinginkan'),
('G45', 'Sesak nafas'),
('G46', 'Rambut pada kepala menipis'),
('G47', 'Jerawatan');

--
-- Dumping data untuk tabel `penyakit`
--

INSERT INTO `penyakit` (`kode_penyakit`, `nama_penyakit`, `bobot`, `keterangan`) VALUES
('P01', 'Menoragia/Hipermenorea', 0.8, 'Menoragia atau Hipermenorea adalah siklus menstruasi yang tidak normal dengan perdarahan berlebihan.'),
('P02', 'Hipomenorea', 0.3, 'Hipomenorea adalah perdarahan menstruasi dengan jumlah yang lebih sedikit dari normal.'),
('P03', 'Polimenorea', 0.8, 'Polimenorea adalah kondisi di mana siklus menstruasi terjadi lebih sering dari biasanya.'),
('P04', 'Oligomenorea', 0.3, 'Oligomenorea adalah haid dengan siklus yang lebih panjang dari normal atau jarang terjadi.'),
('P05', 'Amenorea', 0.8, 'Amenorea adalah kondisi di mana seorang wanita berhenti mengalami menstruasi.'),
('P06', 'Metroragia', 0.8, 'Metroragia biasa disebut dengan perdarahan intermenstrual yang terjadi di antara siklus haid.'),
('P07', 'Menometroragia', 1.0, 'Menometroragia adalah gangguan perdarahan di luar siklus menstruasi yang berlebihan.'),
('P08', 'Dismenorea', 0.8, 'Dismenorea adalah nyeri saat haid, biasanya dengan kram perut yang parah.'),
('P09', 'Sindroma Prahaid (PMS)', 0.3, 'PMS merupakan sindroma atau kumpulan berbagai keluhan fisik dan emosional sebelum menstruasi.'),
('P10', 'PCOS', 0.8, 'Polycystic Ovary Syndrome atau sering disebut dengan PCOS adalah gangguan hormonal yang umum pada wanita.');

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `kode_user`, `nama`, `email`, `password`, `role`, `created_at`) VALUES
(1, '1', 'Administrator', 'admin@gmail.com', 'admin123', 'admin', '2025-02-22 20:16:27'),
(5, '2', 'admin1', 'admin1@gmail.com', '123456', 'user', '2025-02-23 05:47:51'),
(6, '', 'bidan susan', 'bidansusan@gmail.com', '123456', 'user', '2025-02-23 19:05:32');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
