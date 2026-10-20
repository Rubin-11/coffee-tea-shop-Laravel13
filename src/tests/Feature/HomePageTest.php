<?php

it('открывает главную страницу', function () {
    $this->get('/')->assertOk();
});
