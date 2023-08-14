<?php


use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php'; //including autoload.php
require 'logic.php'; //including the logic functions


$app = new \Slim\App;
session_start();

//welcome message

$app->get('/', function () {
    echo 'Welcome to my slim app';
});

//------------------------------------------------------------------------------

//show all

$app->get('/students/list', function (Request $request, Response $response) {
     
    $viewall = Students_List();
    echo json_encode($viewall, JSON_PRETTY_PRINT);

});

//--------------------------------------------------------------------------------

//retrieve single id

$app->get('/students/single/{Id}', function (Request $request, Response $response, array $args) {
    
    $stu_id= $args['Id'];
    $single = Students_Single($stu_id);
    echo json_encode($single, JSON_PRETTY_PRINT);
});

//----------------------------------------------------------------------------------

//insert db

$app->post('/students/insert', function (Request $request, Response $response) {
    
    $Name=$_POST['Name'];
    $Age=$_POST['Age'];
    $Email=$_POST['Email'];
    $insert = Students_New($Name, $Age, $Email);
    echo json_encode($insert, JSON_PRETTY_PRINT);
    
});


//-----------------------------------------------------------------------------------

//delete record

$app->get('/students/delete/{Id}', function (Request $request, Response $response, array $args) {
    
    $stu_id= $args['Id'];
    $delete = Students_Delete($stu_id);
    echo json_encode($delete, JSON_PRETTY_PRINT);

});

//-------------------------------------------------------------------------------------

//update

$app->post('/students/update/{Id}', function (Request $request, Response $response, array $args) {
    
    $stu_id = $args['Id'];
    $updatedName = $request->getParsedBodyParam('Name');
    $updatedAge = $request->getParsedBodyParam('Age');
    $updatedEmail = $request->getParsedBodyParam('Email');

    
    $update = Student_Update($stu_id, $updatedName, $updatedAge, $updatedEmail);

    echo json_encode($update, JSON_PRETTY_PRINT);
    
});

//--------------------------------------------------------------------------------------

$app->run();




