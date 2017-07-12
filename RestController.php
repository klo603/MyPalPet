<?php
require_once("RestHandler.php");

$view = "";
if(isset($_GET["task"]))
    $view = $_GET["task"];
switch($view){
    // GET /pets
    case "list":
        $restHandler = new PetsRestHandler();
        $restHandler->getAllPets();
        break;
    // POST /pet
    case "new":
        $restHandler = new PetsRestHandler();
        $restHandler->newPet();
        break;
    // GET PUT DELETE /pet/(id)
    case "single":
        $restHandler = new PetsRestHandler();
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $restHandler->getPet($_GET["id"]);
        }
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $restHandler->updatePet($_GET["id"]);
        }
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            $restHandler->deletePet($_GET["id"]);
        }
        break;

    case "" :
        //404 - not found;
        break;
}
?>