<?php

namespace App\Enums;

use Illuminate\Support\Arr;

enum District: string
{
    case BARGUZINSKY = 'Баргузинский район';
    case BAUNTOVSKY = 'Баунтовский эвенкийский район';
    case BICHURSKY = 'Бичурский район';
    case DZHIDINSKY = 'Джидинский район';
    case ERAVNINSKY = 'Еравнинский район';
    case ZAIGRAEVSKY = 'Заиграевский район';
    case ZAKAMENSKY = 'Закаменский район';
    case IVOLGINSKY = 'Иволгинский район';
    case KABANSKY = 'Кабанский район';
    case KIZHINGINSKY = 'Кижингинский район';
    case KURUMKANSKY = 'Курумканский район';
    case KYAKHTINSKY = 'Кяхтинский район';
    case MUKHORSHIBIRSKY = 'Мухоршибирский район';
    case MUISKY = 'Муйский район';
    case OKINSKY = 'Окинский район';
    case PRIBAIKALSKY = 'Прибайкальский район';
    case SEVEROBAIKALSKY = 'Северо-Байкальский район';
    case SELENGINSKY = 'Селенгинский район';
    case TARBAGATAISKY = 'Тарбагатайский район';
    case TUNKINSKY = 'Тункинский район';
    case KHORINSKY = 'Хоринский район';
    case ULAN_UDE = 'Улан-Удэ';

    public static function getAll(): array
    {
        return array_column(self::cases(), 'value', 'name');
    }
}
