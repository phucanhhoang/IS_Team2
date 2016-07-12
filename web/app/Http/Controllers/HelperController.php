<?php
/**
 * Created by IntelliJ IDEA.
 * User: Phuc Anh Hoang
 * Date: 7/8/2016
 * Time: 10:34 AM
 */

namespace App\Http\Controllers;


class HelperController extends Controller
{
    public function refereshCapcha()
    {
        return captcha_img('flat');
    }
}