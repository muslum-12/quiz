<?php
  //∣∣∣∣∣∣∣
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\settings;

class SettingsController extends Controller
{
   public function index()
   {

     $data['adminSettings']=Settings::all()->sortBy('settings_must');

     return view('backend.settings.index',compact('data'));
   }

   public function sortable()
   {
     //print_r($_POST['item']);
     foreach ($_POST['item'] as $key => $value) {
       $settings=Settings::find(intval($value));
       $settings->settings_must=intval($key);
       $settings->save();
     // code...
     }
     echo true;
   }

   public function destroy($id)
    {
      $settings=Settings::find($id);
      if($settings->delete()){
      return back()->with('success','işlem Başarılı');
    }
      return back()->width('error','işlem Başarısız');

   }

//edit İşlemi
   public function edit($id)
   {
     $settings=Settings::where('id',$id)->first();
     return view('backend.settings.edit')->with('settings',$settings);
   }

// Düzenlme İşlemi

   public function update(Request $request,$id)
   {


     if($request->hasFile('settings_value'))
     {
       $request->validate([
        'settings_value' => 'required|image|mimes:jpg,jpeg,png|max:2048'
       ]);
       $file_name=uniqid().'.'.$request->settings_value->getClientOriginalExtension();
       $request->settings_value->move(public_path('images/settings'),$file_name);
       $request->settings_value=$file_name;
     }



    $settings=settings::where('id',$id)->Update(
      [
        "settings_value"=>$request->settings_value
      ]
    );

    if($settings)
    {
      $path='images/settings/'.$request->old_file;
      if(file_exists($path))
      {
        @unlink(public_path($path));
      }


       return back()->with("success","Düzenle İşlemi Başarılı");
    }
       return back()->with("error","Düzenleme İşlemi Başarısız");
   }




}
