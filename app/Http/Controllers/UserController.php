<?php

namespace App\Http\Controllers;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


use App\User;
use Illuminate\Support\Str;
class UserController extends Controller
{

    protected $user;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct(User $user)
    {
        $this->user = $user;
        # code...
    }

    public function index()
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

            $data = $request;
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

            return response()->json($this->user,200);
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

                $this->user = User::findOrFail($id);
                return response()->json($this->user,200);

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
                $data =$request;
                $this->user = User::findOrFail($id);

                $this->user->identification_card = $data['identification_card'];
                $this->user->name = $data['name'];
                $this->user->lastname = $data['lastname'];
                $this->user->address = $data['address'];
                $this->user->phone_number = $data['phone_number'];
                $this->user->city = $data['city'];
                $this->user->Country = $data['Country'];
                $this->user->date_of_birth = $data['date_of_birth'];
                $this->user->gender = $data['gender'];
                $this->user->email = $data['email'];
                $this->user->save();

                return response()->json($this->user,200);

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
                $this->user = User::findOrFail($id);
                $this->user->delete();
                return response()->json(['user' => $this->user, 'users' => User::all()],200);

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
