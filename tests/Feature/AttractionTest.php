<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Attractions;
use App\Models\User;



class AttractionTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function test_guests_cannot_view_attractions(): void
    {
        $response = $this->get(route('attractions.index'));
        $response->assertRedirect(route('login'));
    }

     /** @test */
     public function test_authenticated_users_can_view_attractions()
     {
         $user = User::factory()->create();
         $this->actingAs($user);
 
         $attractions = Attractions::factory(5)->create(); 
         $response = $this->get(route('attractions.index'));
         $response->assertStatus(200)->assertSee($attractions->first()->name);
     }

      /** @test */
    public function test_non_admin_users_cannot_access_admin_pages()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('attractions.create'));
        $response->assertStatus(302);
    }

    /** @test */
    public function test_admins_can_create_attractions()
    {
        $admin = User::factory()->admin()->create();
        $this->actingAs($admin);

        $data = [
            'name' => 'Test Attraction',
            'price' => 150.50,
            'location' => 'Test Location',
            'description' => 'Test Description',
        ];
        
        $response = $this->post(route('attractions.store'), $data);
        $response->assertRedirect(route('attractions.index'));
        $this->assertDatabaseHas('attractions', $data);
    }

    /** @test */
    public function test_admins_can_update_attractions()
    {
        $admin = User::factory()->admin()->create();
        $this->actingAs($admin);

        $attraction = Attractions::factory()->create();

        $updatedData = [
            'name' => 'Updated Attraction Name',
            'price' => 250.00,
            'location' => 'Updated Test Location',
            'description' => 'Updated Test Description',
        ];

        $response = $this->put(route('attractions.update', $attraction->id), $updatedData);

        $response->assertRedirect(route('attractions.index'));
        $this->assertDatabaseHas('attractions', $updatedData);
    }

    /** @test */
    public function test_admins_can_delete_attractions()
    {
        $admin = User::factory()->admin()->create();
        $this->actingAs($admin);

        $attraction = Attractions::factory()->create();

        $response = $this->delete(route('attractions.destroy', $attraction->id));
        $response->assertStatus(200)->assertSee("Attraction deleted successfully!");

        $this->assertDatabaseMissing('attractions', ['id' => $attraction->id]);
    }
}
