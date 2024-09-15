<?php

namespace Database\Seeders;

use App\Models\Organization;
use DOMXPath;
use DOMDocument;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\View;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $organizations = $this->get_organizations();
        foreach ($organizations as $key => $organization) {
            Organization::create($organization);
        }
    }

    private function get_organizations()
    {
        $body = View::make('boards')->render();


        $dom = new DOMDocument();
        @$dom->loadHTML($body);


        $xpath = new DOMXPath($dom);
        $options = $xpath->evaluate("/html/body//option");

        for ($i = 0; $i < $options->length; $i++) {
            $organizations_item = $options->item($i);
            $organizations_item_text = $organizations_item->nodeValue;
            $organizations[$i]['organization_name'] = $organizations_item_text;
        }
        array_shift($organizations);
        return $organizations;
    }
}
