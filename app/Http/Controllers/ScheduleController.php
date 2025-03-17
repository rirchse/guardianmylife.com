<?php
namespace App\Http\Controllers;

use Image;
use App\Models\Schedule;
use App\Models\Customer;
use App\Models\FinalCustomer;
use Illuminate\Http\Request;
use Session;
use File;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::orderBy('type', 'ASC')->paginate(25);
        return view('schedule.index', compact('schedules'));
    }

    public function create()
    {
        return view('schedule.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        if(isset($data['_token']))
        {
            unset($data['_token']);
        }

        if(isset($data['_wysihtml5_mode']))
        {
            unset($data['_wysihtml5_mode']);
        }

        Schedule::insert($data);

        Session::flash('success', 'Schedule successfully added.');
        return redirect()->route('schedule.create');

        // dd($data);
    }

    public function show($id)
    {
        $schedule = Schedule::find($id);
        $banner = $schedule->banner;
        $email_title = 'Hello First Name Last Name';
        $email_body = $schedule->details;
        $logo = '/img/logo.png';
        return view('mail.email_template_view', compact('banner', 'email_title', 'email_body', 'logo'));
    }

    public function edit($id)
    {
        $schedule = Schedule::find($id);
        return view('schedule.edit', compact('schedule'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        // dd($data);
        $schedule = Schedule::find($id);
        $ex_banner = public_path($schedule->banner);
        
        if(isset($data['_token']))
        {
            unset($data['_token']);
        }

        if(isset($data['_method']))
        {
            unset($data['_method']);
        }

        if(isset($data['_wysihtml5_mode']))
        {
            unset($data['_wysihtml5_mode']);
        }

        if(!isset($data['status']))
        {
            $data['status'] = 'Deactive';
        }

        if($request->hasFile('banner'))
        {
            $data['banner'] = FileController::upload($request->banner, 'schedule/');
        }
        else
        {
            unset($data['banner']);
        }

        // dd($data);
        Schedule::where('id', $id)->update($data);

        //delete exists banner file
        if($request->hasFile('banner') && File::exists($ex_banner))
        {
            File::delete($ex_banner);
        }

        Session::flash('success', 'The Schedule successfully updated.');
        return redirect()->route('schedule.edit', $id);
    }

    /** email template test */
    public function email($data = null)
    {
        $data['email_from'] = 'no_reply@fflfalcon.com';
        $data['from_name'] = 'Mesidor Azor';

        $data['email_to'] = 'mrirstt@gmail.com';
        $data['subject'] = 'Test Mail';
        $data['banner'] = 'img/email/happy_birthday.jpg';
        $data['email_title'] = 'Email title';
        $data['email_body'] = 'This is test mail';
        $data['logo'] = 'img/logo.png';

        $mail = new EmailController;
        $mail->sendMail($data);
    }

    public function getDayLeft($db_date)
    {
        $current_date = strtotime(date('Y-m-d'));
        $current_year = date('Y');
        $db_month_day = date('m-d', strtotime($db_date));
        $prev_date = strtotime($current_year.'-'.$db_month_day);
        $day_left = ($prev_date - $current_date)/60/60/24;
        return number_format($day_left, 0);
    }

    //================= call to schedule =================
    public function birthday()
    {
        $schedules = Schedule::where('type', 'Birthday')->where('status', 'Active')->get();

        $users = Customer::whereNotNull('email')
        ->select('id', 'email', 'date_of_birth')
        ->get();

        // return response()->json($users);

        // dd($users);
        
        foreach($schedules as $schedule)
        {
            foreach($users as $user)
            {
                if($user->date_of_birth)
                {
                    // get day left from getDayLeft function
                    $day_left = $this->getDayLeft($user->date_of_birth);

                    // echo 'day_left= #'.$day_left.' @ '.$user->email.'<br>';
        
                    if($day_left == $schedule->day_left)
                    {
                        // echo 'emailable = '.$user->email.'<br>';
                        // email data
                        $data = [
                            'email_to' => $user->email,
                            'subject' => $schedule->title,
                            'banner' => substr($schedule->banner, 1),
                            'email_title' => 'Hello '.$user->first_name.' '.$user->last_name,
                            'email_body' => $schedule->details,
                            'logo' => 'img/logo.png'
                        ];

                        //send email to customer
                        $this->email($data);
                    }
                }
            }
        }
    }

    //schedule for marriage aniversary
    public function marriageDay()
    {
        $schedules = Schedule::where('type', 'Marriageday')->where('status', 'Active')->get();

        $users = Customer::whereNotNull('email')->get();
        
        foreach($schedules as $schedule)
        {
            foreach($users as $user)
            {
                if($user->marriage_date)
                {
                    // get day left from getDayLeft function
                    $day_left = $this->getDayLeft($user->marriage_date);
    
                    // email data
                    $data = [
                        'email_to' => $user->email,
                        'subject' => $schedule->title,
                        'banner' => substr($schedule->banner, 1),
                        'email_title' => 'Hello '.$user->first_name.' '.$user->last_name,
                        'email_body' => $schedule->details,
                        'logo' => 'img/logo.png'
                    ];
        
                    if($day_left == $schedule->day_left)
                    {
                        //send email to customer
                        $this->email($data);
                    }
                }
            }
        }
    }
    
    //schedule for Holidays
    public function holiday()
    {
        $schedules = Schedule::where('type', 'Holiday')->where('status', 'Active')->get();

        $users = Customer::whereNotNull('email')->get();
        
        foreach($schedules as $schedule)
        {
            if($schedule->action_at)
            {
                // get day left from getDayLeft function
                $day_left = $this->getDayLeft($schedule->action_at);
        
                if($day_left == $schedule->day_left)
                {
                    foreach($users as $user)
                    {
                        // email data
                        $data = [
                            'email_to' => $user->email,
                            'subject' => $schedule->title,
                            'banner' => substr($schedule->banner, 1),
                            'email_title' => 'Hello '.$user->first_name.' '.$user->last_name,
                            'email_body' => $schedule->details,
                            'logo' => 'img/logo.png'
                        ];
                        
                        //send email to customer
                        $this->email($data);
                    }
                }
            }
        }
    }
    
    //schedule for Holidays
    public function reminder()
    {
        $schedules = Schedule::where('type', 'Reminder')->where('status', 'Active')->get();

        $users = Customer::whereNotNull('email')->get();
        
        foreach($schedules as $schedule)
        {
            if($schedule->action_at)
            {
                // get day left from getDayLeft function
                $day_left = $this->getDayLeft($schedule->action_at);
        
                if($day_left == $schedule->day_left)
                {
                    foreach($users as $user)
                    {
                        // email data
                        $data = [
                            'email_to' => $user->email,
                            'subject' => $schedule->title,
                            'banner' => substr($schedule->banner, 1),
                            'email_title' => 'Hello '.$user->first_name.' '.$user->last_name,
                            'email_body' => $schedule->details,
                            'logo' => 'img/logo.png'
                        ];

                        //send email to customer
                        $this->email($data);

                        echo $user->email.' - match!<br>';
                    }
                }
            }
        }
    }
    
    //schedule for Holidays
    public function newsletter()
    {
        $schedules = Schedule::where('type', 'Newsletter')->where('status', 'Active')->get();

        $users = Customer::whereNotNull('email')->get();
        
        foreach($schedules as $schedule)
        {
            if($schedule->action_at)
            {
                // get day left from getDayLeft function
                $day_left = $this->getDayLeft($schedule->action_at);
        
                if($day_left == $schedule->day_left)
                {
                    foreach($users as $user)
                    {
                        // email data
                        $data = [
                            'email_to' => $user->email,
                            'subject' => $schedule->title,
                            'banner' => substr($schedule->banner, 1),
                            'email_title' => 'Hello '.$user->first_name.' '.$user->last_name,
                            'email_body' => $schedule->details,
                            'logo' => 'img/logo.png'
                        ];
                        
                        //send email to customer
                        $this->email($data);
                    }
                }
            }
        }
    }

}