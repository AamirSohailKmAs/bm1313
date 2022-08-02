<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function withSuccess(string $message)
    {
        return $this->with('success', $message);
    }

    public function withWarning(string $message)
    {
        return $this->with('warning', $message);
    }

    public function withInfo(string $message)
    {
        return $this->with('info', $message);
    }
}
