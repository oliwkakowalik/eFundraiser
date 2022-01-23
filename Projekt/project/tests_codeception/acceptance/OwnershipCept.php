<?php

$I = new AcceptanceTester($scenario ?? null);
$I->wantTo('cannot edit or delete not my fundraiser and donation despite being verified');

$fundraiser = 'Na schronisko dla piesków';

$I->amOnPage('/');
$I->click('Log in');

// verified user
$I->fillField('email', 'krzysztof.zarnowski@gmail.com');
$I->fillField('password', 'secret');

$I->click('Log in');

$fundraiser_id = $I->grabFromDatabase('fundraisers', 'id', [
    'title' => $fundraiser
]);

$I->amOnPage('/fundraisers'.$fundraiser_id);

$I->dontSee('Edit');
$I->dontSee('Delete');

$I->amOnPage('/fundraisers/'.$fundraiser_id.'/edit');
$I->seeResponseCodeIs(403);

$donation_id = $I->grabFromDatabase('donations', 'id', [
    'amount' => '3000',
    'description' => 'Kocham pieski'
]);

$I->amOnPage('/fundraisers'.$fundraiser_id.'donations'.$donation_id);

$I->dontSee('Edit');

$I->amOnPage('/fundraisers/'.$fundraiser_id.'donations'.$donation_id.'/edit');
$I->seeResponseCodeIs(403);



