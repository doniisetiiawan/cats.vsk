<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testHomePageRedirection()
    {
        $response = $this->get('/');
        $response->assertRedirect('cats');
    }

    public function testVisitorIsRedirected()
    {
        $response = $this->get('/cats/create');
        $response->assertRedirect('login');
    }

    public function testLoggedInUserCanCreateCat()
    {
        $user = new User(['name'     => 'John Doe',
                          'is_admin' => false]);
        $this->be($user);
        $response = $this->get('/cats/create');
        $response->assertStatus(200);
    }

    public function testNonAdminCannotEditCat()
    {
        $user = new User(['id'       => 2,
                          'name'     => 'User #2',
                          'is_admin' => false]);
        $this->be($user);
        $response = $this->delete('/cats/2');
        $response->assertRedirect('/cats/2');
        $response->assertSessionHas('error');
    }
}
