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
    const KEY_USER_LIST = 'user_list_';
    const KEY_USER_LIST_ITEM = 'user_list_item_';
    const KEY_USER_DETAIL = 'user_detail_';

    const TAG_USER = 'user';
    const TAG_USER_DETAIL = 'user_detail';
    const TAG_USER_LIST = 'user_list';
    const TAG_USER_LIST_ITEM = 'user_list_item';
}
