# 🏫 School Website — Laravel CMS Build Specification

> **เอกสารนี้สำหรับ AI Agent** ใช้เป็น Prompt/Spec เพื่อสร้างเว็บไซต์โรงเรียนด้วย Laravel
> ให้ปฏิบัติตามทุกข้อกำหนดในเอกสารนี้อย่างเคร่งครัด

---

## 📋 Project Overview

| รายการ | รายละเอียด |
|--------|-----------|
| **ชื่อโปรเจกต์** | School Website CMS |
| **Framework** | Laravel 11 |
| **Hosting Target** | Shared Hosting (cPanel) |
| **PHP Version** | 8.2+ |
| **Database** | MySQL 5.7+ |
| **Admin Panel** | Filament 3 |
| **Rich Text Editor** | TinyMCE 6 (หลัก) / CKEditor 5 / Quill (ทางเลือก) |

---

## 🛠️ Tech Stack (Shared Hosting Optimized)

```
Backend       : Laravel 11
Admin Panel   : Filament 3
Frontend      : Blade + Alpine.js
Styling       : Tailwind CSS
Database      : MySQL
Rich Editor   : TinyMCE 6
Media         : Spatie Media Library
Slug          : Spatie Laravel Sluggable
Permission    : Spatie Laravel Permission
SEO           : artesaos/seotools
Cache         : File Cache (ไม่ใช้ Redis — Shared Hosting ไม่รองรับ)
Queue         : Sync / Database Queue
Search        : MySQL Full-text Search (ไม่ใช้ Meilisearch)
```

### ⚠️ Shared Hosting Constraints (ต้องทำตามนี้เสมอ)

- ❌ ห้ามใช้ Redis
- ❌ ห้ามใช้ Horizon, Octane
- ❌ ห้ามใช้ Meilisearch / Typesense
- ✅ ใช้ `CACHE_DRIVER=file`
- ✅ ใช้ `SESSION_DRIVER=file`
- ✅ ใช้ `QUEUE_CONNECTION=sync`
- ✅ ใช้ `FILESYSTEM_DISK=local`

---

## 📦 Required Packages

```bash
# Admin Panel
composer require filament/filament:"^3.0"

# Media Management
composer require spatie/laravel-medialibrary

# Slug Generation
composer require spatie/laravel-sluggable

# Role & Permission
composer require spatie/laravel-permission

# SEO Tools
composer require artesaos/seotools

# Image Optimization
composer require intervention/image
```

---

## 🗂️ Site Pages & Routes

สร้าง Route และ Controller สำหรับทุกหน้าดังนี้:

```php
// routes/web.php

// หน้าแรก
Route::get('/', [HomeController::class, 'index'])->name('home');

// เกี่ยวกับโรงเรียน
Route::prefix('about')->name('about.')->group(function () {
    Route::get('/history',    [AboutController::class, 'history'])->name('history');
    Route::get('/structure',  [AboutController::class, 'structure'])->name('structure');
    Route::get('/symbols',    [AboutController::class, 'symbols'])->name('symbols');
    Route::get('/philosophy', [AboutController::class, 'philosophy'])->name('philosophy');
    Route::get('/curriculum', [AboutController::class, 'curriculum'])->name('curriculum');
});

// บุคลากร
Route::get('/personnel',          [PersonnelController::class, 'index'])->name('personnel');
Route::get('/personnel/{slug}',   [PersonnelController::class, 'show'])->name('personnel.show');

// เอกสารและข้อมูลสอบ
Route::get('/documents',                    [DocumentController::class, 'index'])->name('documents');
Route::get('/documents/{category}',         [DocumentController::class, 'category'])->name('documents.category');
Route::get('/documents/download/{id}',      [DocumentController::class, 'download'])->name('documents.download');

// แหล่งรวมความรู้
Route::get('/knowledge',          [KnowledgeController::class, 'index'])->name('knowledge');
Route::get('/knowledge/{slug}',   [KnowledgeController::class, 'show'])->name('knowledge.show');

// รวมระบบงาน
Route::get('/systems', [SystemController::class, 'index'])->name('systems');

// ข่าวสาร / ประชาสัมพันธ์ (เพิ่มเติม)
Route::get('/news',        [NewsController::class, 'index'])->name('news');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');

// ติดต่อเรา
Route::get('/contact',  [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
```

