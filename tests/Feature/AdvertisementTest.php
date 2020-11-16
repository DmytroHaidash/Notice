<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdvertisementTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $all = $this->get('/api/advertisements/');
        $all->assertStatus(200);

        $show = $this->get('/api/advertisements/1');
        $show->assertStatus(200);

        $this->be(User::first());
        $data = [
            'title' => 'test',
            'description' => 'test description',
            'phone' => '+380661234567',
            'country' => 'Ukraine',
            'email' => 'test@test.com',
            'end_date' => '2020-11-16',
            'user_id' => 1,
        ];
        $create = $this->post('/api/advertisements/store', $data);
        $create->assertStatus(200);

        $update = $this->post('/api/advertisements/update/1', $data);
        $update->assertStatus(200);
    }
}
