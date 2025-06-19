<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;

class UserController extends Controller
{
public function search(Request $request)
{
    $query = $request->input('query');

    $users = User::select('id', 'name', 'username', 'profile_image')
        ->when($query, function ($q) use ($query) {
            $q->where('username', 'like', "%{$query}%")
              ->orWhere('name', 'like', "%{$query}%");
        })
        ->limit(20)
        ->get()
        ->map(function ($user) {
            $user->profile_image_url = $user->profile_image
                ? asset('storage/' . $user->profile_image)
                : asset('default-profile.png');
            return $user;
        });

    $posts = Post::latest()->take(12)->get();

    return view('recommendations.recommends', compact('users', 'posts', 'query'));
}


}


//edbert19 (admin account)
//email = edbert19@gmail.com
//pw = edbert1909

//wedrtghujki456789
//email = edfgvnhjmk@gmail.com
//pw = wedrtghujki456789

//edbha
//edbha@gmail.com
//pw = edbhagmail

//banana
//banana@gmail.com
//pw = bananagmail

//dioapple
//dioapple@gmail.com
//pw = dioapple

//devinmango
//devinmango@gmail.com
//pw = devinmango

//edbertayanami
//edbertayanami@gmail.com
//pw= edbertayanami

//rukiakuchiki
//rukiakuchiki@gmail.com
//pw = rukiakuchiki

//byakuyakuchiki
//byakuyakuchiki@gmail.com
//pw = byakuyakuchiki

//ichigoat
//ichigoat@gmail.com
//pw = ichigoat

//ainzwallenstein
//ainzwallenstein@gmail.com
//pw = ainzwallenstein

//liliruka
//liliruka@gmail.com
//pw = liliruka

//freyaaa
//freyaaa@gmail.com
//pw = freyaaa

// misatokatsuragi
//misatokatsuragi@gmail.com
//pw = misatokatsuragi

//asukalangley
//asukalangley@gmail.com
//pw = asukalangley

//kajisan
//kajisan@gmail.com
//pw = kajisangmail

//odanobunaga
//odanobunaga@gmail.com
//pw = odanobunaga

//tohsakarin
//tohsakarin@gmail.com
//pw = tohsakarin

//artoriapendragon
//artoriapendragon@gmail.com
//pw = artoriapendragon

//jeannedarc
//jeannedarc@gmail.com
//pw = jeannedarc

//finn
//finn@gmail.com
//pw = finngmail

//jake
//jake@gmail.com
//pw = jakegmail

//julian
//julian@gmail.com
//pw = juliangmail

//fanny
//fanny@gmail.com
//pw = fannygmail

//Mathilda
//mathilda@gmail.com
//pw = Mathilda

//carmilla
//carmilla@gmail.com
//pw = carmilla

//cecillion
//cecillion@gmail.com
//pw = cecilliongmail

//Laurent 
//laurent@gmail.com
//pw = laurenttt

//louisvuitton
//louisvuitton@gmail.com
//pw = louisvuitton

//christiandior
//christiandior@gmail.com
//pw = christiandior

//Alexandria
//alexandria@gmail.com
//pw = Alexandria

//steverogers
//steverogers@gmail.com
//pw = steverogers

//jackolantern
//jackolantern@gmail.com
//pw = jackolantern

//simpati
//simpati@gmail.com
//pw = simpatigmail

//hermanshepperd
//hermanshepperd@gmail.com
//pw = hermanshepperd

//aubreydrake
//aubreydrake@gmail.com
//pw = aubreydrake

//kendricklamar
//kendricklamar@gmail.com
//pw = kendricklamar

//TravisScott
//TravisScott@gmail.com
//pw = TravisScott

//LilBaby
//LilBaby@gmail.com
//LilBabygmail

//DaBaby
//dababy@gmail.com
//dababygmail

//youngthug
//youngthug@gmail.com
//youngthug

//yachiru
//yachiru@gmail.com
//pw = yachiruuu

//hanekawatsubasa
//hanekawatsubasa@gmail.com
//pw = hanekawatsubasa

//jugram
//jugram@gmail.com
//pw = jugramgmail

//tonystark
//tonystark@gmail.com
//pw = tonystarkgmail

//yoruichishihoin
//yoruichishihoin@gmail.com
//pw = yoruichishihoin

//nanao
//nanao@gmail.com
//pw = nanaogmail

//kyorakushunsui
//kyorakushunsui@gmail.com
//pw = kyorakushunsui

//hitagisenjougahara
//hitagisenjougahara@gmail.com
//pw = hitagisenjougahara

//shinobuoshino
//shinobu@gmail.com
//pw = shinobuoshino

//gaenizuko
//gaenizuko@gmail.com
//pw = gaenizuko

//enkidu
//enkidu@gmail.com
//pw = enkidugmail

//ishtarrr
//ishtarrr@gmail.com
//pw = ishtarrr

//acheron
//acheron@gmail.com
//pw = acherongmail

//violetevergarden
//violet@gmail.com
//pw = violetevergarden

//hirakoshinji
//shinji@gmail.com
//pw = hirakoshinji

//riruka
//riruka@gmail.com
//pw = rirukagmail

//ayanamirei
//ayanamirei@gmail.com
//pw = ayanamirei

//chikashihoin
//chika@gmail.com
//pw = chikashihoin

//Osaragi
//osaragi@gmail.com
//pw = Osaragigmail

//unohanayachiru
//unohana@gmail.com
//pw = unohanayachiru

//raven
//raven@gmail.com
//pw = ravengmail
