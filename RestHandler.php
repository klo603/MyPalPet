<?php
require_once("SimpleRestHandler.php");
require_once("Pets.php");

class PetsRestHandler extends SimpleRest {

    private function getPetPost(){
        $data = (object)array();
        $data->breed = !empty($_POST["breed"]) ? $_POST["breed"]:'';
        $data->name = !empty($_POST["name"]) ? $_POST["name"]:'';
        $data->age = !empty($_POST["age"]) ? $_POST["age"]:'';
        $data->price = !empty($_POST["price"]) ? $_POST["price"]:'';
        $data->list_date = !empty($_POST["list_date"]) ? $_POST["list_date"]:'';
        $data->sale_date = !empty($_POST["sale_date"]) ? $_POST["sale_date"]:'';
        return $data;
    }

    private function getPetPut(){
        parse_str(file_get_contents("php://input"),$post_vars);
        $data = (object)array();
        $data->breed = !empty($post_vars["breed"]) ? $post_vars["breed"]:'';
        $data->name = !empty($post_vars["name"]) ? $post_vars["name"]:'';
        $data->age = !empty($post_vars["age"]) ? $post_vars["age"]:'';
        $data->price = !empty($post_vars["price"]) ? $post_vars["price"]:'';
        $data->list_date = !empty($post_vars["list_date"]) ? $post_vars["list_date"]:'';
        $data->sale_date = !empty($post_vars["sale_date"]) ? $post_vars["sale_date"]:'';
        return $data;
    }
    // GET /pets
    public function getAllPets() {

        $pets = new Pets();
        $rawData = $pets->getAllPets();

        if(empty($rawData)) {
            $statusCode = 404;
            $rawData = array('error'=>true,'message' => 'No pets found!');
        } else {
            $statusCode = 200;
        }

        $this ->setHttpHeaders('application/json', $statusCode);
        $response = json_encode($rawData);
        echo $response;
    }

    // GET /pet/(id)
    public function getPet($id) {

        $pets = new Pets();
        $rawData = $pets->getPet($id);

        if(empty($rawData)) {
            $statusCode = 404;
            $rawData = array('error' => 'No pets found!');
        } else {
            $statusCode = 200;
        }

        $this ->setHttpHeaders('application/json', $statusCode);
        $response = json_encode($rawData);
        echo $response;
    }

    // POST /pet
    public function newPet() {

        $pets = new Pets();
        $data = $this->getPetPost();
        $rawData = $pets->newPet($data);

        if(empty($rawData)) {
            $statusCode = 404;
            $rawData = array('error' => 'Cannot add new pet!');
            $response = json_encode($rawData);
            echo $response;
        } else {
            $statusCode = 200;
        }
        $this ->setHttpHeaders('application/json', $statusCode);
        echo 'done';
    }

    // DELETE /pet/(id)
    public function deletePet($id) {

        $pets = new Pets();
        $rawData = $pets->deletePet($id);

        if(empty($rawData)) {
            $statusCode = 404;
            $rawData = array('error' => 'Cannot delete pet!');
            $response = json_encode($rawData);
            echo $response;
        } else {
            $statusCode = 200;
        }

        $this ->setHttpHeaders('application/json', $statusCode);
        echo 'done';
    }

    // PUT /pet/(id)
    public function updatePet($id) {

        $pets = new Pets();
        $data = $this->getPetPut();
        $rawData = $pets->updatePet($id,$data);

        if(empty($rawData)) {
            $statusCode = 404;
            $rawData = array('error' => 'Cannot update pet!');
            $response = json_encode($rawData);
            echo $response;
        } else {
            $statusCode = 200;
        }

        $this ->setHttpHeaders('application/json', $statusCode);
        echo 'done';
    }
}
?>