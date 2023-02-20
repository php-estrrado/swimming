<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Contracts\Admin\ContactInterface as ContactInterface;
use App\Traits\Admin\EmailTrait;
use Redirect;
use Auth;

class ContactController extends BaseController {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests,
        EmailTrait;

    private $contact;

    public function __construct(ContactInterface $contact) {
        $this->middleware('authadmin:admin');
        $this->contact = $contact;
    }

    public function showContacts() {
        if (Auth::guard('admin')->check()) {

            $tablename = "contacts";
            $field = "id";
            $order = "desc";
            $active = "";
            $status = 1;

            $contacts = $this->contact->getAllRows($tablename, $field, $order, $active, $status);

            return view('admin.pages.contact.contacts', compact('contacts'));
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function showContact($id) {
        if (Auth::guard('admin')->check()) {

            $tablename = "contacts";
            $field = "id";
            $value = $id;
            $active = "";
            $status = 1;

            $contact = $this->contact->getRow($tablename, $field, $value, $active, $status);

            return view('admin.pages.contact.contact', compact('contact'));
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function deleteContact($id = 0) {

        if (Auth::guard('admin')->check()) {

            $tablename = "contacts";
            $field = "id";
            $value = $id;
            $active = "";
            $status = "";
            $type = 1;
            $sort = 1;

            $count = $this->contact->getRowCount($tablename, $field, $value, $active, $status);

            if ($count > 0) {
                $result = $this->contact->deleteRow($tablename, $field, $id, $type, $sort);
                if ($result) {
                    return redirect('/admin/contacts')->with('success', 'Contact deleted successfully');
                } else {
                    return redirect('/admin/contacts')->with('error', 'Contact failed to delete');
                }
            } else {
                return redirect('/admin/contacts')->with('error', 'Contact not found');
            }
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function deleteContacts(Request $request) {

        if (Auth::guard('admin')->check()) {

            $tablename = $request->input('tablename');
            $contactids = $request->input('contactids');
            $field = "id";
            $values = $contactids;
            $type = 1;
            $sort = 1;

            $contactscnt = sizeof($contactids);

            if ($contactscnt == 1) {
                $msg = $contactscnt . " Contact Deleted Successfully";
            } else if ($contactscnt > 1) {
                $msg = $contactscnt . " Contacts Deleted Successfully";
            }

            $result = $this->contact->deleteRows($tablename, $field, $values, $type, $sort);
            if ($result) {
                return response()->json(['msg' => $msg, 'type' => 'success']);
            } else {
                return response()->json(['msg' => 'Something went wrong', 'type' => 'error']);
            }
        } else {
            return Redirect::to('admin/login');
        }
    }

}
