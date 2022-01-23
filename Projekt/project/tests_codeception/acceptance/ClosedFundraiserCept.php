<?php

$I = new AcceptanceTester($scenario ?? null);
$I->wantTo('check functionialities for a closed fundraiser');

$I->amOnPage('/fundraisers');
$I->click('End Date ↑');

$stop_dates = $I->grabColumnFromDatabase('fundraisers', 'stop_date');
$min = min($stop_dates);

$fundraiser = $I->grabFromDatabase('fundraisers', 'title', array('stop_date' => $min));
$fundraiser_id = $I->grabFromDatabase('fundraisers', 'id', array('stop_date' => $min));
$user_id = $I->grabFromDatabase('fundraisers', 'user_id', array('stop_date' => $min));

$I->see($fundraiser);
$I->see('Closed');

$I->click($fundraiser);

$I->seeCurrentUrlEquals('/fundraisers/'.$fundraiser_id);
$I->see('This fundraiser has ended and further donations are not allowed.');
$I->dontSee('Make a donation');

$I->see('See all donations for this fundraiser');

$I->amOnPage('/login');

$user_email = $I->grabFromDatabase('users', 'email', array('id' => $user_id));

$I->fillField('email', $user_email);
$I->fillField('password', 'secret');

$I->click('Log in');

$I->seeCurrentUrlEquals('/dashboard');
$I->click($fundraiser);

$I->see('This fundraiser has ended and further donations are not allowed.');
$I->dontSee('Make a donation');
$I->dontSee('Edit');
