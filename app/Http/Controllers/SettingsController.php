<?php

namespace App\Http\Controllers;

use App\Models\MainSetting;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function index() : View {

        $mainsettings = DB::table('main_settings')->select('siteName','siteUrl','siteDesc', 'email', 'phone', 'address', 'sitelogo', 'social')->get();
        
        return view('admin.pages.mainsettings')->with(['settings'=>$mainsettings[0]]);
    }

    public function mainSettingsedit(Request $request){
        
        $request->validate([
            'siteName'=> 'required|string',
            'siteUrl'=> 'required|url',
            'siteDesc'=> 'required|string',
            'email'=> 'required|email',
            'address'=> 'required|string',
            'phone'=> 'required|regex:/^\+201[0125][0-9]{8}$/',
            'social'=> 'required|string',
        ]);

        try {
            $ms = MainSetting::firstOrFail();
            $ms->siteName = $request->siteName;
            $ms->siteUrl = $request->siteUrl;
            $ms->siteDesc = $request->siteDesc;
            $ms->email = $request->email;
            $ms->address = $request->address;
            $ms->phone = $request->phone;
            $ms->social = $request->social;
    
            $ms->save();
            return redirect()->route('mainsettings');
        } catch (\Throwable $th) {
            return redirect()->route('mainsettings');
        }


        
    }
}
