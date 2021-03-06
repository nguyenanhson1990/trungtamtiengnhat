<?php
namespace App\Repositories;

use App\Models\Categories;

class CategoryRepository implements CategoryRepositoryInterface
{

    public function __construct(){}

    public function all($limit)
    {
        return Categories::paginate($limit);
    }

    public function delete($id)
    {
        $category = Categories::where('id',$id);
        return $category->delete();
    }

    public function find($id)
    {
        return Categories::where('id',$id);
    }

    public function update($id,$array_data)
    {
        $category = Categories::where('id',$id);
        return $category->update($array_data);
    }

    public function add($array_data)
    {
        $category = new Categories($array_data);
        $category->slug = $array_data['slug'];
        return $category->save();
    }

    public function get($data)
    {
        return Categories::all($data);
    }
}