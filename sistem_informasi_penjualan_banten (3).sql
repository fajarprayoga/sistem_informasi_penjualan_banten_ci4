-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2022 at 04:41 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_informasi_penjualan_banten`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_status`) VALUES
(38, 'Pitra Yadnya  ', 'Active'),
(39, 'Manusa Yadnya', 'Active'),
(40, 'Bhuta Yadnya', 'Active'),
(41, 'Dewa Yadnya', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` text NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2020-03-26-173901', 'App\\Database\\Migrations\\Categories', 'default', 'App', 1612152514, 1),
(2, '2020-03-26-174621', 'App\\Database\\Migrations\\Products', 'default', 'App', 1612152514, 1),
(3, '2020-03-26-175618', 'App\\Database\\Migrations\\Transactions', 'default', 'App', 1612152514, 1),
(4, '2020-03-26-180409', 'App\\Database\\Migrations\\Users', 'default', 'App', 1612152514, 1),
(5, '2021-11-04-173901', 'App\\Database\\Migrations\\Sub_category', 'default', 'App', 1636248838, 2),
(6, '2021-11-04-173902', 'App\\Database\\Migrations\\Sub_category', 'default', 'App', 1636287395, 3),
(7, '2021-11-04-173902', 'App\\Database\\Migrations\\Sub_categories_foreign_key', 'default', 'App', 1636287442, 4),
(8, '2021-11-04-174002', 'App\\Database\\Migrations\\Sub_category', 'default', 'App', 1636288190, 5),
(9, '2020-11-21-175901', 'App\\Database\\Migrations\\Categories', 'default', 'App', 1637466471, 6),
(10, '2021-11-21-174003', 'App\\Database\\Migrations\\Sub_category', 'default', 'App', 1637466471, 6),
(11, '2020-11-21-175902', 'App\\Database\\Migrations\\Categories', 'default', 'App', 1637466807, 7),
(12, '2021-11-21-174004', 'App\\Database\\Migrations\\Sub_category', 'default', 'App', 1637466807, 7);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_status` enum('PENDING','CANCEL','PROCESS','SENDING','SUCCESS') NOT NULL DEFAULT 'PENDING',
  `order_description` text DEFAULT NULL,
  `order_destination` text DEFAULT NULL,
  `order_total` decimal(20,0) NOT NULL DEFAULT 0,
  `order_type` enum('Dp','Full') NOT NULL,
  `order_pay_1` decimal(20,0) NOT NULL DEFAULT 0,
  `order_pay_2` decimal(20,0) NOT NULL DEFAULT 0,
  `order_notif` enum('NEW','NOTNEW') NOT NULL DEFAULT 'NEW',
  `order_token` varchar(100) DEFAULT NULL,
  `order_pickup_date` date NOT NULL,
  `created_at` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_status`, `order_description`, `order_destination`, `order_total`, `order_type`, `order_pay_1`, `order_pay_2`, `order_notif`, `order_token`, `order_pickup_date`, `created_at`) VALUES
(27, 1, 'CANCEL', 'cepat ya', 'baha', '200000', 'Dp', '0', '0', 'NEW', 'order27.jpg', '2022-01-13', '2022-01-13'),
(28, 1, 'CANCEL', 'Baha', 'Baha', '200000', 'Dp', '0', '0', 'NEW', NULL, '2022-01-14', '2022-01-14'),
(29, 1, 'CANCEL', 'Mengwi Baha', 'Jalan Mengwi ', '200000', 'Dp', '0', '0', 'NEW', NULL, '2022-01-26', '2022-01-26'),
(30, 72, 'PROCESS', 'tolong disiapkan segera', 'jalan sesetan no 11', '200000', 'Dp', '0', '0', 'NEW', 'order30.jpg', '2022-02-05', '2022-01-26'),
(31, 72, 'CANCEL', 'yang rapi', 'jalan teuku umar no 222', '300000', 'Dp', '0', '0', 'NEW', NULL, '2022-02-02', '2022-01-26'),
(32, 72, 'SUCCESS', 'abscsa', 'jalan nusa kambangan 22', '600000', 'Dp', '0', '0', 'NEW', 'order32.jpg', '2022-02-05', '2022-01-29'),
(33, 72, 'CANCEL', 'cepat', 'jalan nangka 22', '200000', 'Dp', '0', '0', 'NEW', NULL, '2022-02-12', '2022-01-29'),
(34, 72, 'CANCEL', 'ghgghj', 'jalan kuta', '200000', 'Dp', '0', '0', 'NEW', NULL, '2022-01-31', '2022-01-29'),
(35, 73, 'PROCESS', 'mohon di kirim dengan baik', 'jalan raya puputan no 205', '3100000', 'Dp', '0', '0', 'NEW', 'order35.jpg', '2022-02-09', '2022-02-01'),
(36, 73, 'CANCEL', 'mohon di kirim dengan packingan yg rapi', 'jalan raya puputan 202', '4100000', 'Dp', '0', '0', 'NEW', NULL, '2022-05-08', '2022-02-01'),
(37, 72, 'SUCCESS', 'disegerakan', 'jalan teuku umar 100', '2100000', 'Dp', '0', '0', 'NEW', 'order37.jpg', '2022-02-09', '2022-02-01'),
(38, 1, 'CANCEL', 'segerakan', 'jalan sesetan ', '7100000', 'Dp', '0', '0', 'NEW', NULL, '2022-02-10', '2022-02-03'),
(39, 72, 'SUCCESS', 'diantar segera', 'jalan imam bonjol no 101', '5100000', 'Dp', '0', '0', 'NEW', 'order39.jpg', '2022-02-17', '2022-02-10'),
(40, 72, 'SUCCESS', 'jangan terlambat', 'jalan raya kuta no 205', '2100000', 'Dp', '0', '0', 'NEW', 'order40.jpg', '2022-02-18', '2022-02-11'),
(41, 72, 'SENDING', 'dipacking dengan rapi', 'jalan teuku umar no 101', '20100000', 'Dp', '0', '0', 'NEW', 'order41.jpg', '2022-02-21', '2022-02-14'),
(42, 72, 'PENDING', 'dirapikan', 'jalan nangka no 10', '2100000', 'Dp', '0', '0', 'NEW', NULL, '2022-02-21', '2022-02-21'),
(43, 1, 'PENDING', 'ASSA', 'asassaas', '20100000', 'Dp', '1111', '20098889', 'NEW', 'order43.jpg', '2022-03-04', '2022-02-26'),
(44, 1, 'PENDING', 'Mohon banten nya bagus', 'Jl. angasoka ', '20100000', 'Full', '0', '220009090', 'NEW', 'order44.jpg', '2022-03-07', '2022-02-27'),
(45, 1, 'SENDING', 'Mohon di segerakan', 'Jl Angasoka', '20100000', 'Full', '0', '1200000', 'NEW', 'order45.jpg', '2022-03-06', '2022-02-27'),
(46, 1, 'PENDING', 'Ini coba', 'jl baha', '20100000', 'Dp', '100000', '0', 'NEW', 'order46.jpg', '2022-03-13', '2022-03-06'),
(47, 1, 'PENDING', 'Ini Pesan Banten', 'Jl Baha', '20100000', 'Full', '0', '100000', 'NEW', 'order47.jpg', '2022-03-14', '2022-03-07'),
(48, 1, 'PENDING', 'Ini Deskripsi', 'Jl Baha', '20100000', 'Full', '0', '20100000', 'NEW', 'order48.jpg', '2022-03-14', '2022-03-07'),
(49, 1, 'PENDING', 'sDAD', 'ASDASDASD', '10100000', 'Full', '0', '1', 'NEW', 'order49.jpg', '2022-03-14', '2022-03-07'),
(50, 1, 'PENDING', 'scmskdncsdc', 'skdnskdns', '10100000', 'Full', '0', '100000', 'NEW', 'order50.jpg', '2022-03-14', '2022-03-07'),
(51, 1, 'PENDING', 'dgdsf', 'sdfdsfsdf', '10100000', 'Full', '0', '11112121', 'NEW', 'order51.jpg', '2022-03-14', '2022-03-07'),
(52, 1, 'PENDING', 'asdasd', 'asdsad', '2100000', 'Full', '0', '11111', 'NEW', 'order52.jpg', '2022-03-14', '2022-03-07'),
(53, 1, 'PENDING', 'adasdas', 'asdasd', '10100000', 'Full', '0', '10000', 'NEW', 'order53.jpg', '2022-03-23', '2022-03-07'),
(54, 1, 'PENDING', 'wrwrwrw', 'rwerwerwe', '2100000', 'Full', '0', '10000', 'NEW', 'order54.jpg', '2022-03-14', '2022-03-07'),
(55, 1, 'PENDING', 'adasd', 'sadsad', '10100000', 'Full', '0', '1000', 'NEW', 'order55.jpg', '2022-03-14', '2022-03-07'),
(56, 1, 'PENDING', 'asdasd', 'sadsad', '20100000', 'Full', '0', '20100000', 'NEW', 'order56.jpg', '2022-03-14', '2022-03-07'),
(57, 1, 'PENDING', 'sadasd', 'sadasd', '20100000', 'Dp', '10000', '0', 'NEW', 'order57.jpg', '2022-03-14', '2022-03-07'),
(58, 1, 'PENDING', 'DASD', 'SADSADSAD', '20100000', 'Dp', '10000', '0', 'NEW', 'order58.jpg', '2022-03-14', '2022-03-07'),
(59, 1, 'PENDING', 'sadasd', 'sadsadas', '10100000', 'Dp', '10000', '0', 'NEW', 'order59.jpg', '2022-03-15', '2022-03-07'),
(60, 1, 'SUCCESS', 'asdasdas', 'dasdsadsa', '10100000', 'Dp', '10000', '0', 'NEW', 'order60.jpg', '2022-03-15', '2022-03-07'),
(61, 1, 'CANCEL', 'saya ingin dibuatkan bantent baru yang bagus tidak cacat dan mohon segera di lakukan saya tidak menirima namanya terlambat', 'asdsad', '10100000', 'Dp', '100000', '0', 'NEW', 'order61.jpg', '2022-03-14', '2022-03-07');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_detail_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `order_detail_quantity` int(11) NOT NULL,
  `order_detail_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_detail_id`, `order_id`, `product_id`, `order_detail_quantity`, `order_detail_price`) VALUES
(20, 27, 4, 1, 100000),
(21, 28, 7, 1, 100000),
(22, 29, 4, 1, 100000),
(23, 30, 4, 1, 100000),
(24, 31, 5, 1, 200000),
(25, 32, 6, 1, 500000),
(26, 33, 4, 1, 100000),
(27, 34, 4, 1, 100000),
(28, 35, 7, 1, 3000000),
(29, 36, 8, 1, 4000000),
(30, 37, 5, 1, 2000000),
(31, 38, 4, 1, 7000000),
(32, 39, 12, 1, 5000000),
(33, 40, 14, 1, 2000000),
(34, 41, 10, 1, 20000000),
(35, 42, 5, 1, 2000000),
(36, 43, 10, 1, 20000000),
(37, 44, 10, 1, 20000000),
(38, 45, 10, 1, 20000000),
(39, 46, 10, 1, 20000000),
(40, 47, 10, 1, 20000000),
(41, 48, 10, 1, 20000000),
(42, 49, 11, 1, 10000000),
(43, 50, 11, 1, 10000000),
(44, 51, 11, 1, 10000000),
(45, 52, 5, 1, 2000000),
(46, 53, 11, 1, 10000000),
(47, 54, 5, 1, 2000000),
(48, 55, 11, 1, 10000000),
(49, 56, 10, 1, 20000000),
(50, 57, 10, 1, 20000000),
(51, 58, 10, 1, 20000000),
(52, 59, 11, 1, 10000000),
(53, 60, 11, 1, 10000000),
(54, 61, 11, 1, 10000000);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sub_category_id` bigint(20) UNSIGNED NOT NULL DEFAULT 26,
  `product_name` varchar(100) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_sku` varchar(100) NOT NULL,
  `product_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `product_image` text DEFAULT NULL,
  `product_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `category_id`, `sub_category_id`, `product_name`, `product_price`, `product_sku`, `product_status`, `product_image`, `product_description`) VALUES
(4, 39, 26, 'Banten Otonan', 7000000, '204', 'Active', '[\"1643726367_295495057610f1d1ef91.jpg\"]', 'Upacara satu oton atau yang di sebut dengan Otonan ini di lakukan setelah bayi berumur 210 hari, dengan mempergunakan perhitungan pawukon. Upacara ini bertujuan agar segala keburukan dan kesalahan-kesalahan yang mungkin di bawa oleh si bayi dan semasa hidupnya terdahulu dapat di kurangi atau di tebus, sehingga kehidupan yang sekarang benar-benar merupakan kesempatan untuk memperbaiki serta meningkatkan diri untuk mencapai kehidupan yang sempurna. Serangkaian pula dengan Upacara Otonan ini adalah upacara pemotongan rambut yang pertama kali, yang bertujuan untuk membersihkan ubun-ubun ( Ciwa Dwara ).'),
(5, 39, 28, 'Banten Pagedong -  Gedongan', 2000000, '201', 'Active', '[\"1643725876_4085cdb590526ef61f86.jpg\"]', 'Upacara ini bertujuan memohon kehadapan Hyang Widhi agar bayi yang ada di dalam kandungan itu di berkahi kebersihan secara lahir bathin. Demikian pula ibu beserta bayinya ada dalam keadaan selamat dan dikemudian setelah lahir dan dewasa dapat berguna di masyarakat serta dapat memenuhi harapan orang tua. Di samping perlu adanya upacara semasih bayi ada di dalam kan-dungan, agar harapan tersebut dapat berhasil, maka si ibu yang sedang hammil perlu melakukan pantangan-pantangan terhadap perbuatan atau perkataan-perkataan yang kurang baik dan sebaliknya mendengarkan nasehat-nasehat serta membaca membaca buku-buku wiracarita atau buku lain yang mengandung pendidikan yang bersifat positif. Sebab tingkah laku dan kegemaran si ibu di waktu hamil akan mempengaruhi sifat si anak yangmasih di dalam kandungan.'),
(6, 39, 30, 'Banten Metatah atau Potong Gigi', 7000000, '205', 'Active', '[\"Banten Metatah atau Potong Gigi-Banten1.jpg\",\"Banten Metatah atau Potong Gigi-Banten2.jpg\"]', 'Upacara ini dapat di lakukan baik terhadap anak laki-laki maupun anak perempuan yang sudah menginjak dewasa. Dalam Upacara potong gigi ini, maka gigi yang di potong ada 6 ( enam ) buah, yaitu empat buah gigi atas dan dua buah lagi gigi taring atas. Secara rohaniah pemotongan terhadap ke enam gigi tersebut merupakan simbolis untuk mengurangi ke enam sifat Sad Ripu yang sering menyesatkan dam menjerumuskan manusia ke dalam penderitaan atau kesengsaraan. Sifat-sifat Sad Ripu yang di maksud adalah nafsu birahi, kemarahan, keserakahan, kemabukkan, kebingungan dan sifat iri hati.'),
(7, 39, 26, 'Banten 42Hari (Nelung Bulanin)', 3000000, '202', 'Active', '[\"1643726168_6b8a240e01245c3d1d57.jpg\"]', 'Upacara ini disebut juga upacara tutug kambuhan. Pada usia 42 hari bayi di buatkan upacara “ Macolongan “. Tujuannya adalah memohon pembersihan dari segala keletehan ( kekotoran dan noda ), terutama si ibu dan bayinya di beri tirtha pangklutan pabersihan, sehingga si ibu dapat memasuki tempat-tempat suci seperti Pura, Merajan dan sebagainya.'),
(8, 39, 26, 'Banten 3 Bulanan  atau Nyambutin', 4000000, '203', 'Active', '[\"1643726238_51e3ee3460c2ced1bc7c.jpg\"]', 'Upacara Nyambutin ini diadakan setelah bayi tersebut berumur 105 hari. Pada umur ini si bayi telah di anggap suatu permulaan untuk belajar duduk, sehingga di adakan upacara Nyambuitn di sertai dengan upacara “ Tuwun di pane “ dan mandi sebagai penyucia atas kelahirannya di dunia. Upacara ini bertujuan untuk memohon kehadapan Hyang Widhi agar jiwatman si bayi benar-benar kembali kepada raganya.'),
(9, 39, 26, 'Banten Pernikahan atau Pawiwahan', 15000000, '206', 'Active', '[\"1643727145_cf45c7412ee111e4a18a.jpg\"]', 'Upacara perkawinan merupakan suatu persaksian, baik kehadapan Hyang Widhi Wasa maupun kepada mayarakat luas, bahwa kedua mempelai mengikat dan mengikrarkan diri sebagai pasangan suami istri yang sah. Di samping itu, di tinju dari segi rohaniah, upacara perkawinan ini merupakan pembersihan diri terhadap kedua orang mempelai, terutama terhadap benih atau bibit baik laki maupun perempuan ( Sukla dan Swanita ), apabila bertemu agar bebas dari pengaruh-pengaruh buruk sehingga dapat di harapkan atman yang akan menjelma adalah atman yang dapat memberi sinar dan mempunyai kelahiran yang baik dan sempurna. '),
(10, 38, 26, 'Banten Ngaben ', 20000000, '101', 'Active', '[\"1643727698_b226c4d06f15f7f028c9.jpg\"]', 'Upacara ini adalah penyelesaian terhadap jasmani orang yang telah meninggal. Upacara ngaben disebut pula upacara pelebon atau Atiwa-tiwa dan hanya dapat dilakukan satu kali saja terhadap seseorang yang meninggal. Tujuannya adalah untuk mengembalikan unsur-unsur jasmani kepada asalnya yaitu Panca Maha Bhuta yang ada di Bhuana Agung. '),
(11, 38, 26, 'Banten Memukur atau Nyekah', 10000000, '202', 'Active', '[\"1643728808_4c20863bd7bc832481ab.jpg\"]', 'Upacara mamukur adalah kelanjutan dari upacara ngaben dalam keseluruhan cakupan pira yadnya dalam aspek adhyatmika. Tujuannya adalah meningatkan lagi kesucian arwah orang yang telah diabenkan, sehingga sampai ke tingkat dewapitara yang berada dialam dewa atau swarga'),
(12, 41, 26, 'Banten Piodalan', 5000000, '301', 'Active', '[\"1643729808_5120399ad1a2d0d7970b.jpg\"]', 'upacara piodalan merupakan bentuk yadnya, atau pengorbanan secara tulus kepada Ida Sang Hyang Widhi yang dilaksanakan pada hari lahirnya pura/merajan.'),
(13, 40, 26, 'Banten Caru Pengeruak', 4000000, '401', 'Active', '[\"1643893028_3128ea5525509228f773.jpg\"]', 'banten caru pengeruak  yaitu sebagai menetralisir kekuatan-kekuatan yang bersifat buruk, sehingga dapat mencapai keseimbangan, keselarasan dan keserasian antara bhuwana agung dan bhuwana alit.'),
(14, 40, 26, 'Banten Caru Ayam Brumbun', 2500000, '402', 'Active', '[\"1643893437_b62de9777ccaae47c12b.jpg\"]', 'Ritual caru eka sata ayam brumbun  adalah salah satu dari beberapa ritual bhuta yadnya yang dilaksanakan oleh umat Hindu di Bali. Caru ini menggunakan seekor ayam brumbun sebagai sarana kurban persembahan.'),
(15, 40, 26, 'Banten Caru Siap Selem', 2000000, '403', 'Active', '[\"1643895148_ad9eb00841c704301edc.jpg\"]', 'banten ini digunakan untuk menetralisirkan Butha Kala dan umumnya diletakkan di depan pelinggih Bhatara Karang atau di natar pelinggih Batara Karang'),
(16, 39, 26, 'Banten Bayi Baru Lahir', 300000, '207', 'Active', '[\"1643894481_3d698f753e88ffebc4ba.jpg\"]', 'Upacara ini merupakan cetusan rasa gembira dan terima kasih serta angayu Bagia atas kelahirannya si bayi kedunia dan mendoakan agar bayi tetap selamat serta sehat walafiat. Pada saat bayi lahir, yang perlu juga di perhatikan adalah upacara perawatan Ari-ari. Ari-ari ini di cuci dengan air bersih atau air kumkuman, kemudian di masukkan ke dalam sebutir kelapa yang di belah dua dengan Ongkara ( pada bagian atas ) dan Ahkara pada bagian bawah.'),
(17, 39, 26, 'Banten Kepus Puser', 200000, '208', 'Active', '[\"1643894658_036f51ffb8a7c96b5c8e.jpg\"]', 'Upacara ini juga di sebut Upacara Mapanelahan. Setelah puser itu putus maka puser tersebut di bungkus dengan secarik kain, lalu di masukkan ke dalam sebuah tipat kukur yang di sertai dengan bumbu-bumbu dan kemudian tipat tersebut di gantungkan di atas tempat tidur si bayi. Mulai saat inilah si bayi di buatkan Kumara, yaitu tempat memuja Dewa Kumara sebagai pelindung anak-anak.'),
(19, 38, 26, 'Tes', 10000, '100', 'Inactive', '[\"Tes-Banten6.jpg\",\"Tes-Banten7.jpg\"]', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE `rates` (
  `rate_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `rate_star` tinyint(1) NOT NULL DEFAULT -1,
  `rate_review` text NOT NULL,
  `rate_status` tinyint(1) NOT NULL DEFAULT 0,
  `rate_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`rate_id`, `user_id`, `rate_star`, `rate_review`, `rate_status`, `rate_date`) VALUES
(1, 1, 2, 'BURUK', 1, '2022-02-26'),
(2, 74, 4, 'Mantppsss', 1, '2022-03-20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `level` enum('Admin','User') NOT NULL DEFAULT 'Admin',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `phone`, `password`, `email_verified_at`, `status`, `level`, `created_at`) VALUES
(1, 'admin', 'Admin', 'admin@example.com', '082253652552', '$2y$10$5s7CR8jIZOjTKzj59RgiQ.EXWE0NqZGLpUF652UNHZN4cUxRblOUS', NULL, 'Active', 'Admin', '2021-12-03 20:06:07'),
(71, 'nikasa', 'NIKASA', 'nikasa@gmail.com', '082235265301', '$2y$10$Z.GtHZG.mZmYKELZOwz2CebHGvf.xq3ROLXHG14fFbcEFjt0keHd.', NULL, 'Active', 'User', '2021-12-03 20:09:31'),
(72, 'ayusriardiani', 'dekayu', 'ayusriardiani@gmail.com', '85954518033', '$2y$10$/MhEpadHGZrOQJwGmTCaFuwgV0BidoptLplZSxYl/9syTRbOo5Fle', NULL, 'Active', 'User', '2022-01-26 19:15:47'),
(73, 'diraindira', 'indira dewi', 'diraindira@gmail.com', '083467382911', '$2y$10$qz6vH7GAOCAi33/mdbml4eZbReM6dPik4lXX1.r1GhNW40s6AQt1y', NULL, 'Active', 'User', '2022-01-29 20:49:56'),
(74, 'fajar', 'fajar prayoga', 'fajarprayoga23@gmail.com', '082235265301', '$2y$10$5s7CR8jIZOjTKzj59RgiQ.EXWE0NqZGLpUF652UNHZN4cUxRblOUS', NULL, 'Active', 'User', '2022-03-20 11:29:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_sub_category_id_foreign` (`sub_category_id`) USING BTREE;

--
-- Indexes for table `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`rate_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_detail_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
  MODIFY `rate_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