---

## 🗄️ Database Schema

สร้าง Migration ทั้งหมดดังนี้:

### 1. Posts (ข่าวสาร/ประชาสัมพันธ์)

```php
Schema::create('posts', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->string('slug')->unique();
    $table->longText('content');         // เก็บ HTML จาก Rich Editor
    $table->text('excerpt')->nullable();
    $table->string('cover_image')->nullable();
    $table->enum('status', ['draft', 'published'])->default('draft');
    $table->timestamp('published_at')->nullable();
    $table->foreignId('category_id')->constrained('post_categories');
    $table->foreignId('user_id')->constrained();
    $table->timestamps();
    $table->softDeletes();
    $table->fullText(['title', 'content']); // MySQL Full-text Search
});

Schema::create('post_categories', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('slug')->unique();
    $table->string('color')->default('#3B82F6');
    $table->timestamps();
});
```

### 2. About School

```php
// ประวัติความเป็นมา
Schema::create('school_histories', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->longText('content');        // Rich Editor HTML
    $table->string('cover_image')->nullable();
    $table->boolean('is_active')->default(true);
    $table->timestamps();
});

// โครงสร้างหน่วย
Schema::create('org_units', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('short_name')->nullable();
    $table->text('description')->nullable();
    $table->string('image')->nullable();
    $table->foreignId('parent_id')->nullable()->constrained('org_units');
    $table->integer('order')->default(0);
    $table->timestamps();
});

// สัญลักษณ์สถานศึกษา
Schema::create('school_symbols', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->text('description')->nullable();
    $table->longText('content')->nullable(); // Rich Editor HTML
    $table->string('image')->nullable();
    $table->integer('order')->default(0);
    $table->timestamps();
});

// ปรัชญา/วิสัยทัศน์/พันธกิจ
Schema::create('philosophies', function (Blueprint $table) {
    $table->id();
    $table->string('type'); // philosophy | vision | mission | value
    $table->string('title');
    $table->longText('content');        // Rich Editor HTML
    $table->string('icon')->nullable();
    $table->integer('order')->default(0);
    $table->timestamps();
});

// หลักสูตร
Schema::create('curriculums', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('level'); // primary | secondary | high
    $table->longText('description');    // Rich Editor HTML
    $table->string('image')->nullable();
    $table->boolean('is_active')->default(true);
    $table->integer('order')->default(0);
    $table->timestamps();
});
```

### 3. Personnel (บุคลากร)

```php
Schema::create('departments', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('slug')->unique();
    $table->text('description')->nullable();
    $table->integer('order')->default(0);
    $table->timestamps();
});

Schema::create('personnel', function (Blueprint $table) {
    $table->id();
    $table->string('prefix');           // นาย/นาง/นางสาว/ร้อยตรี ฯลฯ
    $table->string('first_name');
    $table->string('last_name');
    $table->string('slug')->unique();
    $table->string('position');         // ตำแหน่ง
    $table->string('rank')->nullable(); // ยศ (ถ้ามี)
    $table->string('photo')->nullable();
    $table->text('bio')->nullable();    // ประวัติย่อ
    $table->string('email')->nullable();
    $table->string('phone')->nullable();
    $table->enum('role_type', ['commander', 'unit_head', 'teacher', 'staff'])->default('staff');
    $table->foreignId('department_id')->nullable()->constrained();
    $table->integer('order')->default(0);
    $table->boolean('is_active')->default(true);
    $table->timestamps();
});
```

### 4. Documents (เอกสารข้อมูลสอบ)

