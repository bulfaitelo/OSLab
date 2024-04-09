<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\Os\Os;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OsServiceTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        // Preparando Banco de Dados
        parent::setUp();
        $this->artisan('db:seed');

    }

    public function test_create_os(): void
    {

    }
}
