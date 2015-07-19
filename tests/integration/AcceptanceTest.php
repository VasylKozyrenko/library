<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AcceptanceTest extends TestCase
{
    /**
     * Assert title of home page
     *
     * @return void
     */
    public function testHomePage()
    {
        $this->visit('/')
             ->see('Library');
    }

    /**
     * Assert title of home page
     *
     * @return void
     */
    public function testRegisterPage()
    {
        $this->visit('/register')
            ->see('Register');
    }

    /**
     * Assert title of home page
     *
     * @return void
     */
    public function testLoginPage()
    {
        $this->visit('/login')
            ->see('Login');
    }
}
