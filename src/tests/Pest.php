<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

// RefreshDatabase: каждый тест идёт в транзакции над БД laravel_db_test (см. phpunit.xml);
// схема создаётся один раз через migrate:fresh. withoutVite(): в тестах не нужен собранный public/build
pest()->extend(TestCase::class)
    ->use(RefreshDatabase::class)
    ->beforeEach(fn () => $this->withoutVite())
    ->in('Feature', 'Unit');
