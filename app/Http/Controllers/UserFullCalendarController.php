<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use App\Mail\UserContactSendmail;
use App\Mail\AdminContactSendmail;
use App\Models\Facility;
use App\Models\Reserve;
use App\Models\HolidaySetting;

use Carbon\Carbon;

class UserFullCalendarController extends Controller{
    public function index(){}
    
    // カレンダー初期表示
    public function calendar(){
      $period = $this->getReserveStartDate().'～'.$this->getReserveEndDate();
      return view('user.calendar')->with('period', $period);
    }
    
    // 日付フォーマット（例：2021-01-12）
    public function formatDate($date){
      return date_format($date, 'Y-m-d');
    }
    
    // 日付フォーマット（UNIXタイムスタンプ）
    public function formatstrtoDate($date){      
      return date('Y-m-d', strtotime($date));
    }
    
    // 時間フォーマット（UNIXタイムスタンプ）
    public function formatstrtoTime($date){      
      return date('H:i:s', strtotime($date));
    }
    
    // 日付フォーマット（例：2021-01-12 09:00）
    public function formatDataTime($date, $time){
      $date_time = new \DateTime($date." ".$time, new \DateTimeZone('Asia/Tokyo'));
      $date_time = $date_time->format('Y-m-d H:i');
      return $date_time;    
    }
    
    // 予約可能日付（1日後）取得
    public function getReserveStartDate(){
      $reserve_start_date = Carbon::now();
      $reserve_start_date =$reserve_start_date->addDay();
      $reserve_start_date = $this->formatDate($reserve_start_date);
      return $reserve_start_date;
    }
    
    // 予約可能日付（30日後）取得
    public function getReserveEndDate(){
      $reserve_end_date = Carbon::now();
      $reserve_end_date =$reserve_end_date->addDay(30);
      $reserve_end_date = $this->formatDate($reserve_end_date);
      return $reserve_end_date;
    }
    
    // 予約可能日時か判定
    public function isRreserve($date){
      $is_reserve = false;
      // 営業日情報を取得
      $setting = HolidaySetting::first();
      $start_time_am = $setting['facility_start_time_am'];      
      $end_time_am = $setting['facility_end_time_am'];
      $start_time_pm = $setting['facility_start_time_pm'];
      $end_time_pm = $setting['facility_end_time_pm'];
      /*
      $monday_am = $setting['monday_am'];
      $monday_pm = $setting['monday_pm'];
      $tuesday_am = $setting['tuesday_am'];
      $tuesday_am = $setting['monday_am'];
      $wednesday_am = $setting['monday_am'];
      $wednesday_pm = $setting['monday_am'];
      $thursday_am = $setting['monday_am'];
      $thursday_pm = $setting['monday_am'];
      $friday_am = $setting['monday_am'];
      $friday_pm = $setting['monday_am'];
      $saturday_am = $setting['monday_am'];
      $saturday_pm = $setting['monday_am'];
      $sunday_am = $setting['monday_am'];
      $sunday_pm = $setting['monday_am'];
      $holiday_am = $setting['monday_am'];
      $holiday_pm = $setting['monday_am'];
      // 予約希望日と曜日を取得
      //$reserve_time = $this->formatstrtoTime($date);
      //strtotime('+15 minute' , strtotime($time1));
      
      $reserve_time = strtotime('+1 minute', strtotime($date));
      $reserve_time = date('H:i:s',$reserve_time);
      $reserve_youbi = date('w', strtotime($date));//日:0　月:1　火:2　水:3　木:4 金:5 土:6
      
      // 月曜
      if($reserve_youbi == 1){
        if($setting['monday_am'] == 1){
          if($reserve_time <= $start_time_am || $reserve_time >= $end_time_am){
          
        }
        }elseif($setting['monday_pm'] == 1){
          
        }
        
        
        }
      
        if($reserve_time <= $start_time_am || $reserve_time >= $end_time_am){
      }
      if($this->carbon->isMonday() && $setting->isCloseMondayAM()){
        $this->isHoliday = true;
        $this->isAm = true;
        
      }
      // 営業日時かどうか判定
      if($reserve_time <= $start_time_am || $reserve_time >= $end_time_am){
        $is_reserve = false;
        echo $reserve_time."false";
      }else{
        $is_reserve = true;
        echo $reserve_time."true";
      }
      */
    }
    
