<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Contact;

class ContactController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('contact');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name'    => 'required',
            'last_name'    => 'required',
            'phone'    => 'required',
            'email'   => 'required|email',
            'message' => 'required',
            'g-recaptcha-response' => 'required|captcha',
        ]);

        Contact::create([
            'first_name'      => $request->input('first_name'),
            'last_name'      => $request->input('last_name'),
            'phone'      => $request->input('phone'),
            'email'     => $request->input('email'),
            'message'   => $request->input('message'),
        ]);
        return redirect()->route('contact.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
}