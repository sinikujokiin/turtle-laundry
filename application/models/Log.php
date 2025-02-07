<?php
use \Illuminate\Database\Eloquent\Model as Eloquent;

use Illuminate\Database\Eloquent\SoftDeletes;

class Log extends Eloquent{
    protected $table = 'logs';
    use SoftDeletes;

    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'url', 'description'];

    /**
     * Log has one User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        // hasOne(RelatedModel, foreignKeyOnRelatedModel = log_id, localKey = id)
        return $this->hasOne(User::class, 'id' ,'user_id');
    }
    


}
