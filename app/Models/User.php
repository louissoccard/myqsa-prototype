<?php

namespace App\Models;

use BaconQrCode\Renderer\Color\Rgb;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\Fill;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'district_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    protected static function booted()
    {
        parent::booted();

        static::created(function ($user) {
            $user->preferences()->create();
        });

        static::deleting(function ($user) {
            $user->preferences()->delete();
        });
    }

    public function preferences() {
        return $this->hasOne(Preferences::class, 'user_id', 'id');
    }

    /**
     * Get the QR code SVG of the user's two factor authentication QR code URL.
     * Overrides the default function to make the QR code black instead of a blue-grey colour
     *
     * @return string
     */
    public function twoFactorQrCodeSvg(): string {
        $svg = (new Writer(
            new ImageRenderer(
                new RendererStyle(192, 0, null, null, Fill::uniformColor(new Rgb(255, 255, 255), new Rgb(0, 0, 0))),
                new SvgImageBackEnd
            )
        ))->writeString($this->twoFactorQrCodeUrl());

        return trim(substr($svg, strpos($svg, "\n") + 1));
    }

    /**
     * Get the user's district
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    /**
     * Change the user's full name when their first name is updated
     *
     * @param $value string the new first name
     */
    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = $value;
        $this->attributes['full_name']  = $value.' '.$this->last_name;
    }

    /**
     * Change the user's full name when their last name is updated
     *
     * @param $value string the new last name
     */
    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = $value;
        $this->attributes['full_name'] = $this->first_name.' '.$value;
    }

    /**
     * @throws \Exception
     */
    public function hasDistrictAccess(): bool
    {
        $districtPermissions = DB::table('permissions')->where('name', 'like', 'qsa.district.%')->get();
        $districtPermissions = $districtPermissions->groupBy('name')->keys()->all();

        return $this->hasAnyPermission($districtPermissions);
    }

    public function getDistrictAccess(): array
    {
        $permissions = $this->getAllPermissions()->groupBy('name')->keys()->all();

        $permissions = preg_filter('#^(qsa\.district\.view\.|qsa\.district\.edit\.)#', '', $permissions);
        $permissions = preg_replace('#^(qsa\.district\.view\.|qsa\.district\.edit\.)#', '', $permissions);

        return array_unique($permissions);
    }

    public function getAllRoles()
    {
        $roles = [];

        foreach ($this->getRoleNames() as $role) {
            $roles[] = Role::where('name', $role)->get()->first();
        }

        return collect($roles);
    }

    public function getPermissionTitles(): Collection
    {
        return $this->permissions->pluck('title');
    }

    public function getRoleTitles(): Collection
    {
        return $this->roles->pluck('title');
    }
}
