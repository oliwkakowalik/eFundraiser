<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'deleted_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function donations(){
        return $this->hasMany(Donation::class);
    }

    public function fundraisers(){
        return $this->hasMany(Fundraiser::class);
    }

    public function scopeSumOfDonations($query){
        return $query->where('is_anonymous', '=', '0')->where('user_id', '=', $this->id)->sum('amount');
    }

    public static function scopeRanking(){
        $records = DB::table('donations')->where('is_anonymous', '=', '0')->join('users', 'donations.user_id', '=', 'users.id')->whereNull('deleted_at')
            ->groupBy('id')->get(['users.id', DB::raw('sum(donations.amount) as total')])->sortByDesc('total');
        $ranking = [];
        foreach($records as $record){
            $username = DB::table('users')->whereNull('deleted_at')->where('id', '=', $record->id)->value('name');
            $ranking[] = [$username, $record->total, $record->id];
        }
        return $ranking;
    }

    public function isSpecial(){
        if($this->scopeSumOfDonations(DB::table('donations')->where('is_anonymous', '=', '0')->where('created_at', '>', Carbon::now()->subDays(7))) > 500) {
        return "orange";
        }
        else{
        return "blue";
        }
    }
}
