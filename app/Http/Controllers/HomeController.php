<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Home;
use App\Models\Email;
use Validator;
use Redirect;
use Session;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        //  $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $data['sliders'] = home::bannerSlider();
        $data['homeContents'] = home::getHomeContents();
        return view('index', $data);
    }

    public function about() {
        $page = home::getPage('about');
        if ($page) {
            $data['title'] = $page->title;
            $data['content'] = $page->content;
            $data['banner'] = $page->image;
            $data['active'] = 1;
        } else {
            $data['active'] = 0;
        }
        return view('pages.about', $data);
    }

    public function pricing() {
        $page = home::getPage('pricing');
        if ($page) {
            $data['faqs'] = home::getAllFaqs();
            $data['title'] = $page->title;
            $data['content'] = $page->content;
            $data['banner'] = $page->image;
            $data['active'] = 1;
            $data['mvalidities'] = home::getAllMembershipValidity();
            $data['memberships'] = home::getMembershipPlans();
        } else {
            $data['active'] = 0;
        }
        return view('pages.pricing', $data);
    }
    public function location() {
        $page = home::getPage('location');
        if ($page) {
            $data['title'] = $page->title;
            $data['content'] = $page->content;
            $data['banner'] = $page->image;
            $data['active'] = 1;
            $data['location'] = home::getLocation();
        } else {
            $data['active'] = 0;
        }
        return view('pages.location', $data);
    }
    public function course() {
        $page = home::getPage('course');
        if ($page) {
            $data['title'] = $page->title;
            $data['content'] = $page->content;
            $data['banner'] = $page->image;
            $data['active'] = 1;
            $data['course'] = home::getCourse();
        } else {
            $data['active'] = 0;
        }
        return view('pages.course', $data);
    }


    public function features() {
        $page = home::getPage('features');
        if ($page) {
            $data['title'] = $page->title;
            $data['content'] = $page->content;
            $data['banner'] = $page->image;
            $data['active'] = 1;
        } else {
            $data['active'] = 0;
        }
        return view('pages.features', $data);
    }

    public function support() {

        $page = home::getPage('support');
        if ($page) {
            $data['title'] = $page->title;
            $data['content'] = $page->content;
            $data['banner'] = $page->image;
            $data['faqs'] = home::getAllFaqs();
            $data['active'] = 1;
        } else {
            $data['active'] = 0;
        }
        return view('pages.support', $data);
    }

    public function contact() {
        $page = home::getPage('contact');
        if ($page) {
            $data['title'] = $page->title;
            $data['content'] = $page->content;
            $data['banner'] = $page->image;
            $data['active'] = 1;
        } else {
            $data['active'] = 0;
        }
        return view('pages.contact', $data);
    }

    public function saveContact(Request $request) {

        $rules = [
            'name' => 'required|string|max:55',
            'email' => 'required|email|max:55',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('/contact')->withErrors($validator);
        } else {

            $data = $request->all();
            $email = $request->input('email');

            $result = home::saveContact($data);

            if ($result == 1) {

                $mailcontent = Email::getContactMailTemplate($data);
                Email::sendEmail($email, getAdminEmail(), 'BizzSalon Contact Details', $mailcontent);

                return redirect('/contact')->with('success', 'Contact details sent successfully');
            } else {
                return redirect('/contact')->with('error', 'Contact details failed to send');
            }
        }
    }
    
    public function testResponse(Request $request){
        return Home::saveResponse((object)$request->post());
        return redirect('http://test1.pagedemo.co');
    }

}
