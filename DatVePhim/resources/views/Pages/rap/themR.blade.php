@extends('Pages/admin')
@section('content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            THÊM RẠP
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
                                <form action="{{ route('themR') }}"  method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="hidden" name="token" value="{{csrf_token()}}"/>
                                    <label for="exampleInput1">Tên Rạp</label>
                                    <input type="" name="tenrap" class="form-control" id="exampleInput1" placeholder="Enter ">
                                    <label for="exampleInput1">Chi Nhánh</label>
                                    <select class="form-control" name="chinhanh">
                                        @foreach($chinhanh as $cn)
                                        <option value="{{$cn->id}}">{{$cn->tenchinhanh}}</option>
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