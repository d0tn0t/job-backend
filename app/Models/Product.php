<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'description',
        'price',
        'validity',
        'image',
        'category_id'
    ];

    protected $hidden = [
        'category_id'
    ];

    protected $table = 'product';

    protected $casts = [
        "price" => "decimal:2"
    ];

     /**
     * Get the post that owns the comment.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
