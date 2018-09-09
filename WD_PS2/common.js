function getSumm(){
	let firstValue = document.getElementById("get-sum-first-val").value;
	let secondValue = document.getElementById("get-sum-second-val").value;
	if (!checkInteger(firstValue) || !checkInteger(secondValue)){
		return;
	}
	let result = 0;
	if (firstValue > secondValue){
 	[firstValue, secondValue] = [secondValue, firstValue];
	}
	for (let i = firstValue; i <= secondValue; i++) {
		result+=parseInt(i);
	}
	document.getElementById("get-sum-answer").innerHTML = "Result is : " + result;
}

function getSummEnd(){
	let firstValue = document.getElementById("get-sum-end-first-val").value;
	let secondValue = document.getElementById("get-sum-end-second-val").value;
	if (!checkInteger(firstValue) || !checkInteger(secondValue)){
		return;
	}
	let result = 0;
	let endValues = [2, 3, 7];
	if (firstValue > secondValue){
 	[firstValue, secondValue] = [secondValue, firstValue];
	}
	for (let i = firstValue; i <= secondValue; i++) {
		if (endValues.indexOf(Math.abs(i % 10)) !== -1){
			result+=parseInt(i);
		}
	}
	document.getElementById("get-sum-end-answer").innerHTML = "Result is : " + result;
}

function steps(){
	let firstValue = document.getElementById("steps-first-val").value;
	if (!checkInteger(firstValue)){
		return;
	}
	let result = "";
	for (let i = 1; i <= firstValue; i++) {
		for (let j = 1 ; j <= i; j++){
				result+='*';
		}
		result+="</br>";
	}
	document.getElementById("steps-answer").innerHTML = result;
}

function seconds(){
	let firstValue = document.getElementById("seconds-first-val").value;
	if (!checkInteger(firstValue)){
		return;
	}
	let result  = new Date(null);
	result.setSeconds(firstValue);
	console.log(result.toISOString());
	result = result.toISOString().substr(11, 8);
	document.getElementById("seconds-answer").innerHTML = result;
}

function dateYears(){
	let firstValue = document.getElementById("date-years-first-val").value;
	if (!checkInteger(firstValue)){
		return;
	}
	let result  = new Date(null);
	result.setSeconds(firstValue);
	console.log(result.toISOString());
	result = result.toISOString().substr(11, 8);
	document.getElementById("date-years-answer").innerHTML = result;
}

function dateDifferense(){
	let firstValue = document.getElementById("date-difference-first-val").value;
	let secondValue = document.getElementById("date-difference-second-val").value;
	if (!checkDate(firstValue) || !checkDate(secondValue) || !checkCorrectDate(firstValue) || !checkCorrectDate(secondValue)){
		return;
	}
	let firsDate  = new Date(firstValue);
	let secondDate  = new Date(secondValue);
	if (firsDate < secondDate){
		[secondDate, firsDate] = [firsDate, secondDate];
	}
	let dateValuesName = ['Years', 'Month', 'Days', 'Hours', 'Minutes', 'Seconds'];
	let dateDiff = [];
	dateDiff.push(firsDate.getFullYear() - secondDate.getFullYear());
	dateDiff.push(firsDate.getMonth() - secondDate.getMonth());
	dateDiff.push(firsDate.getDate() - secondDate.getDate());
	dateDiff.push(firsDate.getHours() - secondDate.getHours());
	dateDiff.push(firsDate.getMinutes() - secondDate.getMinutes());
	dateDiff.push(firsDate.getSeconds() - secondDate.getSeconds());
	let dateValues = [12,new Date(dateDiff[0], dateDiff[1], 0).getDate(),24,60,60];
	for (let i = dateDiff.length - 1; i > 1; i--){
		if (dateDiff[i] < 0){
		 if (dateDiff[i] == 2){
				--dateDiff[i - 1];
		 } else {
		 	--dateDiff[i - 1];
		 	dateDiff[i] += dateValues[i-1];
		 }
		}
	}
	let ansver = '';
	for(let i = 0; i < dateDiff.length; i++){
		ansver+=dateValuesName[i] + " " + dateDiff[i] + " ";
	}
	// let dateDiff = new Map();
	// dateDiff.set('Years', firsDate.getFullYear() - secondDate.getFullYear());
	// dateDiff.set('Month', firsDate.getMonth() - secondDate.getMonth());
 // dateDiff.set('Days', firsDate.getDate() - secondDate.getDate());
	// dateDiff.set('Hours', firsDate.getHours() - secondDate.getHours());
	// dateDiff.set('Minutes' ,firsDate.getMinutes() - secondDate.getMinutes());
	// dateDiff.set('Seconds', firsDate.getSeconds() - secondDate.getSeconds());

	// if (dateDiff.get('Seconds') < 0){
	// 	dateDiff.set('Seconds', 1000);
	// 	dateDiff.set('Minutes', dateDiff.get('Minutes') - 1);
	// }
	// if (dateDiff.get('Minutes') < 0){
	// 	dateDiff.set('Minutes', 60);
	// 	dateDiff.set('Hours', dateDiff.get('Hours') - 1);
	// }
	// if (dateDiff.get('Hours') < 0){
	// 	dateDiff.set('Hours', 24);
	// 	dateDiff.set('Days', dateDiff.get('Days') - 1);
	// }
	// if (dateDiff.get('Days') < 0){
	// 	dateDiff.set('Days', 30);
	// 	dateDiff.set('Month', dateDiff.get('Month') - 1);
	// }
	// if (dateDiff.get('Month') < 0){
	// 	dateDiff.set('Month', 11);
	// 	dateDiff.set('Years', dateDiff.get('Years') - 1);
	// }
	// dateDiff.set('Days', new Date(dateDiff.get('Years'), dateDiff.get('Month')).getDate());
	// let ansver = '';
	// dateDiff.forEach( function(value, element) {
	// 	ansver+=element+" ";
	// 	ansver+=value+" ";
	// });
	document.getElementById("date-difference-answer").innerHTML = ansver;
}

