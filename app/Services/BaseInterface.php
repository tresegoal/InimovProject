<?php


namespace App\Services;


interface BaseInterface
{
    public function getAll(array $relations);
    public function findOne($id);
    public function store(array $inputs);
    public function update($id,array $inputs);
    public function destroy($id);
    public function active($id);
    public function deactive($id);


}