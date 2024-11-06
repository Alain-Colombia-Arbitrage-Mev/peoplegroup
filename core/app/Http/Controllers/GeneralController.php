<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Newletter;
use App\News;
use App\Social;
use App\User;
use App\ChargeCommision;
use App\General;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function index()
    {
        $general = General::find(1);
        return view('admin.general-setting.general', compact('general'));
    }

    public function update(Request $request, General $general, $id)
    {
        $this->validate($request,array(
            'web_title' => 'required',
            'currency' => 'required',
            'symbol' => 'required',
            'theme' => 'required',
            'start_date' => 'required',
            'sec_color' => 'required',
        ));

        if ($request->emailver == 'on') {
            $emailv = 0;
        }else{
           $emailv = 1;
        }

        if ($request->smsver == 'on') {
          $smsv = 0;
        }else{
            $smsv = 1;
        }

        if ($request->email_nfy == 'on') {
            $email_nfy = 1;
        }else{
            $email_nfy = 0;
        }

        if ($request->sms_nfy == 'on') {
            $sms_nfy = 1;
        }else{
            $sms_nfy = 0;
        }

        $user = User::all();
        foreach ($user as $key => $data) {
            User::whereId($data->id)
                ->update([
                    'emailv' => $emailv,
                    'smsv' => $smsv,
                ]);
        }
        General::whereId($id)->update([
            'web_title' => $request->web_title,
            'currency' => $request->currency,
            'symbol' => $request->symbol,
            'theme' => $request->theme,
            'sec_color' => $request->sec_color,
            'email_nfy' => $email_nfy,
            'sms_nfy' => $sms_nfy,
            'emailver' => $emailv,
            'smsver' => $smsv,
            'start_date' =>  date('Y-m-d', strtotime($request->start_date))
        ]);

        return redirect()->back()->withMsg('Actualización Éxitosa');
    }

    public function indexTerms(Request $request)
    {
        $terms = General::findOrFail(1);
        return view('admin.terms_policies.index', compact('terms'));
    }

    public function indexCommision(Request $request)
    {
        $charge = ChargeCommision::findOrFail(1);
        return view('admin.commision.index', compact('charge'));
    }

    public function indexFooter(Request $request)
    {
        $general = General::first();
        return view('admin.interface.footer.index', compact('general'));
    }

    public function updateFooter(Request $request)
    {
        $this->validate($request,array(
            'footer' => 'required',
            'footer_text' => 'required',
        ));
        $general = General::first();
        $input = Input::except(array('_method', '_token'));
        General::whereId($general->id)->update($input);
        return redirect()->back()->withMsg('Actualización Éxitosa');
    }

    public function indexContact(Request $request)
    {
        $general = General::first();
        return view('admin.interface.contact.contact', compact('general'));
    }

    public function updateContact(Request $request)
    {
        $this->validate($request,array(
            'address' => 'required',
            'google_map_address' => 'required',
            'email' =>'required'
        ));
        $general = General::first();
        $input = Input::except(array('_method', '_token'));
        General::whereId($general->id)->update($input);
        return redirect()->back()->withMsg('Actualización Éxitosa');
    }

    public function indexSocial(Request $request)
    {
        $social = Social::all();
        return view('admin.interface.social.index', compact('social'));
    }

    public function deleteSocialSocial(Request $request, $id)
    {
        $social = Social::find($id)->delete();
        return redirect()->back()->withMsg('Successfully Deleted');
    }

    public function storeSocial(Request $request)
    {
        $this->validate($request,array(
            'icon' => 'required',
            'link' => 'required',
        ));
        Social::create($request->all());
        return redirect()->back()->withMsg('Successfully Created');

    }

    public function updateSocial(Request $request, $id)
    {
        $this->validate($request,array(
            'icon' => 'required',
            'link' => 'required',
        ));

        $input = Input::except(array('_method', '_token'));
        Social::whereId($id)->update($input);
        return redirect()->back()->withMsg('Actualización Éxitosa');

    }

    public function updateCsafdsfontact(Request $request)
    {
        $this->validate($request,array(
            'address' => 'required',
            'google_map_address' => 'required',
        ));
        $general = General::first();
        $input = Input::except(array('_method', '_token'));
        General::whereId($general->id)->update($input);
        return redirect()->back()->withMsg('Actualización Éxitosa');
    }

    public function indexAbout(Request $request)
    {
        $general = General::first();
        return view('admin.interface.about.index', compact('general'));
    }

    public function updateAbout(Request $request, $id)
    {
        $general = General::find($id);
        $this->validate($request,array(
            'about_video_link' => 'required',
            'image' => 'mimes:jpeg,jpg,png',
            'about_text' => 'required',
        ));
        $general->about_video_link = $request->input('about_video_link');
        $general->about_text = $request->input('about_text');

        if ($request->hasFile('image')) {
            unlink('assets/images/about_image/'.$general->image);
            $image = $request->file('image');
            $filename = time() . '.jpg';

            $location = 'assets/images/about_image/'. $filename;
            Image::make($image)->resize(721,512)->save($location);
            $general->image =  $filename;
        }
        $general->save();

        return redirect()->back()->withMsg('Actualización Éxitosa');
    }

    public function updateTerms( Request $request, $id)
    {
        $this->validate($request,array(
            'policy' => 'required',
            'terms' => 'required',
        ));
        General::whereId($id)->update([
            'policy' => $request->policy,
            'terms' => $request->terms,
        ]);
        return redirect()->back()->withMsg('Actualización Éxitosa');
    }

    public function UpdateCommision( Request $request, $id)
    {
        $this->validate($request,array(
            'transfer_charge' => 'required|numeric|min:0|max:100',
            'withdraw_charge' => 'required|numeric|min:0|max:100',
            'level1_bonus' => 'required|numeric|min:0|max:100',
            'level2_bonus' => 'required|numeric|min:0|max:100',
            'level3_bonus' => 'required|numeric|min:0|max:100',
            'level4_bonus' => 'required|numeric|min:0|max:100',
            'level5_bonus' => 'required|numeric|min:0|max:100',
            'level1_consu' => 'required|numeric|min:0|max:100',
            'level2_consu' => 'required|numeric|min:0|max:100',
            'level3_consu' => 'required|numeric|min:0|max:100',
            'level4_consu' => 'required|numeric|min:0|max:100',
            'level5_consu' => 'required|numeric|min:0|max:100',
        ));


        $bonos = $request->level1_bonus +$request->level2_bonus +$request->level3_bonus + $request->level4_bonus + $request->level5_bonus;
        $consumos = $request->level1_consu +$request->level2_consu +$request->level3_consu + $request->level4_consu + $request->level5_consu;

        if ($bonos != 100) {
            return redirect()->back()->with('alert', 'La sumatoria de los bonos de ingreso debe ser 100 %');
        }

        if ($consumos != 100) {
            return redirect()->back()->with('alert', 'La sumatoria de los bonos de consumo debe ser 100 %');
            
        }

        //dd($request->rest_bonus_for);

        $rest_bonus_for = 1;

        if (isset($request->rest_bonus_for)) {
            $rest_bonus_for = 0;
        }

         ChargeCommision::whereId($id)->update([
            'transfer_charge' => $request->transfer_charge,
            'withdraw_charge' => $request->withdraw_charge,
            'update_text' => $request->update_text,
            'level1_bonus' => $request->level1_bonus,
            'level2_bonus' => $request->level2_bonus,
            'level3_bonus' => $request->level3_bonus,
            'level4_bonus' => $request->level4_bonus,
            'level5_bonus' => $request->level5_bonus,
            'level1_consu' => $request->level1_consu,
            'level2_consu' => $request->level2_consu,
            'level3_consu' => $request->level3_consu,
            'level4_consu' => $request->level4_consu,
            'level5_consu' => $request->level5_consu,
            'rest_bonus_for' => $rest_bonus_for,
            
        ]);
        return redirect()->back()->withMsg('Actualización Éxitosa');
    }

    public function indexTreeImage()
    {
        return view('admin.tree_image.index');
    }

    public function updateTreeImage(Request $request)
    {
        $this->validate($request,array(
            'paid_image' => 'mimes:png,jpg,jpeg' ,
            'free_image' => 'mimes:png,jpg,jpeg' ,
            'nouser_image' => 'mimes:png,jpg,jpeg' ,
        ));

        if ($request->hasFile('paid_image')) {
            unlink('assets/user/paid_user.png');
            $image = $request->file('paid_image');
            $filename = 'paid_user' . '.' . 'png';
            $location = 'assets/user/'. $filename;
            Image::make($image)->save($location);
        };

        if ($request->hasFile('free_image')) {
            unlink('assets/user/user.png');
            $image = $request->file('free_image');
            $filename = 'user' . '.' . 'png';
            $location = 'assets/user/'. $filename;
            Image::make($image)->save($location);
        };

        if ($request->hasFile('nouser_image')) {
            unlink('assets/user/no_user.png');
            $image = $request->file('nouser_image');
            $filename = 'no_user' . '.' . 'png';
            $location = 'assets/user/'. $filename;
            Image::make($image)->save($location);
        };

        return redirect()->back()->withMsg('Actualización Éxitosa');
    }

    public function backgroundImage()
    {
        return view('admin.interface.background_image.index');
    }

    public function backgroundImageUpdate(Request $request)
    {
        $this->validate($request,array(
            'service' => 'mimes:png,jpg,jpeg,svg' ,
            'join' => 'mimes:png,jpg,jpeg,svg' ,
            'counter' => 'mimes:png,jpg,jpeg,svg' ,
            'test' => 'mimes:png,jpg,jpeg,svg' ,
            'payment' => 'mimes:png,jpg,jpeg,svg' ,
            'menu' => 'mimes:png,jpg,jpeg,svg' ,
            'login' => 'mimes:png,jpg,jpeg,svg' ,
            'reg' => 'mimes:png,jpg,jpeg,svg' ,
            'forget' => 'mimes:png,jpg,jpeg,svg' ,
        ));

        if ($request->hasFile('service')) {
            unlink('assets/front_assets/img/service-bg.jpg');
            $image = $request->file('service');
            $filename = 'service-bg' . '.' . 'jpg';
            $location = 'assets/front_assets/img/'. $filename;
            Image::make($image)->save($location);
        }

        if ($request->hasFile('join')) {
            unlink('assets/front_assets/img/call-to-action.png');
            $image = $request->file('join');
            $filename = 'call-to-action' . '.' . 'png';
            $location = 'assets/front_assets/img/'. $filename;
            Image::make($image)->save($location);
        }

        if ($request->hasFile('counter')) {
            unlink('assets/front_assets/img/counter-bg.jpg');
            $image = $request->file('counter');
            $filename = 'counter-bg' . '.' . 'jpg';
            $location = 'assets/front_assets/img/'. $filename;
            Image::make($image)->save($location);
        }

        if ($request->hasFile('test')) {
            unlink('assets/front_assets/img/testimonial-bg.jpg');
            $image = $request->file('test');
            $filename = 'testimonial-bg' . '.' . 'jpg';
            $location = 'assets/front_assets/img/'. $filename;
            Image::make($image)->save($location);
        }

        if ($request->hasFile('payment')) {
            unlink('assets/front_assets/img/payment-bg.jpg');
            $image = $request->file('payment');
            $filename = 'payment-bg' . '.' . 'jpg';
            $location = 'assets/front_assets/img/'. $filename;
            Image::make($image)->save($location);
        }

        if ($request->hasFile('menu')) {
            unlink('assets/front_assets/img/contact-us.jpg');
            $image = $request->file('menu');
            $filename = 'contact-us' . '.' . 'jpg';
            $location = 'assets/front_assets/img/'. $filename;
            Image::make($image)->save($location);
        }

        if ($request->hasFile('login')) {
            unlink('assets/front_assets/img/login_bg.jpg');
            $image = $request->file('login');
            $filename = 'login_bg' . '.' . 'jpg';
            $location = 'assets/front_assets/img/'. $filename;
            Image::make($image)->save($location);
        }

        if ($request->hasFile('reg')) {
            unlink('assets/front_assets/img/registration.jpg');
            $image = $request->file('reg');
            $filename = 'registration' . '.' . 'jpg';
            $location = 'assets/front_assets/img/'. $filename;
            Image::make($image)->save($location);
        }

        if ($request->hasFile('forget')) {
            unlink('assets/front_assets/img/forget_password.jpg');
            $image = $request->file('forget');
            $filename = 'forget_password' . '.' . 'jpg';
            $location = 'assets/front_assets/img/'. $filename;
            Image::make($image)->save($location);
        }

        return redirect()->back()->withMsg('Actualización Éxitosa');
    }

    public function newsLetter()
    {
        return view('admin.news_letter.news_letter');
    }

    public function subscriber()
    {
        $subscriber = Newletter::orderBy('id', 'desc')->paginate(20);
        return view('admin.news_letter.subs_list', compact('subscriber'));
    }

    public function sendMailsubscriber(Request $request)
    {
        $this->validate($request, array(
            'title' => 'required',
            'detail' => 'required',
        ));

        $news = Newletter::all();

        foreach ($news as $data){
            $message = $request->detail;
            send_email($data->email, $request->title, $data->name , $message);
        }
        return redirect()->back()->withMsg('Mail Send Complete');
    }

    public function deleteSubscriber($id)
    {

        Newletter::destroy($id);
        return redirect()->back()->withMsg('Delete Complete');
    }




    public function subblogIndex()
    {
        $blog = News::orderBy('id', 'desc')->paginate(5);
        return view('admin.interface.sub_blog.index', compact('blog'));
    }

    public function subblogCreate()
    {
        return view('admin.interface.sub_blog.create', compact( 'sub_menu'));
    }