```php
Schema::create('document_categories', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('slug')->unique();
    $table->string('icon')->nullable();
    $table->string('color')->default('#3B82F6');
    $table->integer('order')->default(0);
    $table->timestamps();
});

Schema::create('documents', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->string('slug')->unique();
    $table->text('description')->nullable();
    $table->string('file_path');        // Path ของไฟล์ PDF/DOC
    $table->string('file_name');
    $table->string('file_type');        // pdf, docx, xlsx
    $table->bigInteger('file_size');    // bytes
    $table->foreignId('category_id')->constrained('document_categories');
    $table->integer('download_count')->default(0);
    $table->integer('year')->nullable(); // ปีการสอบ
    $table->boolean('is_active')->default(true);
    $table->timestamps();
});
```

### 5. Knowledge Base (แหล่งรวมความรู้)

```php
Schema::create('knowledge_categories', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('slug')->unique();
    $table->string('icon')->nullable();
    $table->integer('order')->default(0);
    $table->timestamps();
});

Schema::create('knowledge_bases', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->string('slug')->unique();
    $table->longText('content');        // Rich Editor HTML
    $table->text('excerpt')->nullable();
    $table->string('cover_image')->nullable();
    $table->string('external_url')->nullable(); // ลิงก์ภายนอก (ถ้ามี)
    $table->enum('type', ['article', 'video', 'link', 'file'])->default('article');
    $table->foreignId('category_id')->constrained('knowledge_categories');
    $table->integer('view_count')->default(0);
    $table->enum('status', ['draft', 'published'])->default('draft');
    $table->timestamps();
    $table->softDeletes();
});
```

### 6. School Systems (รวมระบบงาน)

```php
Schema::create('system_categories', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->integer('order')->default(0);
    $table->timestamps();
});

Schema::create('school_systems', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->text('description')->nullable();
    $table->string('url');              // URL ของระบบงาน
    $table->string('icon')->nullable(); // Icon class หรือ image path
    $table->string('logo')->nullable();
    $table->string('color')->default('#3B82F6');
    $table->foreignId('category_id')->nullable()->constrained('system_categories');
    $table->boolean('open_new_tab')->default(true);
    $table->boolean('is_active')->default(true);
    $table->integer('order')->default(0);
    $table->timestamps();
});
```

### 7. Homepage & General

```php
// Banner/Slider
Schema::create('banners', function (Blueprint $table) {
    $table->id();
    $table->string('title')->nullable();
    $table->text('subtitle')->nullable();
    $table->string('image');
    $table->string('button_text')->nullable();
    $table->string('button_url')->nullable();
    $table->boolean('is_active')->default(true);
    $table->integer('order')->default(0);
    $table->timestamps();
});

// ประกาศด่วน
Schema::create('announcements', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->text('content');
    $table->enum('type', ['info', 'warning', 'danger', 'success'])->default('info');
    $table->boolean('is_active')->default(true);
    $table->timestamp('expired_at')->nullable();
    $table->timestamps();
});

// ข้อมูลติดต่อ
Schema::create('contact_infos', function (Blueprint $table) {
    $table->id();
    $table->string('key')->unique();    // address | phone | email | fax | map_url
    $table->string('label');
    $table->text('value');
    $table->string('icon')->nullable();
    $table->timestamps();
});

// ฟอร์มติดต่อ (inbox)
Schema::create('contact_messages', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email');
    $table->string('phone')->nullable();
    $table->string('subject');
    $table->text('message');
    $table->boolean('is_read')->default(false);
    $table->timestamp('read_at')->nullable();
    $table->timestamps();
});
```

---

## 🎨 Rich Text Editor Integration

### ตัวเลือกที่ 1: TinyMCE 6 (แนะนำ)

ใช้กับ Filament Custom Field และ Blade Form

