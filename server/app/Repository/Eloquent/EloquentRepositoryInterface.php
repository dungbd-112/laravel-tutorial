<?php

namespace App\Repository\Eloquent;

/*
* Interface EloquentRepositoryInterface
* @package App\Repositories
*/
interface EloquentRepositoryInterface
{
    /**
     * Get all
     */
    public function getAll();

    /**
     * Get one
     * @param $id
     */
    public function find($id);

    /**
     * Create
     * @param array $attributes
     */
    public function create($attributes = []);

    /**
     * Update
     * @param $id
     * @param array $attributes
     */
    public function update($id, $attributes = []);

    /**
     * Delete
     * @param $id
     */
    public function delete($id);
}