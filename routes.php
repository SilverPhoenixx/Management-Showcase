<?php

require_once __DIR__.'/router.php';

// ##################################################
// ##################################################
// ##################################################

// Static GET
// In the URL -> http://localhost
// The output -> Index
get('/', 'frontend/entrance.php');
get('/profile/$name', 'frontend/profile.php');
get('/settings/$name', 'frontend/settings.php');
get('/entrance', 'frontend/entrance.php');
get('/quests/$name/$date', 'frontend/quests.php');
get('/diary/$name/$page', 'frontend/diary.php');

// Begin of API routes
post('/api/update/user/information', 'backend/api/settings/Information.php');

post('/api/update/diary/add', 'backend/api/diary/AddDiary.php');
post('/api/update/diary/delete', 'backend/api/diary/DeleteDiary.php');

post('/api/update/activity/add', 'backend/api/activity/AddActivity.php');
post('/api/update/activity/delete', 'backend/api/activity/DeleteActivity.php');

post('/api/update/quests/add', 'backend/api/quests/general/AddQuest.php');
post('/api/update/quests/delete', 'backend/api/quests/general/DeleteQuest.php');

post('/api/update/quests/user/update', 'backend/api/quests/user/UpdateQuest.php');

// Dynamic GET. Example with 1 variable
// The $id will be available in user.php
//get('/user/$id', 'views/user');

// Dynamic GET. Example with 2 variables
// The $name will be available in full_name.php
// The $last_name will be available in full_name.php
// In the browser point to: localhost/user/X/Y
//get('/user/$name/$last_name', 'views/full_name.php');

// Dynamic GET. Example with 2 variables with static
// In the URL -> http://localhost/product/shoes/color/blue
// The $type will be available in product.php
// The $color will be available in product.php
//get('/product/$type/color/$color', 'product.php');

// A route with a callback
//get('/callback', function(){
//  echo 'Callback executed';
//});

// A route with a callback passing a variable
// To run this route, in the browser type:
// http://localhost/user/A
//get('/callback/$name', function($name){
//  echo "Callback executed. The name is $name";
//});

// A route with a callback passing 2 variables
// To run this route, in the browser type:
// http://localhost/callback/A/B
//get('/callback/$name/$last_name', function($name, $last_name){
//  echo "Callback executed. The full name is $name $last_name";
//});

// ##################################################
// ##################################################
// ##################################################
// any can be used for GETs or POSTs

// For GET or POST
// The 404.php which is inside the views folder will be called
// The 404.php has access to $_GET and $_POST
any('/404','frontend/entrance.php');
