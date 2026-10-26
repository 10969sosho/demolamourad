<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['key', 'value'])]
class SiteSetting extends Model
{
    /**
     * Full site content: database overrides merged on top of database/content.json defaults.
     */
    public static function content(): array
    {
        $file = database_path('content.json');
        $content = is_file($file) ? json_decode((string) file_get_contents($file), true) : [];

        foreach (static::query()->get(['key', 'value']) as $row) {
            $decoded = json_decode((string) $row->value, true);
            data_set($content, $row->key, json_last_error() === JSON_ERROR_NONE ? $decoded : $row->value);
        }

        return $content;
    }

    public static function set(string $key, mixed $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => json_encode($value)]);
    }
}
