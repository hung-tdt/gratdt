<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'phone',
        'password',
        'email',
        'description',
        'thumb',
        'status',
        'address',
        'province_id',
        'district_id',
        'ward_id',
        'role_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role() {
        return $this->hasOne(Role::class, 'id', 'role_id')->withDefault(['name' => '']);
    }

    public function provinces() {
        return $this->hasOne(Province::class, 'id', 'province_id');
    }

    public function districts() {
        return $this->hasOne(District::class, 'id', 'district_id');
    }

    public function wards() {
        return $this->hasOne(Ward::class, 'id', 'ward_id');
    }

    // public function checkPermissionAccess($permissionCheck) {
    //     $roles = auth()->admin()->roles;
    //     foreach ($roles as $role) {
    //         $permissions = $role->permissions;
    //         if($permissions->contains('key_code', $permissionCheck)) {
    //             return true;
    //         }   
    //     }
    //     return false;
    // }
    public function checkPermissionAccess($permissionCheck)
    {
        $admin = auth('admin')->user(); // Lấy admin hiện tại
        if (!$admin) {
            return false; // Không có admin nào đang đăng nhập
        }
    
        $role = $admin->role; // Lấy vai trò của admin
        if (!$role) {
            return false; // Admin không có vai trò nào
        }
    
        $permissions = $role->permissions; // Lấy danh sách quyền của vai trò
        return $permissions->contains('key_code', $permissionCheck);
    }
}

