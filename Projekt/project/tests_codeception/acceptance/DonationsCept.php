<?php

$I = new AcceptanceTester($scenario ?? null);
$I->wantTo('have donations page');

$I->amOnPage('/login');
$I->fillField('email', 'john.doe@gmail.com');
$I->fillField('password', 'secret');
$I->click('Log in');

$I->amOnPage('/fundraisers');

$I->click('Na schronisko dla kotków');

$my_id = $I->grabFromDatabase('users', 'id', array('name' => 'John Doe'));
$id = $I->grabFromDatabase('fundraisers', 'id', [
    'title' => 'Na schronisko dla kotków'
]);

$I->seeCurrentUrlEquals('/fundraisers/' . $id);

$I->click('Make a donation');

$I->seeCurrentUrlEquals('/fundraisers/' . $id . '/donations/create');

$I->see("Making a donation", 'h2');

$I->click('Make a donation');

$I->seeCurrentUrlEquals('/fundraisers/' . $id . '/donations/create');
$I->see('The amount field is required.', 'li');
$I->see('The description field is required.', 'li');

$amount = '12.5';
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

$I->seeInDatabase('donations', [
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
$I->see($amount);
$I->see($description);
$I->see('Anonymous donation');

$I->submitForm('#logout_form', array( 'users' => array('name' => 'John Doe')));
$I->seeCurrentUrlEquals('/');

$I->amOnPage("/users/".$my_id);
$I->dontSee($amount);

$I->amOnPage('/login');
$I->fillField('email', 'john.doe@gmail.com');
$I->fillField('password', 'secret');
$I->click('Log in');

$I->amOnPage('/fundraisers/' . $id);

$I->click('Make a donation');

$amount = '18.5';
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

$I->seeInDatabase('donations', [
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

$userId = $I->grabFromDatabase('donations', 'user_id', [
    'amount' => $amount,
    'description' => $description,
    'is_anonymous' => $is_anonymous,
]);

$userName = $I->grabFromDatabase('users', 'name', [
    'id' => $userId
]);

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

$I->dontSeeInDatabase('donations', [
    'amount' => $amount,
    'description' => $description,
    'is_anonymous' => $is_anonymous,
]);

$I->seeInDatabase('donations', [
    'amount' => $amount,
    'description' => $updated_description,
    'is_anonymous' => $is_anonymous,
]);


$I->click('Dashboard');
$I->seeCurrentUrlEquals('/dashboard');

$I->see($amount);
$I->click($amount);
$I->seeCurrentUrlEquals('/fundraisers/' . $id . '/donations/' . $idDonation);


$I->submitForm('#logout_form', array( 'users' => array('name' => 'John Doe')));
$I->seeCurrentUrlEquals('/');

$I->amOnPage("/users/".$my_id);
$I->see($amount);

