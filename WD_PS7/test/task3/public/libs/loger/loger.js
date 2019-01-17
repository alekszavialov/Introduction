class Loger {

    addLog (functionName, status, message = "null") {
        let date = new Date();
        date = `${date.getFullYear()}-${date.getMonth()}-${date.getDate()} ${date.toLocaleTimeString()}`;
        console.log(
           "Date: " + date +
            "; Function: " + functionName +
            "; Status: " + status +
            "; Message: " + message
        );
    }

}