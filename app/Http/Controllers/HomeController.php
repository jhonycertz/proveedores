<?php

namespace App\Http\Controllers;
use Mail;
use App\Question;
use App\Document;
use App\Company;
use App\User;
use App\Mail\QuestionMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DocumentRequest;
use Illuminate\Support\Facades\Storage;
use Log;

// Get the currently authenticated user...
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:client');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.alertas');
    }

    /**
    * @return \Illuminate\Http\Response
    */
    public function documento()
    {
        $client = Auth::guard('client')->user();
        $documents = $client->documents;
        return view('app.documento', compact('documents'));
    }

    /**
    * @return \Illuminate\Http\Response
    */
    public function preguntas()
    {   
        $client = Auth::guard('client')->user();
        $questions = $client->questions()->orderBy('id','desc')->paginate(7); 
        return view('app.preguntas', compact('client','questions'));
    }


    public function preguntasStore(Request $request)
    {
        $client = Auth::guard('client')->user();
        $user = Auth::user();
        $user = Company::where('id',$user->company_id)->first();
        $question = $request->input('question');
        $data = (object) array('name' => $user->name, 'question' => $question);
        $admins = User::where('role_id', 1)->get();
        foreach ($admins as $key => $admin) {
            Mail::to($admin->email)->send(new QuestionMail($data));
        }
        $question = Question::create(['question' => $question,'client_id' => $client->id]);
        return redirect()->route('home-preguntas');
    }

    /**
    * @return \Illuminate\Http\Response
    */
    public function alertas()
    {
        return view('app.alertas');
    }

    /**
    * @return \Illuminate\Http\Response
    */
    public function registrarDocumento()
    {
        $client = Auth::guard('client')->user();
        $company = $client->company;
        $requeriments = $company->companyType->requeriments;
        return view('app.registrar-documento', compact('client','company','requeriments'));
    }

    /**
    * @return \Illuminate\Http\Response
    */
    public function registrarDocumentoStore(DocumentRequest $request)
    {
        $validated = $request->validated();
        $client = Auth::guard('client')->user();
        $company = Document::createWithFile($validated, $client);
        return redirect()->route('home-documento');
    }
}
