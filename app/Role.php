<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Role extends Model
{
    use Sortable;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    public function user() {
        return $this->hasOne('App\User');
    }

    public function listings() {
        return $this->hasManyThrough(Listing::class, User::class);
    }

    protected $fillable = ['role'];
    public $sortable = ['role'];
}
