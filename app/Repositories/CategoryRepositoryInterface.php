<?php
namespace App\Repositories;

interface CategoryRepositoryInterface
{
    public function __construct();

    public function all($limit);

    public function add($array_data);

    public function delete($id);

    public function update($id,$array_data);

    public function find($id);

    public function get($data);

}