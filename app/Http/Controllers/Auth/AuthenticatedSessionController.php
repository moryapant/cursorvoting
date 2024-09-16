class AuthenticatedSessionController extends Controller
{
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended($this->redirectPath());
    }

    protected function redirectPath()
    {
        return route('home');
    }
}
