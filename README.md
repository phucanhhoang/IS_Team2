##Hướng dẫn sử dụng git:
###1. Clone project về máy local:
git clone https://github.com/phucanhhoang/IS_Team2.git

###2. Setting remote:
git remote add origin https://github.com/phucanhhoang/IS_Team2.git

###3. Pull code ve(update code tu git ve):

git pull origin master

###4. Push:
git add .		(add file can push, "." là add toàn bộ file đã sửa)

git commit -m "your name: giai thich update cai gi"         
//ví dụ: git commit -m "update class UserController"

git push -u origin master            
//(chắc chắn phải có -u, để check xem code của bạn đã là code mới nhất chưa, nếu chưa thì git pull nhé)

##Hướng dẫn cài đặt thư mục vendor cho laravel:
php composer.phar install

##Huong dan su dung Migrate:
###1. Sau khi clone code or pull code ve, tao moi database "it4895", sau đó chạy lệnh:

php artisan migrate

###2. Neu da ton tai database truoc do, refesh database de cap nhat thay doi:

php artisan migrate:refresh

##Hướng dẫn sử dụng Seeder:

Điều kiện: đã có cơ sở dữ liệu phía trên, chưa có dữ liệu gì cả

php artisan db:seed
