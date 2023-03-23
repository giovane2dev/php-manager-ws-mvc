<h3 class="text-uppercase text-center text-white text-dark">LOGIN DE USUÁRIO</h3>
<div class="row">
    <div class="col-sm-8 col-md-6 col-lg-5 col-xl-5 mx-auto">        
        <form action="readcreatelogin" id="form" method="post">
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" maxlength="150" required class="form-control form-control-lg" id="email" />
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" name="password" maxlength="15" required class="form-control form-control-lg" id="password" />
            </div>            
            <div class="form-group">
                <button class="btn btn-primary btn-xl mr-2" type="submit" id="sendButton">Fazer login</button>
            </div>
            <div id="result"></div>
        </form>
    </div>
</div>