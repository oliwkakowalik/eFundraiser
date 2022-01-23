<?php

$I = new AcceptanceTester($scenario ?? null);
$I->wantTo('test main page');

$I->amOnPage('/');

$I->see('Latest fundraisers','h3');
$I->see('Na schronisko dla kotków');
$I->see('Na schronisko dla piesków');
$I->see('Podróż do Chin');

$I->see('Top users','h3');
$I->see('Beatrice Travers');
$I->see('Olga Śmistek');
$I->see('Oliwia Kowalik');

$I->see('Latest donations ','h3');
$I->see('Na schronisko dla królików');
$I->see('Na schronisko dla piesków');

$title = 'Test Title';
$description = 'Test Description';
$category = 'Needs';
$date_string = "2022-02-24 23:59:00";
$stop_date = "2022-03-24";
$stop_timestamp = $stop_date . " 23:59:59";
$amount = '1000';
$amount2 = '0';
$amount3 = '900000';

$I->haveInDatabase('fundraisers', array('amount_to_be_raised' => $amount, 'amount_raised' => $amount2 , 'created_at' => $date_string,
             'title' => $title , 'stop_date' => $stop_date, 'description' => $description, 'user_id' => '1', 'category_id' => '2' ));

$I->amOnPage('/');
$I->see($title);
$I->see('Na schronisko dla kotków');
$I->see('Na schronisko dla piesków');
$I->dontsee('Podróż do Chin');


$I->haveInDatabase('donations', array('amount' => $amount3 , 'is_anonymous' => 0, 'created_at' => $date_string,
     'description' => $description,'user_id' => '1', 'fundraiser_id' => '2' ));

$I->amOnPage('/');

$I->see('John Doe');
$I->see('Beatrice Travers');
$I->see('Olga Śmistek');
$I->dontsee('Oliwia Kowalik');

$I->see('Na schronisko dla kotków');
$I->see('Na schronisko dla piesków');
$I->dontsee('Na schronisko dla królików');
