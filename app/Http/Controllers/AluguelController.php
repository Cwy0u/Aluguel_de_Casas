<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\House;
use App\Models\Aluguel;

class AluguelController extends Controller
{
    public function alugar(string $id) {
        if(Auth::check()) {
            $user_id = Auth::id();
            $house = House::find($id);

            $aluguelExistente = Aluguel::where('user_id', $user_id)->where('house_id', $id)->where('status', 'Ativo')->first();

            if($aluguelExistente){
                return redirect('/')->with('error', 'Você já tem um aluguel ativo nessa residência!');
            }

            $house->disponivel = 0;
            $house->save();

            $aluguel = Aluguel::create([
                'user_id' => $user_id,
                'house_id' => $id,
                'status' => 'Ativo',
                'valor' => $house->valor,
            ]);

            if(!$aluguel) {
                return redirect('/')->with('error', 'Erro ao alugar');
            }

            return redirect('/')->with('success', 'Aluguel Realizado com sucesso!');
        } else {
            return redirect('/')->with('error', 'É necessário estar logado para alugar!');
        }
    }

    public function liberar_aluguel(string $id)
    {
        if (Auth::check()) {
            $user_id = Auth::id();

            $house = House::find($id);

            if ($house) {
                $house->disponivel = 1;
                $house->save();

                $alugueis = Aluguel::where('house_id', $id)->get();

                foreach ($alugueis as $aluguel) {
                    $aluguel->status = 'Finalizado';
                    $aluguel->save();
                }

                return redirect('/')->with('success', "Aluguel da casa liberado com sucesso!");
            } else {
                return redirect('/')->with('error', 'Casa não encontrada!');
            }
        } else {
            return redirect('/')->with('error', 'É necessário estar logado para acessar essa página!');
        }
    }

    public function alugadas(){
        if (Auth::check()) {
            $user_id = Auth::id();

            $alugueisAtivos = Aluguel::where('user_id', $user_id)
            ->where('status', 'Ativo')
            ->with('house')
            ->get();

            $casasAlugadas = [];

            foreach ($alugueisAtivos as $aluguel) {
                $casa = $aluguel->house;
                $casasAlugadas[] = $casa;
            }

            
            // $casasAlugadas = json_encode($casasAlugadas);
            
            return view('alugadas', [
                'houses' => $casasAlugadas,
            ]);
            // return redirect('/')->with('success', $casasAlugadas);
        }
        return redirect('/')->with('error', 'É necessário estar logado para acessar essa página!');
    }
}
