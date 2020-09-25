<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * Test that validation error is given for missing name field
     *
     * @return void
     */
    public function testRegistrationNoName()
    {
        $response = $this->withHeaders(['Accept' => 'application/json'])->post('/api/users',[
            'email' => 'test@example.com',
            'password' => 'abcdefg123',
            'password_confirmation' => 'abcdefg123'
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('name');
    }
    
    /**
     * Test that validation error is given for password less than 8 characters
     * 
     * @return void
     */
    public function testRegistrationShortPassword()
    {
        $response = $this->withHeaders(['Accept' => 'application/json'])->post('/api/users',[
            'name' => 'Bob Johnson',
            'email' => 'test@example.com',
            'password' => 'abc123',
            'password_confirmation' => 'abc123'
        ]);
        
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('password');
    }
    
    /**
     * Test successful Registration
     * 
     * @return void
     */
    public function testSuccessfulRegistration()
    {
        $response = $this->withHeaders(['Accept' => 'application/json'])->post('/api/users',[
            'name' => 'Bob Johnson',
            'email' => 'test@example.com',
            'password' => 'abc123456',
            'password_confirmation' => 'abc123456'
        ]);
        
        $response->assertStatus(201);
        $response->assertJson(['name' => 'Bob Johnson']);
    }
}
