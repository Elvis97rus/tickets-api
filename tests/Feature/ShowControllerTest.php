<?php

namespace Tests\Feature;

use App\Services\LeadBookTicketProvider;
use Tests\TestCase;
use Mockery;

class ShowControllerTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    /**
     * Тест на получение информации о конкретном мероприятии
     */
    public function testShowDetails()
    {
        $mockTicketProvider = Mockery::mock(LeadBookTicketProvider::class);

        // Ожидания: метод getShowDetails должен быть вызван и вернуть данные мероприятия
        $mockTicketProvider
            ->shouldReceive('getShowDetails')
            ->once()
            ->with(1)
            ->andReturn([
                'id' => 1,
                'showId' => 1,
                'date' => '2019-08-22 20:26:38',
            ]);

        $this->app->instance(LeadBookTicketProvider::class, $mockTicketProvider);

        $response = $this->getJson('/shows/1');

        $response->assertStatus(200)
            ->assertJson([
                'id' => 1,
                'showId' => 1,
                'date' => '2019-08-22 20:26:38',
            ]);
    }
}
