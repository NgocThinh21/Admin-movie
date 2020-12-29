@extends('Pages/admin')
@section('content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            SỬA RẠP <small> {{$rap->tenrap}}</small>
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                            <!-- thong bao loi -->
                            @if(count($errors)>0)
                                <div class ="alert alert-danger">
                                @foreach($errors->all() as $e)
                                    {{$e}}<br>
                                @endforeach
                                </div>
                            @endif    
                            @if(session('thongbao'))
                                    <div class="alert alert-success">
                                    {{session('thongbao')}}
                                </div>
                            @endif    
                                <form action="{{route('suaR',$rap->id)}}"  method="POST" enctype="multipart/form-data">
                                 @csrf
                                <div class="form-group">
                                    <label for="exampleInput1">Tên Rạp</label>
                                    <input type="" name="tenrap" value="{{$rap->tenrap}}" class="form-control" id="exampleInput1" placeholder="Enter "> 
                                    <label for="exampleInput1">Chi Nhánh</label>
                                    <select class="form-control" name="chinhanh">
                                    @foreach($chinhanh as $cn)
                                        <option 
                                        @if ($rap->chinhanh == $cn->id){{"selected"}}
                                            @endif
                                        value ="{{$cn->id}}">{{$cn->tenchinhanh}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-info">Submit</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
            </div>
        
 @stop