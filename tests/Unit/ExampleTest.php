<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Section;
use App\User;

class ExampleTest extends TestCase
{
    /**
     * Testing redirect on sections page without authorization.
     *
     * @return void
     */
    public function testSectionsNoAuth302()
    {
        $response = $this->get('/sections');
        $response->assertRedirect('/login');
    }
    
    /**
     * Testing an http answer on sections page with authorization.
     *
     * @return void
     */
    public function testSectionsAuth200()
    {
        $this->loginWithFakeUser();
        $response = $this->get('/sections');
        $response->assertStatus(200);
    }
    
    /**
     * Testing an http answer on sections edit page.
     *
     * @return void
     */
    public function testEditSection200()
    {
        $this->loginWithFakeUser();
        $section = Section::first();
        $response = $this->get('/sections/edit/' . $section->id);
        $response->assertStatus(200);
    }
    
    /**
     * Adding user for application
     *
     * @return void
     */
    public function loginWithFakeUser()
    {
        $user = new User([
            'id' => 1,
            'name' => 'fake name'
        ]);

        $this->be($user);
    }
}
