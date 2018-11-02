const ATM = {
    is_auth: false,
    current_user: false,
    current_type: false,

    // all cash of ATM

    cash: 2000,
    // all available users
    users: [
        {number: "0000", pin: "000", debet: 0, type: "admin"}, // EXTENDED
        {number: "0025", pin: "123", debet: 675, type: "user"}
    ],

    log: [],

    isString: function (data) {
        return data.constructor === String;
    },
    findUser: function (number, pin) {
        return false;
    },
    // authorization
    auth: function (number, pin) {
        if (this.is_auth) {
            return ("Already logged!");
        }
        if (!this.isString(number) || !this.isString(number)) {
            return ("Bad params!");
        }
        if (!(this.user = this.users.find(data => data.number === number && data.pin === pin))) {
            return ("Invalid login or password!");
        }
        this.is_auth = true;
        this.current_type = this.user.type;
        return ("logged!");
    },
    // check current debet
    check: function () {

    },
    // get cash - available for user only
    getCash: function (amount) {

    },
    // load cash - available for user only
    loadCash: function (amount) {

    },
    // load cash to ATM - available for admin only - EXTENDED
    load_cash: function (addition) {

    },
    // get report about cash actions - available for admin only - EXTENDED
    getReport: function () {

    },
    // log out
    logout: function () {
        this.is_auth = false;
        this.current_user = false;
        this.current_type = false;
        return "Logout!";
    }
};
