<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 21.02.19
 * Time: 20:35
 */

namespace Sf4\ApiUser\CacheAdapter;

interface CacheKeysInterface
{
    public const KEY_USER_LIST = 'user_list_';
    public const KEY_USER_LIST_ITEM = 'user_list_item_';
    public const KEY_USER_DETAIL = 'user_detail_';
    public const KEY_USER_LIST_DATA = 'user_list_data_';
    public const KEY_USER_LIST_DATA_COUNT = 'user_list_data_count_';

    public const TAG_USER = 'user';
    public const TAG_USER_DETAIL = 'user_detail';
    public const TAG_USER_LIST = 'user_list';
    public const TAG_USER_LIST_ITEM = 'user_list_item';
}
