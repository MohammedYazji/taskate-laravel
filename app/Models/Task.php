<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        "name",
        "description",
        "project_id",
        "is_completed",
        "due_date",
    ] ;

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
