<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    const TYPE_FACEBOOK = 'Facebook';
    const TYPE_INSTAGRAM = 'Instagram';
    const TYPE_MYBUSINESS = 'MyBusiness';
    const TYPE_GOOGLE = 'Google';

    const VALIDATION_TYPE_WAITING = 'Waiting';
    const VALIDATION_TYPE_PUBLISHABLE = 'Publishable';
    const VALIDATION_TYPE_REVIEW = 'Review';

    protected $fillable = [
        'release_date',
        'type',
        'category',
        'text',
        'media',
        'text_validation',
        'media_validation'
    ];

    protected $table = 'activities';

    protected $dates = [
        'release_date'
    ];

    protected static $types = [
        self::TYPE_FACEBOOK,
        self::TYPE_INSTAGRAM,
        self::TYPE_MYBUSINESS,
        self::TYPE_GOOGLE
    ];

    protected static $validationTypes = [
        self::VALIDATION_TYPE_WAITING,
        self::VALIDATION_TYPE_PUBLISHABLE,
        self::VALIDATION_TYPE_REVIEW
    ];

    public static function getTypes()
    {
        return self::$types;
    }

    public static function getValidationTypes()
    {
        return self::$validationTypes;
    }

    public function project()
    {
        return $this->belongsTo('App\Project');
    }
}
