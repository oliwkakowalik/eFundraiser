<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

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
    //suma wplat danego uzytkownika (nalezy wywalac zamiast $query przekazując donations)
    //to jest z 7 ostatnich dni jesli chcemy ogolnie to nalezy usunac where(created at...)
    //where('created_at', '>', Carbon::now()->subDays(7)) - zeby bylo z ostatniego tygodnia
    public function scopeSumOfDonations($query){
        return $query->where('user_id', '=', $this->id)->sum('amount');
    }

    public static function scopeRanking(){
        $records = DB::table('donations')->join('users', 'donations.user_id', '=', 'users.id')->groupBy('id')->get(['users.id', DB::raw('sum(donations.amount) as total')])->sortByDesc('total');
        $ranking = [];
        foreach($records as $record){
            $username = DB::table('users')->where('id', '=', $record->id)->value('name');
            $ranking[] = [$username, $record->total, $record->id];
        }
        return $ranking;
    }
}
