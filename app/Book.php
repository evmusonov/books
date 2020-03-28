<?php

namespace App;

use Evmusonov\LaravelFileHelper\File;
use Evmusonov\LaravelFileHelper\FileHelper;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public $guarded = [];

    public static function rentPeriod()
    {
        return [
            'день (дней)',
            'неделя(и)',
            'месяц(ев)'
        ];
    }

    public function thumb()
    {
        return $this->hasOne('Evmusonov\LaravelFileHelper\File', 'content_id');
    }

    public function dealType()
    {
        return $this->hasOne('App\BookDealType', 'id', 'deal_type_id');
    }

    public function coverType()
    {
        return $this->hasOne('App\BookCoverType', 'id', 'cover_type_id');
    }

    public function owner()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function category()
    {
        return $this->hasOne('App\Category', 'id', 'category_id');
    }

    public function statusName()
    {
        return !$this->moderation
            ? '<span class="moderation">На модерации</span>'
            : ($this->status ? '<span class="active">Активно</span>' : '<span class="inactive">Неактивно</span>');
    }

    public function dealPrice()
    {
        $deal = $this->dealType->alias;

        if ($deal == 'sell') {
            return "Цена: {$this->price} руб.";
        } elseif ($deal == 'rent') {
            if (!is_null($this->rent_amount)) {
                $rent = self::rentPeriod()[$this->rent_type_id];
            }
            return "Период аренды: {$this->rent_amount} $rent | Цена: {$this->price} руб.";
        } else {
            return null;
        }
    }
}
