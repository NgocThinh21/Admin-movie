@extends('Pages/admin')
@section('content')
<div class="panel" id="loadl">
</div>
<span class="error text-enter alert alert-danger hidden"></span>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                THÊM ĐẠO DIỄN
            </header>
            <div class="alert alert-danger" id="loithem" hidden="true"></div>
            <div class="panel-body">
                <div class="position-center">
                    <form action=""  method="POST" enctype="multipart/form-data" id="themdaodien">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="token" value="{{csrf_token()}}"/>
                            <label for="exampleInput1">Tên đạo diễn</label>
                            <input type="" name="tentheloai" class="form-control" id="tendd" placeholder="Enter ">
                        </div>

                        <button type="submit" class="btn btn-info" id="btnhthem">Thêm</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div> 
<div>
 @include('Pages.daodien.suaDD')
</div>

<script type="text/javascript">
    function load(){
        $.ajax({
         type:'GET',
         url:"{{route('dsDD')}}",
         success: function(data){
           $('#loadl').html(data);
       }
   })
    }
    $(document).ready(function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        load();
        $("#btnhthem").click(function(e){
            e.preventDefault();
            var tendaodien = $("#tendd ").val();
            $.ajax({
             type:'POST',
             url:"{{route('themDD')}}",
             data:{tendaodien:tendaodien},
             success: function(data)
             {
                if (data.errors != null) {
                     $.each(data.errors, function(key, value){
                    $('#loithem').show();
                    $('#loithem').text(value);
                    })
                }else{
                        load();
                $('#themdaodien').reset();
                                    }           
           }
        })
        })


    })

    $(document).on('click', '#sua', function(e){
        var id= $(this).data('sua');
        $('#chinhsua').modal('show');
        $.ajax({
            type:'GET',
            url:"{{route('suaDD')}}",
            data:{id:id},
            success: function(data){
                $('#tentheloai').val(data.tendaodien);
                $('#id').val(data.id);
                if (data.trangthai ==1 ) {
                    document.getElementById("trangthai").value = "1";
                }else {
                    document.getElementById("trangthai").value = "0";

                }
            }
        })
    })
    $('#luudaodien').on('click', function(e){
     e.preventDefault();
     var id = $('#id').val();
     var tl = $('#tendaodien').val();
     var tt = $('#trangthai').val();
     $.ajax({
        type:'POST',
        url:"{{route('suaDD')}}",
        data:{id:id,tentheloai:tl, trangthai:tt},
        success: function(data){
            if (data.errors != null) {
                   alert(data.errors);
                }else{
                    load();
                $('#themdaodien').reset();
                                    }    
        }
    })
 })
    $(document).on('click','#xoa', function(){
        var id= $(this).data('xoa');
        if (confirm("Có Chắc Muốn Xóa ???")) {
            $.ajax({
                type:'GET',
                url:"{{route('xoaDD')}}",
                data:{id:id},
                success: function(data){
                    load();
                }
            })
        }
    })

</script> 
@stop


