<?php
use \Illuminate\Database\Eloquent\Model as Eloquent;

use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionDetail extends Eloquent{
    protected $table = 'transaction_details';
    use SoftDeletes;

    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['transaction_id', 'service_detail_id', 'weight', 'price'];
    

    /**
     * Transaction has one Servicedetail.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function servicedetail()
    {
        // hasOne(RelatedModel, foreignKeyOnRelatedModel = transaction_id, localKey = id)
        return $this->hasOne(ServiceDetail::class,'id','service_detail_id')->with(['service']);
    }


}
