<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->getDatabaseData()['courses'] as $course) {
            Course::create([
                'course_name' => $course['__2']['value'],
                'course_code' => substr($course['__1']['value'], 4, 3),
                'practical_credit_hours' => $course['__3']['value'][4],
                'theory_credit_hours' => $course['__3']['value'][2],
                'department_code' => substr($course['__1']['value'], 0, 3),
            ]);
        }
    }

    public function getDatabaseData()
    {
        $data = array(
            'courses' =>
            array(
                0 =>
                array(
                    '__1' =>
                    array(
                        'value' => 'CSI-301',
                        'position' =>
                        array(
                            0 => 350,
                            1 => 288,
                            2 => 436,
                            3 => 316,
                        ),
                        'confidence' => 1.0,
                        'review_required' => false,
                    ),
                    '__2' =>
                    array(
                        'value' => 'Programming Fundamentals',
                        'position' =>
                        array(
                            0 => 507,
                            1 => 288,
                            2 => 828,
                            3 => 316,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__3' =>
                    array(
                        'value' => '4(3-1)',
                        'position' =>
                        array(
                            0 => 1134,
                            1 => 288,
                            2 => 1201,
                            3 => 316,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                ),
                1 =>
                array(
                    '__1' =>
                    array(
                        'value' => 'CSI-303',
                        'position' =>
                        array(
                            0 => 350,
                            1 => 324,
                            2 => 436,
                            3 => 352,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__2' =>
                    array(
                        'value' => 'Introduction to Computing',
                        'position' =>
                        array(
                            0 => 507,
                            1 => 324,
                            2 => 810,
                            3 => 352,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__3' =>
                    array(
                        'value' => '4(3-1)',
                        'position' =>
                        array(
                            0 => 1134,
                            1 => 324,
                            2 => 1201,
                            3 => 352,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                ),
                2 =>
                array(
                    '__1' =>
                    array(
                        'value' => 'ENG-321',
                        'position' =>
                        array(
                            0 => 350,
                            1 => 359,
                            2 => 450,
                            3 => 387,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__2' =>
                    array(
                        'value' => 'Functional English',
                        'position' =>
                        array(
                            0 => 507,
                            1 => 359,
                            2 => 712,
                            3 => 387,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__3' =>
                    array(
                        'value' => '3(3-0)',
                        'position' =>
                        array(
                            0 => 1134,
                            1 => 359,
                            2 => 1201,
                            3 => 387,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                ),
                3 =>
                array(
                    '__1' =>
                    array(
                        'value' => 'ISL-321',
                        'position' =>
                        array(
                            0 => 350,
                            1 => 395,
                            2 => 433,
                            3 => 423,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__2' =>
                    array(
                        'value' => 'Islamic Studies / Ethics',
                        'position' =>
                        array(
                            0 => 507,
                            1 => 395,
                            2 => 764,
                            3 => 423,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__3' =>
                    array(
                        'value' => '2(2-0)',
                        'position' =>
                        array(
                            0 => 1134,
                            1 => 395,
                            2 => 1201,
                            3 => 423,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                ),
                4 =>
                array(
                    '__1' =>
                    array(
                        'value' => 'MTH-323 ',
                        'position' =>
                        array(
                            0 => 350,
                            1 => 430,
                            2 => 479,
                            3 => 529,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__2' =>
                    array(
                        'value' => 'Calculus and Analytical Geometry',
                        'position' =>
                        array(
                            0 => 507,
                            1 => 430,
                            2 => 886,
                            3 => 458,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__3' =>
                    array(
                        'value' => '3(3-0) 16',
                        'position' =>
                        array(
                            0 => 1134,
                            1 => 430,
                            2 => 1359,
                            3 => 494,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                ),
                5 =>
                array(
                    '__1' =>
                    array(
                        'value' => 'CSI-302',
                        'position' =>
                        array(
                            0 => 350,
                            1 => 537,
                            2 => 436,
                            3 => 564,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__2' =>
                    array(
                        'value' => 'Object Oriented Programming',
                        'position' =>
                        array(
                            0 => 507,
                            1 => 537,
                            2 => 849,
                            3 => 564,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__3' =>
                    array(
                        'value' => '4(3-1)',
                        'position' =>
                        array(
                            0 => 1134,
                            1 => 537,
                            2 => 1201,
                            3 => 564,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                ),
                6 =>
                array(
                    '__1' =>
                    array(
                        'value' => 'CSI-304',
                        'position' =>
                        array(
                            0 => 350,
                            1 => 572,
                            2 => 436,
                            3 => 600,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__2' =>
                    array(
                        'value' => 'Discrete Structures',
                        'position' =>
                        array(
                            0 => 507,
                            1 => 572,
                            2 => 723,
                            3 => 600,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__3' =>
                    array(
                        'value' => '3(3-0)',
                        'position' =>
                        array(
                            0 => 1134,
                            1 => 572,
                            2 => 1201,
                            3 => 600,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                ),
                7 =>
                array(
                    '__1' =>
                    array(
                        'value' => 'ENG-322',
                        'position' =>
                        array(
                            0 => 350,
                            1 => 608,
                            2 => 450,
                            3 => 635,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__2' =>
                    array(
                        'value' => 'English Comprehension & Composition',
                        'position' =>
                        array(
                            0 => 507,
                            1 => 608,
                            2 => 948,
                            3 => 635,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__3' =>
                    array(
                        'value' => '3(3-0)',
                        'position' =>
                        array(
                            0 => 1134,
                            1 => 608,
                            2 => 1201,
                            3 => 635,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                ),
                8 =>
                array(
                    '__1' =>
                    array(
                        'value' => 'MTH-324',
                        'position' =>
                        array(
                            0 => 350,
                            1 => 643,
                            2 => 456,
                            3 => 671,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__2' =>
                    array(
                        'value' => 'Advanced Calculus',
                        'position' =>
                        array(
                            0 => 507,
                            1 => 643,
                            2 => 718,
                            3 => 671,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__3' =>
                    array(
                        'value' => '3(3-0)',
                        'position' =>
                        array(
                            0 => 1134,
                            1 => 643,
                            2 => 1201,
                            3 => 671,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                ),
                9 =>
                array(
                    '__1' =>
                    array(
                        'value' => 'ELT-321',
                        'position' =>
                        array(
                            0 => 350,
                            1 => 679,
                            2 => 440,
                            3 => 707,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__2' =>
                    array(
                        'value' => 'Basic Electronics',
                        'position' =>
                        array(
                            0 => 507,
                            1 => 679,
                            2 => 694,
                            3 => 707,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__3' =>
                    array(
                        'value' => '3(3-0)',
                        'position' =>
                        array(
                            0 => 1134,
                            1 => 679,
                            2 => 1201,
                            3 => 707,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                ),
                10 =>
                array(
                    '__1' =>
                    array(
                        'value' => 'PST-321 ',
                        'position' =>
                        array(
                            0 => 350,
                            1 => 714,
                            2 => 479,
                            3 => 813,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__2' =>
                    array(
                        'value' => 'Pakistan Studies',
                        'position' =>
                        array(
                            0 => 507,
                            1 => 714,
                            2 => 691,
                            3 => 742,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__3' =>
                    array(
                        'value' => '2(2-0) 18',
                        'position' =>
                        array(
                            0 => 1134,
                            1 => 714,
                            2 => 1359,
                            3 => 778,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                ),
                11 =>
                array(
                    '__1' =>
                    array(
                        'value' => 'CSI-401',
                        'position' =>
                        array(
                            0 => 350,
                            1 => 821,
                            2 => 436,
                            3 => 849,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__2' =>
                    array(
                        'value' => 'Data Structure and Algorithms',
                        'position' =>
                        array(
                            0 => 507,
                            1 => 821,
                            2 => 851,
                            3 => 849,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__3' =>
                    array(
                        'value' => '3(2-1)',
                        'position' =>
                        array(
                            0 => 1134,
                            1 => 821,
                            2 => 1201,
                            3 => 849,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                ),
                12 =>
                array(
                    '__1' =>
                    array(
                        'value' => 'CSI-403',
                        'position' =>
                        array(
                            0 => 350,
                            1 => 856,
                            2 => 436,
                            3 => 884,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__2' =>
                    array(
                        'value' => 'Digital Logic and Design',
                        'position' =>
                        array(
                            0 => 507,
                            1 => 856,
                            2 => 774,
                            3 => 884,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__3' =>
                    array(
                        'value' => '3(2-1)',
                        'position' =>
                        array(
                            0 => 1134,
                            1 => 856,
                            2 => 1201,
                            3 => 884,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                ),
                13 =>
                array(
                    '__1' =>
                    array(
                        'value' => 'SWE-401',
                        'position' =>
                        array(
                            0 => 350,
                            1 => 891,
                            2 => 452,
                            3 => 919,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__2' =>
                    array(
                        'value' => 'Introduction to Software Engineering',
                        'position' =>
                        array(
                            0 => 507,
                            1 => 891,
                            2 => 928,
                            3 => 919,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__3' =>
                    array(
                        'value' => '3(3-0)',
                        'position' =>
                        array(
                            0 => 1134,
                            1 => 891,
                            2 => 1201,
                            3 => 919,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                ),
                14 =>
                array(
                    '__1' =>
                    array(
                        'value' => 'ENG-421',
                        'position' =>
                        array(
                            0 => 350,
                            1 => 927,
                            2 => 450,
                            3 => 955,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__2' =>
                    array(
                        'value' => 'Communication Skills',
                        'position' =>
                        array(
                            0 => 507,
                            1 => 927,
                            2 => 749,
                            3 => 955,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__3' =>
                    array(
                        'value' => '3(3-0)',
                        'position' =>
                        array(
                            0 => 1134,
                            1 => 927,
                            2 => 1201,
                            3 => 955,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                ),
                15 =>
                array(
                    '__1' =>
                    array(
                        'value' => 'STA-321',
                        'position' =>
                        array(
                            0 => 350,
                            1 => 963,
                            2 => 443,
                            3 => 990,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__2' =>
                    array(
                        'value' => 'Introduction to Statistical Theory',
                        'position' =>
                        array(
                            0 => 507,
                            1 => 963,
                            2 => 880,
                            3 => 990,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__3' =>
                    array(
                        'value' => '3(3-0)',
                        'position' =>
                        array(
                            0 => 1134,
                            1 => 963,
                            2 => 1201,
                            3 => 990,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                ),
                16 =>
                array(
                    '__1' =>
                    array(
                        'value' => 'MTH-424 ',
                        'position' =>
                        array(
                            0 => 350,
                            1 => 998,
                            2 => 479,
                            3 => 1097,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__2' =>
                    array(
                        'value' => 'Linear Algebra',
                        'position' =>
                        array(
                            0 => 507,
                            1 => 998,
                            2 => 670,
                            3 => 1026,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__3' =>
                    array(
                        'value' => '3(3-0) 18',
                        'position' =>
                        array(
                            0 => 1134,
                            1 => 998,
                            2 => 1359,
                            3 => 1061,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                ),
                17 =>
                array(
                    '__1' =>
                    array(
                        'value' => 'CSI-402',
                        'position' =>
                        array(
                            0 => 350,
                            1 => 1105,
                            2 => 436,
                            3 => 1132,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__2' =>
                    array(
                        'value' => 'Operating Systems',
                        'position' =>
                        array(
                            0 => 507,
                            1 => 1105,
                            2 => 719,
                            3 => 1132,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__3' =>
                    array(
                        'value' => '3(2-1)',
                        'position' =>
                        array(
                            0 => 1134,
                            1 => 1105,
                            2 => 1201,
                            3 => 1132,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                ),
                18 =>
                array(
                    '__1' =>
                    array(
                        'value' => 'SWE-450',
                        'position' =>
                        array(
                            0 => 350,
                            1 => 1140,
                            2 => 452,
                            3 => 1168,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__2' =>
                    array(
                        'value' => 'Object Oriented Software Design',
                        'position' =>
                        array(
                            0 => 507,
                            1 => 1140,
                            2 => 880,
                            3 => 1168,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__3' =>
                    array(
                        'value' => '3(2-1)',
                        'position' =>
                        array(
                            0 => 1134,
                            1 => 1140,
                            2 => 1201,
                            3 => 1168,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                ),
                19 =>
                array(
                    '__1' =>
                    array(
                        'value' => 'CSI-405',
                        'position' =>
                        array(
                            0 => 350,
                            1 => 1176,
                            2 => 436,
                            3 => 1203,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__2' =>
                    array(
                        'value' => 'Introduction to Database Systems',
                        'position' =>
                        array(
                            0 => 507,
                            1 => 1176,
                            2 => 890,
                            3 => 1203,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__3' =>
                    array(
                        'value' => '4(3-1)',
                        'position' =>
                        array(
                            0 => 1134,
                            1 => 1176,
                            2 => 1201,
                            3 => 1203,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                ),
                20 =>
                array(
                    '__1' =>
                    array(
                        'value' => 'CSI-506',
                        'position' =>
                        array(
                            0 => 350,
                            1 => 1211,
                            2 => 436,
                            3 => 1239,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__2' =>
                    array(
                        'value' => 'Analysis of Algorithms',
                        'position' =>
                        array(
                            0 => 507,
                            1 => 1211,
                            2 => 758,
                            3 => 1239,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__3' =>
                    array(
                        'value' => '3(3-0)',
                        'position' =>
                        array(
                            0 => 1134,
                            1 => 1211,
                            2 => 1201,
                            3 => 1239,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                ),
                21 =>
                array(
                    '__1' =>
                    array(
                        'value' => 'CSI-406 ',
                        'position' =>
                        array(
                            0 => 350,
                            1 => 1246,
                            2 => 479,
                            3 => 1345,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__2' =>
                    array(
                        'value' => 'Computer Communications and Networks',
                        'position' =>
                        array(
                            0 => 507,
                            1 => 1246,
                            2 => 983,
                            3 => 1274,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__3' =>
                    array(
                        'value' => '3(3-0) 16',
                        'position' =>
                        array(
                            0 => 1134,
                            1 => 1246,
                            2 => 1359,
                            3 => 1310,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                ),
                22 =>
                array(
                    '__1' =>
                    array(
                        'value' => 'CSI-501',
                        'position' =>
                        array(
                            0 => 350,
                            1 => 1353,
                            2 => 436,
                            3 => 1381,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__2' =>
                    array(
                        'value' => 'Web Engineering',
                        'position' =>
                        array(
                            0 => 507,
                            1 => 1353,
                            2 => 700,
                            3 => 1381,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__3' =>
                    array(
                        'value' => '3(2-1)',
                        'position' =>
                        array(
                            0 => 1134,
                            1 => 1353,
                            2 => 1201,
                            3 => 1381,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                ),
                23 =>
                array(
                    '__1' =>
                    array(
                        'value' => 'SWE-501',
                        'position' =>
                        array(
                            0 => 350,
                            1 => 1388,
                            2 => 452,
                            3 => 1416,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__2' =>
                    array(
                        'value' => 'Software Requirements Engineering',
                        'position' =>
                        array(
                            0 => 507,
                            1 => 1388,
                            2 => 915,
                            3 => 1416,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__3' =>
                    array(
                        'value' => '3(2-1)',
                        'position' =>
                        array(
                            0 => 1134,
                            1 => 1388,
                            2 => 1201,
                            3 => 1416,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                ),
                24 =>
                array(
                    '__1' =>
                    array(
                        'value' => 'SWE-550',
                        'position' =>
                        array(
                            0 => 350,
                            1 => 1424,
                            2 => 452,
                            3 => 1452,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__2' =>
                    array(
                        'value' => 'Software Quality Assurance',
                        'position' =>
                        array(
                            0 => 507,
                            1 => 1424,
                            2 => 819,
                            3 => 1452,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__3' =>
                    array(
                        'value' => '3(3-0)',
                        'position' =>
                        array(
                            0 => 1134,
                            1 => 1424,
                            2 => 1201,
                            3 => 1452,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                ),
                25 =>
                array(
                    '__1' =>
                    array(
                        'value' => 'SWE-503',
                        'position' =>
                        array(
                            0 => 350,
                            1 => 1459,
                            2 => 452,
                            3 => 1487,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__2' =>
                    array(
                        'value' => 'Software Engineering Economics',
                        'position' =>
                        array(
                            0 => 507,
                            1 => 1459,
                            2 => 877,
                            3 => 1487,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__3' =>
                    array(
                        'value' => '3(3-0)',
                        'position' =>
                        array(
                            0 => 1134,
                            1 => 1459,
                            2 => 1201,
                            3 => 1487,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                ),
                26 =>
                array(
                    '__1' =>
                    array(
                        'value' => 'BBA-506',
                        'position' =>
                        array(
                            0 => 350,
                            1 => 1495,
                            2 => 447,
                            3 => 1523,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__2' =>
                    array(
                        'value' => 'Human Resource Management',
                        'position' =>
                        array(
                            0 => 507,
                            1 => 1495,
                            2 => 859,
                            3 => 1523,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__3' =>
                    array(
                        'value' => '3(3-0)',
                        'position' =>
                        array(
                            0 => 1134,
                            1 => 1495,
                            2 => 1201,
                            3 => 1523,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                ),
                27 =>
                array(
                    '__1' =>
                    array(
                        'value' => 'CSI-601 ',
                        'position' =>
                        array(
                            0 => 350,
                            1 => 1530,
                            2 => 479,
                            3 => 1629,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__2' =>
                    array(
                        'value' => 'Human Computer Interaction',
                        'position' =>
                        array(
                            0 => 507,
                            1 => 1530,
                            2 => 841,
                            3 => 1558,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__3' =>
                    array(
                        'value' => '3(3-0) 18',
                        'position' =>
                        array(
                            0 => 1134,
                            1 => 1530,
                            2 => 1359,
                            3 => 1593,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                ),
                28 =>
                array(
                    '__1' =>
                    array(
                        'value' => 'SOC-307',
                        'position' =>
                        array(
                            0 => 350,
                            1 => 1637,
                            2 => 447,
                            3 => 1664,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__2' =>
                    array(
                        'value' => 'Introduction to Sociology',
                        'position' =>
                        array(
                            0 => 507,
                            1 => 1637,
                            2 => 793,
                            3 => 1664,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__3' =>
                    array(
                        'value' => '3(3-0)',
                        'position' =>
                        array(
                            0 => 1134,
                            1 => 1637,
                            2 => 1201,
                            3 => 1664,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                ),
                29 =>
                array(
                    '__1' =>
                    array(
                        'value' => 'SWE-505',
                        'position' =>
                        array(
                            0 => 350,
                            1 => 1672,
                            2 => 452,
                            3 => 1700,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__2' =>
                    array(
                        'value' => 'Professional Practices',
                        'position' =>
                        array(
                            0 => 507,
                            1 => 1672,
                            2 => 753,
                            3 => 1700,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__3' =>
                    array(
                        'value' => '3(3-0)',
                        'position' =>
                        array(
                            0 => 1134,
                            1 => 1672,
                            2 => 1201,
                            3 => 1700,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                ),
                30 =>
                array(
                    '__1' =>
                    array(
                        'value' => 'CSI-607',
                        'position' =>
                        array(
                            0 => 350,
                            1 => 1708,
                            2 => 436,
                            3 => 1735,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__2' =>
                    array(
                        'value' => 'Artificial Intelligence',
                        'position' =>
                        array(
                            0 => 507,
                            1 => 1708,
                            2 => 739,
                            3 => 1735,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__3' =>
                    array(
                        'value' => '3(2-1)',
                        'position' =>
                        array(
                            0 => 1134,
                            1 => 1708,
                            2 => 1201,
                            3 => 1735,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                ),
                31 =>
                array(
                    '__1' =>
                    array(
                        'value' => 'SWE-551',
                        'position' =>
                        array(
                            0 => 350,
                            1 => 1743,
                            2 => 452,
                            3 => 1771,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__2' =>
                    array(
                        'value' => 'Software Design and Architecture',
                        'position' =>
                        array(
                            0 => 507,
                            1 => 1743,
                            2 => 888,
                            3 => 1771,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__3' =>
                    array(
                        'value' => '3(2-1)',
                        'position' =>
                        array(
                            0 => 1134,
                            1 => 1743,
                            2 => 1201,
                            3 => 1771,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                ),
                32 =>
                array(
                    '__1' =>
                    array(
                        'value' => 'SWE-553',
                        'position' =>
                        array(
                            0 => 350,
                            1 => 1779,
                            2 => 452,
                            3 => 1807,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__2' =>
                    array(
                        'value' => 'Visual Programming',
                        'position' =>
                        array(
                            0 => 507,
                            1 => 1779,
                            2 => 734,
                            3 => 1807,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                    '__3' =>
                    array(
                        'value' => '3(2-1)',
                        'position' =>
                        array(
                            0 => 1134,
                            1 => 1779,
                            2 => 1201,
                            3 => 1807,
                        ),
                        'confidence' => 0,
                        'review_required' => true,
                    ),
                ),
            ),
        );


        return $data;
    }
}
