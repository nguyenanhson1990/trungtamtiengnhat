<?php
/**
 * Created by PhpStorm.
 * User: IT Hero
 * Date: 4/16/2017
 * Time: 1:13 PM
 */

namespace App\Repositories;

use App\Models\Contents;

class ContentsRepository implements ContentsRepositoryInterface
{

    public function __construct()
    {
        return Contents::class;
    }

    public function getAll($type)
    {
        return Contents::where('content_type',$type);
    }

    public function get($data)
    {
        return Contents::all($data);
    }

    public function findById($id)
    {
        return Contents::where('id',$id);
    }

    public function create($data)
    {
        $query = new Contents($data);
        $query->slug = $data['slug'];
        return $query->save();
    }

    public function update($data ,$id)
    {
        $query = Contents::where('id',$id);
        return $query->update($data);
    }

    public function delete($id)
    {
        $query = Contents::where('id',$id);
        return $query->delete();
    }

    public function getTrashed()
    {
        return Contents::withTrashed();
    }

    public function restore($ids)
    {
        $query = Contents::whereIn('id',$ids);
        return $query->restore();
    }

    public function deletePermanently($ids)
    {
        $query = Contents::whereIn('id',$ids);
        return $query->forceDelete();
    }

}