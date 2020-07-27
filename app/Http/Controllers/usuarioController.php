<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;

class usuarioController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function vista()
    {
        return view('usuario');
    }

    public function index(Request $request)
    {

        // $users = User::paginate(10);
        // return view(user.index, compact('users'));


        $users = \DB::table('users')->select('tipo_usuario', 'tipo_identificacion', 'no_identificacion', 'nombre', 'apellido', 'cargo', 'telefono', 'email')->get();
        return $users;

        if ($request->wantsJson()) {
            return User::where('id', auth()->id())->get();
        } else {
            // return view('home');
            return 'error al mostrar datos';
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario = new User();
        $usuario->tipo_usuario = $request->tipo_usuario;
        $usuario->tipo_identificacion = $request->tipo_identificacion;
        $usuario->no_identificacion = $request->no_identificacion;
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->cargo = $request->cargo;
        $usuario->telefono = $request->telefono;
        $usuario->email = $request->email;
        $usuario->password = bcrypt($request->password);
        $usuario->save();

        return $usuario;
    
         
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $usuario = Nota::find($id);
        $usuario->tipo_usuario = $request->tipo_usuario;
        $usuario->tipo_identificacion = $request->tipo_identificacion;
        $usuario->no_identificacion = $request->no_identificacion;
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->cargo = $request->cargo;
        $usuario->telefono = $request->telefono;
        $usuario->email = $request->email;
        $usuario->save();
        
        return $usuario;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
