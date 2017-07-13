<?php
require_once("SimpleRestHandler.php");
require_once("Pets.php");

class PetsRestHandler extends SimpleRest {

    private function getPetInput(){
        $json = file_get_contents('php://input');
        $data = json_decode($json);
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
        $data = $this->getPetInput();
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
    }

    // PUT /pet/(id)
    public function updatePet($id) {

        $pets = new Pets();
        $data = $this->getPetInput();
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
    }
}
?>