<?php

namespace Tests\Unit\Models;

use Tests\TestCase;

use App\Models\Dependence;
use Illuminate\Database\Eloquent\Collection;

class DependenceTest extends TestCase
{   
    
    public function test_has_many_dependence(): void
    {   
        
        $dependence = new Dependence;
        $this->assertInstanceOf(Collection::class, $dependence->passes);
        
    }

}
