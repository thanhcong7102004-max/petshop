# Pet Shop E-Commerce Platform

Một nền tảng thương mại điện tử chuyên biệt để bán các sản phẩm và dịch vụ chăm sóc thú cưng. Dự án được xây dựng bằng PHP với kiến trúc MVC và tích hợp các tính năng hiện đại.

## 🌟 Các Tính Năng Chính

### Cho Người Mua
- **Duyệt Sản Phẩm**: Tìm kiếm, lọc theo danh mục sản phẩm
- **Giỏ Hàng & Thanh Toán**: Thêm vào giỏ, quản lý đơn hàng, thanh toán qua VNPay
- **Yêu Thích**: Lưu các sản phẩm yêu thích
- **Đơn Hàng**: Theo dõi tình trạng đơn hàng, lịch sử mua hàng
- **Bình Luận & Đánh Giá**: Đánh giá sản phẩm, bình luận
- **Phản Hồi**: Gửi phản hồi, liên hệ với hỗ trợ khách hàng
- **Tin Tức**: Đọc bài viết tin tức về thú cưng
- **Chatbot AI**: Hỗ trợ trực tuyến 24/7 bằng OpenAI

### Cho Admin
- **Quản Lý Sản Phẩm**: CRUD sản phẩm, quản lý kho
- **Quản Lý Danh Mục**: Tạo, chỉnh sửa, xóa danh mục
- **Quản Lý Đơn Hàng**: Xem, cập nhật trạng thái đơn hàng
- **Quản Lý Người Dùng**: Quản lý tài khoản khách hàng
- **Quản Lý Nhà Cung Cấp**: Quản lý hợp đồng cung cấp
- **Quản Lý Tin Tức**: Tạo, chỉnh sửa bài viết
- **Quản Lý Phản Hồi**: Xử lý phản hồi từ khách hàng
- **Thống Kê Doanh Thu**: Xem báo cáo doanh thu
- **Quản Lý Slider**: Cấu hình banner quảng cáo

## 🛠️ Công Nghệ Sử Dụng

- **Backend**: PHP 7.4+
- **Database**: MySQL/MariaDB
- **Frontend**: HTML5, CSS3, JavaScript
- **Package Manager**: Composer
- **Email**: PHPMailer
- **AI Integration**: OpenAI API
- **Payment Gateway**: VNPay
- **Architecture**: MVC Pattern

## 📋 Yêu Cầu Hệ Thống

- PHP 7.4 trở lên
- MySQL 5.7 trở lên hoặc MariaDB 10.2 trở lên
- Apache/Nginx Web Server
- Composer
- cURL extension
- JSON extension

## 🚀 Cài Đặt & Chạy

### 1. Clone/Tải Dự Án
```bash
git clone [repository-url]
cd petshop
```

### 2. Cài Đặt Dependencies
```bash
composer install
```

### 3. Cấu Hình Database
- Mở file `app/config/config.php`
- Cập nhật thông tin kết nối database:
```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'pet_shop');
define('DB_USER', 'root');
define('DB_PASS', '');
```

### 4. Import Database
```bash
mysql -u root -p pet_shop < database/pet_shop.sql
```

### 5. Cấu Hình Email (Tùy Chọn)
Chỉnh sửa file `app/config/mail_config.php`:
```php
define('MAIL_HOST', 'smtp.gmail.com');
define('MAIL_USER', 'your-email@gmail.com');
define('MAIL_PASS', 'your-app-password');
```

### 6. Cấu Hình OpenAI (Tùy Chọn)
Chỉnh sửa file `app/config/ai_config.php`:
```php
define('OPENAI_API_KEY', 'your-api-key');
define('OPENAI_MODEL', 'gpt-3.5-turbo');
```

### 7. Cấu Hình VNPay (Tùy Chọn)
Chỉnh sửa file `vnpay_php/config.php` với thông tin tài khoản VNPay của bạn

### 8. Chạy Dự Án
- Đặt dự án trong thư mục `htdocs` của XAMPP
- Truy cập: `http://localhost/petshop`

## 📁 Cấu Trúc Dự Án

```
petshop/
├── app/
│   ├── config/              # Cấu hình ứng dụng
│   ├── controllers/         # Các controller xử lý logic
│   ├── core/                # Core framework (DB, Session, Controller)
│   ├── helpers/             # Các hàm trợ giúp
│   ├── models/              # Các model database
│   ├── routers/             # Định tuyến ứng dụng
│   └── views/               # Các template HTML
├── database/                # Database SQL
├── public/                  # Thư mục public (index.php, assets)
│   ├── assets/              # CSS, JS, Fonts, Images
│   └── uploads/             # Tải lên file (avatars, products, news)
├── vnpay_php/               # Tích hợp VNPay
├── vendor/                  # Dependencies (Composer)
└── README.md                # Tài liệu này
```

## 👥 Tài Khoản Mặc Định

Sau khi import database, có thể sử dụng:
- **Admin**: Kiểm tra file `database/pet_shop.sql` để lấy thông tin tài khoản
- **User**: Tạo tài khoản mới qua trang đăng ký

## 🔧 Các Route Chính

### Người Dùng
- `/` - Trang chủ
- `/products` - Danh sách sản phẩm
- `/cart` - Giỏ hàng
- `/orders` - Lịch sử đơn hàng
- `/user/profile` - Hồ sơ cá nhân
- `/wishlist` - Danh sách yêu thích
- `/news` - Tin tức

### Admin
- `/admin/login` - Đăng nhập admin
- `/admin/dashboard` - Bảng điều khiển
- `/admin/products` - Quản lý sản phẩm
- `/admin/orders` - Quản lý đơn hàng
- `/admin/users` - Quản lý người dùng
- `/admin/categories` - Quản lý danh mục

## 🔐 Bảo Mật

- Xác thực và phân quyền người dùng
- Mã hóa mật khẩu với hashing
- SQL Injection Protection
- CSRF Protection
- Input Validation & Sanitization

## 🐛 Khắc Phục Sự Cố

### Database không kết nối
- Kiểm tra thông tin kết nối trong `app/config/config.php`
- Đảm bảo MySQL server đang chạy

### Lỗi Permission trên uploads
```bash
chmod -R 755 public/uploads/
```

### Composer autoload issues
```bash
composer dump-autoload
```

## 📞 Hỗ Trợ

Để báo cáo lỗi hoặc gợi ý tính năng, vui lòng:
1. Mở Issue trên GitHub
2. Cung cấp mô tả chi tiết về vấn đề
3. Gửi email đến địa chỉ hỗ trợ

## 📄 License

Dự án này được cấp phép dưới giấy phép [Chỉ định license của bạn]

## 👨‍💻 Tác Giả

Phát triển bởi [Nguyễn Thành]

---

**Cập nhật lần cuối**: December 25, 2025
#

