<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendars extends Model
{
    use HasFactory;

    protected $table = "event";
    protected $fillable = ['event_name', 'event_date', 'event_end', 'event_day', 'active'];

    public function setDateEventStart ( $value ) {
        $this->attributes['event_date'] = Carbon::createFromFormat( 'Y-m-d', $value );
    }

    public function setDateEventEnd ( $value ) {
        $this->attributes['event_end'] = Carbon::createFromFormat( 'Y-m-d', $value );
    }
    
}
