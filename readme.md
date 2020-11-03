-กลุ่ม พีเคน
-ระบบรวบรวมชีทสรุปวิชาอัจฉริยะ
-นาย ปาริญ ฮอปเปอร์ 6010450420
-นาย พิชญุตม์ ยิ้มใหญ่ 6010450527
-สร้างโพส,อัพโหลดไฟล์,แก้ไขโพส,อัพหลายไฟล์

วิธีการติดตั้ง (backend)

composer install
cp.env.example .env
php artisan key:generate
(แก้ไขไฟล์ db_database)

CREATE USER 'newuser'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON * . * TO 'newuser'@'localhost';

php artisan migrate
php artisan storage:link
php artisan passport:client

