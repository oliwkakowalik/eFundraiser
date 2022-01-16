<?php

use App\Models\Category;
use Carbon\Carbon;

$I = new AcceptanceTester($scenario ?? null);
$I->wantTo('have fundraisers page');

$I->amOnPage('/login');
$I->fillField('email', 'john.doe@gmail.com');
$I->fillField('password', 'secret');
$I->click('Log in');

$I->seeCurrentUrlEquals('/dashboard');
$I->click('Fundraisers');

$I->seeCurrentUrlEquals('/fundraisers');

$I->click('Create new...');
$I->seeCurrentUrlEquals('/fundraisers/create');
$I->see('Creating a fundraiser', 'h2');
$I->click('Create');

$I->seeCurrentUrlEquals('/fundraisers/create');
$I->see('The title field is required.', 'li');
$I->see('The description field is required.', 'li');
$I->see('The stop date field is required.', 'li');
$I->see('The amount to be raised field is required.', 'li');

$title = 'Test Title';
$description = 'Test Description';
$category = 'Needs';
$date_string = "01/01/2030 23:59:00";
$stop_date = strtotime($date_string);
$stop_date_form = Carbon::createFromFormat('Y-m-d H:i:s', $date_string )->format('Y-m-d');
$amount = '1000';

$I->fillField('title', $title);
$I->selectOption("select", $category);
$I->fillField('description', $description);
$I->fillField('stop_date', '01/01/1950');
$I->fillField('amount_to_be_raised', '-5');

$I->click('Create');

$I->seeCurrentUrlEquals('/fundraisers/create');
$I->see('The stop date must be a date after now.', 'li');
$I->see('The amount to be raised must be greater than 0.', 'li');

$I->seeInField('title', $title);
$I->seeInField('category', $category);
$I->seeInField('description', $description);
$I->fillField('stop_date', $stop_date_form);
$I->fillField('amount_to_be_raised', $amount);

$I->dontSeeInDatabase('fundraisers', [
    'title' => $title,
    'description' => $description,
    'stop_date' => $stop_date,
    'amount_to_be_raised' => $amount
]);

$I->click('Create');

$I->seeInDatabase('fundraisers', [
    'title' => $title,
    'description' => $description,
    'amount_to_be_raised' => $amount
]);

$id = $I->grabFromDatabase('fundraisers', 'id', [
    'title' => $title
]);

$I->seeCurrentUrlEquals('/fundraisers/' . $id);

$I->see("Viewing a fundraiser", 'h2');
$I->see($title);
$I->see($description);
$I->see($category);
$I->see($stop_date);
$I->see($amount);
$I->see('O');

$I->amOnPage('/fundraisers');

$I->see("$title", 'tr > td');
$I->click($title);

$I->seeCurrentUrlEquals('/fundraisers/' . $id);

$I->click('Edit');

$I->seeCurrentUrlEquals('/fundraisers/' . $id . '/edit');
$I->see('Editing a fundraiser', 'h2');

$I->seeInField('title', $title);
$I->seeInField('category', $category);
$I->seeInField('description', $description);
$I->seeInField('stop_date', $stop_date);
$I->seeInField('amount_to_be_raised', $amount);

$I->fillField('amount_to_be_raised', '-5');
$I->seeInField('stop_date', '');

$I->click('Update');

$I->seeCurrentUrlEquals('/fundraisers/' . $id . '/edit');
$I->see('The stop date field is required.', 'li');
$I->see('The amount to be raised must be greater than 0.', 'li');

$updated_description = "Updated test description";
$updated_amount = '5000';

$I->fillField('description', $updated_description);
$I->fillField('amount_to_be_raised', $updated_amount);

$I->click('Update');

$I->seeCurrentUrlEquals('/fundraisers/' . $id);

$I->see($updated_description);
$I->see($updated_amount);

$I->dontSeeInDatabase('fundraisers', [
    'title' => $title,
    'description' => $description,
    'stop_date' => $stop_date,
    'amount_to_be_raised' => $amount
]);

$I->seeInDatabase('fundraisers', [
    'title' => $title,
    'description' => $updated_description,
    'stop_date' => $stop_date,
    'amount_to_be_raised' => $updated_amount
]);

$I->click('Delete');

$I->seeCurrentUrlEquals('/fundraisers');

$I->dontSeeInDatabase('fundraisers', [
    'title' => $title,
    'description' => $updated_description,
    'stop_date' => $stop_date,
    'amount_to_be_raised' => $updated_amount
]);

$I->dontSee($title);
