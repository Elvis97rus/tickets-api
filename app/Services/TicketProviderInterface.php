<?php

namespace App\Services;
interface TicketProviderInterface
{
    public function getShows(): array;
    public function getShowDetails(int $id): array;
    public function getEventDetails(int $id): array;
    public function bookSeats(int $eventId, array $places, string $customerName): array;
}
