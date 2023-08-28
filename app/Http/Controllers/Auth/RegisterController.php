<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    use RegistersUsers;

    // protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:8',],
            'image' => ['required'], 
            'adress' => [ 'string'],
        ]);
    }

 
    protected function create(array $request)
    {
        $existingUser = User::where('email', $request['email'])->first();
        if ($existingUser) {
            return back()->withErrors(['email' => 'This email is already taken.']);
        }
    
        // Upload the image and get the path
        if ($request['image']->isValid()) {
            $path="storage/images";
            $file = $request['image']->getClientOriginalName();
            $ext = $request['image']->getClientOriginalExtension();
            $imageName = $file.'.'.$ext;
            $imagepath=$request['image']->storeAs($path, $imageName);
            $request['image']->move(public_path('storage/images'), $imageName);

            // $imageName = $request['image']->getClientOriginalName();
            // $imagePath = $request['image']->storeAs('images', $imageName, 'public');
        }
         else {
            // Provide a default image path if no image is uploaded
            $imagepath = null;
        }
    
        return User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'image' =>$imagepath,
            'adress' => $request['adress'],
        ]);
    }
    

    public function showRegistrationForm()
    {
        return view('register'); // Update the view path if needed
    }

    protected function registered(Request $request, $user)
    {
        return redirect()->route('login')->with('registered', true);
    }
}
?>