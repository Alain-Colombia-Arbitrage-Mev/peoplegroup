<?php

namespace App\Http\Controllers\Auth;

use App\ChargeCommision;
use App\Income;
use App\User;
use App\Http\Controllers\Bonus\BonusRedeem;
use App\Http\Controllers\Tree\UsersBinary;
use App\Http\Controllers\Tree\TreeDao;


use App\General;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

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
            'referrer_id' => 'required',
            // 'wallet' => 'required'
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => 'required|string|email|max:255|unique:users',
            'mobile' => 'required',
            'username' => 'required',
            'password' => 'required|string|min:5',
            // 'street_address' => 'required',
            // 'city' => ['required',],
            // 'country' => 'required',
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
        $pin = substr(time(), 4);

        $message = '<center><tr>';
        $message .='<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">';
        $message .='<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;color:green;">Bienvenid @'.$data['username'].' Gracias por ser Solidario.</p>';
                      
        $message .='<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Muchos Éxitos en tu camino.</p>';
        $message .='<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Tu usuario es: '.$data['username'].' .</p>';

        $message .='<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Tu Clave es: '.$data['password'].' .</p>';

        $message .='<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px; color:red;">Recuerda no compartir tu contraseña.</p>';
        $message .='</td>';
        $message .='</tr></center>';

        send_email($data['email'], 'Cuenta creada con éxito', $data['first_name'], $message);


        $general = General::first();


        return User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'referrer_id' => $data['referrer_id'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'mobile' => $data['mobile'],
            'street_address' => '', //$data['street_address'],
            'city' => 'medellin', //$data['city'],
            'country' => 'Colombia', // $data['country'],
            'username' => $data['username'],
            'wallet' => $data['wallet'],
            //'birth_day' =>  date('Y-m-d',strtotime($data['birth_day'])),
            'join_date' => Carbon::today(),
            'balance' => 0,
            'status' => 1,
            'paid_status' => 0,
            'ver_status' => 0,
            'ver_code' => $pin,
            'forget_code' => 0,
            'tauth' => 0,
            'tfver' => 1,
            'emailv' => $general->emailver,
            'smsv' => $general->smsver,
        ]);
    }

    public function register(Request $request)
    {
        // registrar conteo de referidos para solidario
        $r= $request->all();

        $sponsor = $r['referrer_id'];
        // $user =  $r['username'];
        // owner , typebonuses, referidos, fecha
        // dossa ,      solidary,   {id: zoe}, hoy 

        
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        
        if ($sponsor) {
            BonusRedeem::create([
                'owner' => $sponsor,
                'type' => 'Solidary',
                'status' => 0,
                'created' => Carbon::today(),
                'referred_user' =>   $user['id'] // nuevo usuario
            ]);
        }

        // register to binary
        // $sponsor = $r['sponsor']; //$user['referrer_id'];
        // $position = $r['position'];
        
        // $directOwner = $r['directowner']; // root
        
        // $datatree = [
        //     "id" => $user['id'],
        //     "tag" => $user['username'],
        //     "parent" => $sponsor,
        //     "position" => $position,
        //     "directOwner" => $directOwner,
        //     "value" => 100,
        // ];
        
        // $treeDao = new TreeDao();

        // $nodeIsAssigned = $treeDao->assignPosition($datatree);
                
            
        // if ($nodeIsAssigned['status'] === true) {
        // echo $user['_id'] . " fue un nodo asignado: " . print_r($nodeIsAssigned, true);
        // } else {
        // echo $user['_id'] . " NO FUE ASIGNADO: " . print_r($nodeIsAssigned, true);
        // }

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }
}
