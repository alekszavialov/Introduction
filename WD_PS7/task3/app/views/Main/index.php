<section class="chat-body">
    <div class="container">
        <div class="chat">
            <h1>Easy chat</h1>
            <form id="loginForm" action="dashboard/login" method="POST">
                <p>Enter your name</p>
                <input type="text" placeholder="John Doe" name="user">
                <p>Enter your password</p>
                <input type="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" name="password">
                <div class="login-button">
                    <button class="submit-button">Submit</button>
                </div>
            </form>
            <p class="errorArea">

            </p>
        </div>
    </div>
</section>
<script src="/public/libs/jquery/jquery-3.3.1.js"></script>
<script src="/public/js/main.js"></script>