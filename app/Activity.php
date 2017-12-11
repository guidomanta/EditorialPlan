<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'release_date',
        'type',
        'category',
        'text',
        'filename',
        'mime',
        'original_filename',
        'text_validation',
        'media_validation'
    ];

    protected $table = 'activities';

    protected $dates = [
        'release_date'
    ];

    public function project()
    {
        return $this->belongsTo('App\Project');
    }
}
