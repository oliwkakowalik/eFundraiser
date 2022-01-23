<?php

$I = new AcceptanceTester($scenario ?? null);

$I->wantTo('check functionalities connected to users');

$I->amOnPage('/');

$I->click('Log in');
$I->amOnPage('/login');

$I->fillField('email', 'olga.smistek@gmail.com');
$I->fillField('password', 'secret');

$I->click('Log in');

$I->seeCurrentUrlEquals('/dashboard');

$my_name = $I->grabFromDatabase('users', 'name', array('name' => 'Olga Śmistek'));
$my_id = $I->grabFromDatabase('users', 'id', array('name' => 'Olga Śmistek'));
$my_email = $I->grabFromDatabase('users', 'email', array('name' => 'Olga Śmistek'));

$I->see($my_name."'s account", 'h2');

$I->click("Edit your profile");
$I->seeCurrentUrlEquals('/users/'.$my_id.'/edit');

$I->see("Editing your account", 'h2');

$I->see($my_name);
$I->see($my_email);

$I->dontSee('The name field is required.');
$I->dontSee('The email field is required.');
$I->dontSee('The password field is required.');

$I->fillField('name', '');
$I->fillField('email', '');
$I->fillField('password', '');

$I->click('Update');
$I->seeCurrentUrlEquals('/users/'.$my_id.'/edit');

$I->see('The name field is required.');
$I->see('The email field is required.');
$I->see('The password field is required.');

$new_name = 'Olga Barbara Śmistek';
$new_email = 'o.smistek@gmail.com';
$new_password = 'secret123';

$I->fillField('name', $new_name);
$I->fillField('email', $new_email);
$I->fillField('password', '123');

$I->click('Update');
$I->seeCurrentUrlEquals('/users/'.$my_id.'/edit');
$I->see('The password must be at least 6 characters.');

$I->fillField('name', $new_name);
$I->fillField('email', $new_email);
$I->fillField('password', $new_password);

$I->click('Update');
$I->seeCurrentUrlEquals('/dashboard');

$I->see($new_name);
$I->see($new_email);

$I->dontSee($my_name);
$I->dontSee($my_email);


$I->submitForm('#logout_form', array( 'users' => array('name' => 'Olga Śmistek')));
$I->seeCurrentUrlEquals('/');

$I->click('Log in');
$I->amOnPage('/login');
$I->dontSee('These credentials do not match our records.');

$I->fillField('email', $my_email);
$I->fillField('password', 'secret');

$I->click('Log in');
$I->seeCurrentUrlEquals('/login');
$I->see('These credentials do not match our records.');

$I->fillField('email', $new_email);
$I->fillField('password', $new_password);
$I->click('Log in');

$I->seeCurrentUrlEquals('/dashboard');


$I->click('Fundraisers');
$I->seeCurrentUrlEquals('/fundraisers');
$fundraiser = $I->grabFromDatabase('fundraisers', 'title', array('title' => 'Na leczenie dla Hani'));
$fundraiser_id = $I->grabFromDatabase('fundraisers', 'id', array('title' => 'Na leczenie dla Hani'));

$I->amOnPage("/fundraisers/".$fundraiser_id);
$I->see($fundraiser);
$I->see($new_name);

$donation_id = $I->grabFromDatabase('donations', 'id', array('user_id' => $my_id));
$donation_amount = $I->grabFromDatabase('donations', 'amount', array('user_id' => $my_id));
$donation_description = $I->grabFromDatabase('donations', 'description', array('user_id' => $my_id));

$I->amOnPage('/dashboard');
$I->click(strval(intval($donation_amount)));
$I->seeCurrentUrlEquals("/fundraisers/9/donations/".$donation_id);

$I->see($new_name);

$I->click('Users');
$I->seeCurrentUrlEquals('/users');

$I->see('Here you can see ranking of our users, who decided to support fundraisers!', 'h2');
$I->see($new_name);
$I->click('View '.$new_name."'s profile");
$I->seeCurrentUrlEquals('/dashboard');

$I->click("Delete your profile");

$I->seeCurrentUrlEquals('/');
$I->see('Profile has been deleted successfully!');

$I->click('Log in');

$I->amOnPage('/login');
$I->fillField('email', $new_email);
$I->fillField('password', $new_password);

$I->click('Log in');
$I->seeCurrentUrlEquals('/login');

$I->see('These credentials do not match our records.');

$I->amOnPage('/users');
$I->dontSee($new_name);


$I->amOnPage("/fundraisers/".$fundraiser_id);
$I->dontSee($new_name);
$I->see('User has deleted their\'s account.');

$I->amOnPage("/fundraisers/9/donations/".$donation_id);

$I->dontSee($new_name);
$I->see('User has deleted their\'s account.');

$I->click('Fundraisers');
$I->dontSee($new_name);
