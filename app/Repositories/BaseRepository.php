<?php


namespace App\Repositories;


use App\Services\BaseInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository extends Model implements BaseInterface

{
    protected $model;

    public function getAll(array $relations) {
        return $this->model->with($relations)->get();
    }

    public function findOne($id) {
        return $this->model->findOrFail($id);
    }

    public function stores(array $inputs) {
        return $this->model->create($inputs);
    }

    public function updates($id,array $inputs) {
        return $this->findOne($id)->update($inputs);
    }

    public function destroys($id) {
        return $this->findOne($id)->delete();
    }

    public function active($id) {
        $obj = $this->findOne($id);
        $obj->active = 1;
        return $obj->save();
    }

    public function deactive($id) {
        $obj = $this->findOne($id);
        $obj->active = 0;
        return $obj->save();
    }

}