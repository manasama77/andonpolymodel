<style>
	div#calendar2{
		margin:0px auto;
		padding:0px;
		width: 535px;
		font-family:Helvetica, "Times New Roman", Times, serif;
	}

	div#calendar2 div.box{
		position:relative;
		top:0px;
		left:0px;
		width:100%;
		height:40px;
		background-color:   #787878 ;      
	}

	div#calendar2 div.header{
		line-height:40px;  
		vertical-align:middle;
		position:absolute;
		left:11px;
		top:0px;
		width:510px;
		height:40px;   
		text-align:center;
	}

	div#calendar2 div.header a.prev2, div#calendar2 div.header a.next2{ 
		position:absolute;
		top:0px;   
		height: 17px;
		display:block;
		cursor:pointer;
		text-decoration:none;
		color:#FFF;
	}

	div#calendar2 div.header span.title{
		color:#FFF;
		font-size:15px;
	}


	div#calendar2 div.header a.prev2{
		left:0px;
	}

	div#calendar2 div.header a.next2{
		right:0px;
	}
	
	div#calendar2 div.box-content{
		border:1px solid #787878 ;
		border-top:none;
	}

	div#calendar2 ul.label{
		float:left;
		margin: 0px;
		padding: 0px;
		margin-top:5px;
		margin-left: 5px;
	}

	div#calendar2 ul.label li{
		margin:0px;
		padding:0px;
		margin-right:5px;  
		float:left;
		list-style-type:none;
		width:70px;
		height:20px;
		line-height:22px;
		vertical-align:middle;
		text-align:center;
		color:#fff;
		font-size: 15px;
		background-color: transparent;
	}

	div#calendar2 ul.dates{
		float:left;
		margin: 0px;
		padding: 0px;
		margin-left: 5px;
		margin-bottom: 5px;
	}

	div#calendar2 ul.dates li{
		margin:0px;
		padding:0px;
		margin-right:5px;
		margin-top: 5px;
		line-height:30px;
		vertical-align:middle;
		float:left;
		list-style-type:none;
		width:70px;
		height:70px;
		font-size:15px;
		background-color: #DDD;
		color:#000;
		text-align:center; 
	}

	div.clear{
		clear:both;
	}

	.fdate{
		text-align: center;
		width: 70px;
		height: 39px;
		font-size: 14px;
	}
</style>
<?php echo $calendar; ?>