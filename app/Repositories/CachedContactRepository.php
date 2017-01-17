<?php
/**
 * Created by PhpStorm.
 * User: shabbir
 * Date: 1/16/17
 * Time: 2:08 PM
 */

namespace App\Repositories;


use App\Interfaces\ContactRepositoryInterface;

class CachedContactRepository implements ContactRepositoryInterface
{

    private $repository;

    public function __construct(ContactRepositoryInterface $repository)
    {
        return $this->repository = $repository;
    }

    public function store($requestData)
    {
        return $this->repository->store($requestData);
    }

    public function getByID($id)
    {
        //TODO Cache it
        return $this->repository->getByID($id);
    }

    public function update($id, $requestData)
    {
        return $this->repository->update($id, $requestData);
    }

    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }

    public function getAll($perPage, $page)
    {
        //TODO Cache it
        return $this->repository->getAll($perPage, $page);
    }
}