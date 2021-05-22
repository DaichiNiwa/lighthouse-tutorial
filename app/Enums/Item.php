<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class Item extends Enum
{
    const Cup = [
        name => "マグカップ",
        description => "あったかいコーヒーでも飲んで落ち着きましょう",
    ];
    const Watch = [
        name => "腕時計",
        description => "時間を大切に過ごしましょう",
    ];
    const BlackBag = [
        name => "黒いバッグ",
        description => "ものを大切に管理しましょう",
    ];
    const LapTop = [
        name => "ノートパソコン",
        description => "今日はカフェで仕事をしませんか？",
    ];
    const Hat = [
        name => "帽子",
        description => "日焼けに気をつけましょう",
    ];
}
