<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Blog;
use Session;

class HomepageController extends Controller
{
  public function index()
  {
    return view('home.index');
  }

/** ------------------------------- Agent ------------------------- */
  public function agentApply()
  {
    return view('home.agent_apply');
  }

  public function agentApplyStore(Request $request)
  {
    $data = $request->all();
    dd($data);
  }

  public function agentIndex()
  {
    return view('home.agents.index');
  }

  public function agentShow($username)
  {
    $agent = User::where('username', $username)->first();
    if($agent)
    {
      Session::put('_agent', $agent);
    }
    return view('home.agents.single', compact('agent', 'username'));
  }

  /** ----------------------------- end agents methods ------------ */

  public function clientApply()
  {
    return view('home.client_apply');
  }

  public function clientApplyStore(Request $request)
  {
    $data = $request->all();
    dd($data);
  }

  public function contact()
  {
    return view('home.contact');
  }

  public function team()
  {
    return view('home.team');
  }

  public function blog()
  {
    $blogs = Blog::orderBy('id', 'DESC')->where('status', 'Published')->paginate('25');
    return view('home.blog', compact('blogs'));
  }

  public function blogShow($id)
  {
    $blog = Blog::find($id);
    return view('home.blog-show', compact('blog'));
  }

}