```php
// app/Filament/Resources/PostResource.php
use FilamentTiptapEditor\TiptapEditor; // หรือใช้ Custom TinyMCE

// ใน form() method ของ Filament Resource
RichEditor::make('content')
    ->toolbarButtons([
        'bold', 'italic', 'underline', 'strike',
        'h2', 'h3', 'bulletList', 'orderedList',
        'blockquote', 'codeBlock', 'link', 'media',
        'table', 'undo', 'redo',
    ])
    ->columnSpanFull()
```

หรือใช้ TinyMCE แบบ Custom ผ่าน JS:

```html
<!-- resources/views/admin/partials/tinymce.blade.php -->
<script src="https://cdn.tiny.cloud/1/YOUR_API_KEY/tinymce/6/tinymce.min.js"></script>
<script>
tinymce.init({
    selector: 'textarea.rich-editor',
    language: 'th_TH',
    height: 500,
    menubar: true,
    plugins: [
        'advlist', 'autolink', 'lists', 'link', 'image',
        'charmap', 'preview', 'anchor', 'searchreplace',
        'visualblocks', 'code', 'fullscreen', 'insertdatetime',
        'media', 'table', 'help', 'wordcount'
    ],
    toolbar: 'undo redo | formatselect | bold italic underline strikethrough | ' +
             'forecolor backcolor | alignleft aligncenter alignright alignjustify | ' +
             'bullist numlist outdent indent | link image media table | ' +
             'removeformat | code fullscreen help',
    images_upload_url: '/admin/upload-image',
    images_upload_handler: function (blobInfo, success, failure) {
        let formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());
        fetch('/admin/upload-image', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
            body: formData
        })
        .then(res => res.json())
        .then(data => success(data.location))
        .catch(() => failure('Upload failed'));
    },
    content_style: 'body { font-family: Sarabun, Arial, sans-serif; font-size: 16px; }',
});
</script>
```

### ตัวเลือกที่ 2: Filament Tiptap Editor (แนะนำสำหรับ Filament)

```bash
composer require awcodes/filament-tiptap-editor
```

```php
// ใน Filament Resource
TiptapEditor::make('content')
    ->profile('default')
    ->columnSpanFull()
```

### ตัวเลือกที่ 3: CKEditor 5

```html
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<script>
ClassicEditor.create(document.querySelector('#content'), {
    language: 'th',
    toolbar: {
        items: [
            'heading', '|', 'bold', 'italic', 'link', 'bulletedList',
            'numberedList', '|', 'outdent', 'indent', '|',
            'imageUpload', 'blockQuote', 'insertTable', 'mediaEmbed',
            'undo', 'redo'
        ]
    },
    image: {
        toolbar: ['imageTextAlternative', 'imageStyle:full', 'imageStyle:side'],
        upload: { types: ['png', 'jpeg', 'gif', 'webp'] }
    },
    simpleUpload: {
        uploadUrl: '/admin/upload-image',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        }
    }
})
</script>
```

---

## 📁 Project Structure

