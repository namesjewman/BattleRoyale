$(document).ready(function(){$('.win').hover(function(){if ($('#l-name').html()!=''){$(this).css({'color':'black','cursor':'pointer'})}},function(){$(this).css({'color':'green','cursor':'default'})});});
function fadeTo(){if($('#fadeIt').html()=='Tree'){if(finalRound==true){$('#floater').hide()}$('#fight').fadeOut('fast',function(){$('#tree').fadeIn('fast')});$('#fadeIt').html('Fight');}else{$('#tree').fadeOut('fast',function(){$('#fight').fadeIn('fast',function(){if(finalRound==true){$('#floater').show()}})});$('#fadeIt').html('Tree')}}
function toggleTab(){if($('#noteTab').css('margin-top')=='0px'){$('#noteTabUp').hide();$('#noteTabDown').show();$('#noteTab').animate({'margin-top':-400},800);$('#notes').animate({'margin-bottom':380},800)}else{$('#noteTabUp').show();$('#noteTabDown').hide();$('#noteTab').animate({'margin-top':0},800);$('#notes').animate({'margin-bottom':0},800)}}
function winner(d){
	if ($('#l-name').html()!=''){
		if(d==0) {
			p='l';
			$('#right-box').prepend('<div id="loser"><img src="images/pow.png"></div>')
			}
		else {
			p='r';
			$('#left-box').prepend('<div id="loser"><img src="images/pow.png"></div>')
			}
		setTimeout('finishBattle("'+p+'")',1000);
		}
	}

function finishBattle(w){
	w=='l'?l='r':l='l';
	var pos=$('#'+w+'-image').offset();
	var left=Math.round(($(document).width()/2)-150);
	var top=Math.round(($(document).height()/2)-211);
	var src=$('#'+w+'-image').children().attr('src');
	var e='pages/update.php?win='+$('#'+w+'-name').html()+'&note='+encodeURIComponent($('#'+w+'-notes').val());
	$('body').prepend('<div id="floater" style="z-index: 10; position: absolute; left:'+pos.left+'px; top:'+pos.top+'px;"><img src="'+src+'" style="height: 423px; width: 300px;" /></div>');$('#floater').animate({'top':top,'left':left,boxShadow:"10 10 5px 5px rgba(50,50,100,1)"},1000);
	if(finalRound==false){
		setTimeout('$("#floater").fadeOut("slow")',2000);
		setTimeout('window.location.href="'+e+'";',2700)
		}
	else{
		$('#col4 .col1').text($('#'+w+'-name').html());
		$('#middle').fadeOut(1000)
		}
	$('#'+w+'-image,#'+w+'-name').html('');
	$('#'+l+'-name,#'+l+'-image,#'+l+'-notes').fadeOut('800',function(){
		$('#loser').remove();
		$('#'+l+'-name,#'+l+'-image,#'+l+'-notes').html('')
		});
	}
function sendIt(t,i,st1,st2){window.location='/battle/pages/updateAdmin.php?team='+t+'&id='+i+'&a_scroll='+st1+'&j_scroll='+st2;}
function verify(){var v=confirm('Delete all data?');if(v==true){window.location='update.php?end=y';}}
function verifyStart(){if($('#charList').children('div').children().length<24){alert('You must have 8 characters for a battle')}else if($('#joke').children('div').children().length==0){var v=confirm('Proceed without a Joke Battle?');if(v==true){window.location='/battle';}}else if($('#joke').children('div').children().length<4){alert('You must select two characters for the joke battle')}else{window.location='/battle';}}