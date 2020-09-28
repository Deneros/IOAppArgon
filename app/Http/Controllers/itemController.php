<?php

namespace App\Http\Controllers;
use App\Item;
use App\Historial;
use App\ItemsHistorial;
use App\UsuariosHistorial;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class itemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function vistaInventarioTotal()
    {
        return view('inventariototal');
    }

    public function vistaitems()
    {
        return view('items');
    }

    public function index()
    {   
        
        
        $items = \DB::table('items')->select('id','nombre_item', 'serial', 'descripcion_item', 'estado', 'ubicacion', 'A_cargo', 'id_subcategoria')->get();
        return $items;

        // $inventario = DB::table('items')
        //     ->join ('subcategorias','subcategorias.id','=','items.id_subcategoria')
        //     ->select('items.*','subcategorias.nombre_sub')
        //     ->get();
        // return $inventario;  


        // $data = Item::select('items.id','items.nombre_item', 'subcategorias.id')
        // ->leftjoin('subcategorias', 'items.id_subcategorias', '=', 'subcategorias.id')
        // ->get();

        // return $data;

    }

    public function inventarioTotal(){
        

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $fecha = Carbon::now();

        $item = new Item();
        $item->nombre_item = $request->nombre_item;
        $item->serial = $request->serial;
        $item->descripcion_item = $request->descripcion;
        $item->estado = $request->estado;
        $item->ubicacion = $request->ubicacion;
        $item->A_cargo = $request->usuarioCargo;
        $item->id_subcategoria = $request->subcategoria;
        $item->save();
         
        $historial = new Historial();
        $historial -> fecha_inscripcion = Carbon::now();
        $historial -> save();

        $a_cargo = DB::select("SELECT id FROM users WHERE nombre = '$request->usuarioCargo'");

        $usuariosh =  new UsuariosHistorial();
        $usuariosh -> id_usuario = $a_cargo[0]->id;
        $usuariosh -> id_historial = Historial::latest()->first()->id;
        $usuariosh -> save();

        $itemsh = new ItemsHistorial();
        $itemsh -> id_item = Item::latest()->first()->id;
        $itemsh -> id_historial = Historial::latest()->first()->id;
        $itemsh -> save();

        return $itemsh;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $items = \DB::table('items')->select('id','nombre_item', 'serial', 'descripcion_item', 'estado', 'ubicacion', 'A_cargo', 'id_subcategoria')->where('id_subcategoria',$id)->get();
        return $items;
        
        // $inventario = DB::table('items')
        //     ->join ('subcategorias','items.id_subcategoria','=','subcategorias.id_subcategoria')
        //     ->join ('catagorias', 'subcategorias.id_categoria','=','categorias.id_categoria')
        //     ->select('items.*','subcategorias.id_subcategoria','subcategorias.nombre_sub','categorias.id_categoria','categorias.nombre_cat')
        //     ->get();
        // return $inventario; 
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
        $item = Item::find($id);
        $item->nombre_item = $request->nombre_item;
        $item->serial = $request->serial;
        $item->descripcion_item = $request->descripcion;
        $item->estado = $request->estado;
        $item->ubicacion = $request->ubicacion;
        $item->A_cargo = $request->usuarioCargo;
        $item->save();
        
        return $item;
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
