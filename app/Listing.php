<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Listing extends Model
{
    use Sortable;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function role() {
        return $this->belongsToThrough(Role::class, User::class);
    }

    public $sortable = ['id', 'inventory_no', 'user_id', 'description', 'created_at', 'updated_at', 'date'];
}
