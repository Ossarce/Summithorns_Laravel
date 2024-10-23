<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Models\Spot;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PublicPageController extends Controller
{
    public function home() {
        $spots = Spot::take(3)->get();
        foreach($spots as $spot) {
            $spot->short_description = Str::limit($spot->description, 200, '...');
        }

        $entries = Entry::latest()->take(2)->get();
        foreach($entries as $entry) {
            $entry->short_description = Str::limit($entry->description, 150, '...');
        }

        notyf()->ripple(false)->dismissible(true)->warning('Recuerda mover los listados de spots y entries a sus propios archivos!');
        return view('public.home', compact('spots', 'entries'));
    }

    public function spots() {
        notyf()->ripple(false)->info('En breve podrás ver aqui los spots disponibles!');
        return view('public.spots');
    }

    // public function spot(Spot $spot) {

    // }

    public function blog() {
        notyf()->ripple(false)->info('En breve podrás ver aqui las entradas disponibles!');
        return view('public.blog');
    }

    // public function entry(string $id) {

    // }

    public function contact() {
        notyf()->ripple(false)->warning('El formulario no está funcionando y se deben aplicar los estilos correspondientes');
        return view('public.contact');
    }

    public function us() {
        notyf()->ripple(false)->warning('Se deben mejorar las reglas de stilos usadas aqui aaaaagghhh!!!');
        return view('public.us');
    }
}
