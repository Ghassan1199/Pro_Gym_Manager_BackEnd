<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $birthday
 * @property int $height
 * @property int $weight
 * @property string $email
 * @property string|null $email_verified_at
 * @property string $password
 * @property string|null $phone_number
 * @property string|null $img_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $gym_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read \App\Models\gym $gym
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\subscription|null $subscription
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGymId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereImgUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereWeight($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\admin
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $birthday
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read \App\Models\gym|null $gym
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\adminFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|admin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|admin query()
 * @method static \Illuminate\Database\Eloquent\Builder|admin whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|admin whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|admin whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|admin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|admin whereUpdatedAt($value)
 */
	class admin extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\coach
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property string|null $phone_number
 * @property string $birthday
 * @property string|null $img_url
 * @property int $gym_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $Users
 * @property-read int|null $users_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\contract[] $contract
 * @property-read int|null $contract_count
 * @property-read \App\Models\gym $gym
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\qualifications[] $qualifications
 * @property-read int|null $qualifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\subscription[] $subscription
 * @property-read int|null $subscription_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\coachFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|coach newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|coach newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|coach query()
 * @method static \Illuminate\Database\Eloquent\Builder|coach whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|coach whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|coach whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|coach whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|coach whereGymId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|coach whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|coach whereImgUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|coach whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|coach wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|coach wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|coach whereUpdatedAt($value)
 */
	class coach extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\coach_quals
 *
 * @property int $id
 * @property int $qual_id
 * @property int $coach_id
 * @method static \Illuminate\Database\Eloquent\Builder|coach_quals newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|coach_quals newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|coach_quals query()
 * @method static \Illuminate\Database\Eloquent\Builder|coach_quals whereCoachId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|coach_quals whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|coach_quals whereQualId($value)
 */
	class coach_quals extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\contract
 *
 * @property int $id
 * @property int $salary
 * @property string $start_date
 * @property string $end_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $coach_id
 * @property-read \App\Models\coach $coach
 * @method static \Database\Factories\contractFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|contract newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|contract newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|contract query()
 * @method static \Illuminate\Database\Eloquent\Builder|contract whereCoachId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|contract whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|contract whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|contract whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|contract whereSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|contract whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|contract whereUpdatedAt($value)
 */
	class contract extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\day
 *
 * @property int $id
 * @property int $sat
 * @property int $sun
 * @property int $mon
 * @property int $tue
 * @property int $wed
 * @property int $thu
 * @property int $fri
 * @property int $sub_id
 * @property-read \App\Models\subscription|null $subscription
 * @method static \Database\Factories\dayFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|day newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|day newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|day query()
 * @method static \Illuminate\Database\Eloquent\Builder|day whereFri($value)
 * @method static \Illuminate\Database\Eloquent\Builder|day whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|day whereMon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|day whereSat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|day whereSubId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|day whereSun($value)
 * @method static \Illuminate\Database\Eloquent\Builder|day whereThu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|day whereTue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|day whereWed($value)
 */
	class day extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\exercies
 *
 * @property int $id
 * @property string $title
 * @property string $desc
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\subscription[] $subscriptions
 * @property-read int|null $subscriptions_count
 * @method static \Database\Factories\exerciesFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|exercies newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|exercies newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|exercies query()
 * @method static \Illuminate\Database\Eloquent\Builder|exercies whereDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|exercies whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|exercies whereTitle($value)
 */
	class exercies extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\gym
 *
 * @property int $id
 * @property string $title
 * @property string $address
 * @property string|null $logo_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $admin_id
 * @property-read \App\Models\admin $admin
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\coach[] $coaches
 * @property-read int|null $coaches_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\gymFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|gym newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|gym newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|gym query()
 * @method static \Illuminate\Database\Eloquent\Builder|gym whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|gym whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|gym whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|gym whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|gym whereLogoUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|gym whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|gym whereUpdatedAt($value)
 */
	class gym extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\payment
 *
 * @property int $id
 * @property int $amount
 * @property int $sub_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\subscription $sub
 * @method static \Database\Factories\paymentFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|payment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|payment whereSubId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|payment whereUpdatedAt($value)
 */
	class payment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\qualifications
 *
 * @property int $id
 * @property string $title
 * @property-read \Illuminate\Database\Eloquent\Collection|qualifications[] $coaches
 * @property-read int|null $coaches_count
 * @method static \Database\Factories\qualificationsFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|qualifications newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|qualifications newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|qualifications query()
 * @method static \Illuminate\Database\Eloquent\Builder|qualifications whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|qualifications whereTitle($value)
 */
	class qualifications extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\sub_exe
 *
 * @property int $id
 * @property int $sub_id
 * @property int $exe_id
 * @method static \Illuminate\Database\Eloquent\Builder|sub_exe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|sub_exe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|sub_exe query()
 * @method static \Illuminate\Database\Eloquent\Builder|sub_exe whereExeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|sub_exe whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|sub_exe whereSubId($value)
 */
	class sub_exe extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\subscription
 *
 * @property int $id
 * @property int $user_id
 * @property string $starts_at
 * @property string $ends_at
 * @property int $private
 * @property int $price
 * @property int $fully_paid
 * @property int $paid_amount
 * @property int $coach_id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read \App\Models\User $User
 * @property-read \App\Models\coach $coach
 * @property-read \App\Models\day|null $days
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\exercies[] $exercies
 * @property-read int|null $exercies_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\payment[] $payment
 * @property-read int|null $payment_count
 * @method static \Database\Factories\subscriptionFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|subscription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|subscription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|subscription query()
 * @method static \Illuminate\Database\Eloquent\Builder|subscription whereCoachId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|subscription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|subscription whereEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|subscription whereFullyPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|subscription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|subscription wherePaidAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|subscription wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|subscription wherePrivate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|subscription whereStartsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|subscription whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|subscription whereUserId($value)
 */
	class subscription extends \Eloquent {}
}

