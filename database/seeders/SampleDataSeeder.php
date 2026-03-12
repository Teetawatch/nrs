<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\Banner;
use App\Models\Department;
use App\Models\Document;
use App\Models\DocumentCategory;
use App\Models\KnowledgeBase;
use App\Models\KnowledgeCategory;
use App\Models\Personnel;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\SchoolSystem;
use App\Models\SystemCategory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SampleDataSeeder extends Seeder
{
    public function run(): void
    {
        $this->createPlaceholderImage();
        $this->seedAdminUser();
        $this->seedPostCategories();
        $this->seedDocumentCategories();
        $this->seedKnowledgeCategories();
        $this->seedSystemCategories();
        $this->seedDepartments();
        $this->seedBanners();
        $this->seedAnnouncements();
        $this->seedPosts();
        $this->seedPersonnel();
        $this->seedDocuments();
        $this->seedKnowledgeBase();
        $this->seedSchoolSystems();
    }

    private function createPlaceholderImage(): void
    {
        $path = public_path('images/no-photo.png');
        if (file_exists($path)) return;

        if (!is_dir(public_path('images'))) {
            mkdir(public_path('images'), 0755, true);
        }

        if (extension_loaded('gd')) {
            $img = imagecreatetruecolor(300, 300);
            $bg  = imagecolorallocate($img, 226, 232, 240);
            $fg  = imagecolorallocate($img, 148, 163, 184);
            imagefill($img, 0, 0, $bg);
            imagestring($img, 3, 105, 140, 'No Photo', $fg);
            imagepng($img, $path);
            imagedestroy($img);
        }
    }

    private function seedAdminUser(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@school.ac.th'],
            [
                'name'     => 'ผู้ดูแลระบบ',
                'password' => Hash::make('password'),
            ]
        );
    }

    private function seedPostCategories(): void
    {
        $categories = ['ข่าวทั่วไป', 'ข่าวกิจกรรม', 'ข่าวประกาศ', 'ข่าวสำเร็จการศึกษา', 'ข่าวรับสมัคร'];
        foreach ($categories as $name) {
            PostCategory::firstOrCreate(
                ['slug' => Str::slug($name . '-' . Str::random(4))],
                ['name' => $name]
            );
        }
    }

    private function seedDocumentCategories(): void
    {
        $categories = ['ระเบียบ/คำสั่ง', 'แบบฟอร์ม', 'รายงาน', 'คู่มือ', 'ประกาศ'];
        foreach ($categories as $i => $name) {
            DocumentCategory::firstOrCreate(
                ['name' => $name],
                ['slug' => Str::slug($name . '-' . ($i + 1)), 'order' => $i + 1]
            );
        }
    }

    private function seedKnowledgeCategories(): void
    {
        $categories = ['วิทยาศาสตร์และเทคโนโลยี', 'คณิตศาสตร์', 'ภาษาและวรรณคดี', 'สังคมศึกษา', 'ทักษะชีวิต'];
        foreach ($categories as $i => $name) {
            KnowledgeCategory::firstOrCreate(
                ['name' => $name],
                ['slug' => Str::slug($name . '-' . ($i + 1)), 'order' => $i + 1]
            );
        }
    }

    private function seedSystemCategories(): void
    {
        $categories = ['ระบบบริหารการศึกษา', 'ระบบสนับสนุน', 'ระบบภายนอก'];
        foreach ($categories as $i => $name) {
            SystemCategory::firstOrCreate(
                ['name' => $name],
                ['order' => $i + 1]
            );
        }
    }

    private function seedDepartments(): void
    {
        $departments = [
            ['name' => 'ฝ่ายบริหารงานทั่วไป',    'slug' => 'admin'],
            ['name' => 'ฝ่ายวิชาการ',              'slug' => 'academic'],
            ['name' => 'ฝ่ายกิจการนักเรียน',      'slug' => 'student-affairs'],
            ['name' => 'ฝ่ายแผนงานและงบประมาณ',   'slug' => 'planning'],
            ['name' => 'แผนกวิชาช่างยนต์',         'slug' => 'automotive'],
            ['name' => 'แผนกวิชาช่างไฟฟ้ากำลัง',  'slug' => 'electrical'],
            ['name' => 'แผนกวิชาช่างอิเล็กทรอนิกส์', 'slug' => 'electronics'],
            ['name' => 'แผนกวิชาการบัญชี',         'slug' => 'accounting'],
            ['name' => 'แผนกวิชาคอมพิวเตอร์ธุรกิจ', 'slug' => 'computer-business'],
            ['name' => 'แผนกวิชาสามัญ-สัมพันธ์',  'slug' => 'general-education'],
        ];
        foreach ($departments as $i => $dept) {
            Department::firstOrCreate(
                ['slug' => $dept['slug']],
                ['name' => $dept['name'], 'order' => $i + 1]
            );
        }
    }

    private function seedBanners(): void
    {
        $banners = [
            ['title' => 'ยินดีต้อนรับสู่วิทยาลัย', 'subtitle' => 'สถานศึกษาที่มุ่งพัฒนาทักษะอาชีพ', 'order' => 1],
            ['title' => 'เปิดรับสมัครนักเรียนใหม่ ปีการศึกษา 2568', 'subtitle' => 'รับสมัครตั้งแต่บัดนี้เป็นต้นไป', 'order' => 2],
            ['title' => 'ผลงานดีเด่นระดับชาติ', 'subtitle' => 'นักเรียนวิทยาลัยคว้ารางวัลระดับชาติ', 'order' => 3],
        ];
        foreach ($banners as $b) {
            Banner::firstOrCreate(
                ['title' => $b['title']],
                array_merge($b, ['image' => 'banners/placeholder.jpg', 'is_active' => true])
            );
        }
    }

    private function seedAnnouncements(): void
    {
        Announcement::firstOrCreate(
            ['title' => 'เปิดภาคเรียนที่ 1 ปีการศึกษา 2568'],
            ['content' => 'เปิดภาคเรียนที่ 1 วันที่ 1 พฤษภาคม 2568 นักเรียนทุกระดับชั้นรายงานตัว', 'type' => 'info', 'is_active' => true]
        );
        Announcement::firstOrCreate(
            ['title' => 'งดการเรียนการสอนวันที่ 15 มีนาคม'],
            ['content' => 'เนื่องจากมีการจัดกิจกรรมประชุมผู้ปกครอง', 'type' => 'warning', 'is_active' => true]
        );
    }

    private function seedPosts(): void
    {
        $category = PostCategory::first();
        if (!$category) return;

        $user = User::first();
        $posts = [
            ['title' => 'พิธีไหว้ครูประจำปีการศึกษา 2568', 'excerpt' => 'วิทยาลัยจัดพิธีไหว้ครูอย่างยิ่งใหญ่'],
            ['title' => 'นักเรียนวิทยาลัยคว้าเหรียญทองทักษะวิชาชีพ', 'excerpt' => 'ผลงานดีเด่นในการแข่งขันระดับภาค'],
            ['title' => 'กิจกรรมปัจฉิมนิเทศนักเรียน ปีการศึกษา 2567', 'excerpt' => 'วิทยาลัยจัดงานอำลาให้กับนักเรียนที่สำเร็จการศึกษา'],
            ['title' => 'โครงการฝึกอบรมวิชาชีพระยะสั้น', 'excerpt' => 'เปิดรับสมัครหลักสูตรระยะสั้นหลากหลายสาขา'],
        ];
        foreach ($posts as $p) {
            Post::firstOrCreate(
                ['slug' => Str::slug($p['title'])],
                [
                    'title'        => $p['title'],
                    'excerpt'      => $p['excerpt'],
                    'content'      => '<p>' . $p['excerpt'] . ' รายละเอียดเพิ่มเติมจะประกาศให้ทราบในภายหลัง</p>',
                    'category_id'  => $category->id,
                    'user_id'      => $user?->id,
                    'status'       => 'published',
                    'published_at' => now()->subDays(rand(1, 30)),
                ]
            );
        }
    }

    private function seedPersonnel(): void
    {
        $people = [
            ['prefix' => 'นาย',    'first_name' => 'สมชาย',  'last_name' => 'ใจดี',    'position' => 'ผู้อำนวยการ',               'role_type' => 'commander', 'order' => 1],
            ['prefix' => 'นาง',    'first_name' => 'สมหญิง', 'last_name' => 'รักเรียน', 'position' => 'รองผู้อำนวยการฝ่ายวิชาการ', 'role_type' => 'commander', 'order' => 2],
            ['prefix' => 'นาย',    'first_name' => 'วิชาญ',  'last_name' => 'ชำนาญกิจ', 'position' => 'ครูประจำแผนกช่างยนต์',      'role_type' => 'teacher',   'order' => 3],
            ['prefix' => 'นางสาว', 'first_name' => 'มาลี',   'last_name' => 'สุขสันต์', 'position' => 'ครูประจำแผนกการบัญชี',      'role_type' => 'teacher',   'order' => 4],
            ['prefix' => 'นาย',    'first_name' => 'เอกชัย', 'last_name' => 'ก้าวหน้า', 'position' => 'ครูประจำแผนกคอมพิวเตอร์',   'role_type' => 'teacher',   'order' => 5],
        ];
        foreach ($people as $p) {
            $slug = Str::slug($p['prefix'] . '-' . $p['first_name'] . '-' . $p['last_name']);
            Personnel::firstOrCreate(
                ['slug' => $slug],
                array_merge($p, ['slug' => $slug, 'is_active' => true])
            );
        }
    }

    private function seedDocuments(): void
    {
        $category = DocumentCategory::first();
        if (!$category) return;

        $docs = [
            ['title' => 'ระเบียบวิทยาลัย ว่าด้วยการแต่งกาย พ.ศ. 2566', 'year' => 2566],
            ['title' => 'แบบฟอร์มขอใบรับรองการศึกษา',                    'year' => 2567],
            ['title' => 'ปฏิทินการศึกษา ปีการศึกษา 2568',                'year' => 2568],
        ];
        foreach ($docs as $d) {
            Document::firstOrCreate(
                ['title' => $d['title']],
                [
                    'slug'        => Str::slug($d['title']),
                    'category_id' => $category->id,
                    'year'        => $d['year'],
                    'file_path'   => 'documents/placeholder.pdf',
                    'file_name'   => 'placeholder.pdf',
                    'file_type'   => 'pdf',
                    'file_size'   => 0,
                    'is_active'   => true,
                ]
            );
        }
    }

    private function seedKnowledgeBase(): void
    {
        $category = KnowledgeCategory::first();
        if (!$category) return;

        $items = [
            ['title' => 'บทเรียนออนไลน์ช่างยนต์เบื้องต้น',      'type' => 'article'],
            ['title' => 'วิดีโอสอนการเขียนโปรแกรม Python',       'type' => 'video'],
            ['title' => 'ลิงก์แหล่งเรียนรู้คณิตศาสตร์',          'type' => 'link'],
        ];
        foreach ($items as $item) {
            KnowledgeBase::firstOrCreate(
                ['slug' => Str::slug($item['title'])],
                [
                    'title'       => $item['title'],
                    'category_id' => $category->id,
                    'type'        => $item['type'],
                    'status'      => 'published',
                    'content'     => '<p>เนื้อหาตัวอย่างสำหรับรายการนี้</p>',
                ]
            );
        }
    }

    private function seedSchoolSystems(): void
    {
        $category = SystemCategory::first();

        $systems = [
            ['name' => 'ระบบบริหารงานบุคคล (HRMS)',      'url' => 'https://hrms.example.ac.th',   'color' => '#1E3A5F'],
            ['name' => 'ระบบงานทะเบียน',                  'url' => 'https://reg.example.ac.th',    'color' => '#0369A1'],
            ['name' => 'ระบบห้องสมุด',                    'url' => 'https://lib.example.ac.th',    'color' => '#0F766E'],
            ['name' => 'ระบบอีเมลสถานศึกษา',             'url' => 'https://mail.example.ac.th',   'color' => '#B45309'],
            ['name' => 'ระบบ E-Learning',                 'url' => 'https://learn.example.ac.th',  'color' => '#7C3AED'],
            ['name' => 'ระบบโรงฝึกงาน',                  'url' => 'https://ws.example.ac.th',     'color' => '#BE123C'],
        ];
        foreach ($systems as $i => $s) {
            SchoolSystem::firstOrCreate(
                ['name' => $s['name']],
                [
                    'url'          => $s['url'],
                    'color'        => $s['color'],
                    'category_id'  => $category?->id,
                    'order'        => $i + 1,
                    'open_new_tab' => true,
                    'is_active'    => true,
                ]
            );
        }
    }
}
