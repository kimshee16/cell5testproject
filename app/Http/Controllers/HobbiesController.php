<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Hobbies as HobbiesResource;
use App\Hobbies;

class HobbiesController extends Controller
{
    public function index()
    {
        return HobbiesResource::collection(Hobbies::all());
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'hobbies' => 'required',
            'tags' => 'required'
        ]);
        
        if($request->get('id') == ''){
            $hobbies = new Hobbies;  
            $hobbies->firstname =  ucfirst($request->get('firstname'));  
            $hobbies->lastname = ucfirst($request->get('lastname'));  
            $hobbies->hobbies = $request->get('hobbies');  
            $hobbies->tags = $request->get('tags');  
            $hobbies->save();  
            return redirect('/');
        }else{
            $hobbies = Hobbies::findOrFail($request->get('id'));
            $hobbies->firstname = ucfirst($request->firstname);
            $hobbies->lastname = ucfirst($request->lastname);
            $hobbies->hobbies = $request->hobbies;
            $hobbies->tags = $request->tags;
            $hobbies->save();
            return redirect('/');
        }
    }

    public function store2($id, $fn, $ln, $h, $t)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'hobbies' => 'required',
            'tags' => 'required'
        ]);

        if($id == ''){
            $hobbies = new Hobbies;  
            $hobbies->firstname =  $fn;  
            $hobbies->lastname = $ln;  
            $hobbies->hobbies = $h;  
            $hobbies->tags = $t;  
            $hobbies->save();  
            return redirect('/');
        }else{
            $post = Hobbies::findOrFail($id);
            $post->firstname = $request->firstname;
            $post->lastname = $request->lastname;
            $post->hobbies = $request->hobbies;
            $post->tags = $request->tags;
            $post->save();
            return redirect('/');
        }

        
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'hobbies' => 'required',
            'tags' => 'required'
        ]);
        $post = Hobbies::findOrFail($id);
        $post->firstname = $request->firstname;
        $post->lastname = $request->lastname;
        $post->hobbies = $request->hobbies;
        $post->tags = $request->tags;
        $post->save();
        return response()->json([
            'data' => 'Hobbies updated!'
        ]);
    }

    public function destroy($id){
        $post = Hobbies::findOrFail($id);
        $post->delete();
        return redirect('/');
    }

    public function getHobbies(){

        $hobbies = Hobbies::orderby('id','desc')->select('*')->get(); 

        // Fetch all records
        $hobbiesData['data'] = $hobbies;
   
        echo json_encode($hobbiesData);
        exit;
     }

     public function getHobby($id){

        $hobbies = Hobbies::select('*')->where('id', $id)->get(); 
        // Fetch all records
        $hobbiesData['data'] = $hobbies;
        echo json_encode($hobbiesData);
        exit;
     }

     public function searchHobby($term){
        $hobbies = Hobbies::where('tags', $term)->orWhere('tags', 'like', '%' . $term . '%')->get();
        $hobbiesData['data'] = $hobbies;
        echo json_encode($hobbiesData);
     }
      

}
