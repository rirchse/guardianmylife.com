<?php
namespace App\Http\Controllers;

use App\Http\Controllers\FileController;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;
use Auth;
use File;

class BlogController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $blogs = Blog::orderBy('id', 'DESC')->paginate(50);
    return view('blogs.index', compact('blogs'));
  }

  public function create()
  {
    return view('blogs.create');
  }

  public function store(Request $request)
  {
    $file = new FileController;
    $request->validate([
      'title' => 'required|string',
      'image' => 'nullable|image|mimes:jpg,jpeg,png|max:1000',
      'status' => 'nullable|string',
      'details' => 'required|string'
    ]);

    $data = $request->all();
    // dd($data);
    if(isset($data['_token']))
    {
      unset($data['_token']);
    }

    if(isset($data['_wysihtml5_mode']))
    {
      unset($data['_wysihtml5_mode']);
    }

    if(!isset($data['status']))
    {
      $data['status'] = 'Unpublished';
    }

    if(isset($data['files']))
    {
      unset($data['files']);
    }
    
    $slug_array = explode(' ', $data['title']);
    $slug = implode('-', $slug_array);
    $xslug = Blog::where('slug', $slug)->exists();
    $slug = $xslug ? $slug.'-'.time() : $slug;
    $data['slug'] = $slug;

    $data['created_by'] = Auth::id();

    try{
      if($request->hasFile('image'))
      {
        $data['image'] = $file->upload($data['image'], 'blogs/');
      }
      Blog::insert($data);
    }
    catch(\Exception $e)
    {
      return $e;
    }

    Session::flash('success', 'The blog successfully created.');
    return redirect()->route('blog.create');
  }

  public function show($id)
  {
    //
  }

  public function edit($id)
  {
    $blog = Blog::find($id);
    return view('blogs.edit', compact('blog'));
  }

  public function update(Request $request, $id)
  {
    $file = new FileController;
    $blog = Blog::find($id);
    $ximage = public_path($blog->image);

    $request->validate([
      'title' => 'required|string',
      'image' => 'nullable|image|mimes:jpg,jpeg,png|max:1000',
      'status' => 'nullable|string',
      'details' => 'required|string'
    ]);

    $data = $request->all();

    if(isset($data['_token']))
    {
      unset($data['_token']);
    }

    if(isset($data['_method']))
    {
      unset($data['_method']);
    }

    if(isset($data['_wysihtml5_mode']))
    {
      unset($data['_wysihtml5_mode']);
    }

    if(!isset($data['status']))
    {
      $data['status'] = 'Unpublished';
    }

    if(isset($data['files']))
    {
      unset($data['files']);
    }

    if($data['title'] != $blog->title)
    {
      $slug_array = explode(' ', $data['title']);
      $slug = implode('-', $slug_array);
      $xslug = Blog::where('slug', $slug)->exists();
      $slug = $xslug ? $slug.'-'.time() : $slug;
      $data['slug'] = $slug;
    }
    // dd($slug);

    $data['created_by'] = Auth::id();

    try{
      if($request->hasFile('image'))
      {
        $data['image'] = $file->upload($data['image'], 'blogs/');
      }
      Blog::where('id', $id)->update($data);

      if($request->hasFile('image') && File::exists($ximage))
      {
        File::delete($ximage);
      }
    }
    catch(\Exception $e)
    {
      return $e;
    }

    Session::flash('success', 'The blog successfully updated.');
    return redirect()->route('blog.edit', $id);
  }

  public function destroy($id)
  {
    // find out the blog from database
    $blog = Blog::find($id);

    //if blog exists
    if($blog)
    {
      // blog image check to the local storage
      $ximage = public_path($blog->image);

      // check image file exists to the local storage
      if(File::exists($ximage))
      {
        // delete image file from local storage
        File::delete($ximage);
      }

      //delete blog
      $blog->delete();

      Session::flash('success', 'The blog was successfully deleted.');
      return redirect()->route('blog.index');
    }

    Session::flash('error', 'The blog is not exist');
    return back();
  }
}