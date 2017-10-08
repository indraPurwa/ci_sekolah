<?php
//Draw Calendar
function draw_calendar(){
  $month = date('n');
  $year = date('Y');
  $nama_hari  =  array ("Minggu" , "Senin" , "Selasa", "Rabu", "Kamis" , "Jumat" , "Sabtu");
  $hari_ini = $nama_hari[date('w')];
  $nama_bulan =  array ("", "Januari", "Februari", "Maret" , "April" , "Mei", "Juni", "Juli", "Agustus" , "September", "Oktober" , "November", "Desember");
  $bulan_ini = $nama_bulan[date('n')];

	// Draw table for Calendar
	$calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';
  $calendar.= '<tr class="calendar-row"><td colspan="7" class="header_kal">'.$hari_ini.', '.date('j').' '.$bulan_ini.' '.date('Y').'</td></tr>';
	// Draw Calendar table headings
	$headings = array('M','S','S','R','K','J','S');
	$calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">', $headings).'</td></tr>';

	//days and weeks variable for now ...
	$running_day = date('w', mktime(0,0,0,$month,1,$year)); // w = format hari dalam angka
	$days_in_month = date('t', mktime(0,0,0,$month,1,$year)); // t = menghasilkan jumlah hari dlm bulan skrng
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();

	// row for week one
	$calendar.= '<tr class="calendar-row">';

	// Display "blank" days until the first of the current week
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np">&nbsp;</td>';
		$days_in_this_week++;
	endfor;

	// Show days....
	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
		if($list_day == date('d') && $month == date('n')) {
			$currentday = 'currentday';
		} else {
			$currentday='';
		}
		$calendar.= '<td class="calendar-day '.$currentday.'">';
		// Add in the day number
		if($list_day < date('d') && $month==date('n')) {
			$showtoday='<strong class="overday">'.$list_day.'</strong>';
		} else {
			$showtoday = $list_day;
		}
		$calendar.= '<div class="day-number">'.$showtoday.'</div>';

		// Draw table end
		$calendar.= '</td>';
		if($running_day == 6){
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month){
				$calendar.= '<tr class="calendar-row">';
			}
			$running_day = -1;
			$days_in_this_week = 0;
		}
		$days_in_this_week++; $running_day++; $day_counter++;
	endfor;

	// Finish the rest of the days in the week
	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<td class="calendar-day-np">&nbsp;</td>';
		endfor;
	endif;

	// Draw table final row
	$calendar.= '</tr>';

	// Draw table end the table
	$calendar.= '</table>';

	// Finally all done, return result
	return $calendar;
}
?>

<div class="right-modul">
  <div class="header">Member Area</div>
  <?php
    $login = $this->access->is_login();
    if ($login == false) {
      echo '<form class="form-horizontal" method="POST" role="form" action="'.site_url().'/admin/index/login'.'">
        <div class="form-group">
          <label for="username" class="col-md-4 control-label">Username</label>
          <div class="col-md-8">
            <input type="text" name="username" class="form-control" id="username" placeholder="username">
          </div>
        </div>
        <div class="form-group">
          <label for="password" class="col-md-4 control-label">Password</label>
          <div class="col-sm-8">
            <input type="password" name="password" class="form-control" id="password" placeholder="password">
          </div>
        </div>
        <div style="margin-bottom: 0px;" class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" class="btn btn-default" value="Masuk"></input>
          </div>
        </div>
        <br/>'.validation_errors().'
      </form>';
    } else {
      echo '<p style="margin: 10px 20px;font-weight: bold;">Hai '.$login."</p>";
    }
  ?>

</div>
<div class="right-modul">
  <div class="header">Agenda</div>
  <?php
    echo draw_calendar();
  ?>
</div>
