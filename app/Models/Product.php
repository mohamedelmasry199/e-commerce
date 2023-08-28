<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Add this line


class Product extends Model
{
    use HasFactory;
    use SoftDeletes; 

    protected $fillable=[
        'name',
        'description',
        'product_availability',
        'image',
        'price',
        'category_id',
        'deleted_at'
    ];
    public function users(){
        return $this->belongsToMany(User::class, 'product_user', 'product_id', 'user_id');
    }
    public function categories(){
        return $this->belongsTo(Category::class);
    }
    

public function orders()
{
    return $this->belongsToMany(Order::class, 'order_product')
        ->withPivot(['price', 'quantity']); 
}


}
