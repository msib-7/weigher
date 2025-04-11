<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\AuditTrailable;
use App\Traits\UUIDAsPrimaryKey;
use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, UUIDAsPrimaryKey, AuditTrailable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function auditTrails()
    {
        return $this->hasMany(Audit_tr::class, 'model_id')->where('model', User::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function notify()
    {
        return $this->notifications()->orderBy('created_at', 'desc')->get();
    }

    // public function isUserFa()
    // {
    //     return UserFa::where('nik', $this->employeId)->exists();
    // }

    // public function isMstdOfficer()
    // {
    //     return UserMstdOfficer::where('nik', $this->employeId)->exists();
    // }

    // public function isMstdSpv()
    // {
    //     return UserMstdSpv::where('nik', $this->employeId)->exists();
    // }

    public function roles()
    {
        return $this->belongsTo(Roles::class, 'jobLvl', 'name');
    }
    public function sessions()
    {
        return $this->belongsTo(Session::class, 'id', 'user_id');
    }
}
