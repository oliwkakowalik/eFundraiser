<?php


$I = new AcceptanceTester($scenario ?? null);

$I->wantTo('have users page');

$I->amOnPage('/');
$I->click('Users');
$I->seeCurrentUrlEquals('/users');


$I->see('List of users', 'h2');

$I->click('Log in');
$I->amOnPage('/login');

$I->fillField('email', 'john.doe@gmail.com');
$I->fillField('password', 'secret');

$I->click('Log in');

$I->seeCurrentUrlEquals('/dashboard');

$I->click('Users');
$I->seeCurrentUrlEquals('/users');

$I->see('List of users', 'h2');

$name = $I->grabFromDatabase('users', 'name', array('name' => 'Olga Śmistek'));
$id = $I->grabFromDatabase('users', 'id', array('name' => 'Olga Śmistek'));
$email = $I->grabFromDatabase('users', 'email', array('name' => 'Olga Śmistek'));

$I->see($name);
$I->click('View '.$name.' profile');

$I->seeCurrentUrlEquals('/users/'.$id);

$I->see($name."'s account", 'h2');


$I->see($email);

$I->click('Users');
$I->seeCurrentUrlEquals('/users');

$my_name = $I->grabFromDatabase('users', 'name', array('name' => 'John Doe'));
$my_id = $I->grabFromDatabase('users', 'id', array('name' => 'John Doe'));
$my_email = $I->grabFromDatabase('users', 'email', array('name' => 'John Doe'));

$I->click('View '.$my_name.' profile');

$I->seeCurrentUrlEquals('/dashboard');

$I->see($my_name."'s account");

$title = $I->grabFromDatabase('fundraisers', 'title', array('user_id' => $my_id));
$fundraiser_id = $I->grabFromDatabase('fundraisers', 'id', array('user_id' => $my_id));
$I->see($my_name."'s account");

$I->click($title);
$I->seeCurrentUrlEquals('/fundraisers/'.$fundraiser_id);

$I->amOnPage('/dashboard');

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

$new_name = 'Joe Doe';
$new_email = 'joe.doeee@gmail.com';
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


$I->click('Delete your profile');
$I->seeCurrentUrlEquals('/');

$I->click('Users');
$I->seeCurrentUrlEquals('/users');

$I->dontSee($new_name);

$I->amOnPage('/login');
$I->fillField('email', $new_email);
$I->fillField('password', 'secret');

$I->click('Log in');

$I->see('These credentials do not match our records.');

$I->haveInDatabase('users', [ 'name' => $new_name]);
