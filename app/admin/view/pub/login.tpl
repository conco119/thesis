<div class="">
    <a class="hiddenanchor" id="toregister"></a> <a class="hiddenanchor" id="tologin"></a>
    <div id="wrapper">
        <div id="login" class="animate form">
            <section class="login_content">
                <form method="post" action="">
                    <h1>Đăng nhập</h1>
                    <div>
                        <input type="text" autofocus class="form-control text-center" name="username" placeholder="Tên đăng nhập" required value='admin'/>
                    </div>
                    <div>
                        <input type="password" class="form-control text-center" name="password" placeholder="Mật khẩu" required  value='12345'/>
                    </div>
                    <div>
                        <input type="submit" class="btn btn-default submit" name="submit" value="Đăng nhập">
                    </div>
                    <div class="clearfix"></div>
                    <div class="separator">
                        <div class="clearfix"></div>
                        <br />
                        <div>
                        {if $status eq 1}
                            <p style='color: red'> Tài khoản bị vô hiệu hóa <p>
                        {/if}
                        {if $wrong eq 1}
                            <p style='color: red'> Tài khoản hoặc mật khẩu không chính xác <p>
                        {/if}
                            {* <h1><i class="fa fa-paw" style="font-size: 26px;"></i> HLSELLING</h1>
              <p>Sales management software<br>HLSTAR ©2016 All Rights Reserved.</p> *}
                        </div>
                    </div>
                </form>
                <!-- form -->
            </section>
            <!-- content -->
        </div>

    </div>
</div>
