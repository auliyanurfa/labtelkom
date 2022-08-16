<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
  
    public function index()
    {
        $contacts = Contact::all();
      return view ('alat.indexcontact',[
        "title" => "Contact",
      ])->with('contacts', $contacts);
    }

    
    public function create()
    {
        return view('alat.createcontact');
    }

   
    public function store(Request $request)
    {
        $input = $request->all();
 
        $request->validate([
            'name' => 'required|max:255',            
            'address' => 'required|max:255',
            'mobile' => 'required|min:10',
        ]);
 
        Contact::create($input);
 
        return redirect('contact')->with('success', 'Data Kontak Telah Ditambahkan!');
    }

    
    public function show($id)
    {
        $contact = Contact::find($id);
        return view('alat.showcontact')->with('contacts', $contact);
    }

    
    public function edit($id)
    {
        $contact = Contact::find($id);
        return view('alat.editcontact')->with('contacts', $contact);
    }

  
    public function update(Request $request, $id)
    {
        $contact = Contact::find($id);
        $input = $request->all();
        $contact->update($input);
        return redirect('contact')->with('flash_message', 'Contact Updated!');  
    }

   
    public function destroy($id)
    {
        Contact::destroy($id);
        return redirect('contact')->with('flash_message', 'Contact deleted!');  
    }
}