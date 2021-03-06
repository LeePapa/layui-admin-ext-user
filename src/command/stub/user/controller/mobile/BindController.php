<?php


namespace app\user\controller\mobile;

use thans\layuiAdmin\facade\Json;
use thans\user\facade\Auth;
use thans\user\traits\mobile\Bind;
use think\Request;

class BindController
{
    use Bind;

    public function validator(Request $request)
    {
        $validate = (new \app\user\validate\User())->scene('mobile_code');
        if (! $validate->check($request->param())) {
            Json::error($validate->getError());
        }
    }

    public function update(array $data)
    {
        $user         = Auth::info();
        $user->mobile = $data['mobile'];
        $user->save();

        return $user;
    }
}
