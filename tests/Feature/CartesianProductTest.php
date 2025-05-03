<?php

namespace Tests\Feature;

use App\Modules\Order\CalculationController;
use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CartesianProductTest extends TestCase
{

    public function testStandardProduct()
    {
        $payload = [
            'inputs' => [
                [1, 2],
                ['a', 'b']
            ]
        ];
    
        $response = $this->postJson('/api/calculate', $payload);
    
        $response->assertStatus(200)->assertJsonPath('data', [
            [1, 'a'],
            [1, 'b'],
            [2, 'a'],
            [2, 'b']
        ]);
    }
    
    public function testEmptyInputSet()
    {
        $payload = [
            'inputs' => [
                [1, 2],
                []
            ]
        ];

        $response = $this->postJson('/api/calculate', $payload);

        $response->assertStatus(200)
                 ->assertExactJson([]);
    }

    public function testSingleInputSet()
    {
        $payload = [
            'inputs' => [
                [5, 6]
            ]
        ];

        $response = $this->postJson('/api/calculate', $payload);
        
        $response->assertStatus(200)->assertJsonPath('data', [
            [5],
            [6]
        ]);

    }

    public function testTransformationCallback()
    {
        $payload = [
            'inputs' => [
                [1, 2],
                ['x']
            ]
        ];

        $response = $this->postJson('/api/calculate', $payload);

        $response->assertStatus(200)
                 ->assertExactJson([
                     '1-x',
                     '2-x'
                 ]);
    }

    public function testInvalidInputType()
    {
        $payload = [
            'inputs' => [
                [1, 2],
                'not-an-array'
            ]
        ];

        $response = $this->postJson('/api/calculate', $payload);

        $response->assertStatus(422);
    }
    

}
