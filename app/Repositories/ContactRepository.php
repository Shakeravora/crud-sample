<?php

namespace App\Repositories;

use App\Interfaces\ContactRepositoryInterface;
use App\Contact;


class ContactRepository implements ContactRepositoryInterface
{
    public function getAll() {
        return Contact::all();
    }

    public function store($requestData){
       return Contact::create($requestData);
    }

    public function getByID($id){
        return Contact::findOrFail($id);
    }


    public function update($id,$requestData){
        $contactlist = $this->getByID($id);
        return $contactlist->update($requestData);
    }

    public function destroy($id){
        return Contact::destroy($id);
    }
}