//
    public function subblogStore(Request $request)
    {
        $this->validate($request, array(
            'image' => 'required|mimes:jpeg,png,jpg',
            'title' => 'required',
            'description' => 'required',
        ));

        $blog = new News;
        $blog->title = $request->input('title');
        $blog->description = $request->input('description');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . 'jpg';
            $location = 'assets/blog_images/'. $filename;
            Image::make($image)->resize(370,250)->save($location);
            $blog->image =  $filename;
        }

        $blog->save();
        return redirect()->back()->withMsg('Create Successfully');

    }

    public function subblogDelete($id)
    {
        $blog = News::destroy($id);
        return redirect()->back()->withMsg('Successfully Delete');
    }

    public function subblogEdit($id)
    {
        $blog = News::findOrFail($id);
        return view('admin.interface.sub_blog.edit', compact( 'blog'));
    }

    public function subblogUpdate(Request $request, $id)
    {

        $this->validate($request, array(
            'image' => 'mimes:jpeg,png,jpg',
            'title' => 'required',
            'description' => 'required',
        ));
        $blog = News::findOrFail($id);
        $blog->title = $request->input('title');
        $blog->description = $request->input('description');

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $filename = time() . '.' . 'jpg';
            $location = 'assets/blog_images/'. $filename;
            Image::make($image)->resize(370,250)->save($location);
            $blog->image =  $filename;
        }
        $blog->save();
        return redirect('admin/news')->withMsg('Update Successfully');
    }

    public function univelUpdate(Request $request)
    {
        $this->validate($request, array(
            'first_level_name' => 'required',
            'sec_level_name' => 'required',
            'third_level_name' => 'required',
            'first_level_com' => 'required',
            'sec_level_com' => 'required',
            'third_level_com' => 'required',
        ));

        General::whereId(1)->update([
            'first_level_name' => $request->first_level_name,
            'sec_level_name' => $request->sec_level_name,
            'third_level_name' => $request->third_level_name,
            'first_level_com' => $request->first_level_com,
            'sec_level_com' => $request->sec_level_com,
            'third_level_com' => $request->third_level_com,
        ]);

        return redirect()->back()->withMsg('Update Complete');
    }
}
