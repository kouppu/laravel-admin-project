<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PasswordChangeRequest;
use App\Http\Requests\AdminRequest;
use App\Repositories\Admin\AdminRepositoryInterface;

class SettingController extends Controller
{

    /** @var AdminRepositoryInterface */
    private $admin;

    public function __construct(AdminRepositoryInterface $admin)
    {
        $this->admin = $admin;
    }

    /**
     * アカウント設定画面表示
     */
    public function account()
    {
        $account = Auth::user();
        return view('admin.settings.account', compact('account'));
    }

    /**
     * アカウント設定アップデート
     *
     * @param AdminRequest $request
     */
    public function updateAccount(AdminRequest $request)
    {
        $this->admin->update([
            'id' => Auth::user()->id,
            'name' => $request->name,
            'email' => $request->email
        ]);
        return redirect()->route('admin.settings.account')->with('success', '変更が完了しました。');;
    }

    /**
     * パスワード変更画面表示
     */
    public function password()
    {
        return  view('admin.settings.password');
    }

    /**
     * パスワード変更
     *
     * @param PasswordChangeRequest $request
     */
    public function updatePassword(PasswordChangeRequest $request)
    {
        $data = [
            'id' => Auth::user()->id,
            'password' => $request->password
        ];
        $this->admin->updatePassword($data);
        return redirect()->route('admin.settings.password')->with('success', '変更が完了しました。');
    }
}
