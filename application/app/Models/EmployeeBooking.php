<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeBooking extends Model
{
    protected $guarded = [];
    protected $table = 'employee_bookings';

    /**
     * Get the userschedules that owns the EmployeeBooking
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userSchedule(): BelongsTo
    {
        return $this->belongsTo(UserSchedule::class);
    }

    /**
     * Get the service that owns the EmployeeBooking
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
