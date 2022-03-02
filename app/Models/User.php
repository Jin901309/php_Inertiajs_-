<?php

namespace App\Models;

use App\Traits\Likeable;
use App\Traits\Friendable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Likeable;
    use Friendable;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * 대량 할당 가능한 속성입니다.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
    ];

    /**
     * 직렬화를 위해 숨겨야 하는 속성입니다.
     *
     * @var array
     */
    protected $hidden = [
        // 'email_verified_at',
        // 'updated_at',
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * 모델의 배열 형식에 추가할 접근자입니다.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    // /**
    //  * 
    //  *
    //  * @var array
    //  */
    // protected $with = [
    //     'profile',
    // ];

    public function getUserNameAttribute($value)
    {
        //첫글자 대문자
        return ucfirst($value);
    }
    public function getSumNameUsername()
    {
    return "{$this->username} {$this->name}";
    }
    public function setNameAttribute($value)
    {
        $this->attributes['name']=(string)$value;
    }



    /**
     * Get the default profile photo URL if no profile photo has been uploaded.
     *
     * @return string
     */
    protected function defaultProfilePhotoUrl()
    {
        return asset('/storage/images/default.png');
    }
    public function scopeSuggestions($query)
    {
        return $query->notAuth()->orWhereIn('id', auth()->user()->friends_ids());
    }

    public function scopeNotAuth()
    {
        return $this->where('id', '!=', auth()->id());
    }


    public function profile(){
        return $this->hasOne(Profile::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
