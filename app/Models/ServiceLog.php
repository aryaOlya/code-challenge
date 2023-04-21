<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceLog extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = ["id"];

    public function bill()
    {
        return $this->morphOne(BillItem::class,"bill_itemable");
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

}
