<?php

namespace Database\Seeders;

use App\Models\Degree;
use DOMXPath;
use DOMDocument;
use App\Models\Department;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Degree::create([
            'degree_name' => 'BS',
            'semesters' => 8,
        ]);
        Degree::create([
            'degree_name' => 'Associate Degree',
            'semesters' => 4,
        ]);
        Degree::create([
            'degree_name' => 'BBA',
            'semesters' => 8,

        ]);

        $programs = $this->get_programs_from_departments();
        $program_urls = Department::all();


        //match to see if dept url is similiar to progarms
        foreach ($program_urls as $key => $url) { {
                foreach ($programs as $i => $program) {
                    $program = $program['program_name'];

                    //Match urls with program names
                    similar_text($this->replace_dashes($url->slug),  $this->remove_extra_text(strtolower($program)), $percentage);

                    if ($percentage > 74) {
                        $degree = 1;
                        if (str_contains($program, "Associate")) {
                            $degree = 2;
                        }
                        $url->programs()->create([
                            'degree_id' => $degree,
                            'slug' => Str::slug($program),
                            'credit_hours' => 130
                        ]);
                    }
                }
            }
        }
    }

    protected function replace_dashes($string)
    {
        $string = str_replace(["dept-", "-"], " ", $string);
        return $string;
    }

    protected function remove_extra_text($string)
    {
        $string = str_replace(["associate degree in", "degree", "bs", "b.sc", "bba", "(hons.)", "."], " ", $string);
        return $string;
    }

    protected function get_programs_from_departments()
    {

        //html page from gcuf admission page
        $body = View::make('selection')->render();

        $dom = new DOMDocument();
        @$dom->loadHTML($body);

        $xpath = new DOMXPath($dom);
        $options = $xpath->evaluate("/html/body//option");

        for ($i = 0; $i < $options->length; $i++) {
            $program_item = $options->item($i);
            $program_item_text = $program_item->nodeValue;
            $program_names[$i]['program_name'] = $program_item_text;
        }

        array_shift($program_names);
        return $program_names;
    }
}