    //　1.予約日時選択画面（fullcalendar）
    public function getCalendar(Request $request){
      // Reserveテーブルから、予約可能範囲の予約情報を取得
      $reserve = new Reserve;
      $data = Reserve::whereBetween('reserve_date', [$this->getReserveStartDate(), $this->getReserveEndDate()])->whereNull('canceled_at')->get();

      $events = [];
      foreach($data as $item){
        $start_date = $this->formatDataTime($item['reserve_date'],$item['reserve_start_time']);
        $end_date = $this->formatDataTime($item['reserve_date'],$item['reserve_end_time']);
        $event['id'] = $item['reserve_id'];
        $event['start'] = $start_date;
        $event['end'] = $end_date;
        $event['color'] = 'rgba(0, 45, 82, 1)';
        $event['textColor'] = 'rgba(0, 45, 82, 1)';
        $events[] = $event;
      }
      echo json_encode($events);
    }
    
    //　2.予約情報登録画面
    public function entry($info){
      $date = strtotime($info);
      $entry_date_time = date('Y-m-d H:i',$date);
      // 営業日時かどうか判定
      //$isRreserve = $this->isRreserve($entry_date_time);      
      return view('user.entry')->with([
        'entry_date_time' => $entry_date_time,
      ]);
    }
    
    //　3.予約情報登録からの予約情報確認画面
    public function confirm(Request $request){
      //フォームから受け取ったactionの値を取得
      $action = $request->input('action');
      //フォームから受け取ったactionを除いたinputの値を取得
      $inputs = $request->except('action');
      
      if($action !== 'submit'){
        //$info = $request->entry_date_time;
        return redirect()->route('user.calendar');
      } else {
        if ($request->radio == '再診') {
          $rules = [
            'radio' => 'required',
            //'medical' => //'required_without_all:medical_record_number,medical_record_number_check',
            'medical-record-number' => 'max:7',
            'family-name' => 'required|max:120',
            'given-name' => 'required|max:120',
            'family-name-kana' => 'required|max:120',
            'given-name-kana' => 'required|max:120',
            'cat-name' => 'required|max:120',
            'email' => 'required|email',
            //'user_mail_address_confirm' => 'required|same:user_mail_address',
            'tel' => 'required|min:10|numeric',
          ];
        }else{
          $rules = [
            'radio' => 'required',
            'family-name' => 'required|max:120',
            'given-name' => 'required|max:120',
            'family-name-kana' => 'required|max:120',
            'given-name-kana' => 'required|max:120',
            'cat-name' => 'required|max:120',
            'email' => 'required|email',
            //'user_mail_address_confirm' => 'required|same:user_mail_address',
            'tel' => 'required|min:10|numeric',
          ];
        }          
        $messages = [
          'radio.required' =>'【初診】か【再診】を選択してください',
          //'medical.required_without_all' => '【カルテ番号】を入力するか、カルテ番号がわからない場合は【カルテ番号がわからない方はチェックしてください】にチェックをいれてください',
          'email.email' => '【メールアドレス】の形式が正しくありません',
          //'user_mail_address_confirm.same' => '【メールアドレス】と【メールアドレス（確認用）】には同じ値を指定してください。',
        ];
        //入力チェックでエラーがあったらそれを返す
        $validator = Validator::make($inputs, $rules, $messages);
        if($validator->fails()){
          $info = $request->entry_date_time;
          return redirect('user/entry/'.$info)->withErrors($validator)->withInput();
        }
        //入力内容確認ページのviewに変数を渡して表示
        return view('user.confirm', ['inputs' => $inputs]);
      }
    }
    
