<?php

namespace App\Models;

use App\Notifications\Auth\ResetPasswordNotification;
use App\Traits\PermissionTrait;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use PermissionTrait;
    use Notifiable;

    /**
     * {@inheritDoc}
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'company_id',
        'department_id',
        'user_group_id',
        'first_name',
        'last_name',
        'address',
        'password',
        'secondary_address',
        'dob',
        'job_position',
        'phone',
        'secondary_phone',
        'secondary_email',
        'gender',
        'website',
        'skype',
        'facebook',
        'twitter',
        'google_plus',
        'youtube',
        'github',
        'interest',
        'about',
        'super_user',
        'avatar_id',
        'permissions',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The date fields for the model.clear
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'dob',
    ];

    /**
     * Always capitalize the first name when we retrieve it
     * @param string $value
     * @return string
     */
    public function getFirstNameAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * Always capitalize the last name when we retrieve it
     * @param string $value
     * @return string
     */
    public function getLastNameAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_users', 'user_id', 'role_id')->withTimestamps();
    }

    /**
     * @return boolean
     */
    public function isSuperUser()
    {
        return $this->super_user || $this->hasAccess('superuser');
    }

    /**
     * @param string $permission
     * @return boolean
     */
    public function hasPermission($permission)
    {
        if ($this->isSuperUser()) {
            return true;
        }

        return $this->hasAccess($permission);
    }

    /**
     * @param array $permissions
     * @return bool
     */
    public function hasAnyPermission(array $permissions)
    {
        if ($this->isSuperUser()) {
            return true;
        }

        return $this->hasAnyAccess($permissions);
    }

    /**
     * @return array
     */
    public function authorAttributes()
    {
        return [
            'name' => $this->getFullName(),
            'email' => $this->email,
            'url' => $this->website,    // optional
            'avatar' => 'gravatar', // optional
        ];
    }

    /**
     * @param string $date
     */
    public function setDobAttribute($date)
    {
        if (!empty($date)) {
            $this->attributes['dob'] = Carbon::createFromFormat(config('core.base.general.date_format.date'), $date)
                ->toDateTimeString();
        } else {
            $this->attributes['dob'] = $date;
        }
    }


    /**
     * @param string $value
     * @return array
     */
    public function getPermissionsAttribute($value)
    {
        try {
            return json_decode($value, true) ?: [];
        } catch (\Exception $exception) {
            return [];
        }
    }

    /**
     * Send the password reset notification.
     *
     * @param  string $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * Returns the activations relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activations()
    {
        return $this->hasMany(Activation::class, 'user_id');
    }

    /**
     * Set mutator for the "permissions" attribute.
     *
     * @param array $permissions
     * @return void
     */
    public function setPermissionsAttribute(array $permissions)
    {
        $this->attributes['permissions'] = $permissions ? json_encode($permissions) : '';
    }

    public function getRoleByField($user_id, $field)
    {
        if (!is_null($this->roles())){
            $role = $this->roles()->where('user_id',$user_id)->first();
            if ($role){
                return $role->$field;
            }
        }
        return 'Unknown';
    }

    /**
     * {@inheritDoc}
     */
    public function inRole($role)
    {
        $roleId = null;
        if ($role instanceof Role) {
            $roleId = $role->getKey();
        }

        foreach ($this->roles as $instance) {
            /**
             * @var Role $instance
             */
            if ($role instanceof Role) {
                if ($instance->getKey() === $roleId) {
                    return true;
                }
            } elseif ($instance->getKey() == $role || $instance->slug == $role) {
                return true;
            }
        }

        return false;
    }

    /**
     * {@inheritDoc}
     */
    public function delete()
    {
        if ($this->exists) {
            $this->activations()->delete();
            $this->roles()->detach();
        }

        return parent::delete();
    }

    /**
     * {@inheritDoc}
     */
    public function isLeaderApproval()
    {
        return $this->is_leader_approval ? true : false;
    }

    /**
     * {@inheritDoc}
     */
    public function isManagerApproval()
    {
        return $this->is_manager_approval ? true : false;
    }


}
