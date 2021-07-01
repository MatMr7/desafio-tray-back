<?php

namespace Tests\Feature;

use App\Models\Seller;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SellerTest extends TestCase
{
    /**
     * Get all sellers
     * 
     * @return void
     */
    public function test_get_all_sellers()
    {
        Seller::factory()->count(6)->create();

        $response = $this->getJson('/seller');
        $response->assertStatus(200);
        $response->assertJsonCount(6,'data');
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'email',
                    'created_at'
                ]
            ]
        ]);
    }

    /**
     * Store a seller
     * 
     * @return void
     */
    public function test_store_seller()
    {
        $response = $this->postJson('/seller',[
            'name' => 'Test Name',
            'email' => 'test@mail'
        ]);
        $response->assertStatus(201);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'email',
                'created_at'
            ]
        ]);
        $response->assertJson([
            'data' => [
                'name' => 'Test Name',
                'email' => 'test@mail',
            ]
        ]);
    }

    /**
     * Validation Seller Store
     * 
     * @return void
     */
    public function test_store_seller_validations()
    {
        $response = $this->postJson('/seller',[
            //'name' => 'Test Name',
            'email' => 'test@mail'
        ]);
        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message',
            'errors' => [
                'name'
            ]
        ]);

        $response = $this->postJson('/seller',[
            'name' => 'Test Name',
            //'email' => 'test@mail'
        ]);
        $response->assertJsonStructure([
            'message',
            'errors' => [
                'email'
            ]
        ]);


        $response = $this->postJson('/seller',[
            //'name' => 'Test Name',
            //'email' => 'test@mail'
        ]);
        $response->assertJsonStructure([
            'message',
            'errors' => [
                'name',
                'email'
            ]
        ]);
        $response->assertStatus(422);
    }
}
