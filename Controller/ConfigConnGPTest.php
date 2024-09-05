<?php
require_once('./ConfigConnGP.php');
use PHPUnit\Framework\TestCase;

class ConfigConnGPTest extends TestCase
{
    public function testConnectDB()
    {
        $_SESSION['local'] = true;

        // Test case 1: When $current_url matches $goldorak
        $_SERVER['REQUEST_URI'] = "/goldorak/";
        $expected1 = new PDO("mysql:host=localhost; dbname=goldorak;charset=utf8mb4;port=3307", "root", "");
        $this->assertEquals($expected1, connectDB());

        // Test case 2: When $current_url matches $garageParrot
        $_SERVER['REQUEST_URI'] = "/garageparrot/";
        $expected2 = new PDO("mysql:host=localhost; dbname=garage_parrot;charset=utf8mb4;port=3307", "root", "");
        $this->assertEquals($expected2, connectDB());

        // Test case 3: When $current_url doesn't match $goldorak or $garageParrot
        $_SERVER['REQUEST_URI'] = "/someotherurl/";
        $expected3 = new PDO("mysql:host=localhost; dbname=mycv;charset=utf8mb4;port=3307", "root", "");
        $this->assertEquals($expected3, connectDB());

    }
}