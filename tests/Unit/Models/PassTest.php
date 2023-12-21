<?php

namespace Tests\Unit\Models;

use Tests\TestCase;

use App\Models\Charge;
use App\Models\Dependence;
use App\Models\User;

use App\Models\Pass;

use Illuminate\Foundation\Testing\RefreshDatabase;

class PassTest extends TestCase
{
    use RefreshDatabase;
    
    // public function test_belongs_to_charge(): void
    // {
    //     $pass = Pass::factory()->create();

    //     $this->assertInstanceOf(Charge::class, $pass->charge);
    // }
    //  public function test_belongs_to_dependence(): void
    // {
    //     $pass = Pass::factory()->create();

    //     $this->assertInstanceOf(Dependence::class, $pass->dependence);
    // }   
    
    // public function test_belongs_to_user(): void
    // {
    //     $pass = Pass::factory()->create();

    //     $this->assertInstanceOf(User::class, $pass->user);
    // }

}
