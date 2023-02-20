<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Contracts\Admin\PageInterface as PageInterface;
use App\Traits\Admin\EmailTrait;
use Validator;
use Redirect;
use Auth;

class PageController extends BaseController {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests,
        EmailTrait;

    private $page;

    public function __construct(PageInterface $page) {
        $this->middleware('authadmin:admin');
        $this->page = $page;
    }

    public function showPageForm($identifier) {
        if (Auth::guard('admin')->check()) {

            $tablename = "pages";
            $field = "identifier";
            $value = $identifier;
            $active = "";
            $status = 1;

            $page = $this->page->getRow($tablename, $field, $value, $active, $status);
            $identifier = $page->identifier;

            if ($identifier == "home") {

                $btablename = "banner";
                $wtablename = "widgets";

                $banners = $this->page->getAllRows($btablename, "sort", "asc", $active, $status);
                $widgets = $this->page->getAllRows($wtablename, "sort", "asc", $active, $status);

                return view('admin.pages.page.' . $identifier, compact('page', 'banners', 'widgets'));
            } else {
                return view('admin.pages.page.' . $identifier, compact('page'));
            }
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function savePage(Request $request) {
        if (Auth::guard('admin')->check()) {

            $date = date('Y-m-d H:i:s');

            $data = $request->all();
            $id = $request->input('id');
            $remstatus = $request->input('remstatus');

            if ($request->hasFile("banner")) {
                $rules = [
                    'title' => 'required|string|max:255',
                    'identifier' => 'required|string|max:55',
                    'banner' => 'required|file|max:4096|mimes:jpeg,png,jpg,gif|dimensions:min_width=512,max_width=3072,min_height=128,max_height=768',
                    'description' => 'required'
                ];
            } else {
                $rules = [
                    'title' => 'required|string|max:255',
                    'identifier' => 'required|string|max:55',
                    'description' => 'required'
                ];
            }

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return Redirect::to('/admin/pages/' . $data['identifier'])->withErrors($validator);
            } else {

                $tablename = "pages";
                $field = "id";
                $value = $id;

                /* File Upload Starts */

                if ($request->hasFile("banner")) {
                    $file = $request->file("banner");
                    $filenameWithExt = $request->file("banner")->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file("banner")->getClientOriginalExtension();
                    $fileNameToStore = $filename . "_" . round(microtime(true)) . "." . $extension;
                    $file->move(storage_path() . "/uploads/admin/pages/", $fileNameToStore);
                }

                /* File Upload Ends */

                if ($remstatus == 0 || $remstatus == 1) {
                    $datasave = [
                        'identifier' => $data['identifier'],
                        'title' => $data['title'],
                        'content' => $data['description'],
                        'active' => $data['status'],
                        'modified_on' => $date
                    ];
                } else if ($remstatus == 2) {
                    $datasave = [
                        'identifier' => $data['identifier'],
                        'title' => $data['title'],
                        'image' => $fileNameToStore,
                        'content' => $data['description'],
                        'active' => $data['status'],
                        'modified_on' => $date
                    ];
                } else if ($remstatus == 3) {
                    $datasave = [
                        'identifier' => $data['identifier'],
                        'title' => $data['title'],
                        'image' => '',
                        'content' => $data['description'],
                        'active' => $data['status'],
                        'modified_on' => $date
                    ];
                }

                $result = $this->page->saveRow($tablename, $field, $value, $datasave);

                if ($result == 0) {
                    return redirect('/admin/pages/' . $data['identifier'])->with('error', 'Page not found');
                } else if ($result == 1) {
                    return redirect('/admin/pages/' . $data['identifier'])->with('success', 'Page updated successfully');
                } else {
                    return redirect('/admin/pages/' . $data['identifier'])->with('error', 'Page failed to update');
                }
            }
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function saveWidget(Request $request) {
        if (Auth::guard('admin')->check()) {

            $date = date('Y-m-d H:i:s');

            $data = $request->all();
            $id = $request->input('widgetid');
            $page = $request->input('wpidentifier');

            $rules = [
                'wname' => 'required|string|max:255',
                'widentifier' => 'required|string|max:55',
                'description' => 'required'
            ];

            $messages = [
                'wname.required' => 'The name field is required.',
                'widentifier.required' => 'The identifier field is required.',
                'description.required' => 'The description field is required.'
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return Redirect::to('/admin/pages/' . $page)->withErrors($validator);
            } else {

                $tablename = "widgets";
                $field = "id";
                $value = $id;

                $datasave = [
                    'identifier' => $data['widentifier'],
                    'title' => $data['wname'],
                    'content' => $data['description'],
                    'active' => $data['wstatus'],
                    'modified_on' => $date
                ];

                $result = $this->page->saveRow($tablename, $field, $value, $datasave);

                if ($result == 0) {
                    return redirect('/admin/pages/' . $page)->with('error', 'Widget not found');
                } else if ($result == 1) {
                    return redirect('/admin/pages/' . $page)->with('success', 'Widget updated successfully');
                } else {
                    return redirect('/admin/pages/' . $page)->with('error', 'Widget failed to update');
                }
            }
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function saveBanner(Request $request) {
        if (Auth::guard('admin')->check()) {

            $date = date('Y-m-d H:i:s');

            $data = $request->all();
            $id = $request->input('bannerid');
            $page = $request->input('bpidentifier');
            $remstatus = $request->input('remstatus');

            if ($id == "new") {

                $rules = [
                    'btitle' => 'required|string|max:255',
                    'bidentifier' => 'required|string|max:55',
                    'banner' => 'required|file|max:4096|mimes:jpeg,png,jpg,gif|dimensions:min_width=1024,max_width=3072,min_height=256,max_height=768'
                ];
            } else {

                if ($request->hasFile("banner") && $remstatus == 2) {
                    $rules = [
                        'btitle' => 'required|string|max:255',
                        'bidentifier' => 'required|string|max:55',
                        'banner' => 'required|file|max:4096|mimes:jpeg,png,jpg,gif|dimensions:min_width=1024,max_width=3072,min_height=256,max_height=768'
                    ];
                } else {
                    $rules = [
                        'btitle' => 'required|string|max:255',
                        'bidentifier' => 'required|string|max:55'
                    ];
                }
            }

            $messages = [
                'btitle.required' => 'The title title is required.',
                'bidentifier.required' => 'The identifier field is required.'
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return Redirect::to('/admin/pages/' . $page)->withErrors($validator);
            } else {

                $tablename = "banner";
                $field = "id";
                $value = $id;

                if ($id != "new") {
                    $updtype = "updated";
                } else {
                    $updtype = "added";
                }

                /* File Upload Starts */

                if ($request->hasFile("banner") && $remstatus == 2) {
                    $file = $request->file("banner");
                    $filenameWithExt = $request->file("banner")->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file("banner")->getClientOriginalExtension();
                    $fileNameToStore = $filename . "_" . round(microtime(true)) . "." . $extension;
                    $file->move(storage_path() . "/uploads/admin/pages/home/banner/", $fileNameToStore);
                }

                /* File Upload Ends */

                if ($remstatus == 0 || $remstatus == 1) {
                    $datasave = [
                        'identifier' => $data['bidentifier'],
                        'title' => $data['btitle'],
                        'description' => $data['caption'],
                        'active' => $data['bstatus'],
                        'modified' => $date
                    ];
                } else if ($remstatus == 2) {
                    $datasave = [
                        'identifier' => $data['bidentifier'],
                        'title' => $data['btitle'],
                        'banner' => $fileNameToStore,
                        'description' => $data['caption'],
                        'active' => $data['bstatus'],
                        'modified' => $date
                    ];
                } else if ($remstatus == 3) {
                    $datasave = [
                        'identifier' => $data['bidentifier'],
                        'title' => $data['btitle'],
                        'banner' => '',
                        'description' => $data['caption'],
                        'active' => $data['bstatus'],
                        'modified' => $date
                    ];
                }

                $result = $this->page->saveRow($tablename, $field, $value, $datasave);

                if ($result == 0) {
                    return redirect('/admin/pages/' . $page)->with('error', 'Banner not found');
                } else if ($result == 1) {
                    return redirect('/admin/pages/' . $page)->with('success', 'Banner ' . $updtype . ' successfully');
                } else {
                    return redirect('/admin/pages/' . $page)->with('error', 'Banner failed to update');
                }
            }
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function getWidget(Request $request) {
        if (Auth::guard('admin')->check()) {
            $id = $request->input('wid');
            $tablename = "widgets";
            $field = "id";
            $value = $id;
            $active = "";
            $status = "";

            $widget = $this->page->getRow($tablename, $field, $value, $active, $status);
            return response()->json(['widget' => $widget, 'type' => 'success']);
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function getBanner(Request $request) {
        if (Auth::guard('admin')->check()) {
            $id = $request->input('bid');
            $tablename = "banner";
            $field = "id";
            $value = $id;
            $active = "";
            $status = "";

            $banner = $this->page->getRow($tablename, $field, $value, $active, $status);
            return response()->json(['banner' => $banner, 'type' => 'success']);
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function updateBannerOrder(Request $request) {

        if (Auth::guard('admin')->check()) {

            $tablename = "banner";
            $field = "sort";
            $order = "desc";
            $fld = "id";
            $active = "";
            $status = "";

            $tasks = $this->page->getAllRows($tablename, $field, $order, $active, $status);

            foreach ($tasks as $task) {
                $id = $task->id;

                foreach ($request->order as $order) {
                    if ($order['id'] == $id) {
                        $value = $id;
                        $datasave = ['sort' => $order['position']];
                        $result = $this->page->saveRow($tablename, $fld, $value, $datasave);
                    }
                }
            }

            return 1;
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function updateWidgetOrder(Request $request) {

        if (Auth::guard('admin')->check()) {

            $tablename = "widgets";
            $field = "sort";
            $order = "desc";
            $fld = "id";
            $active = "";
            $status = "";

            $tasks = $this->page->getAllRows($tablename, $field, $order, $active, $status);

            foreach ($tasks as $task) {
                $id = $task->id;

                foreach ($request->order as $order) {
                    if ($order['id'] == $id) {
                        $value = $id;
                        $datasave = ['sort' => $order['position']];
                        $result = $this->page->saveRow($tablename, $fld, $value, $datasave);
                    }
                }
            }

            return 1;
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function changeBannerStatus(Request $request) {
        if (Auth::guard('admin')->check()) {
            $bannerid = $request->input('bid');
            $tablename = $request->input('tablename');
            $status = $request->input('status');
            $count = $this->page->getRowCount($tablename, "id", $bannerid, "", "");
            if ($count > 0) {

                $bannerstatus = $this->page->checkStatus($tablename, "active", $status, $bannerid);

                if ($bannerstatus == 0) {
                    $res = $this->page->changeStatus($tablename, $bannerid, $status);
                    if ($res) {
                        return response()->json(['msg' => 'Banner Status Changed Successfully', 'type' => 'success']);
                    } else {
                        return response()->json(['msg' => 'Something went wrong', 'type' => 'error']);
                    }
                } else {
                    return response()->json(['msg' => 'Status already exists', 'type' => 'warning']);
                }
            } else {
                return response()->json(['msg' => 'Banner Not Found', 'type' => 'warning']);
            }
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function changeWidgetStatus(Request $request) {
        if (Auth::guard('admin')->check()) {
            $widgetid = $request->input('wid');
            $tablename = $request->input('tablename');
            $status = $request->input('status');
            $count = $this->page->getRowCount($tablename, "id", $widgetid, "", "");
            if ($count > 0) {

                $widgetstatus = $this->page->checkStatus($tablename, "active", $status, $widgetid);

                if ($widgetstatus == 0) {
                    $res = $this->page->changeStatus($tablename, $widgetid, $status);
                    if ($res) {
                        return response()->json(['msg' => 'Widget Status Changed Successfully', 'type' => 'success']);
                    } else {
                        return response()->json(['msg' => 'Something went wrong', 'type' => 'error']);
                    }
                } else {
                    return response()->json(['msg' => 'Status already exists', 'type' => 'warning']);
                }
            } else {
                return response()->json(['msg' => 'Widget Not Found', 'type' => 'warning']);
            }
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function deleteBanner($id = 0) {

        if (Auth::guard('admin')->check()) {

            $tablename = "banner";
            $field = "id";
            $value = $id;
            $active = "";
            $status = "";
            $type = 1;
            $sort = 0;

            $count = $this->page->getRowCount($tablename, $field, $value, $active, $status);

            if ($count > 0) {
                $result = $this->page->deleteRow($tablename, $field, $value, $type, $sort);
                if ($result) {
                    return redirect('/admin/pages/home')->with('success', 'Banner deleted successfully');
                } else {
                    return redirect('/admin/pages/home')->with('error', 'Banner failed to delete');
                }
            } else {
                return redirect('/admin/pages/home')->with('error', 'Banner not found');
            }
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function deleteBanners(Request $request) {

        if (Auth::guard('admin')->check()) {

            $bannerids = $request->input('bannerids');
            $tablename = $request->input('tablename');
            $field = "id";
            $values = $bannerids;
            $type = 1;
            $sort = 0;

            $bannercnt = sizeof($bannerids);

            if ($bannercnt == 1) {
                $msg = $bannercnt . " Banner Deleted Successfully";
            } else if ($bannercnt > 1) {
                $msg = $bannercnt . " Banners Deleted Successfully";
            }

            $res = $this->page->deleteRows($tablename, $field, $values, $type, $sort);
            if ($res == 1) {
                return response()->json(['msg' => $msg, 'type' => 'success']);
            } else {
                return response()->json(['msg' => 'Something went wrong', 'type' => 'error']);
            }
        } else {
            return Redirect::to('admin/login');
        }
    }

}
