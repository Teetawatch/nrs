# ระบบเว็บไซต์โรงเรียน (School Website CMS)

ระบบจัดการเนื้อหาเว็บไซต์สถานศึกษา สร้างด้วย Laravel + Filament 3

## Tech Stack

- **Backend**: Laravel 10, PHP 8.2+
- **Admin Panel**: Filament 3
- **Frontend**: Blade, Tailwind CSS 3, Alpine.js 3
- **Database**: MySQL 5.7+
- **File Storage**: Laravel Storage (local/public disk)

---

## ขั้นตอนการติดตั้ง (Setup)

### 1. ติดตั้ง PHP Dependencies

```bash
composer install
```

### 2. ติดตั้ง Node Dependencies

```bash
npm install
```

### 3. ตั้งค่า Environment

```bash
cp .env.example .env
php artisan key:generate
```

แก้ไขไฟล์ `.env` ให้ตรงกับฐานข้อมูลและการตั้งค่าของเซิร์ฟเวอร์

### 4. สร้างฐานข้อมูล

```bash
php artisan migrate
```

### 5. สร้าง Storage Link

```bash
php artisan storage:link
```

### 6. Seed ข้อมูลตัวอย่าง (ไม่บังคับ)

```bash
php artisan db:seed
```

> ข้อมูล seed จะสร้างบัญชี admin: `admin@school.ac.th` / `password`

### 7. Build Frontend Assets

**Development:**
```bash
npm run dev
```

**Production:**
```bash
npm run build
```

---

## การเข้าใช้งาน Admin Panel

เข้าที่ `/admin` จากนั้น login ด้วยบัญชี admin ที่สร้างจาก seeder หรือสร้างบัญชีใหม่ด้วย:

```bash
php artisan make:filament-user
```

---

## โครงสร้างหน้าเว็บ (Frontend Routes)

| URL | หน้า |
|-----|------|
| `/` | หน้าหลัก |
| `/about/structure` | โครงสร้างสถานศึกษา |
| `/about/symbols` | สัญลักษณ์สถานศึกษา |
| `/about/philosophy` | ปรัชญา/วิสัยทัศน์ |
| `/about/curriculum` | หลักสูตรที่เปิดสอน |
| `/personnel` | บุคลากรทั้งหมด |
| `/personnel/{slug}` | ประวัติบุคลากร |
| `/documents` | เอกสารดาวน์โหลด |
| `/documents/{slug}/download` | ดาวน์โหลดเอกสาร |
| `/news` | ข่าวสารทั้งหมด |
| `/news/{slug}` | รายละเอียดข่าว |
| `/knowledge` | แหล่งความรู้ |
| `/knowledge/{slug}` | รายละเอียดความรู้ |
| `/systems` | ระบบงานภายใน |
| `/contact` | ติดต่อเรา |
| `/admin` | Admin Panel (Filament) |

---

## Admin Resources

| Resource | คำอธิบาย |
|----------|----------|
| PostResource | จัดการข่าวสาร |
| PersonnelResource | จัดการบุคลากร |
| DocumentResource | จัดการเอกสาร |
| KnowledgeBaseResource | จัดการแหล่งความรู้ |
| BannerResource | จัดการแบนเนอร์หน้าแรก |
| AnnouncementResource | จัดการประกาศแถบด้านบน |
| SchoolSystemResource | จัดการลิงก์ระบบงาน |
| ContactMessageResource | ดูข้อความติดต่อ |

---

## การตั้งค่าอีเมลแจ้งเตือน

ตั้ง `CONTACT_MAIL_TO` ใน `.env` เพื่อรับอีเมลเมื่อมีผู้ติดต่อ:

```env
CONTACT_MAIL_TO=admin@school.ac.th
```

---

## Shared Hosting Notes

- ไม่ใช้ Redis / Horizon / Octane
- Queue driver: `sync`
- Cache/Session driver: `file`
- ใช้ `FILESYSTEM_DISK=public` สำหรับ file upload

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
