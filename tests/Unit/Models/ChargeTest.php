<?php

namespace Tests\Unit\Models;


use Tests\TestCase;

use App\Models\Charge;
use Illuminate\Database\Eloquent\Collection;


class ChargeTest extends TestCase
{
    
    public function test_has_many_charges(): void
    {
        $charge = new Charge;
        $this->assertInstanceOf(Collection::class, $charge->passes);
        
    }
    
}
