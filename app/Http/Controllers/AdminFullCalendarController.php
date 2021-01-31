<?php
namespace App\Http\Controllers;

use App\Mail\UserContactSendmail;
use App\Mail\AdminContactSendmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Facility;
use App\Models\Reserve;
use App\Models\HolidaySetting;

use Carbon\Carbon;

class AdminFullCalendarController extends Controller{
    public function index(){}
    
    // カレンダー初期表示
    public function calendar(Request $request){
      $period = $this->getReserveStartDate().'～'.$this->getReserveEndDate();
      return view('admin.calendar')->with('period', $period);
    }
    
    // 日付フォーマット（例：2021-01-12）
    public function formatDate($date){
      return date_format($date, 'Y-m-d');
    }
    
    // 日付フォーマット（UNIXタイムスタンプ）
    public function formatstrtoDate($date){      
      return date('Y-m-d', strtotime($date));
    }
    
    // 時間フォーマット（UNIXタイムスタンプ 00:00:00）
    public function formatstrtoTimeHis($date){      
      return date('H:i:s', strtotime($date));
    }
    
    // 時間フォーマット（UNIXタイムスタンプ 00:00）
    public function formatstrtoTimeHi($date){      
      return date('H:i', strtotime($date));
    }
    
    // 日付フォーマット（例：2021-01-12 09:00）
    public function formatDataTime($date, $time){
      $date_time = new \DateTime($date." ".$time, new \DateTimeZone('Asia/Tokyo'));
      $date_time = $date_time->format('Y-m-d H:i');
      return $date_time;    
    }
    // 日付フォーマット（例：2021-01-12 09:00）
    public function formatDataTime2($date, $time){
      $date_time = new \DateTime($date." ".$time, new \DateTimeZone('Asia/Tokyo'));
      $date_time = $date_time->format('Y-m-d\TH:i:s');
      return $date_time;    
    }
    
