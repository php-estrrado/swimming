<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Contracts\Admin\WidgetInterface as WidgetInterface;
use App\Traits\Admin\EmailTrait;
use Redirect;
use Auth;

class WidgetController extends BaseController {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests,
        EmailTrait;

    private $widget;

    public function __construct(WidgetInterface $widget) {
        $this->middleware('authadmin:admin');
        $this->widget = $widget;
    }

}
