<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Facades\Storage;
use View;
use File;

class FileController extends Controller
{
  public static function upload($file, $path)
  {
    $file_name = time().'.'.$file->getClientOriginalExtension();
    $base_path = base_path('public/uploads/'.$path);
    $file->move($base_path, $file_name);
    return '/uploads/'.$path.$file_name;
  }
}