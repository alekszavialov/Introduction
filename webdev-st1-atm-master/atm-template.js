const ATM = {
    user: false,
    is_auth: false,

    // all cash of ATM
    cash: 2000,
    // all available users
    users: [
        {number: "0000", pin: "000", debet: 0, type: "admin"}, // EXTENDED
        {number: "0025", pin: "123", debet: 2500, type: "user"}
    ],

    cashLogs: [],

    atmMessages: {
        logIn: "Hello!",
        logOut: "Bye!",
        isAuth: "Already logged!",
        incorrectData: "Incorrect value of username or password!",
        invalidData: "Invalid login or password!",
        notLogged: "You must logit to use it!",
        accesError: "You cant do this!",
        lessCash: "You cant get that value. ATM only have ",
        userLessCash: "You cant get that value. You only have ",
        incorrectMoneyValue: "You only can get or add integer value bigger than 0!"
    },
    cashLogsMessages: {
        getCash : "Try to get cash!",
        loadCash : "Try to load cash!",
        load_cash : "Try to add cash!"
    },
    isString: function (data) {
        return data.constructor === String;
    },
    isPositiveInt: function (data) {
        return Number.isInteger(data) && data > 0;
    },
    // authorization
    auth: function (number, pin) {
        if (this.is_auth){
            return this.atmMessages.isAuth;
        }
        if (!this.isString(number) || !this.isString(pin)) {
            return this.atmMessages.incorrectData;
        }
        if (!(this.user = this.users.find(data => data.number === number && data.pin === pin))) {
            return this.atmMessages.invalidData;
        }
        this.is_auth = true;
        return this.atmMessages.logIn;
    },
    // check current debet
    check: function () {
        if (this.user) {
            return this.user.debet;
        }
        return this.atmMessages["notLogged"];
    },
    checkAutorizationAndTypeErrors: function(type){
        if (!this.user){
            return this.atmMessages["notLogged"];
        }
        if (this.user.type !== type){
            return this.atmMessages.accesError;
        }
        return false;
    },
    addToLogs: function(functionName, error){
        this.cashLogs.push(`${new Date().toLocaleString()} : ${this.cashLogsMessages[functionName]} ${error}`);
    },
    // get cash - available for user only
    getCash: function (amount) {
        let checkResult;
        let functionName = "getCash";
        if (checkResult = this.checkAutorizationAndTypeErrors("user")) {
            this.addToLogs(functionName, "without autorization!");
            return checkResult;
        }
        if (!this.isPositiveInt(amount)) {
            this.addToLogs(functionName, `with incorrect cash value! User : ${this.user.number}.`);
            return this.atmMessages.incorrectMoneyValue;
        }
        if (this.user.debet < amount) {
            this.addToLogs(functionName, `more that debet has! User : ${this.user.number}.`);
            return `${this.atmMessages.userLessCash} ${this.user.debet}!`;
        }
        if (this.cash < amount) {
            this.addToLogs(functionName, `more that ATM has! User : ${this.user.number}.`);
            return `${this.atmMessages.lessCash} ${this.cash}!`;
        }
        this.cash -= amount;
        this.user.debet -= amount;
        this.addToLogs(functionName, `user ${this.user.number} got ${amount}!`);
        return `You got ${amount}. You debet is ${this.user.debet}`;
    },
    // load cash - available for user only
    loadCash: function (amount) {
        let checkResult;
        let functionName = "loadCash";
        if (checkResult = this.checkAutorizationAndTypeErrors("user")) {
            this.addToLogs(functionName, "without autorization!");
            return checkResult;
        }
        if (!this.isPositiveInt(amount)) {
            this.addToLogs(functionName, `with incorrect cash value! User : ${this.user.number}.`);
            return this.atmMessages.incorrectMoneyValue;
        }
        this.cash += amount;
        this.user.debet += amount;
        this.addToLogs(functionName, `user ${this.user.number} add ${amount}!`);
        return (`You add ${amount}. You debet is ${this.user.debet}`)
    },

    // load cash to ATM - available for admin only - EXTENDED
    load_cash: function (addition) {
        let checkResult;
        let functionName = "load_cash";
        if (checkResult = this.checkAutorizationAndTypeErrors("admin")) {
            this.addToLogs(functionName, "without autorization!");
            return checkResult;
        }
        if (!this.isPositiveInt(addition)) {
            this.addToLogs(functionName, `with incorrect cash value! User : ${this.user.number}.`);
            return this.atmMessages.incorrectMoneyValue;
        }
        this.cash += addition;
        this.addToLogs(functionName, `user ${this.user.number} add ${addition}!`);
        return (`You add ${addition}. ATM cash value is ${this.cash}`);
    },
    // get report about cash actions - available for admin only - EXTENDED
    getReport: function () {
        let checkResult;
        if (checkResult = this.checkAutorizationAndTypeErrors("admin")) {
            return checkResult;
        }
        checkResult = [];
        for (const key in this.cashLogs) {
            checkResult.push(this.cashLogs[key]);
        }
        return checkResult.join("\n");
    },
    // log out
    logout: function () {
        if (!this.is_auth){
            return this.atmMessages.notLogged;
        }
        this.user = false;
        this.is_auth = false;
        return this.atmMessages.logOut;
    }
};
