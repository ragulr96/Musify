<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['userProfile/(:any)'] = 'userProfile/getPostBySlugValue/$1';
$route['timelinePosts/addPost'] = 'userProfile/addPost';
$route['timelinePosts/updatePost'] = 'userProfile/updatePost';
$route['timelinePosts/editPost'] = 'userProfile/editPost';
$route['timelinePosts/editPost'] = 'userProfile/editPost';
$route['timelinePosts/viewPosts'] = 'userProfile/loadTimelinePage';


$route['users/editProfile'] = 'userProfile/editProfile';
$route['users/updateProfile'] = 'userProfile/updateProfile';

$route['userProfile'] = 'userProfile/loadUserProfilePage';

$route['users/signin'] = 'userProfile/signIn';
$route['users/signup'] = 'userProfile/signUp';
$route['users/signout'] = 'userProfile/signOut';

$route['search/addConnection/(:any)'] = 'searchUser/addConnection/$1';
$route['search/deleteConnection/(:any)'] = 'searchUser/deleteConnection/$1';
$route['search/addConnectionFromProfile/(:any)'] = 'searchUser/addConnectionFromProfile/$1';
$route['search/deleteConnectionFromProfile/(:any)'] = 'searchUser/deleteConnectionFromProfile/$1';

$route['search'] = 'searchUser/getUserProfile';
$route['searchUser/loadPublicUserProfilePage/(:any)'] = 'userProfile/loadPublicUserProfilePage/$1';

$route['connection'] = 'userConnection/getConnectionDetails';

$route['contacts/contactCard'] = 'userContact/contactCard';
$route['contacts/updateContactCard'] = 'userContact/updateContactCard';
//$route['contacts/contactCard'] = 'userContact/getContacts';
$route['userContact'] = 'userContact/loadContact';


$route['default_controller'] = 'pages/view';
$route['(:any)'] = 'pages/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
