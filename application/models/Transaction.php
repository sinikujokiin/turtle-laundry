<?php
use \Illuminate\Database\Eloquent\Model as Eloquent;

use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Eloquent{
    protected $table = 'transactions';
    use SoftDeletes;
    

    /**
     * Transaction has one .
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function member()
    {
        return $this->hasOne(Member::class,'id','member_id');
    }

    /**
     * Transaction has one Creator.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function creator()
    {
        // hasOne(RelatedModel, foreignKeyOnRelatedModel = transaction_id, localKey = id)
        return $this->hasOne(User::class,'id', 'created_by');
    }

    

    /**
     * Transaction has many Transactiondetail.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactiondetail()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = transaction_id, localKey = id)
        return $this->hasMany(TransactionDetail::class, 'transaction_id');
    }

    /**
     * Transaction has many Transactionlog.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactionlog()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = transaction_id, localKey = id)
        return $this->hasMany(TransactionLog::class, 'transaction_id');
    }

}
