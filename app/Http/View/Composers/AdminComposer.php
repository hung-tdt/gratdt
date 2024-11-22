<?php
 
namespace App\Http\View\Composers;

use App\Models\Admin;
use Illuminate\View\View;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
 
class AdminComposer
{
    
    public function __construct() 
    {

    }
     
    public function compose(View $view): void
    {
        $id = Auth::id();
        $admin = Admin::find($id);
        $view->with('admin', $admin);
    }
}