<?php


namespace App\Services;


interface BaseInterface
{
    public function getAll(array $relations);
    public function findOne($id);
    public function stores(array $inputs);
    public function updates($id,array $inputs);
    public function destroys($id);
    public function active($id);
    public function deactive($id);


}