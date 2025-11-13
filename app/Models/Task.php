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

    protected $dates = ["due_date"];

    protected $casts = [
        "due_date"=> "datetime",
        "is_completed" => "boolean",
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function getFormattedDueDate()
    {
        return $this->due_date->format('M d, Y');
    }
}
