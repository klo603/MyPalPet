<?php
Class Pets {

    private $petFile = 'pets.json';

    // GET /pets
    public function getAllPets(){
        return json_decode(file_get_contents($this->petFile), true);
    }

    // GET /pet/(id)
    public function getPet($id){
        $pets = json_decode(file_get_contents($this->petFile), true);
        $pet = !empty($pets[$id]) ? $pets[$id] : false;
        return $pet;
    }

    // POST /pet
    public function newPet($data){
        $pets = json_decode(file_get_contents($this->petFile), true);
        $newPet = array();
        $newPet['breed'] = (!empty($data->breed))?$data->breed:'';
        $newPet['age'] = (!empty($data->age))?$data->age:'';
        $newPet['name'] = (!empty($data->name))?$data->name:'';
        $newPet['price'] = (!empty($data->price))?$data->price:'';
        $newPet['list_date'] = (!empty($data->list_date))?$data->list_date:'';
        $newPet['sale_date'] = (!empty($data->sale_date))?$data->sale_date:'';
        $pets[] = $newPet;
        $success = file_put_contents($this->petFile,json_encode($pets));
        return $success;
    }

    // PUT /pet/(id)
    public function updatePet($id,$data){
        $pets = json_decode(file_get_contents($this->petFile), true);
        $newPet = array();
        $newPet['breed'] = (!empty($data->breed))?$data->breed:'';
        $newPet['age'] = (!empty($data->age))?$data->age:'';
        $newPet['name'] = (!empty($data->name))?$data->name:'';
        $newPet['price'] = (!empty($data->price))?$data->price:'';
        $newPet['list_date'] = (!empty($data->list_date))?$data->list_date:'';
        $newPet['sale_date'] = (!empty($data->sale_date))?$data->sale_date:'';
        $pets[$id] = $newPet;
        $success = file_put_contents($this->petFile,json_encode($pets));
        return $success;
    }

    // DELETE /pet/(id)
    public function deletePet($id){
        $pets = json_decode(file_get_contents($this->petFile), true);
        unset($pets[$id]);
        $success = file_put_contents($this->petFile,json_encode($pets));
        return $success;
    }
}
?>