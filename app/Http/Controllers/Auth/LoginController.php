<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home'; // Adjust the redirection URL

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('login'); // Update the view path if needed
    }

    protected function authenticated(Request $request, $user)
    {
        // Customize the redirection logic after successful login
        return redirect($this->redirectTo);
    }

    protected function credentials(Request $request)
    {
        // Modify the credentials array to include additional conditions
        return array_merge(
            $request->only($this->username(), 'password'),
            // ['active' => 1] // Add any conditions you need
        );
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ])->redirectTo('login');
    }

    protected function sendFailedInactiveResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => ['Your account is not active.'],
        ])->redirectTo('login');
    }

    protected function sendFailedInvalidResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => ['Please enter correct email or password.'],
        ])->redirectTo('login');
    }
    protected function loggedOut(Request $request)
    {
        // Customize the redirection after logging out
        return redirect()->route('login');
    }
}
?>