<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Http\Controllers\Controller;
use App\Models\Contact; // Contact Model ko import karein
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Sab se naye messages ko sab se ooper dikhane ke liye latest() ka istemal
        $contacts = Contact::latest()->get();
        return view('admin.contact.all_contact', compact('contacts'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        // Route Model Binding se contact khud mil jayega
        $contact->delete();

        // Success message ke sath wapis redirect karein
        return redirect()->route('admin.contact.index')->with('success', 'Contact message has been deleted successfully!');
    }
}