```
school-website/
├── app/
│   ├── Filament/
│   │   ├── Resources/
│   │   │   ├── PostResource.php
│   │   │   ├── PostResource/Pages/
│   │   │   ├── PersonnelResource.php
│   │   │   ├── DocumentResource.php
│   │   │   ├── KnowledgeBaseResource.php
│   │   │   ├── BannerResource.php
│   │   │   ├── AnnouncementResource.php
│   │   │   └── SchoolSystemResource.php
│   │   └── Widgets/
│   │       ├── StatsOverview.php
│   │       └── LatestMessages.php
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── HomeController.php
│   │   │   ├── AboutController.php
│   │   │   ├── PersonnelController.php
│   │   │   ├── DocumentController.php
│   │   │   ├── KnowledgeController.php
│   │   │   ├── NewsController.php
│   │   │   ├── SystemController.php
│   │   │   └── ContactController.php
│   │   └── Requests/
│   │       └── ContactRequest.php
│   └── Models/
│       ├── Post.php
│       ├── PostCategory.php
│       ├── Personnel.php
│       ├── Department.php
│       ├── Document.php
│       ├── DocumentCategory.php
│       ├── KnowledgeBase.php
│       ├── KnowledgeCategory.php
│       ├── SchoolSystem.php
│       ├── Banner.php
│       ├── Announcement.php
│       ├── Philosophy.php
│       ├── Curriculum.php
│       ├── OrgUnit.php
│       └── ContactMessage.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   ├── app.blade.php         ← Main layout (Navbar + Footer)
│       │   └── partials/
│       │       ├── navbar.blade.php
│       │       ├── footer.blade.php
│       │       └── announcement-bar.blade.php
│       └── pages/
│           ├── home.blade.php
│           ├── about/
│           │   ├── history.blade.php
│           │   ├── structure.blade.php
│           │   ├── symbols.blade.php
│           │   ├── philosophy.blade.php
│           │   └── curriculum.blade.php
│           ├── personnel/
│           │   ├── index.blade.php
│           │   └── show.blade.php
│           ├── documents/
│           │   └── index.blade.php
│           ├── knowledge/
│           │   ├── index.blade.php
│           │   └── show.blade.php
│           ├── news/
│           │   ├── index.blade.php
│           │   └── show.blade.php
│           ├── systems/
│           │   └── index.blade.php
│           └── contact/
│               └── index.blade.php
├── database/
│   └── migrations/
│       ├── xxxx_create_posts_table.php
│       ├── xxxx_create_personnel_table.php
│       ├── xxxx_create_documents_table.php
│       └── ... (ตามที่กำหนดใน Database Schema)
└── public/
    └── (CSS, JS, Images)
```

---

## ⚙️ Environment Configuration (.env)

```env
APP_NAME="ชื่อโรงเรียน"
APP_ENV=production
APP_KEY=                    # php artisan key:generate
APP_DEBUG=false
APP_URL=https://yourschool.ac.th

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=school_db
DB_USERNAME=school_user
DB_PASSWORD=strong_password_here

# Shared Hosting Optimized
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
FILESYSTEM_DISK=local

MAIL_MAILER=smtp
MAIL_HOST=mail.yourschool.ac.th
MAIL_PORT=465
MAIL_USERNAME=noreply@yourschool.ac.th
MAIL_PASSWORD=
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=noreply@yourschool.ac.th
MAIL_FROM_NAME="${APP_NAME}"
```

---

## 🚀 Deploy บน Shared Hosting (cPanel)

### โครงสร้างไฟล์บน Server

```
home/
├── public_html/                   ← Document Root
│   ├── index.php                  ← Copy จาก /public/index.php
│   ├── .htaccess                  ← Copy จาก /public/.htaccess
│   └── assets/                    ← CSS, JS, Images (compiled)
└── school_laravel/                ← Laravel Root (นอก public_html)
    ├── app/
    ├── bootstrap/
    ├── config/
    ├── database/
    ├── resources/
    ├── routes/
    ├── storage/
    └── vendor/
```

### index.php ที่ต้องแก้ไข

```php
// public_html/index.php
<?php

define('LARAVEL_START', microtime(true));

// แก้ path ให้ชี้ไปยัง Laravel root ที่อยู่นอก public_html
require __DIR__.'/../school_laravel/vendor/autoload.php';

$app = require_once __DIR__.'/../school_laravel/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
)->send();

$kernel->terminate($request, $response);
```

### .htaccess

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^ index.php [L]
</IfModule>

# Security Headers
Header always set X-Frame-Options "SAMEORIGIN"
Header always set X-XSS-Protection "1; mode=block"
Header always set X-Content-Type-Options "nosniff"
Header always set Referrer-Policy "strict-origin-when-cross-origin"

# Hide sensitive files
<FilesMatch "\.(env|log|git|sql)$">
    Order allow,deny
    Deny from all
</FilesMatch>

