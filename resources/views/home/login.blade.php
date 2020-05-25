<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登录</title>
    <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
    <script src="{{ asset('/jQuery.js') }}"></script>
    <style>

        body{
            overflow: hidden;
            /* background-image: url('/home/photo/limage.jpg'); */
        }

        hr{
            width: 0px;
        }
        #div1{
            height: 200px;


        }

        #div2{
            height: 600px;

        }
        #div2-1{

            height: 100%;
            width: 45%;
            float: left;


        }
        #div2-2{

           float: left;


        }

        /* input{

            border-radius:6px 6px 6px 6px ;
        } */

        span{
            color: red;
        }

    </style>
</head>
<body>
    <div id="div1"></div>
    <div id="div2">
        <div id="div2-1">

        </div>
        <div id="div2-2">
            <form>
                <label for="uname">用户名</label>
                <input type="text" id="uname" name="username" value="">
                <span></span>
                <br><br>

                <label for="upass">密&nbsp;&nbsp;&nbsp;码</label>
                <input type="password" id="upass" name="password" value="">
                <span></span>
                <br><br>

                <label for="ucode">验证码</label>
                <input type="text" id="ucode" name="code" value="">
                <span></span>
                <br><br>

                <img src="{{ url('code') }}"  onclick="this.src='{{ url('code') }}?'+Math.random()"><br><br>

                <input type="button" id="sub" name="submit" value="登录" style="float: left;">
                &nbsp;&nbsp;&nbsp;
                <input type="button" id="reg" name="register" value="注册" >
            </form>
        </div>

    </div>

</body>
</html>

<script>




    $(function(){


        function name(){
            $('#uname').blur(function(){
            var $username = $('#uname').val();
            if($username == ''){
                $('#uname').next().show().html('*用户名不能为空');
            }else{
                $('#uname').next().show().html('');
            }
        })
        }



        function pass(){
            $('#upass').blur(function(){
            var $password = $('#upass').val();
            if($password == ''){
                $('#upass').next().show().html('*密码不能为空');
            }else{
                $('#upass').next().show().html('');
            }
            })
        }



        function code(){
            $('#ucode').blur(function(){
            var reg = /^[a-zA-Z0-9]{4}$/;
            var $code = $('#ucode').val();
            if($code == ''){
                $('#ucode').next().show().html('*验证码不能为空');
            }else if(!reg.test($code)){
                $('#ucode').next().show().html('*验证码格式错误');
            }else{
                $('#ucode').next().show().html('');
            }
        })
        }






        $('#sub').click(function(){
            if($('#uname').val().length == 0 || $('#upass').val().length == 0 ||$('#ucode').val().length == 0){
                return false;
            }
            $.ajaxSetup({
                type: 'post',
                url: '/dologin',
                // headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                data: {
                    username: $('#uname').val(),
                    password: $('#upass').val(),
                    code: $('#ucode').val(),
                },
                success: function(data){
                    if(!data.message){
                        window.location.href='/chat';
                    }else{
                        console.log(data.message);
                        alert(data.message);

                        window.location.reload(true);
                    }


                },
                error:function(msg){
                    alert('error');
		        }
            })
        })



        name();
        pass();
        code();

    })


</script>
