/** Calculate summ of few values */
function getSumm() {
	let firstValue = +document.getElementById("get-sum-first-val").value;
	let secondValue = +document.getElementById("get-sum-second-val").value;
	if (!checkInteger(firstValue) || !checkInteger(secondValue)) {
		return;
	}
	let result = 0;
	if (firstValue > secondValue) {
		[firstValue, secondValue] = [secondValue, firstValue];
	}
	for (let i = firstValue; i <= secondValue; i++) {
		result += i;
	}
	document.getElementById("get-sum-answer").innerText = `Result is : ${result}`;
}

/** Calculate summ of few values ending with 2, 3 or 7 */
function getSummEnd() {
	let firstValue = +document.getElementById("get-sum-end-first-val").value;
	let secondValue = +document.getElementById("get-sum-end-second-val").value;
	if (!checkInteger(firstValue) || !checkInteger(secondValue)) {
		return;
	}
	let result = 0;
	const endValues = [2, 3, 7];
	if (firstValue > secondValue) {
		[firstValue, secondValue] = [secondValue, firstValue];
	}
	for (let i = firstValue; i <= secondValue; i++) {
		if (endValues.indexOf(Math.abs(i % 10)) !== -1) {
			result += i;
		}
	}
	document.getElementById("get-sum-end-answer").innerText = `Result is : ${result}`;
}

/** Create list of elements */
function steps() {
	let firstValue = +document.getElementById("steps-first-val").value;
	if (!checkInteger(firstValue)) {
		return;
	}
	let result = "";
	for (let i = 1; i <= firstValue; i++) {
		for (let j = 1; j <= i; j++) {
			result += '*';
		}
		result += "</br>";
	}
	document.getElementById("steps-answer").innerHTML = result;
}

/** Conver seconds to hh:mm:ss format */
function seconds() {
	let firstValue = +document.getElementById("seconds-first-val").value;
	if (!checkInteger(firstValue)) {
		return;
	}
	let result = new Date(null);
	result.setSeconds(firstValue);
	result = result.toISOString().substr(11, 8); // convert date represent to 1970-01-01T00:01:00.000Z and trim h:m:s
	document.getElementById("seconds-answer").innerText = result;
}

/** Decline values  */
function dateYears() {
	let firstValue = +document.getElementById("date-years-first-val").value;
	if (!checkInteger(firstValue)) {
		return;
	}
	const yearText = ["Года", "Год", "Лет"];
	manYears = +firstValue % 100;
	if (manYears >= 11 && manYears <= 19) {
		firstValue = firstValue + " " + yearText[2];
	} else {
		manYears = manYears % 10;
		switch (manYears) {
			case 1:
				firstValue = firstValue + " " + yearText[1];
				break;
			case 2:
			case 3:
			case 4:
				firstValue = firstValue + " " + yearText[0];
				break;
			default:
				firstValue = firstValue + " " + yearText[2];
				break;
		}
	}
	document.getElementById("date-years-answer").innerText = firstValue;
}


/** Calculate difference between dates */
function dateDifferense() {
	let firstValue = document.getElementById("date-difference-first-val").value;
	let secondValue = document.getElementById("date-difference-second-val").value;
	if (!checkDate(firstValue) || !checkDate(secondValue) || !checkCorrectDate(firstValue) || !checkCorrectDate(secondValue)) {
		return;
	}
	let firsDate = new Date(firstValue);
	let secondDate = new Date(secondValue);
	if (firsDate < secondDate) {
		[secondDate, firsDate] = [firsDate, secondDate];
	}
	const dateValuesName = ['Years', 'Month', 'Days', 'Hours', 'Minutes', 'Seconds'];
	let dateDiff = [];
	dateDiff.push(firsDate.getFullYear() - secondDate.getFullYear());
	dateDiff.push(firsDate.getMonth() - secondDate.getMonth());
	dateDiff.push(firsDate.getDate() - secondDate.getDate());
	dateDiff.push(firsDate.getHours() - secondDate.getHours());
	dateDiff.push(firsDate.getMinutes() - secondDate.getMinutes());
	dateDiff.push(firsDate.getSeconds() - secondDate.getSeconds());
	const dateValues = [12, new Date(dateDiff[0], dateDiff[1], 0).getDate(), 24, 60, 60];
	for (let i = dateDiff.length - 1; i > 1; i--) {
		if (dateDiff[i] < 0) {
			if (dateDiff[i] == 2) {
				--dateDiff[i - 1];
			} else {
				--dateDiff[i - 1];
				dateDiff[i] += dateValues[i - 1];
			}
		}
	}
	let ansver = '';
	for (let i = 0; i < dateDiff.length; i++) {
		ansver += dateValuesName[i] + " " + dateDiff[i] + " ";
	}
	document.getElementById("date-difference-answer").innerText = ansver;
}

/** Check difference between dates for correct expression like October 13, 2014 11:13:00 */
function checkDate(value) {
	let checkDate = value.split(/ |\, /);
	if (isNaN(checkDate[1])) {
		alert("invalid date " + value);
		return;
	}
	if (checkDate.length !== 4) {
		alert("invalid date " + value);
		return;
	}
	return true;
}