# Cache static assets
<IfModule mod_expires.c>
    ExpiresActive On
    ExpiresByType image/jpg "access plus 1 year"
    ExpiresByType image/jpeg "access plus 1 year"
    ExpiresByType image/png "access plus 1 year"
    ExpiresByType image/webp "access plus 1 year"
    ExpiresByType text/css "access plus 1 month"
    ExpiresByType application/javascript "access plus 1 month"
</IfModule>
```

### Storage Symlink (ทำผ่าน SSH หรือ PHP Script)

```bash
# ผ่าน SSH
php artisan storage:link

# หรือถ้าไม่มี SSH ให้สร้าง symlink.php แล้วรันครั้งเดียว
<?php symlink('../school_laravel/storage/app/public', __DIR__.'/storage'); ?>
```

---

## 🚀 Deploy บน Railway (ทางเลือก)

### railway.json

```json
{
  "$schema": "https://railway.app/railway.schema.json",
  "build": {
    "builder": "NIXPACKS"
  },
  "deploy": {
    "startCommand": "php artisan migrate --force && php artisan storage:link && php artisan config:cache && php artisan route:cache && php artisan view:cache && php artisan serve --host=0.0.0.0 --port=$PORT",
    "restartPolicyType": "ON_FAILURE",
    "restartPolicyMaxRetries": 3
  }
}
```

### nixpacks.toml

```toml
[phases.setup]
nixPkgs = ["php82", "php82Extensions.pdo_mysql", "php82Extensions.mbstring", 
           "php82Extensions.xml", "php82Extensions.gd", "php82Extensions.zip",
           "php82Extensions.bcmath", "composer"]

[phases.build]
cmds = ["composer install --no-dev --optimize-autoloader", "npm install && npm run build"]

[start]
cmd = "php artisan serve --host=0.0.0.0 --port=$PORT"
```

---

## 🏠 Homepage (home.blade.php) — Sections ที่ต้องมี

```
1. Hero Slider/Banner          ← ดึงจาก banners table
2. Announcement Bar            ← ดึงจาก announcements table (is_active = true)
3. About School (สรุปย่อ)     ← ข้อความสั้น + ลิงก์ไปหน้า About
4. ข่าวสารล่าสุด               ← ดึง posts 6 รายการล่าสุด
5. ผู้บังคับบัญชา              ← ดึง personnel role_type = commander
6. หลักสูตรของโรงเรียน         ← ดึง curriculums ที่ is_active = true
7. รวมระบบงาน (Quick Links)    ← ดึง school_systems
8. แกลเลอรีภาพกิจกรรม         ← รูปล่าสุดจาก posts
9. ติดต่อเรา (สรุปย่อ)         ← contact_infos + Google Maps
```

---

## 🔒 Security Requirements

```php
// config/session.php
'secure' => env('SESSION_SECURE_COOKIE', true),   // HTTPS only
'http_only' => true,
'same_site' => 'lax',

// Filament Admin — เพิ่ม Middleware
// ป้องกัน Admin Panel ด้วย Role
// ใน AdminPanelProvider.php
->authMiddleware([
    Authenticate::class,
])
->middleware([
    'throttle:60,1', // Rate limiting
])
```

---

## 🌐 SEO Configuration

```php
// ทุก Controller ต้องเรียก SEO เช่นนี้
use Artesaos\SEOTools\Facades\SEOTools;

