<?php
/**
 * Created by PhpStorm.
 * User: IT Hero
 * Date: 4/16/2017
 * Time: 1:13 PM
 */

namespace App\Repositories;


interface ContentsRepositoryInterface
{
    public function __construct();

    public function getAll($type);

    public function get($data);

    public function findById($id);

    public function create($data);

    public function update($data ,$id);

    public function delete($id);
}