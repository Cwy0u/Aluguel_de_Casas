<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class HouseController extends Controller
{
    public function index()
    {
        $houses = House::with('user')->get();

        return view('welcome', [
            'houses' => $houses,
        ]);
    }

    public function myhouses()
    {
        if (Auth::check()) {
            $user_id = Auth::id();

            $houses = House::where('user_id', $user_id)->get();

            return view('my_houses', [
                'houses' => $houses,
            ]);
        }
        return redirect('/')->with('error', 'É necessário estar logado para acessar essa página!');
    }

    public function store(Request $request)
    {
        $descricao = $request->input('descricao');
        $valor = $request->input('valor');
        $quartos = $request->input('quartos');
        $banheiros = $request->input('banheiros');
        $area = $request->input('area');

        if (Auth::check()) {

            $user_id = Auth::id();

            $newHouse = House::create([
                'descricao' => $descricao,
                'valor' => $valor,
                'quartos' => $quartos,
                'banheiros' => $banheiros,
                'area' => $area,
                'disponivel' => true,
                'user_id' => $user_id,
            ]);

            if(!$newHouse) {
                return redirect('/')->with('error', 'Erro ao cadastrar');
            }
    
            return redirect('/')->with('success', 'Imóvel cadastrado com sucesso!');
        } 
        return redirect('/')->with('error', 'É necessário estar logado para cadastrar um imóvel!');
    }

    public function show(string $id)
    {
        $house = House::with('user')->find($id);

        if(!$house) {
            return redirect('/')->with('error', 'Imóvel não encontrado');
        }

        return view('house', [
            'house' => $house,
        ]);
    }
}
