<?php

namespace Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Charge;
use App\Models\Dependence;
use App\Models\User;
use App\Models\Pass;

class passTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    
    // public function test_guest_pass(): void
    // {
    //     $this->get('passes')->assertRedirect('login'); //index
    //     $this->get('passes/1')->assertRedirect('login'); //show
    //     $this->get('passes/i/edit')->assertRedirect('login'); //formulario editar
    //     $this->put('passes/1')->assertRedirect('login'); //editar - update
    //     $this->delete('passes/1')->assertRedirect('login'); //destroy - eliminar
    //     $this->get('passes/create')->assertRedirect('login'); //formulario - crear nuevo
    //     $this->post('passes', [])->assertRedirect('login'); //store - guardar nuevo
    // }
    
    // public function test_index_empty()
    // {
    //     Pass::factory()->create();

    //     $user = User::factory()->create();

    //     $this
    //         ->actingAs($user)
    //         ->get('passes')
    //         ->assertStatus(200)
    //         ->assertSee('No has creado ningun permiso');

    // }

    // public function test_index_with_data()
    // {   
    //     $user = User::factory()->create();
    //     $pass = Pass::factory()->create(['user_id' => $user->id]);

    //     dd($pass);

    //     $this
    //         ->actingAs($user)
    //         ->get("passes/$pass->id")
    //         ->assertStatus(200)
    //         ->assertSee($pass->name)
    //         ->assertSee($pass->charges_id)
    //         ->assertSee($pass->dependences_id)
    //         ->assertSee($pass->ncard)
    //         ->assertSee($pass->motive)
    //         ->assertSee($pass->place)
    //         ->assertSee($pass->observation)
    //         ->assertSee($pass->time)
    //         ->assertSee($pass->input)
    //         ->assertSee($pass->output)
    //         ->assertSee($pass->date);
    // }

    // public function test_create()
    // {
    //     $user = User::factory()->create();

    //     $this
    //         ->actingAs($user)
    //         ->get('passes/create')
    //         ->assertStatus(200);

    // }
    
    // public function test_store()
    // {   
        
    //     $charge = Charge::factory()->create();
    //     $dependence = Dependence::factory()->create();
    //     $user = User::factory()->create();
    //     $data = [
    //         'charge_id' => $charge->id,
    //         'dependence_id' => $dependence->id,

    //         'ncard' => $this->faker->randomDigitNot(6),
    //         'name' => $this->faker->name(),
    //         'motive' => $this->faker->sentence(),
    //         'place' => $this->faker->secondaryAddress(),
    //         'observation' => $this->faker->sentence(25),
    //         'time' => $this->faker->time(),
    //         'input' => $this->faker->time(),
    //         'output' => $this->faker->time(),
    //         'date' => $this->faker->date(),
    //     ];
    //     dd($data);


    //     $this
    //         ->actingAs($user)
    //         ->post('passes', $data)
    //         ->assertRedirect('passes');

    //     $this->assertDatabaseHas('passes', $data);   
    // }

    public function test_show()
    {
        $user = User::factory()->create();

        $pass = Pass::factory()->create(['user_id' => $user->id]);

        dd($pass);

        $this
            ->actingAs($user)
            ->get("passes/$pass->id")
            ->assertStatus(200);
    }

//     public function test_updade()
//     {
//         $charge = Charge::factory()->create();
//         $dependence = Dependence::factory()->create();


//         $user = User::factory()->create();
//         $pass = Pass::factory()->create(['user_id' => $user->id] );//pass->user_id === $user_id

//         //dd($user->id, "  ", $pass->user_id); user_id = 1, "  ", $pass->user_id = 1
//         $data = [
//             'charge_id' => $charge->id,
//             'dependence_id' => $dependence->id,

//             'ncard' => $this->faker->randomDigitNot(6),
//             'name' => $this->faker->name(),
//             'motive' => $this->faker->sentence(),
//             'place' => $this->faker->secondaryAddress(),
//             'observation' => $this->faker->sentence(25),
//             'time' => $this->faker->time(),
//             'input' => $this->faker->time(),
//             'output' => $this->faker->time(),
//             'date' => $this->faker->date(),
//         ];

//         $this
//         ->actingAs($user)
//         ->put("passes/$pass->id", $data)
//         ->assertRedirect("passes/$pass->id/edit");
        
//         $this->assertDatabaseHas('passes', $data);

//     }
    
