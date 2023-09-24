# Nhóm I Chuyên Đề Web
## Giới thiệu
## Yêu Cầu Hệ Thống
* PHP: 7.x, 8.x
* Composer
* Node: >16.14
* Wamp/Xampp
## Cách Sử Dụng
- Clone the repository
  `git clone https://github.com/TranDuc41/nhom-i-chuyen-de-web.git`
### Backend
- Vào thư mục backend
  `cd backend`
- Cài đặt các phụ thuộc
  `composer install` hoặc `composer i`
- Sao chép tệp `env.example` và đổi tên thành `.env`
- Thực hiện các thay đổi cấu hình cần thiết trong tệp .env
- Chạy di chuyển cơ sở dữ liệu ( Cấu hình cơ sở dữ liệu trong .env trước khi di chuyển )
  `php artisan migrate`
- Khởi động
  `php artisan serve`
- Truy cập tại `http://localhost:8000`
### Frontend
- Vào thư mục frontend
  `cd frontend`
- Cài đặt các phụ thuộc
  `npm install` hoặc `npm i`
- Khởi động
  `npm run dev`
- Truy cập tại `http://localhost:3000`
## Building and deploying in production
Nếu bạn muốn chạy trang web này trong production, bạn nên cài đặt các mô-đun sau đó xây dựng trang web `npm run build` và chạy nó với `npm start`:
## Công nghệ được sử dụng – thư viện, phiên bản…
- Laraver 10
- Nexjs 13
