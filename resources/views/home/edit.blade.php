<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>修改信息</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('/jQuery.js') }}"></script>

    <style>

        body{
            overflow: hidden;
        }

        hr{
            border: 0px;
        }

        #left{
            height: 800px;
            width: 650px;
            float: left;
            overflow: hidden;
        }

        #center{
            height: 800px;
            width: 550px;
            float: left;
            overflow: hidden;
        }
        #center-top{
            height: 200px;
            width: 550px;
            overflow: hidden;
        }

        .inputudate{
            margin-left: 35px;
            width: 80px;
        }

    </style>


</head>
    <body>
        <div id="left">

    </div>


    <div>
        <div id="center-top">

        </div>
        <div >
            <form>
                <th>输入你的自定义信息</th><br>
                <hr>
                <input type="hidden" name="user_id" id="uid" value="{{ $user->user_id }}">
                
                <input type="text" name="username" id="uname" value="{{ $user->username }}"><br>
                <hr>
                <input type="text" name="password" id="upass" placeholder="密码"><br>
                <hr>
                <input class="inputudate" type="button" name="update" id="udate" value="修改">
            </form>
        </div>
           
    </div>

</body>
</html>

<script>

    $(function(){
        

        $('#udate').click(function(){
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

            $.ajax({
                
                type: 'put',
                url: '/user/'+$('#uid').val(),
                dataType: 'json',
                data: {
                    username: $('#uname').val(),
                    password: $('#upass').val(),
                },
                success: function(data){
                    for($i=0;$i<data.length;$i++){
                        console.log(data[$i]);
                        if(data[$i] != 0){
                            window.location.href='/login';
                        }else{
                            window.location.reload(true);
                        }
                    }
                },
                error: function(msg){
                    alert(msg);
                }   
            })
        })
    })

</script>