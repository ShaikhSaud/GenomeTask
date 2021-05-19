<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Carbon\Carbon;

class WeatherTest extends TestCase{
    /**
     * Test for checking the city validation
     *
     * @return void
     */
    public function test_city_validation(){
        $response = $this->post('/fetch-weather', ['city' => '']);

        $response->assertStatus(302);
    }

    /**
     * Test for case of correct city input
     *
     * @return void
     */
    public function test_correct_city(){
        $this->withoutExceptionHandling();

        $response = $this->post('/fetch-weather', ['city' => 'Karachi']);

        $response->assertJsonFragment([
            'date' => Carbon::now()->day,
            'month' => Carbon::now()->englishMonth,
            'city' => 'Karachi',
            'country' => 'PK'
        ]);
    }

    /**
     * Test for case of incorrect city input
     *
     * @return void
     */
    public function test_incorrect_city(){
        $this->withoutExceptionHandling();

        $response = $this->post('/fetch-weather', ['city' => 'Test City']);

        $response->assertStatus(404);
    }
}