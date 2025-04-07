<?php

namespace App\OrionTools;

class Button
{
    public static function inline(array $buttons): string
    {
        $keyboard['inline_keyboard'] = [];
        foreach ($buttons as $button) {
            $keyboard['inline_keyboard'][] = $button;
        }

        return Utils::jsonEncode($keyboard);
    }
}