//     public function test_edit()
//     {
//         $user = User::factory()->create();
//         $pass = Pass::factory()->create(['user_id' => $user->id]);
//         //dd($pass);
//         $this
//             ->actingAs($user)
//             ->get("passes/$pass->id/edit")
//             ->assertStatus(200)
//             ->assertSee($pass->id)
//             ->assertSee($pass->charge_id)
//             ->assertSee($pass->dependence_id)
//             ->assertSee($pass->ncard)
//             ->assertSee($pass->name)
//             ->assertSee($pass->motive)
//             ->assertSee($pass->place)
//             ->assertSee($pass->observation)
//             ->assertSee($pass->time)
//             ->assertSee($pass->input)
//             ->assertSee($pass->output)
//             ->assertSee($pass->date);
//     }

//     public function test_destroy()
//     {
//         $user = User::factory()->create();
//         $pass = Pass::factory()->create(['user_id' => $user->id]);

//         //dd($pass);

//         $this
//             ->actingAs($user)
//             ->delete("passes/$pass->id")
//             ->assertredirect('passes');

//         $this->assertDatabaseMissing('passes', [
//             'id' => $pass->id,
//             'charge_id' => $pass->charge_id,
//             'dependence_id' => $pass->dependence_id,
//             'ncard' => $pass->ncard,
//             'name' => $pass->name,
//             'motive' => $pass->motive,
//             'place' => $pass->place,
//             'observation' => $pass->observation,
//             'time' => $pass->time,
//             'input' => $pass->input,
//             'output' => $pass->output,
//             'date' => $pass->date,
//         ]);
//     }    

//     public function test_validate_store()
//     {   
//         $user = User::factory()->create();
//         $this
//             ->actingAs($user)
//             ->post('passes', [])
//             ->assertStatus(302)
//             ->assertSessionHasErrors([
//                 'ncard',
//                 'name',
//                 'charge_id',
//                 'dependence_id',
//                 'motive',
//                 'place',
//                 'time',
//                 'input',
//                 'output',
//                 'date',
//             ]);  
//     }
    
//     public function test_validate_updade()
//     {

//         $pass = Pass::factory()->create();//pass->user_id === $user_id
//         $user = User::factory()->create();

//         $this
//         ->actingAs($user)
//         ->put("passes/$pass->id", [])
//         ->assertStatus(302)
//         ->assertSessionHasErrors([
//             'ncard',
//             'name',
//             'charge_id',
//             'dependence_id',
//             'motive',
//             'place',
//             'time',
//             'input',
//             'output',
//             'date',
//         ]);
//     }

//     public function test_show_policy()
//     {
//         $user = User::factory()->create();

//         $pass = Pass::factory()->create();

//         $this
//             ->actingAs($user)
//             ->get("passes/$pass->id")
//             ->assertStatus(403);
//     }

//     public function test_updade_policy()
//     {
//         $charge = Charge::factory()->create();
//         $dependence = Dependence::factory()->create();

//         $user = User::factory()->create();
//         $pass = Pass::factory()->create();

//         //dd($pass);
//         $data = [
//             'charge_id' => $charge->id,
//             'dependence_id' => $dependence->id,

//             'ncard' => $this->faker->randomDigitNot(6),
//             'name' => $this->faker->name(),
//             'motive' => $this->faker->sentence(),
//             'place' => $this->faker->secondaryAddress(),
//             'observation' => $this->faker->sentence(25),
//             'time' => $this->faker->time(),
//             'input' => $this->faker->time(),
//             'output' => $this->faker->time(),
//             'date' => $this->faker->date(),
//         ];

//         //dd($user->id, "  ", $pass->user_id); //user->id =1,"  ", pass->user_id=2
//         $this
//         ->actingAs($user)
//         ->put("passes/$pass->id", $data)
//         ->assertStatus(403);

//     }

//     public function test_edit_policy()
//     {
//         $user = User::factory()->create();
//         $pass = Pass::factory()->create();

//         $this
//             ->actingAs($user)
//             ->get("passes/$pass->id/edit")
//             ->assertStatus(403);
//     }

//     public function test_destroy_policy()
//     {
//         $user = User::factory()->create();
//         $pass = Pass::factory()->create();

//         //dd($user->id, "   ", $pass->user_id);// 2," ", 1

//         $this
//             ->actingAs($user)
//             ->delete("passes/$pass->id")
//             ->assertStatus(403);
//     }    

}