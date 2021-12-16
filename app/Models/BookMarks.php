<?php namespace App\Models;

class BookMarks extends Model
{
    protected $table = 'bookmarks';

    public function getUserBookmark($id, $userId)
    {
        return $this->where('product_id', $id)
            ->where('user_id', $userId)
            ->first();
    }

    public function deleteBookmark($productId , $userId)
    {
        $this->where('product_id' , $productId)->where('user_id' , $userId)->delete();
    }

    public function bookmark($data , $userId , $productId)
    {
        $isChecked = $this->getUserBookmark($productId , $userId);
        
        if(!$isChecked){
            return $this->create($data);
        }else{
            return $this->deleteBookmark($productId , $userId);
        }

        
    }
}