function checkDate(value){
	let checkDate = value.split(/ |\, /);
	if (isNaN(checkDate[1])){
		alert("invalid date " + value);
		return false;
	}
	if (checkDate.length !== 4){
		alert("invalid date " + value);
		return false;
	}
	return true;
}

function checkCorrectDate(value){
	let date = new Date(value);
	if (isNaN(date.getTime()) || isNaN(date.getDate()) || isNaN(date.getFullYear()) ||
		isNaN(date.getMonth())){
		alert("invalid date " + value);
		return false;
	}
	let month = date.getMonth();
	let currentDate = date.getDate();
	if (month === 2 && currentDate > 29){
		alert("invalid date " + value);
		return false;
	}
	if ((month===1||3||5||7||8||10||12) && currentDate>31){
		alert("invalid date " + value);
		return false;
	}
	if ((month==4||6||9||11) && currentDate>30){
		alert("invalid date " + value);
		return false;
	}
	return true;
}

function checkCorrectSignDate(value){
	let checkDate = value.split('-');
	if (checkDate.length !== 3){
		alert("invalid date " + value);
		return false;
	}
	if (checkDate[0].length !== 4){
		alert("invalid date " + value);
		return false;
	}
	if (checkDate[1].length !== 2 || checkDate[2].length !== 2){
		alert("invalid date " + value);
		return false;
	}
	return true;
}

function zodiacSign(){
	let firstValue = document.getElementById("zodiac-first-val").value;
	if (!checkCorrectDate(firstValue) || !checkCorrectSignDate(firstValue)){
		return;
	}
	let zodiacSignNames = ["Водолей", "Рыбы", "Овен", "Телец", "Близнецы", "Рак", "Лев", "Дева", "Весы", "Скорпион", "Стрелец", "Козерог"];
	let zodiacDates = [
		[20, 18],
		[19, 20],
		[21, 19],
		[20, 20],
		[21, 21],
		[22, 22],
		[23, 22],
		[23, 22],
		[23, 22],
		[23, 21],
		[22, 21],
		[22, 19]
	];
	let zodiacMonth = [
		[1, 12],
		[2, 3],
		[3, 4],
		[4, 5],
		[5, 6],
		[6, 7],
		[7, 8],
		[8, 9],
		[9, 10],
		[10, 11],
		[11, 12],
		[12, 1]
	];
	firstValue = firstValue.split('-');
	let zodiacDatesValue;
	let ansver = 0;
	for(let i = 0; i < 11; i++){
		if ((firstValue[1] == zodiacMonth[i][0] && firstValue[2] >= zodiacDates[i][0]) ||
			(firstValue[1] == zodiacMonth[i][1] && firstValue[2] <= zodiacDates[i][1])){
			ansver = i;
			break;
		}
	}
	document.getElementById("zodiac-answer").innerHTML = zodiacSignNames[ansver];
	document.getElementById("zodiac-answer-img").src = "images/" + ansver  + ".png";
}

function chess(){
	let firstValue = document.getElementById("chess-first-val").value;
	let secondValue = document.getElementById("chess-second-val").value;
	if (!checkInteger(firstValue) || !checkInteger(secondValue)){
		return;
	}
	let chessBox = document.getElementById('chess-box');
	let box;
	let br;
	var blackBox = document.createElement('div');
	for (let i = 0; i < firstValue; i++){
		br = document.createElement('br');
		for (let j = 0; j < secondValue; j++){
			box = document.createElement('div');
			if (((i+j) % 2 == 0)){
			 box.className = 'white';
			}else{
				box.className = 'black';
			}
			chessBox.appendChild(box);
		}
		chessBox.appendChild(br);
	}
}

function room(){
	let houseValue = document.getElementById("room-first-val").value;
	let apatmentValue = document.getElementById("room-second-val").value;
	let florValue = document.getElementById("room-third-val").value;
	let searchApartmentValue = document.getElementById("room-four-val").value;
	if (!checkInteger(houseValue) || !checkInteger(apatmentValue) || !checkInteger(florValue) || !checkInteger(searchApartmentValue)){
		return;
	}
	let roomsInHouse = apatmentValue * florValue;
	let roomsInAllHouses = houseValue * roomsInHouse;
	if (searchApartmentValue > roomsInAllHouses){
		alert("value " + searchApartmentValue + " is incorrect! Enter correct value");
		return;
	}
	let ansverEntrance = Math.ceil((searchApartmentValue) / roomsInHouse);
	let ansverFlor = Math.ceil(((searchApartmentValue) / roomsInHouse)) % apatmentValue  ;
	console.log("Подъезд " + ansverEntrance + " этаж" + ansverFlor);
}

function calcValue(){
	let firstValue = document.getElementById("find-val-first-val").value;
	if (!checkInteger(firstValue)){
		return;
	}
	let ansver = 0;
	for (let i = 0; i < firstValue.length; i++){
		ansver += parseInt(firstValue[i]);
	}
	document.getElementById("find-val-answer").innerHTML = ansver;
}

function checkInteger(value){
	return parseInt(value) == value ? true : alert("value '"+value+"' is incorrect! Enter correct value");
}

var textAreaFocus = document.getElementById('sortsrc');
textAreaFocus.addEventListener("focusout", function(){
	let textValue = textAreaFocus.value;
	textValue =	textValue.replace(/(http:\/\/)|(https:\/\/)/g, "");
	textValue = textValue.split(',');
	textValue.sort();
	textAreaFocus.value = textValue.join("\n");
});

