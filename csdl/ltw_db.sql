-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2025 at 11:38 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ltw_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `recipient_name` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `city_id` varchar(10) NOT NULL,
  `district_id` varchar(10) NOT NULL,
  `ward_id` varchar(10) NOT NULL,
  `city_name` varchar(50) NOT NULL,
  `district_name` varchar(50) NOT NULL,
  `ward_name` varchar(50) NOT NULL,
  `specific_address` varchar(255) NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`, `created_at`) VALUES
(32, '7wQqspCp17I9Ia1pPOci', '2xrHRGMwIhCAIDlBkVAd', 2, '2025-05-10 23:13:45'),
(33, '7wQqspCp17I9Ia1pPOci', 'Dp41sOFXYfPRuRjBtYaf', 1, '2025-05-10 23:16:20'),
(34, '7wQqspCp17I9Ia1pPOci', 'wwmQr6vTqu0Kns1FWBJw', 1, '2025-05-11 06:49:22');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(255) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `shipping_cost` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL DEFAULT 'COD',
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending',
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `email`, `phone`, `address`, `total_price`, `shipping_cost`, `payment_method`, `payment_status`, `order_date`, `status`) VALUES
('17458535968448', '7wQqspCp17I9Ia1pPOci', 'Duc Khoiii', 'pardox2k4@gmail.com', '0988835895', 'ngõ 173 thôn cuối chùa, 10006, 276, 01, Việt Nam', 35640000.00, 0.00, 'COD', 'pending', '2025-04-28 15:19:56', 'cancelled'),
('17458820827624', '7wQqspCp17I9Ia1pPOci', 'Duc Khoiii', 'pardox2k4@gmail.com', '0988835895', 'ngõ 173 thôn cuối chùa, 10006, 276, 01, Việt Nam', 6626000.00, 0.00, 'COD', 'pending', '2025-04-28 23:14:42', 'cancelled'),
('17458869501853', '7wQqspCp17I9Ia1pPOci', 'Duc Khoiii', 'pardox2k4@gmail.com', '0988835895', 'ngõ 173 thôn cuối chùa, 00592, 019, 01, Việt Nam', 3240000.00, 0.00, 'COD', 'pending', '2025-04-29 00:35:50', 'cancelled'),
('17465556691535', '7wQqspCp17I9Ia1pPOci', 'Duc Khoiii', 'pardox2k4@gmail.com', '0988835895', 'ngõ 173 thôn cuối chùa, Xã Quang Trung, Huyện Thạch Thất, Thành phố Hà Nội, Việt Nam', 3240000.00, 0.00, 'COD', 'pending', '2025-05-06 18:21:09', 'cancelled'),
('17465571126841', '7wQqspCp17I9Ia1pPOci', 'minh hoang', 'pardox2k4@gmail.com', '09874747888', 'ngõ 173 thôn cuối chùa, Phường Vĩnh Trại, Thành phố Lạng Sơn, Tỉnh Lạng Sơn, Việt Nam', 37398000.00, 0.00, 'COD', 'pending', '2025-05-06 18:45:12', 'cancelled'),
('17465585976914', '7wQqspCp17I9Ia1pPOci', 'minh hoang', 'pardox2k4@gmail.com', '0987474793', '207/7 bùi xương trạch, Phường Khương Đình, Quận Thanh Xuân, Thành phố Hà Nội, Việt Nam', 724000.00, 0.00, 'COD', 'pending', '2025-05-06 19:09:57', 'cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` varchar(20) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, '17452828949294', '2xrHRGMwIhCAIDlBkVAd', 1, 3240000.00),
(2, '17452828949294', 'Dp41sOFXYfPRuRjBtYaf', 1, 724000.00),
(3, '17452832113948', '2xrHRGMwIhCAIDlBkVAd', 1, 3240000.00),
(4, '17452832113948', 'GM1Yp8aYZx7zynLzhYDD', 2, 1950000.00),
(5, '17458515836388', 'Dp41sOFXYfPRuRjBtYaf', 1, 724000.00),
(6, '17458515836388', '2xrHRGMwIhCAIDlBkVAd', 1, 3240000.00),
(7, '17458535968448', '2xrHRGMwIhCAIDlBkVAd', 11, 3240000.00),
(8, '17458820827624', 'GM1Yp8aYZx7zynLzhYDD', 1, 1950000.00),
(9, '17458820827624', 'lnRviOvq9X5Q7JbKcYkx', 1, 2220000.00),
(10, '17458820827624', 'M3YwJ60znqyJeHjJurzm', 1, 2456000.00),
(11, '17458869501853', '2xrHRGMwIhCAIDlBkVAd', 1, 3240000.00),
(12, '17465556691535', '2xrHRGMwIhCAIDlBkVAd', 1, 3240000.00),
(13, '17465571126841', '7FYUy8Zf5rQcaM6hi2bu', 1, 37398000.00),
(14, '17465585976914', 'Dp41sOFXYfPRuRjBtYaf', 1, 724000.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` varchar(20) NOT NULL,
  `vendor_id` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `image` varchar(100) NOT NULL,
  `stock` int(100) NOT NULL,
  `product_detail` varchar(1000) NOT NULL,
  `status` varchar(100) NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `vendor_id`, `name`, `price`, `image`, `stock`, `product_detail`, `status`, `category`) VALUES
('2xrHRGMwIhCAIDlBkVAd', 'ezqlEEnkQyaIGBvBVPcM', 'Nhẫn hoa đá peridot và đá topaz trắng', 3240000, 'flora_ring.jpg', 5, 'Giới thiệu chiếc nhẫn hoa đá peridot và topaz trắng tinh xảo của chúng tôi, một kiệt tác thực sự của sự thanh lịch và vẻ đẹp. Chiếc nhẫn nổi bật với viên đá peridot faceted lớn ở trung tâm, được bao quanh bởi một vòng tròn đá topaz trắng lấp lánh.&#13;&#10;&#13;&#10;Thiết kế lá cây tinh xảo ôm lấy viên đá peridot hình hoa, mang đến một nét duyên dáng đầy cảm hứng từ thiên nhiên cho món trang sức bạc sterling này. Với màu xanh rực rỡ của peridot và vẻ lấp lánh của topaz trắng, chiếc nhẫn này là sự lựa chọn hoàn hảo cho những ai tìm kiếm một phụ kiện độc đáo và tinh tế.', 'active', 'ring'),
('6fC2gKgyrC1bvQoZCG4M', 'ezqlEEnkQyaIGBvBVPcM', 'Bông tai ngọc trai nuôi cấy hình cỏ 4 lá và đá CZ', 3460000, 'Product-4.jpg', 5, 'Giới thiệu đôi **bông tai ngọc trai nuôi cấy hình cỏ 4 lá và đá CZ** tinh xảo của chúng tôi, biểu tượng của sự thanh lịch và tinh tế. Được chế tác từ ngọc trai nước ngọt nuôi cấy 10mm, đôi bông tai này nổi bật với thiết kế hình cỏ 4 lá, mang đến một vẻ đẹp mềm mại và cuốn hút.  &#13;&#10;&#13;&#10;Các đường viền đá cubic zirconia xung quanh ngọc trai tạo ra hiệu ứng lấp lánh mê hoặc, khiến đôi bông tai này trở thành lựa chọn hoàn hảo cho bất kỳ dịp đặc biệt nào hoặc như một món quà vĩnh cửu.  &#13;&#10;&#13;&#10;Nâng tầm phong cách của bạn với đôi bông tai ngọc trai nuôi cấy hình cỏ 4 lá và đá CZ này, và cảm nhận vẻ đẹp mà chúng mang lại cho mọi trang phục.', 'active', 'earring'),
('7FYUy8Zf5rQcaM6hi2bu', 'ezqlEEnkQyaIGBvBVPcM', 'Vòng cổ ngọc trai nước ngọt hình hoa', 37398000, 'flora_necklace.jpg', 5, 'Vòng cổ ngọc trai South Sea hình hoa này nổi bật với thiết kế hoa ngọc trai tuyệt đẹp. Kích thước ngọc trai dao động từ 12mm đến 13mm, kết hợp với đá cubic zirconia lấp lánh tạo nên một chiếc vòng cổ sang trọng và ấn tượng.', 'active', 'necklace'),
('7PST7rCWkZ9hvktr4wSJ', 'ezqlEEnkQyaIGBvBVPcM', 'Vòng cổ ngọc trai và hạt onyx đen', 4896000, 'black_necklace.jpg', 5, 'Vòng cổ ngọc trai và hạt onyx đen này nổi bật với ngọc trai nước ngọt nuôi cấy kết hợp cùng các hạt onyx đen và bạc sterling 925.&#13;&#10;&#13;&#10;Sự kết hợp giữa ngọc trai trắng và hạt onyx đen tạo nên một thiết kế sang trọng và đầy ấn tượng.', 'active', 'necklace'),
('8uSgg2pZkY7JGCR4lk8q', 'ezqlEEnkQyaIGBvBVPcM', 'Dây chuyền ngọc trai baroque hình nhụy hoa', 1720000, 'pearl_neckchain.jpg', 5, 'Dây chuyền ngọc trai baroque hình nhụy hoa nổi bật với viên ngọc trai baroque cỡ lớn kết hợp cùng bạc sterling cao cấp.&#13;&#10;&#13;&#10;Thiết kế nhụy hoa được tô điểm bằng đá cubic zirconia mang lại hiệu ứng lấp lánh rực rỡ, tạo nên một món trang sức vừa độc đáo vừa tinh tế.&#13;&#10;&#13;&#10;Phụ kiện lý tưởng để tôn lên vẻ đẹp thanh lịch và cuốn hút cho mọi phong cách.', 'active', 'chain'),
('Dp41sOFXYfPRuRjBtYaf', 'ezqlEEnkQyaIGBvBVPcM', 'Nhẫn ngọc trai bạc hoa sen', 724000, 'lotus_ring.jpg', 10, 'Giới thiệu một kiệt tác toát lên vẻ thanh lịch và duyên dáng – Nhẫn ngọc trai bạc hoa sen được điểm xuyết bởi viên ngọc trai trắng nuôi cấy óng ánh. Được chế tác từ bạc sterling chất lượng cao nhất, chiếc nhẫn này có vẻ ngoài tỏa sáng rực rỡ, làm tôn lên vẻ đẹp tự nhiên và thanh thoát của nó.', 'active', 'ring'),
('GM1Yp8aYZx7zynLzhYDD', 'ezqlEEnkQyaIGBvBVPcM', 'Dây chuyền ngọc trai quấn dây rối nghệ thuật', 1950000, 'pearl_neckchain2.jpg', 5, 'Dây chuyền ngọc trai quấn dây rối nghệ thuật có một viên ngọc trai baroque cỡ lớn và bạc sterling được quấn trong thiết kế dây', 'active', 'chain'),
('iLkvpfHeVD3AXDBEjkqd', 'ezqlEEnkQyaIGBvBVPcM', 'Nhẫn nho bằng bạc sterling đá tourmaline', 1970000, 'grape_ring.jpg', 10, 'Chiếc nhẫn nho bằng bạc sterling đá tourmaline tinh xảo này nổi bật với cụm đá tourmaline hình dáng marquise (thon dài) đủ màu sắc, được sắp xếp một cách tinh tế để tượng trưng cho chùm nho.&#13;&#10;&#13;&#10;Mỗi viên đá tourmaline đều được lựa chọn kỹ lưỡng dựa trên màu sắc rực rỡ và độ trong suốt, tạo nên một món trang sức lộng lẫy và thu hút ánh nhìn.&#13;&#10;&#13;&#10;Chiếc nhẫn này là lựa chọn hoàn hảo cho những ai yêu thích thiết kế trang sức độc đáo, nghệ thuật, cũng như những người trân trọng vẻ đẹp của thiên nhiên và các loại đá quý.', 'active', ''),
('Ipl6JH6Tadubka0HYf5E', 'ezqlEEnkQyaIGBvBVPcM', 'Bông tai ngọc trai hoa bạc mờ', 1734000, 'matte_earrings.jpg', 8, 'Bông tai ngọc trai hoa bạc mờ này nổi bật với ngọc trai nuôi cấy hình giọt nước và bạc sterling mờ. Thiết kế hoa bao phủ viên ngọc trai tinh xảo phía dưới mang lại vẻ đẹp thanh lịch và tinh tế.', 'active', 'earring'),
('K8mjriEGCRzxW23f1AlF', 'ezqlEEnkQyaIGBvBVPcM', 'Vòng cổ ngọc trai nước ngọt màu đào với mặt dây treo bên', 6217000, 'peach_necklace.jpg', 5, 'Vòng cổ ngọc trai nước ngọt màu đào với mặt dây treo bên làm nổi bật vẻ đẹp và màu sắc đặc biệt của ngọc trai nước ngọt nuôi cấy. Chỉ có ngọc trai nước ngọt nuôi cấy mới có thể mang đến màu sắc độc đáo này trong tông màu đào.&#13;&#10;&#13;&#10;Hãy bỏ lại sự nhàm chán, chiếc vòng cổ ngọc trai đơn giản này còn có mặt dây treo bên với đá cubic zirconia trắng lấp lánh, tạo thêm sự sang trọng và tinh tế cho thiết kế.', 'active', 'necklace'),
('khA4UmN3y9engTbJ6Pn1', 'ezqlEEnkQyaIGBvBVPcM', 'Bông tai ngọc trai kiểu vòng ôm sát', 3967000, 'hoop_earrings.jpg', 6, 'Bông tai ngọc trai kiểu huggie hoop này nổi bật với ngọc trai trắng nuôi cấy và bạc sterling. Kích thước nhỏ nhắn của ngọc trai cùng thiết kế huggie hoop làm cho chiếc bông tai trở nên tinh tế và dễ thương.', 'active', 'earring'),
('lnRviOvq9X5Q7JbKcYkx', 'ezqlEEnkQyaIGBvBVPcM', 'Dây chuyền ngọc trai thả dáng chuồn chuồn', 2220000, 'dragonfly_neckchain.jpg', 5, 'Dây chuyền ngọc trai thả dáng chuồn chuồn này nổi bật với ngọc trai nuôi cấy và bạc sterling. Đặc biệt, hình dáng chuồn chuồn làm từ vỏ mẹ (mother of pearl) là điểm nhấn trung tâm của chiếc dây chuyền, tạo nên vẻ đẹp tinh tế và sang trọng.', 'active', 'chain'),
('M3YwJ60znqyJeHjJurzm', 'ezqlEEnkQyaIGBvBVPcM', 'Nhẫn ngọc trai nuôi cấy ba bông hoa', 2456000, 'flower_ring.jpg', 4, 'Giới thiệu Nhẫn ngọc trai nuôi cấy ba hoa tinh xảo của chúng tôi, một biểu tượng đích thực của sự thanh lịch và duyên dáng. Mẫu nhẫn tuyệt đẹp này có thiết kế hoa với bốn cánh và nhụy ngọc trai óng ánh, tỏa ra vẻ đẹp vượt thời gian.&#13;&#10;&#13;&#10;Được chế tác từ ngọc trai nước ngọt nuôi cấy, chiếc nhẫn nhẹ nhàng này thể hiện một thiết kế trang sức tinh tế và thanh nhã, chắc chắn sẽ thu hút trái tim của mọi người.', 'active', 'ring'),
('Q66QSzq6BymzL4xXDUZf', 'ezqlEEnkQyaIGBvBVPcM', 'Nhẫn ngọc trai bạc uốn lượn ba chiều', 1530000, 'deformed_ring.jpg', 6, 'Nhẫn ngọc trai bạc biến dạng này nổi bật với ngọc trai nuôi cấy và bạc sterling. Thiết kế biến dạng độc đáo làm cho chiếc nhẫn này trở nên độc lạ và thời trang.', 'active', 'ring'),
('qpQeyaxL80q9yZJlAlRi', 'ezqlEEnkQyaIGBvBVPcM', 'Vòng cổ ngọc trai Tahitian hoàng gia đen', 5168000, 'dark_royal_necklace.jpg', 5, 'Vòng cổ ngọc trai Tahitian hoàng gia đen này nổi bật với 7 viên ngọc trai Tahitian cỡ lớn có màu đen xám đậm. Thiết kế sóng nhẹ kết hợp với đá cubic zirconia và bạc sterling làm tăng vẻ thanh lịch và sang trọng cho chiếc vòng cổ.&#13;&#10;&#13;&#10;Kích thước ngọc trai: 10,3-11,4mm.', 'active', 'necklace'),
('sm6RfCtQrTsx1Q7XyCSE', 'ezqlEEnkQyaIGBvBVPcM', 'Bông tai bạc sterling hình con ong mật', 1970000, 'Product-3.jpg', 5, 'Thưởng thức sự thanh lịch tuyệt vời của đôi bông tai bạc sterling hình con ong mật quyến rũ này. Được chế tác tỉ mỉ từ bạc sterling cao cấp nhất, đôi bông tai tinh xảo này nổi bật với sự kết hợp duyên dáng giữa bạc bóng và bạc mờ, tạo ra sự tương phản tuyệt đẹp cho từng phần của con ong.&#13;&#10;&#13;&#10;Mang bạn vào thế giới thiên nhiên huyền bí, đôi bông tai này thể hiện vẻ đẹp rực rỡ của con ong mật, biểu tượng cho bản chất đáng yêu và tinh tế của nó.&#13;&#10;&#13;&#10;Hãy trang trí đôi tai của bạn với phụ kiện tuyệt vời này và để sự quyến rũ của nó làm sáng bừng mọi trang phục.', 'active', 'earring'),
('Tdv4X2tXhT1mniKWQmVd', 'ezqlEEnkQyaIGBvBVPcM', 'Dây chuyền ngọc trai hoa bạc mờ', 1950000, 'matte_neckchain.jpg', 5, 'Dây chuyền ngọc trai hoa bạc mờ này nổi bật với viên ngọc trai nuôi cấy hình giọt nước và bạc sterling mờ. Đặc biệt, thiết kế hoa bao phủ viên ngọc trai tinh xảo phía dưới mang lại vẻ đẹp thanh lịch và duyên dáng.', 'active', 'chain'),
('uoH6XyVoqHwX9a30k8qV', 'ezqlEEnkQyaIGBvBVPcM', 'Bông tai ngọc trai baroque nơ thắt bằng bạc', 5610000, 'Product-5.jpg', 4, 'Tô điểm cho bản thân bằng vẻ đẹp thanh lịch và duyên dáng với đôi bông tai ngọc trai baroque nơ thắt bằng bạc tinh xảo của chúng tôi. Sự óng ánh quyến rũ của ngọc trai baroque kết hợp cùng đá CZ hình oval và thiết kế nơ thắt tạo nên một món phụ kiện độc đáo và tinh tế, mang lại nét sang trọng và đẳng cấp cho bất kỳ trang phục nào.&#13;&#10;&#13;&#10;Hãy nâng tầm phong cách và khẳng định dấu ấn riêng của bạn với đôi bông tai tuyệt đẹp này — chắc chắn sẽ thu hút mọi ánh nhìn và để lại ấn tượng khó phai.', 'active', 'earring'),
('wwmQr6vTqu0Kns1FWBJw', 'ezqlEEnkQyaIGBvBVPcM', 'Vòng cổ ngọc trai hoa chạm khắc vintage', 5407000, 'vintage_necklace.jpg', 5, 'Vòng cổ ngọc trai hoa chạm khắc vintage này mang lại cảm giác hoài niệm cho người sở hữu. Người thợ thủ công đã tỉ mỉ biến một mảnh bạc dày thành một kiệt tác tuyệt đẹp. Với thiết kế hoa tinh xảo, chiếc vòng cổ này không chỉ thể hiện sự độc đáo mà còn rất thời trang.&#13;&#10;&#13;&#10;Ngoài ra, với những viên ngọc trai trắng nuôi cấy xinh đẹp, chiếc vòng cổ này là lựa chọn hoàn hảo cho những tín đồ yêu thích trang sức.', 'active', 'necklace'),
('yTVGRkRJgFecuyS9Jweg', 'ezqlEEnkQyaIGBvBVPcM', 'Dây chuyền ngọc trai giọt nước quý tộc', 2655000, 'royal_neckchain.jpg', 5, 'Chiếc dây chuyền ngọc trai tinh tế này mang lại vẻ sang trọng và thời thượng cho người sở hữu. Sự kết hợp hoàn hảo giữa ngọc trai nuôi cấy và bạc sterling 925 là lựa chọn lý tưởng cho những tín đồ yêu thích trang sức. Thêm vào đó, đá cubic zirconia giúp tôn lên vẻ tự nhiên của ngọc trai trắng nuôi cấy.', 'active', 'chain'),
('ZGOgdbh57VFYXdng3Fab', 'ezqlEEnkQyaIGBvBVPcM', 'Nhẫn ngọc trai và cubic zirconia cụm sóng', 2547000, 'wavy_ring.jpg', 7, 'Giới thiệu Nhẫn ngọc trai và cubic zirconia cụm sóng tinh xảo của chúng tôi, một kiệt tác thực sự của sự thanh lịch và tinh tế. Mẫu nhẫn tuyệt đẹp này có một viên ngọc trai nước ngọt nuôi cấy 13mm ở trung tâm, được bao quanh bởi thiết kế sóng quyến rũ với các viên cubic zirconia tạo thành cụm.', 'active', 'ring');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `image`) VALUES
('7wQqspCp17I9Ia1pPOci', 'duckhui', 'pardox2k4@gmail.com', '0987654321', '7c4a8d09ca3762af61e59520943dc26494f8941b', '');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `email`, `phone`, `password`, `image`) VALUES
('ezqlEEnkQyaIGBvBVPcM', 'pardos', 'pardox2k4@gmail.com', '0999717223', '7c4a8d09ca3762af61e59520943dc26494f8941b', '');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `product_id`, `date_added`) VALUES
(5, '7wQqspCp17I9Ia1pPOci', 'Q66QSzq6BymzL4xXDUZf', '2025-04-28 23:04:37'),
(6, '7wQqspCp17I9Ia1pPOci', 'Dp41sOFXYfPRuRjBtYaf', '2025-04-28 23:17:01'),
(7, '7wQqspCp17I9Ia1pPOci', '2xrHRGMwIhCAIDlBkVAd', '2025-04-29 00:00:52'),
(8, '7wQqspCp17I9Ia1pPOci', '7FYUy8Zf5rQcaM6hi2bu', '2025-04-29 00:29:09'),
(9, '7wQqspCp17I9Ia1pPOci', 'M3YwJ60znqyJeHjJurzm', '2025-05-10 23:27:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_product` (`user_id`,`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
