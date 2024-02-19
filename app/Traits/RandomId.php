<?php

namespace App\Traits;

trait RandomId
{
    public static function bootRandomId()
    {
        static::creating(function ($model) {
            $model->no_doc = $model->generateId();
        });
    }

    /**
     * Generate 13 characters unique ID using 9 hex characters timestamp and random 4 characters random hex strings.
     *
     * @return string
     */
    public function generateId(): string
    {
        $hex1 = str_pad(dechex(time()), 9, "0", STR_PAD_LEFT);

        try {
            $hex2 = dechex(random_int(4096, 65535));
        }
        catch (\Exception $e) {
            $hex2 = dechex(rand(4096, 65535));
        }

        $id = $hex1 . $hex2;

        if (self::find($id))
            return $this->generateId();

        return $id;
    }
}
