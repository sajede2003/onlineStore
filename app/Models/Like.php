<?php namespace App\Models;

class Like extends Model
{
    protected $table = 'likes';

    public function getUserLiked($userId, $productId)
    {
        return $this->select(['COUNT(user_id) as count'])
            ->where('user_id', $userId)
            ->where('product_id', $productId)
            ->get();

    }

    public function likeCount($productId)
    {
        return $this->select(["COUNT(product_id) as count"])
        ->where('product_id', $productId)
        ->get();
    }

    public function disLike($userId, $productId)
    {
        $this->where('user_id', $userId)->where('product_id', $productId)->delete();
    }

    public function like($data ,$userId, $productId)
    {

        // is user like
        $isLike = $this->getUserLiked($userId, $productId);

        // check for is user like the product
        if ($isLike[0]['count'] == 0) {
            return $this->create($data);
        } else {
            return $this->disLike($userId, $productId);
        }

    }
}
