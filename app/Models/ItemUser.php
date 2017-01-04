<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ItemUser
 *
 * @property int $id
 * @property int $item_id
 * @property int $user_id
 * @property bool $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ItemUser whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ItemUser whereItemId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ItemUser whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ItemUser whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ItemUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ItemUser whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $amount
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ItemUser whereAmount($value)
 */
class ItemUser extends Model
{
    public static function getUserItemCount($uid,$item_id)
    {
        return self::whereUserId($uid)->whereItemId($item_id)->value('amount')?:0;
    }
}
