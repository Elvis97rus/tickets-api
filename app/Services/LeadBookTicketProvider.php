<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class LeadBookTicketProvider implements TicketProviderInterface
{
    protected string $baseUrl;
    protected string $token;

    public function __construct()
    {
        $this->baseUrl = config('services.leadbook.base_url');
        $this->token = config('services.leadbook.token');
    }

    public function getShows(): array
    {
        $response = Http::withToken($this->token)->get("{$this->baseUrl}/shows");
        return $response->json();
    }

    public function getShowDetails(int $id): array
    {
        $response = Http::withToken($this->token)->get("{$this->baseUrl}/shows/{$id}/events");
        return $response->json();
    }

    public function getEventDetails(int $id): array
    {
        $response = Http::withToken($this->token)->get("{$this->baseUrl}/events/{$id}/places");
        return $response->json();
    }

    public function bookSeats(int $eventId, array $places, string $customerName): array
    {
        $response = Http::withToken($this->token)->post("{$this->baseUrl}/events/{$eventId}/reserve", [
            'places' => $places,
            'name' => $customerName,
        ]);

        return $response->json();
    }
}
