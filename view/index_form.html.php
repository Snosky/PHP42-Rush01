<main class="form-container">
    <div id="form-container-left">
        <h1>Login</h1>
        <form class="login-form" method="POST" action="">
            <ul>
                <li>
                    <label>Username :</label><br/>
                    <input type="text" name="name" value="">
                </li>
                <li>
                    <label>Password :</label><br/>
                    <input type="password" name="password" value="">
                </li>
                <li>
                    <input type="submit" name="login" value="log in">
                </li>
            </ul>
        </form>
    </div>
    <div id="form-container-right">
        <h1>New here ?</h1>
        <form class="register-form" method="POST" action="">
        <ul>
            <li>
                <label>Choose a username :</label><br/>
                <input type="text" name="name" value="">
            </li>
            <li><label>Choose a password :</label><br/>
                <input type="password" name="password" value=""></li>
            <li><label>Retype your password :</label><br/>
                <input type="password" name="password-check" value=""></li>
            <li><label>Your e-mail :</label><br/>
                <input type="email" name="email" value=""></li>
            <li><label>Retype your e-mail :</label><br/>
                <input type="email" name="email-check" value=""></li>
            <li>
                <input type="submit" name="register" value="register"></li>
        </ul>
        </form>
    </div>
</main>