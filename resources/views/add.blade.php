@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>管理者用ページ</title>
    <link href="{{ ('css/app.css') }}" rel="stylesheet">
  </head>

        <div class="card-header">社員データを登録する</div>

        <div class="card-body">
            <form method='POST' action="/store" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>氏名</label>
                    <div class="col-md-5">
                        <input type="text" name="name" class="form-control">
                    </div>
                    @if($errors->has('name'))
                    <span class="text-danger">
                    {{$errors->first('name')}}
                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <label>生年月日</label>
                    <div class="col-md-5">
                        <input type="date" name="birthday" class="form-control">
                    </div>
                    @if($errors->has('birthday'))
                    <span class="text-danger">
                    {{$errors->first('birthday')}}
                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <label>性別</label>
                    <div class="col-md-5">
                        <select name="gender" class="form-control">
                            <option value="男">男</option>
                            <option value="女">女</option>
                        </select>    
                    </div>
                </div>  

                <div class="form-group">  
                        <label>所属部署</label>
                        <div class="col-md-5">
                            <select name="department_id" class="form-control">
                              @foreach ($department as $result)
                                 <option value="{{$result['department_id']}}">{{$result['department_name']}}</option>
                                @endforeach
                            </select>
                        </div>
                </div>

                <div class="form-group">
                    <label>電話番号</label>
                    <div class="col-md-5">
                        <input type="text" name="tel" class="form-control">
                    </div>
                        @if($errors->has('tel'))
                          <span class="text-danger">
                             {{$errors->first('tel')}}
                         </span>
                        @endif
                </div>

                <div class="form-group">
                     <lavel for="image">写真</lavel>
                     <input type="file" class="form-control-file" name="image">
                     @if($errors->has('image'))
                    <span class="text-danger">
                    {{$errors->first('image')}}
                    </span>
                    @endif
                </div>
                <input type='submit' class="btn btn-primary btn-lg w-25 p-3" value="登録">
            </form>
        </div>
   
  
@endsection



