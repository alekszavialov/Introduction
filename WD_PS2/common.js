const errorMsg = "Incorrect input data";
const isZero = val => val === 0;

/**
First task
Calculate summ of few values
*/
function getSumm() {
	let firstValue = getIntegerFromInput("get-sum-first-val");
	let secondValue = getIntegerFromInput("get-sum-second-val");
	const answerBlock = document.getElementById("get-sum-answer");
	if (isNaN(firstValue) || isNaN(secondValue)) {
		setAnswer(answerBlock, errorMsg);
		return;
	}
	let result = 0;
	if (firstValue > secondValue) {
		[firstValue, secondValue] = [secondValue, firstValue];
	}
	for (let i = firstValue; i <= secondValue; i++) {
		result += i;
	}
	result = `Result is : ${result}`;
	setAnswer(answerBlock, result);
}

function getIntegerFromInput(object) {
	let inputData = document.getElementById(object).value;
	if (!inputData || !Number.isInteger(+inputData)) {
		return NaN;
	}
	return +inputData;
}

/** Print ansver */
function setAnswer(object, text) {
	object.innerText = text;
}

/**
Second task
Calculate summ of few values ending with 2, 3 or 7
*/
function getSummEnd() {
	let firstValue = getIntegerFromInput("get-sum-end-first-val");
	let secondValue = getIntegerFromInput("get-sum-end-second-val");
	const answerBlock = document.getElementById("get-sum-end-answer");
	if (isNaN(firstValue) || isNaN(secondValue)) {
		setAnswer(answerBlock, errorMsg);
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
	result = `Result is : ${result}`;
	setAnswer(answerBlock, result);
}

/**
Third task
Create list of elements
*/
function createSteps() {
	const stepsValue = getIntegerFromInput("steps-val");
	const answerBlock = document.getElementById("steps-answer");
	const maxElements = 50;
	if (isNaN(stepsValue) || !isPositive(stepsValue) ||
		maxElements < stepsValue) {
		setAnswer(answerBlock, errorMsg);
		return;
	}
	let result = "";
	for (let i = 1; i <= stepsValue; i++) {
		for (let j = 1; j <= i; j++) {
			result += "*";
		}
		result += "</br>";
	}
	answerBlock.innerHTML = result;
}

/** Check negative values */
function isPositive(value) {
	return value > 0;
}

/**
Conver seconds to hh:mm:ss format
*/
function convertSeconds() {
	let secondsValue = getIntegerFromInput("seconds-val");
	const answerBlock = document.getElementById("seconds-answer");
	const maxValue = 10;
	if (isNaN(secondsValue) || !isPositive(secondsValue) ||
		secondsValue.toString().length > maxValue) {
		setAnswer(answerBlock, errorMsg);
		return;
	}
	const secInHour = 3600;
	const secInMinute = 60;
	const hours = setTime(Math.floor(secondsValue / secInHour));
	const minutes = setTime(Math.floor((secondsValue - (hours * secInHour)) / secInMinute));
	const seconds = setTime(secondsValue - (hours * secInHour) - (minutes * secInMinute));
	const result = `${hours}:${minutes}:${seconds}`;
	setAnswer(answerBlock, result);
}

function setTime(value) {
	return value < 10 ? "0" + value : value;
}

/**
Decline values
*/
function dateYears() {
	let dateValue = getIntegerFromInput("date-years-val");
	const answerBlock = document.getElementById("date-years-answer");
	const maxValue = 150;
	if (isNaN(dateValue) || !isPositive(dateValue) ||
		dateValue > maxValue) {
		setAnswer(answerBlock, errorMsg);
		return;
	}
	const yearText = ["Года", "Год", "Лет"];
	let manYears = dateValue % 100;
	setAnswer(answerBlock, wordDeclination(dateValue, yearText));
}


function wordDeclination(value, text) {
	let textValue = value % 100;
	if (textValue >= 11 && textValue <= 19) {
		value = value + " " + text[2];
	} else {
		textValue = textValue % 10;
		switch (textValue) {
			case 1:
				value += ` ${text[1]}`;
				break;
			case 2:
			case 3:
			case 4:
				value += ` ${text[0]}`;
				break;
			default:
				value += ` ${text[2]}`;
				break;
		}
	}
	return value;
}

/**
Calculate difference between dates
*/
function dateDifferense() {
	const firstValue = document.getElementById("date-difference-first-val").value;
	const secondValue = document.getElementById("date-difference-second-val").value;
	const checkFirstVal = firstValue.split(/ |, /);
	const checkSecondVal = secondValue.split(/ |, /);
	const answerBlock = document.getElementById("date-difference-answer");
	if (!checkDate(checkFirstVal) || !checkDate(checkSecondVal) ||
		!checkCorrectDate(checkFirstVal[2], checkFirstVal[0], checkFirstVal[1]) ||
		!checkCorrectDate(checkSecondVal[2], checkSecondVal[0], checkSecondVal[1])) {
		setAnswer(answerBlock, errorMsg);
		return;
	}
	let firsDate = new Date(firstValue);
	let secondDate = new Date(secondValue);
	if (firsDate < secondDate) {
		[secondDate, firsDate] = [firsDate, secondDate];
	}
	const dateValuesName = [
		["Года", "Год", "Лет"],
		["Месяца", "Месяц", "Месяцев"],
		["Дня", "День", "Дней"],
		["Часа", "Час", "Часов"],
		["Минуты", "Минута", "Минут"],
		["Секунды", "Секунда", "Секунд"]
	];
	let dateDiff = [
		firsDate.getFullYear() - secondDate.getFullYear(),
		firsDate.getMonth() - secondDate.getMonth(),
		firsDate.getDate() - secondDate.getDate(),
		firsDate.getHours() - secondDate.getHours(),
		firsDate.getMinutes() - secondDate.getMinutes(),
		firsDate.getSeconds() - secondDate.getSeconds()
	];
	const dateValues = [12, new Date(dateDiff[0], dateDiff[1], 0).getDate(), 24, 60, 60];
	for (let i = dateDiff.length - 1; i > 0; i--) {
		if (dateDiff[i] < 0) {
			if (dateDiff[i] == 2) {
				--dateDiff[i - 1];
			} else {
				--dateDiff[i - 1];
				dateDiff[i] += dateValues[i - 1];
			}
		}
	}
	let answerText = "Прошло ";
	for (let i = 0; i < dateDiff.length; i++) {
		answerText += wordDeclination(dateDiff[i], dateValuesName[i]) + " ";
	}
	setAnswer(answerBlock, answerText);
}

/**
Check difference between dates for correct expression like October 13, 2014 11:13:00
*/
function checkDate(value) {
	const timeExp = /^(([0-1]?[0-9])|(2[0-3])):[0-5][0-9]:[0-5][0-9]$/;
	if (value.length !== 4 || !timeExp.test(value[3]) || !isNaN(value[0])) {
		return false;
	}
	return true;
}

/** Check sign date for correct data */
function checkCorrectDate(year, month, date) {
	const checkDate = new Date(`${year} ${month} 1`);
	if (checkDate instanceof Date && !isNaN(checkDate)) {
		const checkMonth = parseInt(checkDate.getMonth(), 10);
		const checkDays = date;
		const checkYear = parseInt(checkDate.getFullYear(), 10);
		let dayInCurrentMonth;
		switch (checkMonth) {
			case 1:
				dayInCurrentMonth = (checkYear % 4 === 0 && checkYear % 100) || checkYear % 400 === 0 ? 29 : 28;
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
		return checkDays > 0 && checkDays <= dayInCurrentMonth ? true : false;
	}
	return false;
}

/** Check sign date for correct expression like 2014-12-31 */
function checkCorrectSignDate(value) {
	if (value.length !== 3 || value[0].length !== 4 || value[1].length !== 2 || value[2].length !== 2) {
		return false;
	}
	return true;
}

/** Find zodiac sign by input date */
function zodiacSign() {
	const zodiacDate = document.getElementById("zodiac-first-val").value.split("-");
	const answerBlock = document.getElementById("zodiac-answer");
	const answerBlockImg = document.getElementById("zodiac-answer-img");
	answerBlockImg.src = "";
	if (!checkCorrectDate(zodiacDate[0], zodiacDate[1], zodiacDate[2]) || !checkCorrectSignDate(zodiacDate)) {
		setAnswer(answerBlock, errorMsg);
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
	let ansver = 0;
	for (let i = 0; i < zodiacSignNames.length; i++) {
		if ((zodiacDate[1] == zodiacMonth[i][0] && zodiacDate[2] >= zodiacDates[i][0]) ||
			(zodiacDate[1] == zodiacMonth[i][1] && zodiacDate[2] <= zodiacDates[i][1])) {
			ansver = i;
			break;
		}
	}
	setAnswer(answerBlock, zodiacSignNames[ansver]);
	answerBlockImg.src = "images/" + ansver + ".png";
}

/** Create chess desc */
function chess() {
	const firstValue = getIntegerFromInput("chess-first-val");
	const secondValue = getIntegerFromInput("chess-second-val");
	const answerBlock = document.getElementById("chess-box");
	const maxChessValue = 15;
	if (!Number.isInteger(firstValue) || !Number.isInteger(secondValue) ||
		!isPositive(firstValue) || !isPositive(secondValue) || firstValue > maxChessValue ||
		secondValue > maxChessValue) {
		setAnswer(answerBlock, errorMsg);
		return;
	}
	answerBlock.innerHTML = "";
	const boxWidth = answerBlock.offsetWidth / firstValue;
	const boxHeight = answerBlock.offsetHeight / secondValue;
	const boxSize = boxWidth > boxHeight ? boxHeight : boxWidth;
	let box;
	let br;
	for (let i = 0; i < secondValue; i++) {
		br = document.createElement("br");
		for (let j = 0; j < firstValue; j++) {
			box = document.createElement("div");
			box.style.width = boxSize + "px";
			box.style.height = boxSize + "px";
			if (((i + j) % 2 == 0)) {
				box.className = "white";
			} else {
				box.className = "black";
			}
			answerBlock.appendChild(box);
		}
		answerBlock.appendChild(br);
	}
}

function room() {
	let houseValue = getIntegerFromInput("room-first-val");
	let apatmentValue = getIntegerFromInput("room-second-val");
	let florValue = getIntegerFromInput("room-third-val");
	let searchApartmentValue = getIntegerFromInput("room-four-val");
	const answerBlock = document.getElementById("room-answer");
	if (!isPositive(houseValue) || !isPositive(apatmentValue) ||
		!isPositive(florValue) || !isPositive(searchApartmentValue)) {
		setAnswer(answerBlock, errorMsg);
		return;
	}
	if (isZero(houseValue) || isZero(apatmentValue) ||
		isZero(florValue) || isZero(searchApartmentValue)) {
		setAnswer(answerBlock, errorMsg);
		return;
	}
	const appartmentsInHouse = florValue * apatmentValue;
	if (searchApartmentValue > appartmentsInHouse * houseValue) {
		setAnswer(answerBlock, `value ${searchApartmentValue} is incorrect! Enter correct value`);
		return;
	}
	const temp = searchApartmentValue % appartmentsInHouse;
	const test = (searchApartmentValue - temp) / appartmentsInHouse;
	const entryNumb = temp == 0 ? test : test + 1;
	const florNumb = (((searchApartmentValue - 1 - ((searchApartmentValue - 1) % apatmentValue)) / apatmentValue) % florValue) + 1;
	let answerText = `Подъезд ${entryNumb} этаж ${florNumb}`;
	setAnswer(answerBlock, answerText);
}

/** Calculate all numbers from value */
function calcValue() {
	let calcValue = document.getElementById("find-val-first-val").value;
	const answerBlock = document.getElementById("find-val-answer");
	if (isNaN(calcValue)) {
		setAnswer(answerBlock, errorMsg);
		return;
	}
	calcValue = calcValue.replace(/\-|\./g, "").split(/(?!$)/u);
	let answerText = calcValue.reduce(function(sum, current, index) {
		return sum + parseInt(current, 10);
	}, 0);
	setAnswer(answerBlock, answerText);
}

/** When focusout textarea = remove http:// and https:// from textarean values, sort values and add it to textarea */
var textAreaFocus = document.getElementById("sortsrc");
textAreaFocus.addEventListener("focusout", function() {
	if (textAreaFocus.value) {
        const linkRegex = /^https?:\/\//;
		const textValue = textAreaFocus.value.split(",").map((object) => {
            return object.replace(linkRegex, "").trim();
        }).sort();
		const answerBlock = document.getElementById("link");
		let linkArray;
		if ((linkArray = document.getElementById("textLinks"))) {
			linkArray.innerHTML = "";
		} else {
			linkArray = document.createElement("ul");
			linkArray.id = "textLinks";
			linkArray.style.listStyleType = "none";
		}
		let box;
		let link;
		for (item in textValue) {
			box = document.createElement("li");
			link = document.createElement("a");
			link.href = textValue[item];
			link.innerText = textValue[item];
			link.setAttribute("target", "_blank");
			box.appendChild(link);
			linkArray.appendChild(box);
		}
		textAreaFocus.value = "";
		answerBlock.appendChild(linkArray);
	}
});