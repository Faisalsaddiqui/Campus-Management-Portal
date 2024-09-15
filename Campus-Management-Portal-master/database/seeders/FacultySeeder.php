<?php

namespace Database\Seeders;

use DOMXPath;
use DOMDocument;
use App\Models\Faculty;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        list($faculties, $departments)  = $this->get_faculties_and_departments();
        $url = $this->get_programs_urls();
        $i = 0;
        $k = 0;
        foreach ($faculties as $key => $faculty) {

            $faculty_model =  Faculty::create($faculty);

            //create array from string by slicing every new line
            $department_array = explode("\n", $departments[$i]["department_name"]);
            //remove white space from array
            $department_array = preg_replace('/\h+/', ' ', $department_array);

            //removes waste lines
            array_pop($department_array);
            array_shift($department_array);



            foreach ($department_array as $dept) {
                //Check if empty 
                if (trim($dept) != '') {
                    $faculty_model->departments()->create([
                        "department_name" => $dept,
                        "slug" => $url[$k]['department_url'] ? $url[$k]['department_url'] : Str::slug($dept),
                    ]);
                    $k++;
                }
            }
            $i++;
        }
    }

    //Function to fetch faculties and departments from gcuf website
    //Messy, I know. But it works

    protected function get_faculties_and_departments()
    {
        $list = '<a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">Faculties';
        $response = Http::get('https://gcuf.edu.pk/');
        $body = $response->body();
        $list_first = explode($list, $body);
        $list_second = explode('<li class="nav-item dropdown ">', $list_first[1]);
        $list_second[0] = "<li>" . $list_second[0];

        $dom = new DOMDocument();
        @$dom->loadHTML($list_second[0]);


        $xpath = new DOMXPath($dom);

        $faculty_list = $xpath->evaluate("/html/body/li/ul/li/a");
        $department_list = $xpath->evaluate("/html/body/li/ul/li/ul");

        for ($i = 0; $i < $faculty_list->length; $i++) {
            $faculty_item = $faculty_list->item($i);
            $faculty_item_text = $faculty_item->nodeValue;

            $department_item = $department_list->item($i);
            $department_item_text = $department_item->nodeValue;

            $faculty_names[$i]['faculty_name'] = $faculty_item_text;
            $faculty_names[$i]['slug'] = Str::slug($faculty_item_text);
            $department_names[$i]['department_name'] = $department_item_text;
        }

        return array($faculty_names, $department_names);
    }

    protected function get_programs_urls()
    {
        $list = '<a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">Faculties';
        $response = Http::get('https://gcuf.edu.pk/');
        $body = $response->body();
        $list_first = explode($list, $body);
        $list_second = explode('<li class="nav-item dropdown ">', $list_first[1]);
        $list_second[0] = "<li>" . $list_second[0];

        $dom = new DOMDocument();
        @$dom->loadHTML($list_second[0]);


        $xpath = new DOMXPath($dom);

        $department_urls = $xpath->evaluate("/html/body/li/ul/li/ul//a");

        for ($k = 0; $k <  $department_urls->length; $k++) {
            $department_url_item = $department_urls->item($k);
            $department_url_item = $department_url_item->getAttribute('href');


            $url[$k]['department_url'] = $department_url_item;
        }

        return $url;
    }
}
