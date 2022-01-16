<?php

use App\Models\Category;

$I = new AcceptanceTester($scenario ?? null);
$I->wantTo('have donations page');

$I->amOnPage('/login');
$I->fillField('email', 'john.doe@gmail.com');
$I->fillField('password', 'secret');
$I->click('Log in');

$I->amOnPage('/fundraisers');

$I->click('Na schornisko dla kotków');

$id = $I->grabFromDatabase('fundraisers', 'id', [
    'title' => 'Na schornisko dla kotków'
]);

$I->seeCurrentUrlEquals('/fundraisers/' . $id);

$I->click('Make a donation');

$I->seeCurrentUrlEquals('/fundraisers/' . $id . '/donations/create');

$I->see("Making a donation", 'h2');

$I->click('Make a donation');

$I->seeCurrentUrlEquals('/fundraisers/' . $id . '/donations/create');
$I->see('The amount field is required.', 'li');
$I->see('The description field is required.', 'li');
$I->see('The is anonymous field is required.', 'li');

$amount = '12.50';
$description = 'Test Description';
$is_anonymous = '1';

$I->fillField('amount', 'abcd');
$I->fillField('description', $description);
$I->selectOption("select", $is_anonymous);

$I->click('Make a donation');
$I->seeCurrentUrlEquals('/fundraisers/' . $id . '/donations/create');
$I->see('The amount must be a number.', 'li');

$I->seeInField('description', $description);
$I->seeInField('is_anonymous', 'Anonymous donation');

$I->fillField('amount', $amount);

$I->dontSeeInDatabase('donations', [
    'amount' => $amount,
    'description' => $description,
    'is_anonymous' => $is_anonymous,
]);

$I->click('Make a donation');

$I->seeInDatabase('fundraisers', [
    'amount' => $amount,
    'description' => $description,
    'is_anonymous' => $is_anonymous,
]);

$idDonation = $I->grabFromDatabase('donations', 'id', [
    'amount' => $amount,
    'description' => $description,
    'is_anonymous' => $is_anonymous,
]);

$I->seeCurrentUrlEquals('/fundraisers/' . $id . '/donations/' . $idDonation);

$I->see("Viewing a donation", 'h2');
$I->see($amount, 'h3');
$I->see($description);
$I->see('Anonymous donation');

$I->amOnPage('/fundraisers/' . $id);

$I->click('Make a donation');

$amount = '18.50';
$description = 'Test Description2';
$is_anonymous = '0';

$I->fillField('amount', $amount);
$I->fillField('description', $description);
$I->selectOption("select", $is_anonymous);

$I->dontSeeInDatabase('donations', [
    'amount' => $amount,
    'description' => $description,
    'is_anonymous' => $is_anonymous,
]);

$I->click('Make a donation');

$I->seeInDatabase('fundraisers', [
    'amount' => $amount,
    'description' => $description,
    'is_anonymous' => $is_anonymous,
]);

$idDonation = $I->grabFromDatabase('donations', 'id', [
    'amount' => $amount,
    'description' => $description,
    'is_anonymous' => $is_anonymous,
]);

$I->seeCurrentUrlEquals('/fundraisers/' . $id . '/donations/' . $idDonation);

$userName = Auth::name();
$I->see("Viewing a donation", 'h2');
$I->see($amount, 'h3');
$I->see($description);
$I->see($userName);

$I->click('Edit');

$I->seeCurrentUrlEquals('/fundraisers/' . $id . '/donations/' . $idDonation . '/edit');

$I->see('Editing a donation', 'h2');

$I->seeInField('description', $description);
$I->seeInField('is_anonymous', 'Show my username');

$updated_description = "Updated test description";

$I->fillField('description', $updated_description);

$I->click('Update');

$I->seeCurrentUrlEquals('/fundraisers/' . $id . '/donations/' . $idDonation);

$I->see($updated_description);

$I->dontSeeInDatabase('fundraisers', [
    'amount' => $amount,
    'description' => $description,
    'is_anonymous' => $is_anonymous,
]);

$I->seeInDatabase('fundraisers', [
    'amount' => $amount,
    'description' => $updated_description,
    'is_anonymous' => $is_anonymous,
]);




