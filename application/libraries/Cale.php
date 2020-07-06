<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cale
{

	protected $ci;
	private $dayLabels    = array("Mon","Tue","Wed","Thu","Fri","Sat","Sun");
	private $currentYear  = 0;
	private $currentMonth = 0;
	private $currentDay   = 0;
	private $currentDate  = null;
	private $daysInMonth  = 0;
	private $naviHref     = null;

	public function __construct()
	{
		$this->ci       =& get_instance();
		$this->naviHref = htmlentities($_SERVER['PHP_SELF']);
		$this->ci->load->model('M_core', 'mcore');
	}

	/**
    * print out the calendar
    */
	public function show() {
		$year  = null;
		$month = null;

		if(null==$year&&isset($_GET['year'])){
			$year = $_GET['year'];
		}elseif(null==$year){
			$year = date("Y",time());
		}          

		if(null==$month&&isset($_GET['month'])){
			$month = $_GET['month'];
		}else if(null==$month){
			$month = date("m",time());
		}                  

		$this->currentYear  = $year;
		$this->currentMonth = $month;
		$this->daysInMonth  = $this->_daysInMonth($month, $year);  

		$content = '<div id="calendar">'.
		'<div class="box">'.
		$this->_createNavi().
		'</div>'.
		'<div class="box-content">'.
		'<ul class="label">'.$this->_createLabels().'</ul>';   
		$content .= '<div class="clear"></div>';     
		$content .= '<ul class="dates">';    

		$weeksInMonth = $this->_weeksInMonth($month,$year); // Create weeks in a month
		// echo $weeksInMonth;
		for( $i=0; $i<$weeksInMonth; $i++ ){ 
			//Create days in a week
			for($j=1;$j<=7;$j++){
				// echo $i."<br>".$j."<hr>";
				$content.=$this->_showDay($i*7+$j);
			}
		}

		$content.='</ul>';
		$content.='<div class="clear"></div>';     
		$content.='</div>';
		$content.='</div>';
		return $content;   
	}

	/********************* PRIVATE **********************/ 
  /**
  * create the li element for ul
  */
  private function _showDay($cellNumber){

  	if($this->currentDay==0){

  		$firstDayOfTheWeek = date('N',strtotime($this->currentYear.'-'.$this->currentMonth.'-01'));

  		if(intval($cellNumber) == intval($firstDayOfTheWeek)){

  			$this->currentDay=1;

  		}
  	}

  	if( ($this->currentDay!=0)&&($this->currentDay<=$this->daysInMonth) ){
  		$x = new DateTime();
  		$this->currentDate = $x->createFromFormat('Y-M-j', $this->currentYear.'-'.$this->currentMonth.'-'.$this->currentDay)->format('Y-m-d');

  		$cellContent = $this->currentDay;

  		$this->currentDay++;   

  	}else{

  		$this->currentDate =null;

  		$cellContent=null;
  	}

  	$sekarang = date("Y-m-d");
  	if($this->currentDate != NULL){
  		
  		if($this->currentDate < $sekarang){
  			$disabled = 'disabled';
  		}else{
  			$disabled = '';
  		}

  		$where = ['date' => $this->currentDate];
  		$valueDate = $this->ci->mcore->get('planning', 'time', $where, NULL, 'ASC');

  		if($valueDate->num_rows() > 0){
  			$valueDate = $valueDate->row()->time;
  		}else{
  			$valueDate = NULL;
  		}

  		$render_date = '<li id="li-'.$this->currentDate.'" class="'.($cellNumber%7==1?' start ':($cellNumber%7==0?' end ':' ')).
  	($cellContent==null?'mask':'').'">'.$cellContent.'<br><input type="text" class="input-mini fdate" placeholder="HH:MM" id="'.$this->currentDate.'" name="'.$this->currentDate.'" value="'.$valueDate.'" '.$disabled.'></li>';
  	}else{
  		$render_date = '<li id="li-'.$this->currentDate.'" class="'.($cellNumber%7==1?' start ':($cellNumber%7==0?' end ':' ')).
  	($cellContent==null?'mask':'').'">'.$cellContent.'<br><input type="text" class="input-mini fdate" id="'.$this->currentDate.'" name="'.$this->currentDate.'" disabled></li>';
  	}

  	return $render_date;
  }

  /**
  * create navigation
  */
  private function _createNavi(){

  	$nextMonth = $this->currentMonth==12?1:intval($this->currentMonth)+1;

  	$nextYear = $this->currentMonth==12?intval($this->currentYear)+1:$this->currentYear;

  	$preMonth = $this->currentMonth==1?12:intval($this->currentMonth)-1;

  	$preYear = $this->currentMonth==1?intval($this->currentYear)-1:$this->currentYear;

  	return
  	'<div class="header">'.
  	'<a class="prev"><i class="fa fa-backward"></i> Prev</a>'.
  	'<input type="text" class="input-sm text-center" id="datepicker" name="active_date" value="'.date('M Y',strtotime($this->currentYear.'-'.$this->currentMonth.'-1')).'" style="width:100px; font-weight: bold; height: 40px;" readonly>'.
  	'<a class="next">Next <i class="fa fa-forward"></i></a>'.
  	'</div>';
  }

  /**
  * create calendar week labels
  */
  private function _createLabels(){  

  	$content='';

  	foreach($this->dayLabels as $index=>$label){

  		$content.='<li class="'.($label==6?'end title':'start title').' title">'.$label.'</li>';

  	}

  	return $content;
  }



  /**
  * calculate number of weeks in a particular month
  */
  private function _weeksInMonth($month=null,$year=null){

  	if( null==($year) ) {
  		$year =  date("Y",time()); 
  	}

  	if(null==($month)) {
  		$month = date("m",time());
  	}

        // find number of days in this month
  	$daysInMonths = $this->_daysInMonth($month,$year);

  	$numOfweeks = ($daysInMonths%7==0?0:1) + intval($daysInMonths/7);

  	$monthEndingDay= date('N',strtotime($year.'-'.$month.'-'.$daysInMonths));

  	$monthStartDay = date('N',strtotime($year.'-'.$month.'-01'));

  	if($monthEndingDay<$monthStartDay){

  		$numOfweeks++;

  	}

  	return $numOfweeks;
  }

  /**
  * calculate number of days in a particular month
  */
  private function _daysInMonth($month=null, $year=null){

  	if(null==($year))
  		$year =  date("Y",time()); 

  	if(null==($month))
  		$month = date("m",time());

  	return date('t',strtotime($year.'-'.$month.'-01'));
  }

}