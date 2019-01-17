<section class="chat-body">
    <div class="container">
        <div class="chat chat-area">
            <h1>Easy chat</h1>
            <form id="chat-Form" method="get" action="dashboard/loadMessage">
                <div id="message-chat">
                </div>
                <div class="chat-send-msg">
                    <input id="message-value" type="text" name="data" minlength="1" maxlength="500">
                    <input type="submit" value="Send">
                </div>
                <p class="errorArea"></p>
            </form>
            <button id="logout" class="submit-button">Logout</button>
        </div>
    </div>
</section>
<script src="/public/libs/jquery/jquery-3.3.1.js"></script>
<script src="/public/libs/loger/loger.js"></script>
<script src="/public/js/chat.js"></script>