/** Check sign date for correct data */
function checkCorrectDate(value) {
	let date = new Date(value);
	if (isNaN(date.getTime()) || isNaN(date.getDate()) || isNaN(date.getFullYear()) ||
		isNaN(date.getMonth())) {
		alert("invalid date " + value);
		return;
	}
	let month = parseInt(date.getMonth(), 10);
	let days = parseInt(date.getDate(), 10);
	let year = parseInt(date.getFullYear(), 10);
	let dayInCurrentMonth = parseInt(date.getFullYear());
	switch (month) {
		case 1:
			dayInCurrentMonth = (year % 4 == 0 && year % 100) || year % 400 == 0 ? 29 : 28;
			break;
		case 8:
		case 3:
		case 5:
		case 10:
			dayInCurrentMonth = 30;
			break;
		default:
			dayInCurrentMonth = 31;
			break;
	}
	return month >= 0 && month < 12 && days > 0 && days <= dayInCurrentMonth;
}

/** Check sign date for correct expression like 2014-12-31 */
function checkCorrectSignDate(value) {
	let checkDate = value.split('-');
	if (checkDate.length !== 3) {
		alert("invalid date " + value);
		return;
	}
	if (checkDate[0].length !== 4) {
		alert("invalid date " + value);
		return;
	}
	if (checkDate[1].length !== 2 || checkDate[2].length !== 2) {
		alert("invalid date " + value);
		return;
	}
	return true;
}

/** Find zodiac sign by input date */
function zodiacSign() {
	let firstValue = document.getElementById("zodiac-first-val").value;
	if (!checkCorrectDate(firstValue) || !checkCorrectSignDate(firstValue)) {
		return;
	}
	const zodiacSignNames = ["Овен", "Телец", "Близнецы", "Рак", "Лев", "Дева", "Весы", "Скорпион", "Стрелец", "Козерог", "Водолей", "Рыбы"];
	const zodiacDates = [
		[21, 19],
		[20, 20],
		[21, 20],
		[21, 22],
		[23, 22],
		[23, 22],
		[23, 22],
		[23, 21],
		[22, 21],
		[22, 19],
		[20, 18],
		[19, 20]
	];
	const zodiacMonth = [
		[3, 4],
		[4, 5],
		[5, 6],
		[6, 7],
		[7, 8],
		[8, 9],
		[9, 10],
		[10, 11],
		[11, 12],
		[12, 1],
		[1, 2],
		[2, 3]
	];
	firstValue = firstValue.split('-');
	let ansver = 0;
	for (let i = 0; i < zodiacSignNames.length; i++) {
		if ((firstValue[1] == zodiacMonth[i][0] && firstValue[2] >= zodiacDates[i][0]) ||
			(firstValue[1] == zodiacMonth[i][1] && firstValue[2] <= zodiacDates[i][1])) {
			ansver = i;
			break;
		}
	}
	document.getElementById("zodiac-answer").innerText = zodiacSignNames[ansver];
	document.getElementById("zodiac-answer-img").src = "images/" + ansver + ".png";
}

/** Create chess desc */
function chess() {
	let firstValue = document.getElementById("chess-first-val").value;
	let secondValue = document.getElementById("chess-second-val").value;
	if (!checkInteger(firstValue) || !checkInteger(secondValue)) {
		return;
	}
	let chessBox = document.getElementById('chess-box');
	chessBox.innerHTML = "";
	let box;
	let br;
	var blackBox = document.createElement('div');
	for (let i = 0; i < firstValue; i++) {
		br = document.createElement('br');
		for (let j = 0; j < secondValue; j++) {
			box = document.createElement('div');
			if (((i + j) % 2 == 0)) {
				box.className = 'white';
			} else {
				box.className = 'black';
			}
			chessBox.appendChild(box);
		}
		chessBox.appendChild(br);
	}
}

function room() {
	let houseValue = document.getElementById("room-first-val").value;
	let apatmentValue = document.getElementById("room-second-val").value;
	let florValue = document.getElementById("room-third-val").value;
	let searchApartmentValue = document.getElementById("room-four-val").value;
	if (!checkInteger(houseValue) || !checkInteger(apatmentValue) || !checkInteger(florValue) || !checkInteger(searchApartmentValue)) {
		return;
	}
	let appartmentsInHouse = florValue * apatmentValue;
	if (searchApartmentValue > appartmentsInHouse * houseValue) {
		alert("value " + searchApartmentValue + " is incorrect! Enter correct value");
		return;
	}
	let temp = searchApartmentValue % appartmentsInHouse;
	let test = (searchApartmentValue - temp) / appartmentsInHouse;
	let entryNumb = temp == 0 ? test : test + 1;
	let florNumb = (((searchApartmentValue-1-((searchApartmentValue-1)%apatmentValue))/apatmentValue)%florValue)+1;
	document.getElementById("room-answer").innerText = `Подъезд ${entryNumb} этаж ${florNumb}`;
}

/** Calculate all numbers from value */
function calcValue() {
	let firstValue = document.getElementById("find-val-first-val").value;
	if (!checkInteger(firstValue)) {
		return;
	}
	let ansver = 0;
	for (let i = 0; i < firstValue.length; i++) {
		ansver += +firstValue[i];
	}
	document.getElementById("find-val-answer").innerText = ansver;
}

/** Check if value is integer */
function checkInteger(value) {
	return parseInt(value, 10) == value ? true : alert("value '" + value + "' is incorrect! Enter correct value");
}

/** When focusout textarea = remove http:// and https:// from textarean values, sort values and add it to textarea */
var textAreaFocus = document.getElementById('sortsrc');
textAreaFocus.addEventListener("focusout", function() {
	let textValue = textAreaFocus.value;
	textValue = textValue.replace(/(http:\/\/)|(https:\/\/)/g, "").split(',').sort();
	textAreaFocus.value = textValue.join("\n");
});