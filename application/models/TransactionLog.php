<?php
use \Illuminate\Database\Eloquent\Model as Eloquent;


class TransactionLog extends Eloquent{
    protected $table = 'transaction_logs';
    protected $fillable = ['transaction_id', 'description', 'user_id', 'status'];

    public $timestamps = false;

    /**
     * TransactionLog has one User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        // hasOne(RelatedModel, foreignKeyOnRelatedModel = transactionLog_id, localKey = id)
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    
}
