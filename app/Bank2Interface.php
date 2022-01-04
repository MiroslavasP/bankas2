<?php

namespace Bankas\Bankas2;

interface Bank2Interface
{
    function create(array $userData): void;

    function update(int $userId, array $userData): void;

    function delete(int $userId): void;

    function show(int $userId): array;

    function showAll(): array;
}
