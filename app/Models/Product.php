<?php namespace App\Models;

class Product extends Model{

    protected $table = 'products'; 


    public function deleteProductByCategoryId($data)
    {
        return $this->where('category_id' , $data)->delete();
    }

}
