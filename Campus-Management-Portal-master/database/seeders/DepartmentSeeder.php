<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    }


    public function get_data()
    {
        $response = Http::get('https://gcuf.edu.pk/dept-applied-chemistry');
        $body = $response->body();
        $table_first = explode('<table class="table table-striped table-condensed">', $body);

        $table_second = explode('</table>', $table_first[1]);
    }
}
