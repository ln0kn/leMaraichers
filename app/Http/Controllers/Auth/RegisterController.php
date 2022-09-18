<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
   
    public function __construct()
    {
         $this->middleware('auth');
         $this->middleware('level:8');
        $this->middleware('permission');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
          'pageUtilisareur.*' => 'required|integer',
          'droitUtilisateur.*' => 'required|integer',
          'nom' => 'required',
          'prenomUtilisateur' => 'required',
          'nomUtilisateur' => 'nullable|unique:users,username',
          'telephoneUtilisateur' => 'required|integer|digits:8',
          'motDePasse' => 'required|string|min:6|confirmed',
          
          
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        
     $droit =0 ;
     $page ='' ;
      foreach ($data['droitUtilisateur'] as $key => $value) {
        $droit +=$value;
      }
        
        foreach ($data['pageUtilisateur'] as $key => $value) {
        $page .=$value.',';
      }    
        
        return User::create([
            'nom' => $data['nom'],
            'prenom' => $data['prenomUtilisateur'],
            'username' => $data['nomUtilisateur'],
            'telephone' => $data['telephoneUtilisateur'],
            'droit' => $droit,
            'pageUtilisateur' => $page,
            'statut' => 0,
            'password' => bcrypt($data['motDePasse']),
        ]);
    }
    
    
    protected function getUser()
    {
        return User::all();
        
    }
    
    
    protected function deleteUser(Request $request){
        $valide = Validator::make($request->all(), [
        'idUtilisateur' => 'required|integer',
        ]);

      if ($valide->fails()) {
        return response()->json([
          'fail' =>true,
          'errors' => $valide->errors()
        ]);
      }
        
      $user = User::find($request['idUtilisateur']);
        
        if($user -> statut == 0)
            $user -> statut = 1;
        else
            $user -> statut = 0;
        
        $user -> save();
        return $user; 
    }
    
    
    protected function updateUser(Request $request){
        $valide = Validator::make($request->all(), [
        'idUtilisateur' => 'required|integer',
        'pageUtilisareur.*' => 'required|integer',
        'droitUtilisateur.*' => 'required|integer',
        'nom' => 'required',
        'prenomUtilisateur' => 'required',
        'nomUtilisateur' => 'nullable|unique:users,username,'.$request['idUtilisateur'].',id',
        'telephoneUtilisateur' => 'required|integer|digits:8',
        'motDePasse' => 'nullable|string|min:6|confirmed',
        ]);

      if ($valide->fails()) {
        return response()->json([
          'fail' =>true,
          'errors' => $valide->errors()
        ]);
      }
        
        $droit =0 ;
     $page ='' ;
      foreach ($request['droitUtilisateur'] as $key => $value) {
        $droit +=$value;
      }
        
        foreach ($request['pageUtilisateur'] as $key => $value) {
        $page .=$value.',';
      }    

        if ($request['password']) {
        $user -> password = bcrypt($request['password']);
        }
        $user = User::find($request['idUtilisateur']);
        $user -> nom = $request['nom'];
        $user -> prenom = $request['prenomUtilisateur'];
        $user -> telephone = $request['telephoneUtilisateur'];
        $user -> droit = $droit;
        $user -> pageUtilisateur = $page;
        $user -> username  = $request['nomUtilisateur'];
        $user -> save() ;

        return $user;
    }
    

}
