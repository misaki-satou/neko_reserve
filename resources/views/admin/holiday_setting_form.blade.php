@extends('layouts.app')
@section('title', '管理画面　定休日設定')
@section('content')
    <div class="container pt-3 pb-3">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">定休日設定</div>
              <div class="card-body">
              @if (session('status'))
                <div class="alert alert-success" role="alert">
                {{ session('status') }}
                </div>
              @endif
                <form method="post" action="{{ route('update_holiday_setting') }}">
              @csrf
                  <table class="table table-borderd">
                    <tr>
                      <th>月曜日</th>
                      <td>
                        <span class="pr-3">午前</span><input type="radio" name="monday_am" value="{{ $FLAG_OPEN }}" {{ ($setting->isOpenMondayAM()) ? 'checked' : '' }} id="monday_am_open" />
                        <label for="monday_am_open" class="pr-2">診療あり</label>
                        <input type="radio" name="monday_am" value="{{ $FLAG_CLOSE }}" {{ ($setting->isCloseMondayAM()) ? 'checked' : '' }} id="monday_am_close" />
                        <label for="monday_am_close">診療なし</label>
                        </br>
                        <span class="pr-3">午後</span><input type="radio" name="monday_pm" value="{{ $FLAG_OPEN }}" {{ ($setting->isOpenMondayPM()) ? 'checked' : '' }} id="monday_pm_open" />
                        <label for="monday_pm_open" class="pr-2">診療あり</label>
                        <input type="radio" name="monday_pm" value="{{ $FLAG_CLOSE }}" {{ ($setting->isCloseMondayPM()) ? 'checked' : '' }} id="monday_pm_close" />
                        <label for="monday_pm_close">診療なし</label>
                      </td>
                    </tr>
                    <tr>
                      <th>火曜日</th>
                      <td>
                        <span class="pr-3">午前</span><input type="radio" name="tuesday_am" value="{{ $FLAG_OPEN }}" {{ ($setting->isOpenTuesdayAM()) ? 'checked' : '' }} id="tuesday_am_open" />
                        <label for="tuesday_am_open" class="pr-2">診療あり</label>
                        <input type="radio" name="tuesday_am" value="{{ $FLAG_CLOSE }}" {{ ($setting->isCloseTuesdayAM()) ? 'checked' : '' }} id="tuesday_am_close" />
                        <label for="tuesday_am_close">診療なし</label>
                        </br>
                        <span class="pr-3">午後</span><input type="radio" name="tuesday_pm" value="{{ $FLAG_OPEN }}" {{ ($setting->isOpenTuesdayPM()) ? 'checked' : '' }} id="tuesday_pm_open" />
                        <label for="tuesday_pm_open" class="pr-2">診療あり</label>
                        <input type="radio" name="tuesday_pm" value="{{ $FLAG_CLOSE }}" {{ ($setting->isCloseTuesdayPM()) ? 'checked' : '' }} id="tuesday_pm_close" />
                        <label for="tuesday_pm_close">診療なし</label>
                      </td>
                    </tr>
                    <tr>
                      <th>水曜日</th>
                      <td>
                        <span class="pr-3">午前</span><input type="radio" name="wednesday_am" value="{{ $FLAG_OPEN }}" {{ ($setting->isOpenWednesdayAM()) ? 'checked' : '' }} id="wednesday_am_open" />
                        <label for="wednesday_am_open" class="pr-2">診療あり</label>
                        <input type="radio" name="wednesday_am" value="{{ $FLAG_CLOSE }}" {{ ($setting->isCloseWednesdayAM()) ? 'checked' : '' }} id="wednesday_am_close" />
                        <label for="wednesday_am_close">診療なし</label>
                        </br>
                        <span class="pr-3">午後</span><input type="radio" name="wednesday_pm" value="{{ $FLAG_OPEN }}" {{ ($setting->isOpenWednesdayPM()) ? 'checked' : '' }} id="wednesday_pm_open" />
                        <label for="wednesday_pm_open" class="pr-2">診療あり</label>
                        <input type="radio" name="wednesday_pm" value="{{ $FLAG_CLOSE }}" {{ ($setting->isCloseWednesdayPM()) ? 'checked' : '' }} id="wednesday_pm_close" />
                        <label for="wednesday_pm_close">診療なし</label>
                      </td>
                    </tr>
                    <tr>
                      <th>木曜日</th>
                      <td>
                        <span class="pr-3">午前</span><input type="radio" name="thursday_am" value="{{ $FLAG_OPEN }}" {{ ($setting->isOpenThursdayAM()) ? 'checked' : '' }} id="thursday_am_open" />
                        <label for="thursday_am_open" class="pr-2">診療あり</label>
                        <input type="radio" name="thursday_am" value="{{ $FLAG_CLOSE }}" {{ ($setting->isCloseThursdayAM()) ? 'checked' : '' }} id="thursday_am_close" />
                        <label for="thursday_am_close">診療なし</label>
                        </br>
                        <span class="pr-3">午後</span><input type="radio" name="thursday_pm" value="{{ $FLAG_OPEN }}" {{ ($setting->isOpenThursdayPM()) ? 'checked' : '' }} id="thursday_pm_open" />
                        <label for="thursday_pm_open" class="pr-2">診療あり</label>
                        <input type="radio" name="thursday_pm" value="{{ $FLAG_CLOSE }}" {{ ($setting->isCloseThursdayPM()) ? 'checked' : '' }} id="thursday_pm_close" />
                        <label for="thursday_pm_close">診療なし</label>
                      </td>
                    </tr>
                    <tr>
                      <th>金曜日</th>
                      <td>
                        <span class="pr-3">午前</span><input type="radio" name="friday_am" value="{{ $FLAG_OPEN }}" {{ ($setting->isOpenFridayAM()) ? 'checked' : '' }} id="friday_am_open" />
                        <label for="friday_am_open" class="pr-2">診療あり</label>
                        <input type="radio" name="friday_am" value="{{ $FLAG_CLOSE }}" {{ ($setting->isCloseFridayAM()) ? 'checked' : '' }} id="friday_am_close" />
                        <label for="friday_am_close">診療なし</label>
                        </br>
                        <span class="pr-3">午後</span><input type="radio" name="friday_pm" value="{{ $FLAG_OPEN }}" {{ ($setting->isOpenFridayPM()) ? 'checked' : '' }} id="friday_pm_open" />
                        <label for="friday_pm_open" class="pr-2">診療あり</label>
                        <input type="radio" name="friday_pm" value="{{ $FLAG_CLOSE }}" {{ ($setting->isCloseFridayPM()) ? 'checked' : '' }} id="friday_pm_close" />
                        <label for="friday_pm_close">診療なし</label>
                      </td>
                    </tr>
                    <tr>
                      <th>土曜日</th>
                      <td>
                        <span class="pr-3">午前</span><input type="radio" name="saturday_am" value="{{ $FLAG_OPEN }}" {{ ($setting->isOpenSaturdayAM()) ? 'checked' : '' }} id="saturday_am_open" />
                        <label for="saturday_am_open" class="pr-2">診療あり</label>
                        <input type="radio" name="saturday_am" value="{{ $FLAG_CLOSE }}" {{ ($setting->isCloseSaturdayAM()) ? 'checked' : '' }} id="saturday_am_close" />
                        <label for="saturday_am_close">診療なし</label>
                        </br>
                        <span class="pr-3">午後</span><input type="radio" name="saturday_pm" value="{{ $FLAG_OPEN }}" {{ ($setting->isOpenSaturdayPM()) ? 'checked' : '' }} id="saturday_pm_open" />
                        <label for="saturday_pm_open" class="pr-2">診療あり</label>
                        <input type="radio" name="saturday_pm" value="{{ $FLAG_CLOSE }}" {{ ($setting->isCloseSaturdayPM()) ? 'checked' : '' }} id="saturday_pm_close" />
                        <label for="saturday_pm_close">診療なし</label>
                      </td>
                    </tr>
                    <tr>
                      <th>日曜日</th>
                      <td>
                        <span class="pr-3">午前</span><input type="radio" name="sunday_am" value="{{ $FLAG_OPEN }}" {{ ($setting->isOpenSundayAM()) ? 'checked' : '' }} id="sunday_am_open" />
                        <label for="sunday_am_open" class="pr-2">診療あり</label>
                        <input type="radio" name="sunday_am" value="{{ $FLAG_CLOSE }}" {{ ($setting->isCloseSundayAM()) ? 'checked' : '' }} id="sunday_am_close" />
                        <label for="sunday_am_close">診療なし</label>
                        </br>
                        <span class="pr-3">午後</span><input type="radio" name="sunday_pm" value="{{ $FLAG_OPEN }}" {{ ($setting->isOpenSundayPM()) ? 'checked' : '' }} id="sunday_pm_open" />
                        <label for="sunday_pm_open" class="pr-2">診療あり</label>
                        <input type="radio" name="sunday_pm" value="{{ $FLAG_CLOSE }}" {{ ($setting->isCloseSundayPM()) ? 'checked' : '' }} id="sunday_pm_close" />
                        <label for="sunday_pm_close">診療なし</label>
                      </td>
                    </tr>
                    <tr>
                      <th>祝日</th>
                      <td>
                        <span class="pr-3">午前</span><input type="radio" name="holiday_am" value="{{ $FLAG_OPEN }}" {{ ($setting->isOpenHolidayAM()) ? 'checked' : '' }} id="holiday_am_open" />
                        <label for="holiday_am_open" class="pr-2">診療あり</label>
                        <input type="radio" name="holiday_am" value="{{ $FLAG_CLOSE }}" {{ ($setting->isCloseHolidayAM()) ? 'checked' : '' }} id="holiday_am_close" />
                        <label for="holiday_am_close">診療なし</label>
                        </br>
                        <span class="pr-3">午後</span><input type="radio" name="holiday_pm" value="{{ $FLAG_OPEN }}" {{ ($setting->isOpenHolidayPM()) ? 'checked' : '' }} id="holiday_pm_open" />
                        <label for="holiday_pm_open" class="pr-2">診療あり</label>
                        <input type="radio" name="holiday_pm" value="{{ $FLAG_CLOSE }}" {{ ($setting->isCloseHolidayPM()) ? 'checked' : '' }} id="holiday_pm_close" />
                        <label for="holiday_pm_close">診療なし</label>
                      </td>
                    </tr>
                  </table>
                  <button type="submit" class="btn btn-primary">保存</button>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection