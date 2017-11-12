<?php
require __DIR__ . '/vendor/autoload.php';

/**
 * @property int $id
 * @property string $name
 */
class User extends Model {}

ORM::configure('sqlite:./db/blog.sqlite3');
ORM::configure('logging', true);

// find by primary key
$user = Model::factory('User')->find_one(1);
print "find_one id $user->id $user->name \n";


// find by unique column
$person = ORM::for_table('User')->where('name', 'Alice')->find_one();
print "find_one where name=Alice $user->id $user->name \n";

$person = ORM::for_table('User')->where('name', 'Zorglub')->find_one();
if ($person===false ) print "find_one where name=Zorglub not found \n";


// find all
$users = ORM::for_table('user')->find_many();
foreach ($users as $user) {
    print "find all : $user->id $user->name \n";
}

// deleting
$person = ORM::for_table('User')->where('name', 'Charlie')->find_one();
if ($person) {
    print "Deleting Charlie \n";
    $person->delete(); 
}

// creating record
$person = ORM::for_table('User')->create();
$person->name = 'Charlie';
$person->save();
print "Creatinng Charlie id=$person->id \n";


print_r(ORM::get_query_log());