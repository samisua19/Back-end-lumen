<?php

namespace App\Http\Controllers;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


use App\User;
use Illuminate\Support\Str;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
                return User::all();
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Verificar que la solicitud sea json
        if($request->isJson()){
            $data = $this->validate($request,[
                'identification_card' => 'required|max:10',
                'name' => 'required|max:225',
                'lastname' => 'required|max:225',
                'address' => 'required|max:225',
                'phone_number' => 'required|max:10',
                'city' => 'required|max:225',
                'Country' => 'required|max:225',
                'date_of_birth' => 'required',
                'gender' => 'required',
                'email' => 'required|max:225',
                'password' => 'required'
            ]);

            $user = User::create([
                'identification_card' => $data['identification_card'],
                'name' => $data['name'],
                'lastname' => $data['lastname'],
                'address' => $data['address'],
                'phone_number' => $data['phone_number'],
                'city' => $data['city'],
                'Country' => $data['Country'],
                'date_of_birth' => $data['date_of_birth'],
                'gender' => $data['gender'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'api_token' => Str::random(60)
            ]);

            return response()->json($user,200);
        }else{
            // Devuelve un error al no recibir una solicitud en formato Json
            return response()->json(['Error' => 'Unautorized'], 401,[]);
        }
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
         if($request->isJson()){
            try{

                $user = User::findOrFail($id);
                return response()->json($user,200);

            }catch(ModelNotFoundException $e){
                return response()->json(['Error' => 'No content'], 406,[]);

            }
        }else{
            // Devuelve un error al no recibir una solicitud en formato Json
            return response()->json(['Error' => 'Unautorized'], 401,[]);
        }
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->isJson()){
            try{
                $data = $this->validate($request,[
                    'identification_card' => 'required|max:10',
                    'name' => 'required|max:225',
                    'lastname' => 'required|max:225',
                    'address' => 'required|max:225',
                    'phone_number' => 'required|max:10',
                    'city' => 'required|max:225',
                    'Country' => 'required|max:225',
                    'date_of_birth' => 'required',
                    'gender' => 'required',
                    'email' => 'required|max:225'
                ]);

                $user = User::findOrFail($id);

                $user->identification_card = $data['identification_card'];
                $user->name = $data['name'];
                $user->lastname = $data['lastname'];
                $user->address = $data['address'];
                $user->phone_number = $data['phone_number'];
                $user->city = $data['city'];
                $user->Country = $data['Country'];
                $user->date_of_birth = $data['date_of_birth'];
                $user->gender = $data['gender'];
                $user->email = $data['email'];
                $user->save();

                return response()->json($user,200);

            }catch(ModelNotFoundException $e){
                return response()->json(['Error' => 'No content'], 406,[]);

            }
        }else{
            // Devuelve un error al no recibir una solicitud en formato Json
            return response()->json(['Error' => 'Unautorized'], 401,[]);
        }
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
         if($request->isJson()){
            try{

                $user = User::findOrFail($id);
                $user->delete();

                return response()->json($user,200);

            }catch(ModelNotFoundException $e){
                return response()->json(['Error' => 'No content'], 406,[]);

            }
        }else{
            // Devuelve un error al no recibir una solicitud en formato Json
            return response()->json(['Error' => 'Unautorized'], 401,[]);
        }
        //
    }
}