    // 今日の日付取得
    public function getReserveStartDate(){
      $reserve_start_date = Carbon::now();
      //$reserve_start_date =$reserve_start_date->addDay();
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

    //　1.予約日時選択画面（fullcalendar）
    public function getCalendar(Request $request){      
      // Reserveテーブルから、予約可能範囲の予約情報を取得
      $data = Reserve::whereBetween('reserve_date', [$this->getReserveStartDate(), $this->getReserveEndDate()])->whereNull('canceled_at')->get();

      $events = [];
      foreach($data as $item){
        $start_date = $this->formatDataTime($item['reserve_date'],$item['reserve_start_time']);
        $end_date = $this->formatDataTime($item['reserve_date'],$item['reserve_end_time']);  
        $event['id'] = $item['reserve_id'];
        $event['title'] = $item['last_name_kana']." ".$item['first_name_kana'];
        $event['start'] = $start_date;
        $event['end'] = $end_date;
        $event['color'] = 'rgba(0, 45, 82, 0.8)';
        $event['textColor'] = '#ffffff';
        $events[] = $event;
      }
      echo json_encode($events);
    }
    
    // 2.予約情報詳細画面
    public function details(Request $request, $id){
      $data = Reserve::where('reserve_id', $id)->first();
      
      if(!is_null($data)){
        if(!is_null($data->canceled_at)){
          $message = '予約がありません。';
          return view('admin.error', ['message' => $message]);
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
          return view('admin.details', $request);
        }
      }else{
        $message = '予約がありません。';
        return view('admin.error', ['message' => $message]);
      }
    }
    
    // 3.予約情報詳細画面からの予約情報編集画面
    public function update(Request $request){
      // actionの値を取得
      $action = $request->input('action');  
      // actionを除いたinputの値を取得
      $inputs = $request->except('action');
      
      // 戻るボタン押下
      if($action == 'back'){
        $period = $this->getReserveStartDate().'～'.$this->getReserveEndDate();
        //return redirect('admin.calendar')->with('period', $period);
        return redirect()->route('admin.calendar');
      // 予約キャンセルボタン押下
      }elseif($action == 'cancel'){
        $id = $request->session()->get('reserve-id');
        $data = Reserve::where('reserve_id', $id)->first();        
        if(!is_null($data)){
          if(!is_null($data->canceled_at)){
            $message = '予約がありません。';
            return view('admin.error', ['message' => $message]);
          // データが存在した場合
          }else{
              $data->canceled_at = Carbon::now();
              $data->save();
              $request->session()->regenerateToken();
              $request->session()->flush();
              return redirect()->route('admin.calendar');
          }
        }else{
          $message = '予約がありません。';
          return view('admin.error', ['message' => $message]);
        }
      // 編集ボタン押下
      }else{
        $medical_record_number = $request->session()->get('medical-record-number');
        if($medical_record_number == '初診'){
          $medical_record_number = '';
        }
        $request->session()->put('medical-record-number', $medical_record_number);    
        return view('admin.update', $request);
      }
    }
    
    //　4.予約情報編集画面からの予約送信完了画面
    public function send(Request $request){
      $id = $request->session()->get('reserve-id');
      $data = Reserve::where('reserve_id', $id)->first();
      // actionの値を取得
      $action = $request->input('action');  
      // actionを除いたinputの値を取得
      $inputs = $request->except('action');

      // 戻るボタン押下
      if($action !== 'submit'){
        return redirect('/admin/details/'.$id)->withInput($inputs);
      // 登録ボタン押下
      }else{
        if(!is_null($data)){
          // データがなかった場合、エラー画面へ遷移（ユーザーがキャンセルした場合など）
          if(!is_null($data->canceled_at)){
            $message = '予約がキャンセルされました。';
            return view('admin.error', ['message' => $message]);
          // データが存在した場合
          }else{ 
            if ($request->session()->get('radio') == '再診') {
              $rules = [
                'radio' => 'required',
                'medical-record-number' => 'max:7',
                'family-name-kana' => 'required|max:120',
                'given-name-kana' => 'required|max:120',
                'family-name' => 'max:120',
                'given-name' => 'max:120',
                'cat-name' => 'max:120',
                'email' => 'nullable|email',
                'tel' => 'required|min:10|numeric',
              ];
            }else{
              $rules = [
                'radio' => 'required',
                'family-name-kana' => 'required|max:120',
                'given-name-kana' => 'required|max:120',
                'family-name' => 'max:120',
                'given-name' => 'max:120',
                'cat-name' => 'max:120',
                'email' => 'nullable|email',
                'tel' => 'required|min:10|numeric',
              ];
            }
            $messages = [
              'radio.required' =>'【初診】か【再診】を選択してください',
              'email.email' => '【メールアドレス】の形式が正しくありません',
            ];
            
            $request->session()->put([
              'radio' => $inputs['radio'],
              'medical-record-number' => $inputs['medical-record-number'],
              'family-name' => $inputs['family-name'],
              'given-name' => $inputs['given-name'],
              'family-name-kana' => $inputs['family-name-kana'],
              'given-name-kana' => $inputs['given-name-kana'],
              'cat-name' => $inputs['cat-name'],
              'email' => $inputs['email'],
              'tel' => $inputs['tel']
            ]);
            
            //入力チェックでエラーがあったらそれを返す
            $validator = Validator::make($inputs, $rules, $messages);
            if($validator->fails()){
              return redirect('admin/update')->withErrors($validator)->withInput();
            // エラーがなければDB更新
            }else{
              $radio = $inputs['radio'];
              $mrn = $inputs['medical-record-number'];
              if($radio == '初診'){
                $medical_record_number = '0';
              }elseif($radio == '再診'){
                if(is_null($mrn)){
                  $medical_record_number = '1';
                }else{
                  if($mrn == 'わからない'){
                    $medical_record_number = '1';
                  }else{
                    $medical_record_number = $mrn;
                  }                  
                }
              }
              $data->medical_examination =  $inputs['radio'];
              $data->medical_record_number = $medical_record_number;
              $data->last_name =  $inputs['family-name'];
              $data->first_name =  $inputs['given-name'];
              $data->last_name_kana =  $inputs['family-name-kana'];
              $data->first_name_kana =  $inputs['given-name-kana'];
              $data->cat_name =  $inputs['cat-name'];
              $data->user_mail_address =  $inputs['email'];
              $data->user_phone =  $inputs['tel'];
              $data->save();
              $request->session()->regenerateToken();
              $request->session()->flush();
              return redirect()->route('admin.calendar');
            }            
          }
        }else{
          $message = '予約がありません。';
          return view('admin.error', ['message' => $message]);
        }
      }
      /*      
          //ユーザーにメール送信
          \Mail::to($inputs['email'])->send(new UserContactSendmail($inputs));
            
          //管理者にメール送信
          $facility_mail_address = Facility::where('facility_id', '1')->value('facility_mail_address');
          //var_dump($facility_mail_address);
          \Mail::to($facility_mail_address)->send(new AdminContactSendmail($inputs));
          //再送信を防ぐためにトークンを再発行
          $request->session()->regenerateToken();
          //送信完了ページのviewを表示
          return view('admin.thanks', ['inputs' => $inputs]);
        }else{
          return view('admin.error');
        }
        */
    }

    // 5.予約情報登録画面
    public function entry($info){
      $date = strtotime($info);
      $entry_date_time = date('Y-m-d H:i:s',$date);
      // 営業日時かどうか判定
      //$isRreserve = $this->isRreserve($entry_date_time);      
      return view('admin.entry')->with([
        'entry_date_time' => $entry_date_time,
      ]);
    }
    
    //　6.予約新規登録画面からの予約新規登録確認画面
    public function confirm(Request $request){
      //フォームから受け取ったactionの値を取得
      $action = $request->input('action');
      //フォームから受け取ったactionを除いたinputの値を取得
      $inputs = $request->except('action');
      
      if($action !== 'submit'){
        $info = $request->entry_date_time;
        return redirect()->route('admin.calendar');
      } else {
        if ($request->session()->get('radio') == '再診') {
          $rules = [
            'radio' => 'required',
            'medical-record-number' => 'max:7',
            'family-name-kana' => 'required|max:120',
            'given-name-kana' => 'required|max:120',
            'family-name' => 'max:120',
            'given-name' => 'max:120',
            'cat-name' => 'max:120',
            'email' => 'nullable|email',
            'tel' => 'required|min:10|numeric',
          ];
        }else{
          $rules = [
            'radio' => 'required',
            'family-name-kana' => 'required|max:120',
            'given-name-kana' => 'required|max:120',
            'family-name' => 'max:120',
            'given-name' => 'max:120',
            'cat-name' => 'max:120',
            'email' => 'nullable|email',
            'tel' => 'required|min:10|numeric',
          ];
        }
        $messages = [
          'radio.required' =>'【初診】か【再診】を選択してください',
          'email.email' => '【メールアドレス】の形式が正しくありません',
        ];

        //入力チェックでエラーがあったらそれを返す
        $validator = Validator::make($inputs, $rules, $messages);
        if($validator->fails()){
          $info = $request->entry_date_time;
          return redirect('admin/entry/'.$info)->withErrors($validator)->withInput();
        }
        
        if($inputs['radio']=='再診'){
          if(is_null($inputs['medical-record-number'])){
            $inputs['medical-record-number'] = 'わからない';
          }
        }
        //入力内容確認ページのviewに変数を渡して表示
        return view('admin.confirm', ['inputs' => $inputs]);
      }
    }
    //　7.予約新規登録確認画面からの予約送信完了画面
    public function send2(Request $request){
      //フォームから受け取ったactionの値を取得
      $action = $request->input('action');
      //フォームから受け取ったactionを除いたinputの値を取得
      $inputs = $request->except('action');

      //actionの値で分岐
      if($action !== 'submit'){
        $info = $request->entry_date_time;
        return redirect('admin/entry/'.$info)->withInput($inputs);
      } else {
        $reserve = new Reserve;
        $entry_date = $this->formatstrtoDate($inputs['entry_date_time']);
        $entry_start_time = $this->formatstrtoTimeHis($inputs['entry_date_time']);
        $entry_end_time  = date('H:i:s', strtotime($inputs['entry_date_time'].'+30 minute'));
        
        // 同じ日時に予約がなければ、予約確定処理
        $date = Reserve::where('reserve_date', $entry_date)->where('reserve_start_time', $entry_start_time)->whereNull('canceled_at')->first();
        if(is_null($date)){
          $inputs['entry_date'] = $entry_date;
          $inputs['entry_start_time'] = $entry_start_time;
          $inputs['entry_end_time'] = $entry_end_time;
          
          if($inputs['radio']== '初診'){
            $medical_record_number = '0';
          }elseif($inputs['radio']== '再診'){
            if(is_null($inputs['medical-record-number'])
              ||$inputs['medical-record-number']=='わからない'){
              $medical_record_number = '1';
            }else{
              $medical_record_number = $inputs['medical-record-number'];
            }
          }
          
          $reserve->create([
            'facility_id' => '1',
            'medical_examination' => $inputs['radio'],
            'medical_record_number' => $medical_record_number,
            'reserves_status' => '予約確定',
            'last_name' => $inputs['family-name'],
            'first_name' => $inputs['given-name'],
            'last_name_kana' => $inputs['family-name-kana'],
            'first_name_kana' => $inputs['given-name-kana'],
            'cat_name' => $inputs['cat-name'],
            'user_mail_address' => $inputs['email'],
            'user_phone' => $inputs['tel'],
            'reserve_date' => $inputs['entry_date'],
            'reserve_start_time' => $inputs['entry_start_time'],
            'reserve_end_time' => $inputs['entry_end_time'],
          ]);
          /*
          //ユーザーにメール送信
          \Mail::to($inputs['email'])->send(new UserContactSendmail($inputs));
            
          //管理者にメール送信
          $facility_mail_address = Facility::where('facility_id', '1')->value('facility_mail_address');
          //var_dump($facility_mail_address);
          \Mail::to($facility_mail_address)->send(new AdminContactSendmail($inputs));
          */
          //再送信を防ぐためにトークンを再発行
          $request->session()->regenerateToken();
          //送信完了ページのviewを表示
          return view('admin.thanks', ['inputs' => $inputs]);
          
        }else{
          $message = '同じ日時に予約が入っています。';
          return view('admin.error', ['message' => $message]);
        }
      }
    }
}
