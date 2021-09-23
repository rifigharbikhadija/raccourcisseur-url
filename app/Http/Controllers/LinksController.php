<?php

namespace App\Http\Controllers;

use App\Contracts\UrlShortenerContract;
use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Jenssegers\Agent\Agent;
use Spatie\ValidationRules\Rules\Delimited;

class LinksController extends Controller
{
    protected $urlShortener;

    public function __construct(UrlShortenerContract $urlShortener)
    {
        $this->urlShortener = $urlShortener;
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
        ]);
        $links = Link::all();
        $link = $this->urlShortener->make($request->url, $request->hash);
        $userLinks = Link::where( 'user_id','=', Auth::user()->id )->count();

        if ($links->count() >= 20)
        {
            $links->first()->delete();
            $link->save();
             return redirect('/')->with([
                 'url' => url($link->hash),
             ]);
        }

        if ($userLinks > 5 )
        {
            return redirect('/')->with([
                'error' => "You can create 5 links only",
            ]);
        }

       else {
           $link->save();
            return redirect('/')->with([
                'url' => url($link->hash),
            ]);
       }
    }

    public function show(Link $link)
    {
        $visitors = $link->visitors()->paginate(10);

        return view('show', compact('link', 'visitors'));
    }
    public function links()
    {
        $links = Link::with('user')->withCount('visitors')->paginate(10);

        return view('links', compact('links'));
    }
    public function process($hash)
    {
        $link = $this->urlShortener->byHash($hash);

        if (! $link) {
            return redirect('/')->with(['error' => 'This URL is non existent']);
        }

        $agent = new Agent;
        $ip = '103.239.147.187';
        $link->visitors()->create([
              'ip'      => request()->ip(),
              'user_id' => request()->get('id'),
              'browser' => $agent->browser(),
            //   'country' => \Location::get($ip)
          ]);

        return redirect()->away($link->url);
    }
    public function destroy($id)
    {
        $link = Link::find($id);
        $link ->delete();
        return back()->with([
            'message' => 'Link deleted successfully'
        ]);;
    }
}
