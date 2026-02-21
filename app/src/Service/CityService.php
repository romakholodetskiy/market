<?php

namespace App\Service;

use App\Repository\CityRepository;

class CityService
{
    public function __construct(
        private CityRepository $cityRepository,
    ) {
    }

    public function showAll(): array
    {
        return $this->cityRepository->findAll();
    }
}
