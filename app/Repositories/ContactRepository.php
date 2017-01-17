<?php

namespace App\Repositories;

use App\Interfaces\ContactRepositoryInterface;
use App\Contact;


class ContactRepository implements ContactRepositoryInterface
{
    public function getAll($perPage, $page) {
        return Contact::paginate($perPage, ['*'], 'page', $page);
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
