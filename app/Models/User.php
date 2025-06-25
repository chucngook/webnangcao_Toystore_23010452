<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash; // 1. Đảm bảo đã import Hash
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable // Bắt đầu class User
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
        'is_admin',
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
        // 'password' => 'hashed', // Đã xóa hoặc comment dòng này
        'is_admin' => 'boolean',
    ];

    // 2. Đặt toàn bộ khối hàm này vào đây
    /**
     * Luôn luôn băm mật khẩu khi nó được gán giá trị.
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        // Chỉ hash nếu giá trị không phải là một chuỗi đã được hash rồi
        if (Hash::needsRehash($value)) {
            $value = Hash::make($value);
        }
        $this->attributes['password'] = $value;
    }
    public function orders() {
    return $this->hasMany(Order::class);
}

} // Kết thúc class User