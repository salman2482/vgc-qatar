<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSchedule extends Model
{
    protected $guarded = [];
    protected $table = 'user_schedules';
    public $timestamps = false;
    protected $date = ['start'];


    /**
     * Get the user that owns the UserSchedule
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the employeeBooking for the UserSchedule
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employeeBooking(): HasMany
    {
        return $this->hasMany(EmployeeBooking::class, 'user_schedule_id');
    }
}
