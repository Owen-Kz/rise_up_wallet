<?php

namespace Database\Seeders\Admin;

use App\Models\Frontend\AnnouncementCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnnouncementCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $announcement_categories = array(
            array('id' => '1','name' => '{"language":{"en":{"name":"Introduction"},"es":{"name":"Introducci\\u00f3n"},"ar":{"name":"\\u0645\\u0642\\u062f\\u0645\\u0629"}}}','status' => '1','created_at' => '2023-12-25 09:44:06','updated_at' => '2024-04-04 09:23:59'),
            array('id' => '2','name' => '{"language":{"en":{"name":"Security Measures"},"es":{"name":"Medidas de seguridad"},"ar":{"name":"\\u062a\\u062f\\u0627\\u0628\\u064a\\u0631 \\u0623\\u0645\\u0646\\u064a\\u0629"}}}','status' => '1','created_at' => '2023-12-25 09:44:29','updated_at' => '2024-04-04 09:23:24'),
            array('id' => '3','name' => '{"language":{"en":{"name":"FAQs About"},"es":{"name":"Preguntas frecuentes sobre"},"ar":{"name":"\\u0627\\u0644\\u0623\\u0633\\u0626\\u0644\\u0629 \\u0627\\u0644\\u0634\\u0627\\u0626\\u0639\\u0629 \\u062d\\u0648\\u0644"}}}','status' => '1','created_at' => '2023-12-25 09:44:56','updated_at' => '2024-04-04 09:22:58'),
            array('id' => '4','name' => '{"language":{"en":{"name":"Maximizing"},"es":{"name":"Maximizando"},"ar":{"name":"\\u062a\\u0639\\u0638\\u064a\\u0645"}}}','status' => '1','created_at' => '2023-12-25 09:45:10','updated_at' => '2024-04-04 09:22:26')
          );
        AnnouncementCategory::insert($announcement_categories);
    }
}
