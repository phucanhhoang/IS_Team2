<?php namespace App\Enum;

/**
 * Created by IntelliJ IDEA.
 * User: Phuc Anh Hoang
 * Date: 4/18/2016
 * Time: 10:29 PM
 */

class OrderStatus extends MyEnum
{
    const PENDING = 0;
    const PROCESSING = 1;
    const COMPLETE = 2;
    const CANCELED = 3;
}