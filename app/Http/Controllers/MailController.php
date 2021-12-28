<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Mail;
    use App\Mail\EmailMail;
    use App\Models\User;
    use App\Models\UploadMail;
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Facades\File;

    class MailController extends Controller
    {

        public function send(Request $request)
        {
            $this->validate($request, [
                'content' => 'required|max:100',
            ]);

            if ($request->allUser == 'on') {
                $users = User::all();


            }

            if ($request->User == 'on') {
                $usersId = $request->session()->pull('user');
                $users = User::whereIn('id', $usersId)
                    ->get();

            }


            foreach ($users as $user) {
                $comment = 'Helow' . $user['íd'] . $user['name'];

                $toMail = $user['email'];

                Mail::to($toMail)->send(new EmailMail($comment));

            }
        }



        public function index()
        {
            $model = new UploadMail();

            $views = $model->getViews();
            return view('admin.mail.index',['views' => $views]);
        }


        public function mailUsers()
        {
            $users = User::all();

            return view('admin.mail.user', compact('users'));
        }

        public function saveUser(Request $request)
        {

            foreach ($request->User as $user) {
                $usersId[] = $user;
            }


            //  $users = User::whereIn('id', $usersId)
            //      ->get();
//

            $request->session()->put('user', $usersId);
            return redirect(route('mail.index'));
        }

        public function addMail(Request $request)
        {

            return view('admin.mail.htmlMail');
        }

        public function upload(Request $request)
        {
            $this->validate($request, [
                'content' => 'required|max:100',
            ]);
            $data = htmlspecialchars($request->content);

            $model = new UploadMail();

            $model->saves($data);


            ///File::put('../resources/views/mail.blade.php', 'sdsdagdfdsafsadfsadf');


            return view('admin.mail.htmlMail');
        }

        public function sendMail(Request $request)
        {
            $this->validate($request, [
                'mail_view' => 'required',
            ]);



            if ($request->allUser == 'on') {
                $users = User::all();


            }

            if ($request->User == 'on') {
                $usersId = $request->session()->pull('user');
                $users = User::whereIn('id', $usersId)
                    ->get();

            }


            foreach ($users as $user) {
                $comment = 'Helow' . $user['íd'] . $user['name'];

                $toMail = $user['email'];

                $model = new UploadMail();
                $view = $model->getMail($request->mail_view);

                File::put('../resources/views/mail.blade.php', html_entity_decode($view->patch));

                Mail::to($toMail)->send(new EmailMail($comment));

            }
        }

        public function destroy(Request $request)
        {

            $model = new UploadMail();
            $model->destroys($request->id);
            return redirect(route('mail.index'));
        }
    }
