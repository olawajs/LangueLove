<?php

namespace App\Http\Controllers;

use App\Models\Lector;
use App\Models\LanguageLevel;
use App\Models\Language;
use App\Models\User;
use Illuminate\Http\Request;

class LectorController extends Controller
{
    public function showLectors()
    {
        $path = public_path('images/lectors');
        $lectors = Lector::all();
        return view('admin/lectors',[
                'lectors' => $lectors
            ]);
    }
    public function getLector(Request $request)
    {
       
        $lector = Lector::where('id',$request->id)->get();
        $levels = LanguageLevel::where('lector_id',$request->id)->get();
        return view('admin/lectorData',[
                'lector' => $lector,
                'id' => $request->id,
                'levels' => $levels,
            ]);
    }
    public function NewLector()
    {
        $langs = Language::where('active',1)->get();
        return view('admin/newLector',[
                'langs' => $langs
        ]);
    }
    public function EditLector(Request $request)
    {

        $imageName = time().'.'.$request->name.'_'.$request->file('photo')->getClientOriginalName();    
        $validated = $request->validate([
            'name' => 'required', 
            'surname' => 'required', 
            'email' => 'required', 
            'native_language_id' => 'required|integer', 
            'education' => 'required',
            'description' => 'required',
            'city' => 'required',
            'levels' => 'nullable',
            'style' => 'nullable',
            'street' => 'required',
            'post_code' => 'required'
        ]);
        $ile = $request->languageAmount;
        if($request->file('photo') !=''){
         $validated['photo'] = $imageName;
        }
       
        $validated['active'] = true;
       
       
        $lector = Lector::update($validated);
  
            //  for($i=1; $i<=$ile; $i++){
                 
            //     if($request['language_level'.$i] != '0'){
            //          $data=[
            //                 'lector_id'=>$lector->id,
            //                 'language_id'=>$request['native_language'.$i],
            //                 'level'=>$request['language_level'.$i],
            //             ];
            //     $lanLevel = LanguageLevel::create($data);  
            //     }
             
            // }
                
        if($lector){
            if($request->file('photo') !=''){
              $image = $request->file('photo')->move('images/lectors/', $imageName);
            }
              return redirect()->route('lectors');
          
        }
    }
    public function AddLector(Request $request)
    {
        $imageName = time().'.'.$request->name.$request->surname.'_'.$request->file('photo')->getClientOriginalName();    
        $validated = $request->validate([
            'name' => 'required', 
            'surname' => 'required', 
            'email' => 'required', 
            'native_language_id' => 'required|integer', 
            'education' => 'required',
            'description' => 'required',
            'city' => 'required',
            'levels' => 'nullable',
            'style' => 'nullable',
            'street' => 'required',
            'post_code' => 'required'
        ]);
        $ile = $request->languageAmount;
        $validated['photo'] = $imageName;
        $validated['active'] = true;
       
        $user = User::where('email',$request->email)->get();
        // dd($user[0]->id);
        if(count($user)>0){
            $validated['id_user'] = $user[0]->id;
             User::where('email',$request->email)
            ->update(['user_type' => 3]);
        }
        else{
            $validated['id_user'] = 0;
        }
       
        $lector = Lector::create($validated);
  
             for($i=1; $i<=$ile; $i++){
                 
                if($request['language_level'.$i] != '0'){
                     $data=[
                            'lector_id'=>$lector->id,
                            'language_id'=>$request['native_language'.$i],
                            'level'=>$request['language_level'.$i],
                        ];
                $lanLevel = LanguageLevel::create($data);  
                }
             
            }
                
        if($lector){
              $image = $request->file('photo')->move('images/lectors/', $imageName);
              return redirect()->route('lectors');
          
        }
    }
}
