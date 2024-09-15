<?php

namespace Tests\Unit\Http\Requests;

use App\Http\Requests\StoreUserRequest;
use PHPUnit\Framework\TestCase;

class StoreUserRequestTest extends TestCase
{
    /** @var StoreUserRequest */
    private $storeUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->storeUser = new StoreUserRequest();
    }

    public function testRules()
    {
        $this->assertEquals(
            [
                'name' => 'required|string|max:255',
                'father_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'cnic' => 'required|numeric|digits:13|unique:users',
                'phone' => 'required|phone:PK',
                'password' => 'required|string|min:8|confirmed',
                'gender' => 'required|string',
                'date_of_birth' => 'required|date'
            ],
            $this->storeUser->rules()
        );
    }

    public function testAuthorize()
    {
        $this->assertTrue($this->storeUser->authorize());
    }
}
