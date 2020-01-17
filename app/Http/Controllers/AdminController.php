<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function isadmin()
    {
        if (auth()->check()) {
            if(Auth::user()->ach_mel == "com@service.fr")
                return redirect('serviceCom');
            if (Auth::user()->ach_mel == "vente@service.fr")
                return redirect('serviceVente');
            if (Auth::user()->ach_mel == "service@adh.fr")
                return redirect('serviceAdherent');
            else return redirect('/');
        }
        else return redirect('/');
    }
}