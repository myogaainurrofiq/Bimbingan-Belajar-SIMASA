<?php

namespace Modules\SPP\Entities;

use App\Models\User;
use App\Models\MasterPayment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailPaymentSpp extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['url_file'];

    public function getUrlFileAttribute()
    {
        if (!isset($this->file) && $this->file == '') {
            return null;
        }
        return asset(Storage::url('images/bukti_payment/' . $this->file));
    }

    public function payment()
    {
        return $this->hasOne(PaymentSpp::class, 'id', 'payment_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function aprroveBy()
    {
        return $this->belongsTo(User::class, 'approve_by');
    }

    public function masterBiaya()
    {
        return $this->belongsTo(MasterPayment::class, 'user_id', 'user_id');
    }
}
