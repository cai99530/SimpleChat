<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <title>聊天室</title>
    <style>

        body{
            overflow: hidden;
            background-image: url('/home/photo/newimage.jpg');
        }




        #con-left{
            width: 400px;
            float: left;
            height: 680px;
            background-color: rgba(0,0,0,0);
        }

        #con-center{
            width:  700px;
            height: 680px;
            float: left;
            overflow: hidden;
            background-color: rgba(0,0,0,0);
        }


        #con-cen-top{
            width: 700px;
            height: 600px;
            text-align: left;
            overflow-y:auto;
            word-wrap: break-word;
            word-break:keep-all;
            background-color: rgba(0,0,0,0);
        }



        #con-right{
            float: right;
            height: 680px;
            background-color: rgba(0,0,0,0);
        }



        .inputuname{
            border: 0px;
            background:rgba(255,255,255,0);
        }
        .inputucontent{
            border: 0px;
            background:rgba(255,255,255,0.8);
        }
        .inputsend{
            border: 0px;
            background:rgba(255,255,255,0.7);
        }
        .inputedit{
            border: 0px;
            background:rgba(255,255,255,0.7);
        }
        .inputexit{
            height: 20px;
            width: 300px;
            border: 0px;
            background:rgba(255,255,255,0.7);
        }




        .font1{
            color: red;
        }

        .font{
            color: blue;
            text-align: left;
        }

        .font-cont{
            color: black;
            text-align: left;
        }

        .ownfont{
            color: blue;
            text-align: right;
        }

        .ownfont-cont{
            color: black;
            text-align: right;
        }

    </style>
</head>
<body>
    <div id="con-left">
        
    </div>
    <div id="con-center">
        <div id="con-cen-top">
       
        </div>
        <form >
            <center>
                <span class="font1">Hello&nbsp;&nbsp;<input class="inputuname" type="text" name="username" id="uname" size="10" value="{{ $user->username }}" readonly disabled></span>
                <input type="hidden" name="userid" id="userid" value="{{ $user->user_id }}">
                <input class="inputucontent" type="text" size="50" id="ucontent" name="content" maxlength="50">
                <input class="inputsend" type="button" value="发送" id="send" style="cursor:pointer">
                <input class="inputedit" type="button" value="修改信息" id="edit" style="cursor:pointer">
            </center>

       </form>
       <form>
           <br>
           <center>  <input class="inputexit" type="button" value="退出" id="exit" style="cursor:pointer"></center>
          
       </form>
    </div>
   <div id="con-right">

   </div>
</body>
</html>



<script>

    $(function(){
        $.ajaxSetup({ 
  headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
  }
});
        

        $('#send').click(function (){
            $.ajax({
                type:'post',
                url:'/chat/write',
                data:{
                    userid: $('#userid').val(),
                    username : $('#uname').val(),
                    content : $("#ucontent").val(),  
                },
                success:function(data){
                    $('#ucontent').val("");
                    console.log(data);
                    
                },
                error:function(msg){
                    console.log(msg);
                }
            })
        });
    })

    $(function(){
        $.ajaxSetup({ 
  headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
  }
});
         getText();
    })

    function getText(){
        setTimeout(getText,2*100);
        $.ajax({
            url: '/chat/read',
            type: 'get',
            dataType : 'json',
            success:function(data,statusText,xhr){
                dataList(data);
            },
                error:function(msg){
                    
            }
        })
    }

    function dataList(data){
        var temp = '';
            for(var $i=0 ; $i < data.length ; $i++){
                if(data[$i].username == $('#uname').val()){
                    temp += 
                            
                    '<p class="ownfont">'+data[$i].username+"("+data[$i].date+")"+'</p>'+
                            
                            
                    '<p class="ownfont-cont">'+data[$i].content+'</p>';
                }else{
                    temp += 
                            
                    '<p class="font">'+data[$i].username+"("+data[$i].date+")"+'</p>'+
                            
                            
                    '<p class="font-cont">'+data[$i].content+'</p>';
                }
                
                            
            }
        $('#con-cen-top').html(temp);
    }


    $(function(){
        $('#edit').click(function(){
            var id = $('#userid').val();
            window.location.href='/user/'+id+'/edit';
        })
    })

    $(function(){
        $('#exit').click(function(){
            window.location.href='/loginout';
        })
    })

</script>
