<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\Contacts;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contact_list()
    {
        $contacts = Contacts::orderBy('id')->get();
        $count = 1;

        return view(
            'adminfrontend.pages.contacts.contact_list',
            compact(
                'contacts',
                'count',
            )
        );
    }

    public function contact_add()
    {
        return view('adminfrontend.pages.contacts.contact_add');
    }

    public function contact_store(Request $request)
    {
        $input  = $request->all();
        Contacts::create($input);
        return redirect('/admin/contact-add')
            ->with('message', 'Contact ' . $request->contact_info . ' is added successfully !');
    }

    public function contact_edit($id)
    {
        $contact = Contacts::where('id', $id)->first();
        return view(
            'adminfrontend.pages.contacts.contact_edit',
            compact(
                'contact'
            )
        );
    }


    public function contact_update(Request $request, $id)
    {
        $update_contact = Contacts::where('id', $id)->first();
        $update_contact->contact_info = $request->input('contact_info');
        $update_contact->update();

        return redirect('/admin/contact-list')
            ->with(
                'message',
                'Contact ' . '"' . $update_contact->contact_info . '"' .
                    ' is updated successfully !'
            );
    }

    public function contact_delete($id)
    {
        $delete_contact = Contacts::where('id', $id)->first();
        $delete_contact->delete();

        return redirect('admin/contact-list')
            ->with(
                'message',
                'Contact ' . '"' . $delete_contact->contact_info . '"' .
                    ' is deleted successfully !'
            );
    }
}
