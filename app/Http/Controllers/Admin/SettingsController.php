<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Settings\EmailRequest;
use App\Http\Requests\Admin\Settings\FaqRequest;
use App\Http\Requests\Admin\Settings\SmsRequest;
use App\Http\Requests\Admin\Settings\SmsPackageRequest;
use App\Contracts\Admin\SettingsInterface as SettingsInterface;
use App\Traits\Admin\EmailTrait;
use Validator;
use Redirect;
use Auth;

class SettingsController extends BaseController {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests,
        EmailTrait;

    private $settings;

    public function __construct(SettingsInterface $settings) {
        $this->middleware('authadmin:admin');
        $this->settings = $settings;
    }

    public function showEmailTemplates() {
        if (Auth::guard('admin')->check()) {

            $tablename = "email_template";
            $field = "id";
            $order = "desc";
            $active = "";
            $status = "";

            $emailtemps = $this->settings->getAllRows($tablename, $field, $order, $active, $status);

            return view('admin.pages.settings.emailtemplates', compact('emailtemps'));
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function showSmsTemplates() {
        if (Auth::guard('admin')->check()) {

            $tablename = "sms_template";
            $field = "id";
            $order = "desc";
            $active = "";
            $status = "";

            $smstemps = $this->settings->getAllRows($tablename, $field, $order, $active, $status);

            return view('admin.pages.settings.smstemplates', compact('smstemps'));
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function showFaqs() {
        if (Auth::guard('admin')->check()) {

            $tablename = "faqs";
            $field = "sort";
            $order = "asc";
            $active = "";
            $status = 1;

            $faqs = $this->settings->getAllRows($tablename, $field, $order, $active, $status);

            return view('admin.pages.settings.faqs', compact('faqs'));
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function showEmailTemplateForm($id = '') {
        if (Auth::guard('admin')->check()) {
            if ($id == 'new') {
                $title = 'Add Email Template';
                $emailtemplate = "";
                $users = "";
                $shopusers = "";
            } else {
                $title = 'Edit Email Template';

                $tablename = "email_template";
                $tblname = "email_shop";
                $field = "id";
                $fld = "email_id";
                $value = $id;
                $active = "";
                $act = 1;
                $status = "";

                $usersargs = [
                    "type" => 1,
                    "active" => 1,
                    "status" => 1
                ];

                $template_id = $id;
                $template_type = 1;

                $emailtemplate = $this->settings->getRow($tablename, $field, $value, $active, $status);
                $users = $this->settings->getUsers($usersargs);
                $shopusers = $this->settings->getRows($tblname, $fld, $value, $act, $status);
                $tempkeywords = $this->settings->getTemplateKeywords($template_id, $template_type);
            }

            $etid = $id;

            return view('admin.pages.settings.emailtemplate', compact('title', 'emailtemplate', 'etid', 'users', 'shopusers', 'tempkeywords'));
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function showSmsTemplateForm($id = '') {
        if (Auth::guard('admin')->check()) {
            if ($id == 'new') {
                $title = 'Add Sms Template';
                $smstemplate = "";
                $users = "";
                $shopusers = "";
            } else {
                $title = 'Edit Sms Template';

                $tablename = "sms_template";
                $tblname = "sms_shop";
                $field = "id";
                $fld = "sms_id";
                $value = $id;
                $active = "";
                $act = 1;
                $status = 1;

                $usersargs = [
                    "type" => 1,
                    "active" => 1,
                    "status" => 1
                ];

                $template_id = $id;
                $template_type = 2;

                $smstemplate = $this->settings->getRow($tablename, $field, $value, $active, $status);
                $users = $this->settings->getUsers($usersargs);
                $shopusers = $this->settings->getRows($tblname, $fld, $value, $act, $status);
                $tempkeywords = $this->settings->getTemplateKeywords($template_id, $template_type);
            }

            $stid = $id;

            return view('admin.pages.settings.smstemplate', compact('title', 'smstemplate', 'stid', 'users', 'shopusers', 'tempkeywords'));
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function showFaqForm($id = '') {
        if (Auth::guard('admin')->check()) {
            if ($id == 'new') {
                $title = 'Add Faq';
                $faq = "";
            } else {
                $title = 'Edit Faq';

                $tablename = "faqs";
                $field = "id";
                $value = $id;
                $active = "";
                $status = "";

                $faq = $this->settings->getRow($tablename, $field, $value, $active, $status);
            }

            $fid = $id;

            return view('admin.pages.settings.faq', compact('title', 'faq', 'fid'));
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function saveEmailTemplate(EmailRequest $request) {
        if (Auth::guard('admin')->check()) {

            $date = date('Y-m-d H:i:s');

            $data = $request->all();
            $id = $request->input('id');

            $tablename = "email_template";
            $field = "id";
            $value = $id;

            $datasave = [
                'identifier' => $data['identifier'],
                'title' => $data['title'],
                'description' => $data['description'],
                'type' => $data['type'],
                'active' => $data['status'],
                'updated_at' => $date
            ];

            $result = $this->settings->saveRow($tablename, $field, $value, $datasave);

            if ($id != 'new') {
                $updtype = 'updated';
            } else {
                $updtype = 'added';
            }

            if ($result == 0) {
                return redirect('/admin/settings/emails')->with('error', 'Email Template not found');
            } else if ($result == 1) {
                return redirect('/admin/settings/emails')->with('success', 'Email Template ' . $updtype . ' successfully');
            } else {
                return redirect('/admin/settings/emails/' . $id)->with('error', 'Email Template failed to update');
            }
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function saveSmsTemplate(SmsRequest $request) {
        if (Auth::guard('admin')->check()) {

            $date = date('Y-m-d H:i:s');

            $data = $request->all();
            $id = $request->input('id');

            $tablename = "sms_template";
            $field = "id";
            $value = $id;

            $datasave = [
                'identifier' => $data['identifier'],
                'title' => $data['title'],
                'description' => $data['description'],
                'type' => $data['type'],
                'active' => $data['status'],
                'updated_at' => $date
            ];

            $result = $this->settings->saveRow($tablename, $field, $value, $datasave);

            if ($id != 'new') {
                $updtype = 'updated';
            } else {
                $updtype = 'added';
            }

            if ($result == 0) {
                return redirect('/admin/settings/smstemplates')->with('error', 'Sms Template not found');
            } else if ($result == 1) {
                return redirect('/admin/settings/smstemplates')->with('success', 'Sms Template ' . $updtype . ' successfully');
            } else {
                return redirect('/admin/settings/smstemplates/' . $id)->with('error', 'Sms Template failed to update');
            }
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function saveFaq(FaqRequest $request) {
        if (Auth::guard('admin')->check()) {

            $date = date('Y-m-d H:i:s');

            $data = $request->all();
            $id = $request->input('id');

            $tablename = "faqs";
            $field = "id";
            $value = $id;

            $datasave = [
                'question' => $data['question'],
                'answer' => $data['answer'],
                'active' => $data['status'],
                'updated_at' => $date
            ];

            $result = $this->settings->saveRow($tablename, $field, $value, $datasave);

            if ($id != 'new') {
                $updtype = 'updated';
            } else {
                $updtype = 'added';
            }

            if ($result == 0) {
                return redirect('/admin/settings/faqs')->with('error', 'Faq not found');
            } else if ($result == 1) {
                return redirect('/admin/settings/faqs')->with('success', 'Faq ' . $updtype . ' successfully');
            } else {
                return redirect('/admin/settings/faqs/' . $id)->with('error', 'Faq failed to update');
            }
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function changeEmailStatus(Request $request) {
        if (Auth::guard('admin')->check()) {
            $eid = $request->input('eid');
            $tablename = $request->input('tablename');
            $status = $request->input('status');
            $count = $this->settings->getRowCount($tablename, "id", $eid, "", "");
            if ($count > 0) {

                $emailstatus = $this->settings->checkStatus($tablename, "active", $status, $eid);

                if ($emailstatus == 0) {
                    $res = $this->settings->changeStatus($tablename, $eid, $status);
                    if ($res) {
                        return response()->json(['msg' => 'Email Template Status Changed Successfully', 'type' => 'success']);
                    } else {
                        return response()->json(['msg' => 'Something went wrong', 'type' => 'error']);
                    }
                } else {
                    return response()->json(['msg' => 'Status already exists', 'type' => 'warning']);
                }
            } else {
                return response()->json(['msg' => 'Email Template Not Found', 'type' => 'warning']);
            }
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function changeSmsStatus(Request $request) {
        if (Auth::guard('admin')->check()) {
            $smsid = $request->input('smsid');
            $tablename = $request->input('tablename');
            $status = $request->input('status');
            $count = $this->settings->getRowCount($tablename, "id", $smsid, "", "");
            if ($count > 0) {

                $smsstatus = $this->settings->checkStatus($tablename, "active", $status, $smsid);

                if ($smsstatus == 0) {
                    $res = $this->settings->changeStatus($tablename, $smsid, $status);
                    if ($res) {
                        return response()->json(['msg' => 'Sms Template Status Changed Successfully', 'type' => 'success']);
                    } else {
                        return response()->json(['msg' => 'Something went wrong', 'type' => 'error']);
                    }
                } else {
                    return response()->json(['msg' => 'Status already exists', 'type' => 'warning']);
                }
            } else {
                return response()->json(['msg' => 'Sms Template Not Found', 'type' => 'warning']);
            }
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function changeFaqStatus(Request $request) {
        if (Auth::guard('admin')->check()) {
            $faqid = $request->input('fid');
            $tablename = $request->input('tablename');
            $status = $request->input('status');
            $count = $this->settings->getRowCount($tablename, "id", $faqid, "", "");
            if ($count > 0) {

                $faqstatus = $this->settings->checkStatus($tablename, "active", $status, $faqid);

                if ($faqstatus == 0) {
                    $res = $this->settings->changeStatus($tablename, $faqid, $status);
                    if ($res) {
                        return response()->json(['msg' => 'Faq Status Changed Successfully', 'type' => 'success']);
                    } else {
                        return response()->json(['msg' => 'Something went wrong', 'type' => 'error']);
                    }
                } else {
                    return response()->json(['msg' => 'Status already exists', 'type' => 'warning']);
                }
            } else {
                return response()->json(['msg' => 'Faq Not Found', 'type' => 'warning']);
            }
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function deleteEmailTemplate($id = 0) {

        if (Auth::guard('admin')->check()) {

            $tablename = "email_template";
            $field = "id";
            $value = $id;
            $active = "";
            $status = "";
            $type = 2;
            $sort = 1;

            $count = $this->settings->getRowCount($tablename, $field, $value, $active, $status);

            if ($count > 0) {
                $result = $this->settings->deleteRow($tablename, $field, $id, $type, $sort);
                if ($result) {
                    return redirect('/admin/settings/emails')->with('success', 'Email Template deleted successfully');
                } else {
                    return redirect('/admin/settings/emails')->with('error', 'Email Template failed to delete');
                }
            } else {
                return redirect('/admin/settings/emails')->with('error', 'Email Template not found');
            }
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function deleteSmsTemplate($id = 0) {

        if (Auth::guard('admin')->check()) {

            $tablename = "sms_template";
            $field = "id";
            $value = $id;
            $active = "";
            $status = "";
            $type = 2;
            $sort = 1;

            $count = $this->settings->getRowCount($tablename, $field, $value, $active, $status);

            if ($count > 0) {
                $result = $this->settings->deleteRow($tablename, $field, $id, $type, $sort);
                if ($result) {
                    return redirect('/admin/settings/smstemplates')->with('success', 'Sms Template deleted successfully');
                } else {
                    return redirect('/admin/settings/smstemplates')->with('error', 'Sms Template failed to delete');
                }
            } else {
                return redirect('/admin/settings/smstemplates')->with('error', 'Sms Template not found');
            }
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function deleteFaq($id = 0) {

        if (Auth::guard('admin')->check()) {

            $tablename = "faqs";
            $field = "id";
            $value = $id;
            $active = "";
            $status = "";
            $type = 1;
            $sort = 0;

            $count = $this->settings->getRowCount($tablename, $field, $value, $active, $status);

            if ($count > 0) {
                $result = $this->settings->deleteRow($tablename, $field, $value, $type, $sort);
                if ($result) {
                    return redirect('/admin/settings/faqs')->with('success', 'Faq deleted successfully');
                } else {
                    return redirect('/admin/settings/faqs')->with('error', 'Faq failed to delete');
                }
            } else {
                return redirect('/admin/settings/faqs')->with('error', 'Faq not found');
            }
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function deleteEmailTemplates(Request $request) {

        if (Auth::guard('admin')->check()) {

            $emids = $request->input('emids');
            $tablename = $request->input('tablename');
            $field = "id";
            $values = $emids;
            $type = 2;
            $sort = 1;

            $emtscnt = sizeof($emids);

            if ($emtscnt == 1) {
                $msg = $emtscnt . " Email Template Deleted Successfully";
            } else if ($emtscnt > 1) {
                $msg = $emtscnt . " Email Templates Deleted Successfully";
            }

            $res = $this->settings->deleteRows($tablename, $field, $values, $type, $sort);
            if ($res == 1) {
                return response()->json(['msg' => $msg, 'type' => 'success']);
            } else {
                return response()->json(['msg' => 'Something went wrong', 'type' => 'error']);
            }
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function deleteSmsTemplates(Request $request) {

        if (Auth::guard('admin')->check()) {

            $smsids = $request->input('smsids');
            $tablename = $request->input('tablename');
            $field = "id";
            $values = $smsids;
            $type = 2;
            $sort = 1;

            $smstscnt = sizeof($smsids);

            if ($smstscnt == 1) {
                $msg = $smstscnt . " Sms Template Deleted Successfully";
            } else if ($smstscnt > 1) {
                $msg = $smstscnt . " Sms Templates Deleted Successfully";
            }

            $res = $this->settings->deleteRows($tablename, $field, $values, $type, $sort);
            if ($res == 1) {
                return response()->json(['msg' => $msg, 'type' => 'success']);
            } else {
                return response()->json(['msg' => 'Something went wrong', 'type' => 'error']);
            }
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function deleteFaqs(Request $request) {

        if (Auth::guard('admin')->check()) {

            $faqids = $request->input('faqids');
            $tablename = $request->input('tablename');
            $field = "id";
            $values = $faqids;
            $type = 1;
            $sort = 0;

            $faqcnt = sizeof($faqids);
            $msg = $faqcnt . " Faq Deleted Successfully";

            $res = $this->settings->deleteRows($tablename, $field, $values, $type, $sort);
            if ($res == 1) {
                return response()->json(['msg' => $msg, 'type' => 'success']);
            } else {
                return response()->json(['msg' => 'Something went wrong', 'type' => 'error']);
            }
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function uploadEditorImage() {

        if (Auth::guard('admin')->check()) {

            $result = $this->settings->uploadEditorImage();
            return $result;
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function updateFaqOrder(Request $request) {

        if (Auth::guard('admin')->check()) {

            $tablename = "faqs";
            $field = "sort";
            $order = "desc";
            $fld = "id";
            $active = "";
            $status = "";

            $tasks = $this->settings->getAllRows($tablename, $field, $order, $active, $status);

            foreach ($tasks as $task) {
                $id = $task->id;

                foreach ($request->order as $order) {
                    if ($order['id'] == $id) {
                        $value = $id;
                        $datasave = ['sort' => $order['position']];
                        $result = $this->settings->saveRow($tablename, $fld, $value, $datasave);
                    }
                }
            }

            return 1;
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function assignSmsUsers(Request $request) {

        if (Auth::guard('admin')->check()) {

            $tablename = "sms_shop";
            $data = $request->all();
            $smsid = $request->input('smsid');
            $formtype = $request->input('formtype');

            switch ($formtype) {

                case 0:
                    $result = $this->settings->unAssignSmsUsers($tablename, $smsid);
                    if ($result) {
                        return redirect('/admin/settings/sms/' . $smsid)->with('success', 'Users unassigned successfully');
                    } else {
                        return redirect('/admin/settings/sms/' . $smsid)->with('error', 'Failed to unassign users');
                    }
                    break;

                case 1:
                    $result = $this->settings->assignSmsUsers($tablename, $data);
                    if ($result == 1) {
                        return redirect('/admin/settings/sms/' . $smsid)->with('success', 'Users assigned successfully');
                    } else if ($result == 0) {
                        return redirect('/admin/settings/sms/' . $smsid)->with('error', 'Check at least one user');
                    } else {
                        return redirect('/admin/settings/sms/' . $smsid)->with('error', 'Failed to assign users');
                    }
                    break;

                default :
                    return redirect('/admin/settings/sms/' . $smsid)->with('error', 'Something went wrong');
            }
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function assignEmailUsers(Request $request) {

        if (Auth::guard('admin')->check()) {

            $tablename = "email_shop";
            $data = $request->all();
            $emailid = $request->input('emailid');
            $formtype = $request->input('formtype');

            switch ($formtype) {

                case 0:
                    $result = $this->settings->unAssignEmailUsers($tablename, $emailid);
                    if ($result) {
                        return redirect('/admin/settings/email/' . $emailid)->with('success', 'Users unassigned successfully');
                    } else {
                        return redirect('/admin/settings/email/' . $emailid)->with('error', 'Failed to unassign users');
                    }
                    break;

                case 1:
                    $result = $this->settings->assignEmailUsers($tablename, $data);
                    if ($result == 1) {
                        return redirect('/admin/settings/email/' . $emailid)->with('success', 'Users assigned successfully');
                    } else if ($result == 0) {
                        return redirect('/admin/settings/email/' . $emailid)->with('error', 'Check at least one user');
                    } else {
                        return redirect('/admin/settings/email/' . $emailid)->with('error', 'Failed to assign users');
                    }
                    break;

                default :
                    return redirect('/admin/settings/email/' . $emailid)->with('error', 'Something went wrong');
            }
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function showSmsCredits() {
        if (Auth::guard('admin')->check()) {

            $tablename = "sms_package_details";
            $field = "id";
            $order = "desc";
            $active = "";
            $status = 1;

            $smspackages = $this->settings->getAllRows($tablename, $field, $order, $active, $status);
            $smscredits = $this->settings->getSmsUsers();

            return view('admin.pages.settings.smscredits', compact('smscredits', 'smspackages'));
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function saveSmsPackageDetails(SmsPackageRequest $request) {
        if (Auth::guard('admin')->check()) {

            $date = date('Y-m-d H:i:s');

            $data = $request->all();
            $id = $request->input('spdid');

            $tablename = "sms_package_details";
            $field = "id";
            $value = $id;

            $datasave = [
                'package_name' => $data['packagename'],
                'noofmessages' => $data['noofmessages'],
                'amount' => $data['amount'],
                'active' => $data['spdstatus'],
                'updated_at' => $date
            ];

            $result = $this->settings->saveRow($tablename, $field, $value, $datasave);

            if ($id != 'new') {
                $updtype = 'updated';
            } else {
                $updtype = 'added';
            }

            if ($result == 0) {
                return redirect('/admin/settings/smscredits')->with('error', 'Sms Package Details not found');
            } else if ($result == 1) {
                return redirect('/admin/settings/smscredits')->with('success', 'Sms Package Details ' . $updtype . ' successfully');
            } else {
                return redirect('/admin/settings/smscredits')->with('error', 'Sms Package Details failed to update');
            }
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function getSmsPackageDetails(Request $request) {
        if (Auth::guard('admin')->check()) {
            $id = $request->input('sid');
            $tablename = "sms_package_details";
            $field = "id";
            $value = $id;
            $active = "";
            $status = 1;

            $package = $this->settings->getRow($tablename, $field, $value, $active, $status);
            return response()->json(['package' => $package, 'type' => 'success']);
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function changeSmsPackageStatus(Request $request) {
        if (Auth::guard('admin')->check()) {
            $pid = $request->input('pid');
            $tablename = $request->input('tablename');
            $status = $request->input('status');
            $count = $this->settings->getRowCount($tablename, "id", $pid, "", "");
            if ($count > 0) {

                $packagestatus = $this->settings->checkStatus($tablename, "active", $status, $pid);

                if ($packagestatus == 0) {
                    $res = $this->settings->changeStatus($tablename, $pid, $status);
                    if ($res) {
                        return response()->json(['msg' => 'Sms Package Status Changed Successfully', 'type' => 'success']);
                    } else {
                        return response()->json(['msg' => 'Something went wrong', 'type' => 'error']);
                    }
                } else {
                    return response()->json(['msg' => 'Status already exists', 'type' => 'warning']);
                }
            } else {
                return response()->json(['msg' => 'Sms Package Not Found', 'type' => 'warning']);
            }
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function deleteSmsPackageDetail($id = 0) {

        if (Auth::guard('admin')->check()) {

            $tablename = "sms_package_details";
            $field = "id";
            $value = $id;
            $active = "";
            $status = "";
            $type = 1;
            $sort = 1;

            $count = $this->settings->getRowCount($tablename, $field, $value, $active, $status);

            if ($count > 0) {
                $result = $this->settings->deleteRow($tablename, $field, $value, $type, $sort);
                if ($result) {
                    return redirect('/admin/settings/smscredits')->with('success', 'Sms Package deleted successfully');
                } else {
                    return redirect('/admin/settings/smscredits')->with('error', 'Sms Package failed to delete');
                }
            } else {
                return redirect('/admin/settings/smscredits')->with('error', 'Sms Package not found');
            }
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function deleteSmsPackageDetails(Request $request) {

        if (Auth::guard('admin')->check()) {

            $packageids = $request->input('packageids');
            $tablename = $request->input('tablename');
            $field = "id";
            $values = $packageids;
            $type = 1;
            $sort = 1;

            $packagecnt = sizeof($packageids);

            if ($packagecnt == 1) {
                $msg = $packagecnt . " Package Deleted Successfully";
            } else if ($packagecnt > 1) {
                $msg = $packagecnt . " Packages Deleted Successfully";
            }

            $res = $this->settings->deleteRows($tablename, $field, $values, $type, $sort);
            if ($res == 1) {
                return response()->json(['msg' => $msg, 'type' => 'success']);
            } else {
                return response()->json(['msg' => 'Something went wrong', 'type' => 'error']);
            }
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function getSmsRequest(Request $request) {
        if (Auth::guard('admin')->check()) {
            $userid = $request->input('uid');
            $results = $this->settings->getSmsRequest($userid);

            $html = '';
            $html .= '<table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="wd-15p">Sl No</th>
                                <th class="wd-15p">Package Name</th>
                                <th class="wd-25p text-center notexport action-btn">Action</th>
                            </tr>
                        </thead>
                        <tbody>';

            if ($results) {
                $slno = 1;
                foreach ($results as $result) {
                    $rstatus = "";
                    if ($result->request_status == 1) {
                        $rstatus = '<button id="approvebtn-' . $result->rid . '" class="btn btn-sm btn-primary approvebtn">Approve</button>';
                    } else if ($result->request_status == 0) {
                        $rstatus = '<i class="fa fa-check" aria-hidden="true"></i> Approved';
                    }

                    $html .= '<tr>
                            <td>' . $slno . '</td>
                            <td>' . $result->package_name . '</td>
                            <td class="text-center">' . $rstatus . '</td>
                          </tr>';
                    $slno++;
                }
            }
            $html .= '</tbody></table>';

            return response()->json(['result' => $html, 'type' => 'success']);
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function approveSmsRequest(Request $request) {

        if (Auth::guard('admin')->check()) {

            $rid = $request->input('rid');
            $tablename = $request->input('tablename');
            $status = $request->input('status');
            $count = $this->settings->getRowCount($tablename, "id", $rid, "", "");
            if ($count > 0) {

                $packagestatus = $this->settings->checkStatus($tablename, "request_status", $status, $rid);

                if ($packagestatus == 0) {
                    $res = $this->settings->changeRequestStatus($tablename, $rid, $status);
                    if ($res) {
                        return response()->json(['msg' => 'Sms Package Activated Successfully', 'type' => 'success']);
                    } else {
                        return response()->json(['msg' => 'Something went wrong', 'type' => 'error']);
                    }
                } else {
                    return response()->json(['msg' => 'Sms Package already activated', 'type' => 'warning']);
                }
            } else {
                return response()->json(['msg' => 'Sms Package Not Found', 'type' => 'warning']);
            }
        } else {
            return Redirect::to('admin/login');
        }
    }
    function prints(){
        $data['title']              =   'Print Templates';
        $data['prints']             =   $this->settings->printList();
         return view('admin.pages.settings.prints.list', $data);
    }
    function printTemplate($id=0){ 
        $data['title']              =   'Add Template';
        if($id > 0){ $data['title'] =   'Edit Template'; }
        $data['id']                 =   $id;
        $data['print']              =   $this->settings->getPrintTemplate($id);
         return view('admin.pages.settings.prints.print_template', $data);
    }
    function savePrint(Request $request){
        $post                       =   $request->post();
        $id                         =   (int)$post['id'];
        $rules                      =   array(
                                            'title' => 'required|max:200',
                                            'identifier' => 'required|max:50',
                                            'identifier' => 'required|unique:print_templates,identifier,'.$id,
                                            'content' => 'required',
                                        );
        $validator                  =   Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('/admin/settings/print/'.$id)->withErrors($validator)->withInput();
        }else{ 
            $result                 =   $this->settings->savePrintTemplate($post,$id);
            if($id > 0){ $updType   =   'updat'; }else{ $updType = 'add'; }
            if($result){ 
                return redirect('/admin/settings/prints')->with('success', 'Template '.$updType.'ed successfully!');
            }else{ return redirect('/admin/settings/prints')->with('error', 'Template failed to update'); }
        }
    }
    function printStatus(Request $request,$id=0){ 
        $result                     =   $this->settings->changePrintStatus($request->post(),$id);
        return json_encode($result);
    }
    function deletePrint($id=0){ 
        $res                        =   $this->settings->deletePrintTemplate($id); 
        if($res){ 
            return redirect('/admin/settings/prints')->with('success', 'Template deleted successfully!');
        }else{ return redirect('/admin/settings/prints')->with('error', 'Template failed to delete'); }
    }
}