public function show(Post $post)
{
    SEOTools::setTitle($post->title . ' | ' . config('app.name'));
    SEOTools::setDescription($post->excerpt);
    SEOTools::opengraph()->setUrl(request()->url());
    SEOTools::opengraph()->addImage($post->cover_image_url);
    SEOTools::twitter()->setTitle($post->title);
    
    return view('pages.news.show', compact('post'));
}
```

---

## 📝 Filament Admin Panel — Resources ที่ต้องสร้าง

| Resource | Model | Features |
|----------|-------|---------|
| `PostResource` | Post | Rich Editor, Image Upload, Status, Category |
| `PersonnelResource` | Personnel | Photo Upload, Department, Role Type, Order |
| `DocumentResource` | Document | File Upload (PDF/DOC), Category, Year |
| `KnowledgeBaseResource` | KnowledgeBase | Rich Editor, Type (article/video/link) |
| `BannerResource` | Banner | Image Upload, Order, Active Toggle |
| `AnnouncementResource` | Announcement | Type, Expired At |
| `SchoolSystemResource` | SchoolSystem | URL, Logo, Color, Order |
| `ContactMessageResource` | ContactMessage | Read-only Inbox, Mark as Read |
| `AboutResource` | (หลาย Model) | Tab-based form สำหรับ History, Symbol, Philosophy |

---

## 🌏 Thai Language Support

```php
// config/app.php
'locale' => 'th',
'timezone' => 'Asia/Bangkok',

// เพิ่ม Thai font ใน Tailwind / CSS
// ใน resources/css/app.css
@import url('https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;500;600;700&display=swap');

body {
    font-family: 'Sarabun', sans-serif;
}
```

---

## ✅ Development Checklist

### Phase 1 — Core Setup (สัปดาห์ที่ 1-2)
- [ ] ติดตั้ง Laravel 11
- [ ] ติดตั้ง Filament 3
- [ ] ติดตั้ง Packages ทั้งหมด
- [ ] สร้าง Migrations ทั้งหมด
- [ ] สร้าง Models + Relationships
- [ ] ตั้งค่า Filament Admin Panel
- [ ] สร้าง Filament Resources ทั้งหมด
- [ ] ตั้งค่า Rich Editor (TinyMCE)
- [ ] Image Upload Handler

### Phase 2 — Frontend (สัปดาห์ที่ 2-3)
- [ ] สร้าง Main Layout (Navbar + Footer)
- [ ] หน้าแรก (Home) ครบทุก Section
- [ ] หน้าเกี่ยวกับโรงเรียน (5 sub-pages)
- [ ] หน้าบุคลากร
- [ ] หน้าเอกสาร + ระบบ Download
- [ ] หน้าแหล่งความรู้
- [ ] หน้ารวมระบบงาน
- [ ] หน้าข่าวสาร + รายละเอียด
- [ ] หน้าติดต่อเรา + Form

### Phase 3 — Production (สัปดาห์ที่ 3-4)
- [ ] SEO ทุกหน้า
- [ ] Responsive Design (Mobile)
- [ ] Security Headers
- [ ] Deploy บน Shared Hosting / Railway
- [ ] ตั้งค่า DNS + Custom Domain
- [ ] SSL Certificate
- [ ] Performance Test
- [ ] ทดสอบ Rich Editor บน Admin

---

## 🎯 Design Guidelines

- **Primary Color**: กำหนดตามสีของโรงเรียน (ค่าเริ่มต้น: `#1E3A5F`)
- **Font**: Sarabun (Thai) + Inter (English)
- **Style**: Clean, Professional, Government-like
- **Mobile First**: Responsive ทุกหน้า
- **Accessibility**: Alt text ทุกรูป, Contrast ผ่าน WCAG AA

---

> 📌 **หมายเหตุสำหรับ AI Agent**
> - ให้สร้างไฟล์ทุกไฟล์ตาม Structure ที่กำหนด
> - ทุก Model ต้องมี Relationship ที่ถูกต้อง
> - Filament Resource ทุกตัวต้องมี `form()`, `table()`, `pages()` ครบถ้วน
> - เนื้อหาที่เป็น Rich Text ให้แสดงผลด้วย `{!! $content !!}` และ sanitize ก่อน save เสมอ
> - ไฟล์ที่ Upload ต้องตรวจสอบ MIME type และ ขนาดก่อนเสมอ
> - ทุกฟอร์มต้องมี CSRF Protection
