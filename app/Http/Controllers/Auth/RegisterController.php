<?php

namespace MOHA\Http\Controllers\Auth;

use MOHA\User;
use MOHA\Provincia;
use MOHA\TipoUsuario;
use MOHA\Representante;
use MOHA\Mail\Bienvenido;
use MOHA\Mail\UsuarioRegistrado;
use MOHA\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Session;
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

    public function showRegistrationForm()
    {   
        $provincias = Provincia::orderBy('nombre', 'ASC')->get();
        //$tipousuarios = TipoUsuario::orderBy('descripcion', 'ASC')->get();
        $representantes = Representante::where('id', '!=', 1)->get();
        return view('auth.register', array('representantes' => $representantes, 'provincias' => $provincias));
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/index';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'razonsocial' => 'string|max:255|unique:users',
            'cuit' => 'required|unique:users',
            'registro' => 'required|unique:users',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \MOHA\User
     */
    protected function create(array $data)
    {
        if(!isset($data['id_rep']))
        {
            $id_rep = 1;
        }
        else
        {
            $id_rep = $data['id_rep'];   
        }

        if(!isset($data['is_rep']))
        {
            $is_rep = false;
        }
        else
        {
            $is_rep = true;      
        }

        DB::beginTransaction();

        try {

            $user = User::create([
                'name' => ucwords(mb_strtolower($data['name'])),
                'apellido' => ucwords(mb_strtolower($data['apellido'])),
                'razonsocial' => ucwords(mb_strtolower($data['razonsocial'])),
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'cuit' => $data['cuit'],
                'telefono' => $data['telefono'],
                'domicilio' => ucwords(mb_strtolower($data['domicilio'])),
                'id_provincia' => $data['id_provincia'], 
                'id_ciudad' => $data['id_ciudad'],
                'tipo_us' => $data['tipo_us'],
                'registro' => $data['registro'],
                'id_rep' => $id_rep,
                'is_rep' => $is_rep,                
            ]);

            if($is_rep)
            {
                $rep = New Representante();
                $rep->id_user = User::all()->last()->id;

                $rep->save();
            }

            Mail::to($user->email)->send(new Bienvenido());

            Mail::to(config('mail.username'))->send(new UsuarioRegistrado());
            
            Session::flash('message','Usuario registrado con éxito! \n 
                                        Se le ha enviado un correo electrónico a la dirección con la que se registró. Por favor verifique su buzon de entrada o correos no deseados.');

            DB::commit();

        } catch (\Trowable $e) {

            DB::rollback();
            throw $e;
            Session::flash('message', 'Verifique los datos ingresados');
        }

        return $user;
    }
}
