<?php namespace App\Models;

class Scores extends Model
{

    protected $table = 'scores';

    public function getProductScore($userId, $productId)
    {
        return $this->where('user_id', $userId)
            ->where('product_id', $productId)
            ->get();
    }

    public function edit($data , $userId , $productId)
    {
        $this->where('user_id', $userId)
            ->where('product_id', $productId)
            ->update([
                'score' => $data['score']
            ]);
    }

    public function score($data ,  $userId , $productId)
    {
        $isScore = $this->getProductScore($data['user_id'], $data['product_id']);
// dd($data);
        if (!$isScore[0]) {
            // dd('hi if');
            return $this->create($data);
        } else {
            // dd($this->edit($data , $userId , $productId));
            return $this->edit($data ,  $userId , $productId );
        }
    }
}
