class Loger {

    addLog (functionName, status, message = "none") {
        let date = new Date().toLocaleString();
        console.log(
           "Date: " + date +
            "; Function: " + functionName +
            "; Status: " + status +
            "; Message: " + message
        );
    }

}