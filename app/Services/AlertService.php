<?php
namespace App\Services;
use Flasher\Noty\Prime\NotyInterface;

class AlertService
{
    public static function updated($message = null)
    {
        flash()->success($message ? $message : 'Updated Successfully.');
    }

    public static function created($message = null)
    {
        flash()->success($message ? $message : 'Created Successfully.');
    }

    public static function deleted() : void
    {
        flash()->success('Deleted Successfully.');
    }

    public static function error($message) : void
    {
        flash()->error($message ? $message : 'Something went wrong.');
    }

}
