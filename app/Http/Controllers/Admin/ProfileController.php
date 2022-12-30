<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\ProfileHistory;
use Carbon\Carbon;


class ProfileController extends Controller
{
    //
    public function add()
    {
        return view('admin.profile.create');
    }
    
    public function create(Request $request)
    {
        $this->validate($request, Profile::$rules);
        $profile = new Profile;
        $form = $request->all();
        
        unset($form['_token']);
        unset($form['image']);
        
        $profile->fill($form);
        $profile->save();
        
        return redirect('admin/profile/create');
    }
    
    public function edit(Request $request)
    {
        $profile = Profile::find($request->id);
        if (empty($profile)) {
            abort(404);
        }
        
        return view('admin.profile.edit',['profile_form' => $profile]);
    }
    
    public function update(Request $request)
    {
        $this->validate($request,Profile::$rules);   // 1.入力値チェック
        $profile = Profile::find($request->id);      // 2.プロフィールモデルのfind関数にリクエストで受けとったidを渡して該当のプロフィールを取得する
        $profile_form =$request->all();              // 3.リクエストで受け取ったすべての情報を変数($profile_form)に格納する
        unset($profile_form['_token']);              // 4.すべての情報の中からtoken情報をはずす
        
        $profile->fill($profile_form)->save();       // 5.プロフィールモデルに代入して保存する
        
        $history = new ProfileHistory();             // 6.プロフィールヒストリーに新しく行をつくる
        $history->profile_id = $profile->id;         // 7.profilehistoryモデルのidとprofileモデルのidを関連付ける
        $history->edited_at = Carbon::now();         // 8.「6」で作った行の「edited_at」カラムに現在時刻をセットする
        $history->save();
        
        return redirect('admin/profile/create');
    }
}
