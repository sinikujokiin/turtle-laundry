<?php
use \Illuminate\Database\Eloquent\Model as Eloquent;

use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Eloquent{
    protected $table = 'members';
    use SoftDeletes;
    
    /**
     * Member has many Transaction.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transaction()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = member_id, localKey = id)
        return $this->hasMany(Transaction::class, 'member_id', 'id');
    }

}
