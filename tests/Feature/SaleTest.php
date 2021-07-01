<?php

namespace Tests\Feature;

use App\Models\{
    Sale,
    Seller
};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SaleTest extends TestCase
{
    /**
     * Get all sales from a seller
     *
     * @return void
     */
    public function test_get_sales()
    {
        $seller = Seller::factory()->create();

        Sale::factory()->count(6)->create(['seller_uuid' => $seller->uuid]);

        $response = $this->getJson("/sale/$seller->uuid");
        $response->assertStatus(200);
        $response->assertJsonCount(6,'data');
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'seller' => [
                        'name',
                        'email'
                    ],
                    'sale_value',
                    'commission',
                    'created_at'
                ]
            ]
        ]);
    }

     /**
     * Store Sale
     *
     * @return void
     */
    public function test_errors_store_sales()
    {
        $seller = Seller::factory()->create();

        $response = $this->postJson("/sale",[
            'seller_id' => $seller->uuid,
            'sale_value' => "000000010000" //R$ 100
        ]);
        $response->assertStatus(201);
        $response->assertJsonStructure([
            'data' => [
                    'id',
                    'seller' => [
                        'name',
                        'email'
                    ],
                    'sale_value',
                    'commission',
                    'created_at'
            ]
        ]);
        $response->assertJson([
            'data' => [
                    'seller' => [
                        'name' => $seller->name,
                        'email' => $seller->email
                    ],
                    'sale_value' => 100,
                    'commission' => 8.5
            ]
        ]);
    }


     /**
     * Store validarion
     *
     * @return void
     */
    public function test_errors_validation_store_sales()
    {
        $seller = Seller::factory()->create();

        $response = $this->postJson("/sale",[
            //'seller_id' => $seller->uuid,
            'sale_value' => "000000010000" //R$ 100
        ]);
        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message',
            'errors' => [
                'seller_uuid'
            ]
        ]);
        $response = $this->postJson("/sale",[
            'seller_id' => $seller->uuid,
            //'sale_value' => "000000010000" //R$ 100
        ]);
        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message',
            'errors' => [
                'sale_value'
            ]
        ]);
        $response = $this->postJson("/sale",[
            //'seller_id' => $seller->uuid,
            //'sale_value' => "000000010000" //R$ 100
        ]);
        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message',
            'errors' => [
                'sale_value',
                'seller_uuid'
            ]
        ]);
    }

     /**
     * Store validarion
     *
     * @return void
     */
    public function test_errors_validation_get_sales()
    {
        $response = $this->getJson("/sale/fake-id");
        $response->assertStatus(422);
    }
}
