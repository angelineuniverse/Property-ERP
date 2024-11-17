<?php

namespace Modules\Users\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Company\Models\MProjectTab;

class TUserProjectTab extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    public $timestamps = false;
    protected $fillable = [
        'm_user_tabs_id',
        'm_project_tabs_id',
    ];

    public function project()
    {
        return $this->hasOne(MProjectTab::class, 'id', 'm_project_tabs_id');
    }
}