    //　4.予約情報確認画面からの予約送信完了画面
    public function send(Request $request){
      //フォームから受け取ったactionの値を取得
      $action = $request->input('action');
      //フォームから受け取ったactionを除いたinputの値を取得
      $inputs = $request->except('action');

      //actionの値で分岐
      if($action !== 'submit'){
        $info = $request->entry_date_time;
        return redirect('user/entry/'.$info)->withInput($inputs);
      } else {
        
        $entry_date = $this->formatstrtoDate($inputs['entry_date_time']);
        $entry_start_time = $this->formatstrtoTime($inputs['entry_date_time']);
        $entry_end_time  = date('H:i:s', strtotime($inputs['entry_date_time'].'+30 minute'));
        
        // 同じ日時に予約がなければ、予約確定処理
        $data = Reserve::where('reserve_date', $entry_date)->where('reserve_start_time', $entry_start_time)->whereNull('canceled_at')->first();
        if(is_null($data)){
          $inputs['entry_date'] = $entry_date;
          $inputs['entry_start_time'] = $entry_start_time;
          $inputs['entry_end_time'] = $entry_end_time;
          
          $mrn = $inputs['medical-record-number'];

          if($inputs['radio'] == '初診'){
            $medical_record_number = '0';
            $mrn = "";
          }elseif($inputs['radio'] == '再診'){
            if(is_null($mrn)){
              $medical_record_number = '1';
              $mrn = 'わからない';
            }else{
              $medical_record_number = $mrn;
            }
          }
          $inputs['medical-record-number'] = $mrn;
          $reserve = new Reserve;
          $reserve->facility_id = '1';
          $reserve->medical_examination = $inputs['radio'];
          $reserve->medical_record_number = $medical_record_number;
          $reserve->reserves_status = '予約確定';
          $reserve->last_name = $inputs['family-name'];
          $reserve->first_name = $inputs['given-name'];
          $reserve->last_name_kana = $inputs['family-name-kana'];
          $reserve->first_name_kana = $inputs['given-name-kana'];
          $reserve->cat_name = $inputs['cat-name'];
          $reserve->user_mail_address = $inputs['email'];
          $reserve->user_phone = $inputs['tel'];
          $reserve->reserve_date = $inputs['entry_date'];
          $reserve->reserve_start_time = $inputs['entry_start_time'];
          $reserve->reserve_end_time = $inputs['entry_end_time'];          
          $reserve->save();
          $id = $reserve->reserve_id;          
          $urls = [
            'cancel' => URL::temporarySignedRoute(
                'user.cancel',
                now()->addMinutes(60),  // 60分間だけ有効
                ['id' => $id]
            ),
          ];
          //管理者メールアドレス取得
          $facility_mail_address = Facility::where('facility_id', '1')->value('facility_mail_address');
          //var_dump($facility_mail_address);          
          //ユーザーにメール送信
          \Mail::to($inputs['email'])->send(new UserContactSendmail($inputs, $urls));
          //管理者にメール送信
          \Mail::to($facility_mail_address)->send(new AdminContactSendmail($inputs));
          //再送信を防ぐためにトークンを再発行
          $request->session()->regenerateToken();
          //送信完了ページのviewを表示
          return view('user.thanks', ['inputs' => $inputs]);
        }else{
          $request->session()->regenerateToken();
          $message = '他の予約が先に入ったため、予約を登録できませんでした。恐れ入りますが、予約日時からお選び直しください。';
          return view('user.error', ['message' => $message]);
        }
      }
    }
    
    //　5.ユーザー宛てメールのキャンセルURLをクリック
    public function cancel(Request $request, $id){
    
      // リンクの検証
      if (!$request->hasValidSignature()) {
        return redirect()->route('user.invalid');
      }else{
        $data = Reserve::where('reserve_id', $id)->first();
        
        if(!is_null($data)){
          if(!is_null($data->canceled_at)){
            $message = '既にキャンセル済みです';
            return view('user.error', ['message' => $message]);
          }else{
            $medical_examination = $data->medical_examination;
            $mrn = $data->medical_record_number;
            if($medical_examination == '初診'){
              $medical_record_number = '初診';
            }elseif($medical_examination == '再診'){
              if($mrn == '1'){
                $medical_record_number = 'わからない';
              }else{
                $medical_record_number = $mrn;
              }
            }
            $request->session()->put([
              'reserve-id' => $data->reserve_id,
              'radio' => $data->medical_examination,
              'medical-record-number' => $medical_record_number,
              'family-name' => $data->last_name,
              'given-name' => $data->first_name,
              'family-name-kana' => $data->last_name_kana,
              'given-name-kana' => $data->first_name_kana,
              'cat-name' => $data->cat_name,
              'email' => $data->user_mail_address,
              'tel' => $data->user_phone,
              'entry_date' => $this->formatDataTime($data->reserve_date,$data->reserve_start_time)
            ]);
            return view('user.cancel', $request);
          }
        }else{
          $message = '予約がありません。';
          return view('user.error', ['message' => $message]);
        }
      }
    }
    // 6.キャンセル画面からのキャンセルボタンクリック
    public function cancelthanks(Request $request){
      // actionの値を取得
      $action = $request->input('action');  
      // actionを除いたinputの値を取得
      $inputs = $request->except('action');

      // 予約キャンセルボタン押下
      if($action == 'cancel'){
        $id = $request->session()->get('reserve-id');
        $data = Reserve::where('reserve_id', $id)->first();        
        if(!is_null($data)){
          if(!is_null($data->canceled_at)){
            $message = '予約がありません。';
            return view('user.error', ['message' => $message]);
          // データが存在した場合
          }else{
              $data->canceled_at = Carbon::now();
              $data->save();
              $request->session()->regenerateToken();
              $request->session()->flush();
              return view('user.cancelthanks');
          }
        }else{
          $message = '予約がありません。';
          return view('user.error', ['message' => $message]);
        }
      }
    }
    
    //　7.キャンセルURL　期限切れ or 無効URL
    public function invalid(){
      return view('user.invalid');
    }
}
