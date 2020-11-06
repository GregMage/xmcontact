function insert_answer()
{
	var answer_radios = document.getElementsByName('radioanswer');
	var answer_id;
	var answer_name;
	answer_name = '';
	for(var i = 0; i < answer_radios.length; i++){
		if(answer_radios[i].checked){
			answer_id = answer_radios[i].value;
			answer_name = 'answer' + answer_id
		}
	}	
	document.getElementById('xmcontact_message').value = document.getElementById(answer_name).value + "\r\n\r\n" + document.getElementById('xmcontact_message').value;
}