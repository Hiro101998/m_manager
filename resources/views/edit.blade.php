@extends('layouts.app')
@section('content')
<div class="card-header">社員データ編集</div>
<div class="card-body">
            <form method='POST' action="{{ route('update', ['id' => $details->id] ) }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>氏名</label>
                    <div class="col-md-5">
                    <input type="text" name="name" value="{{$details->name}}" class="form-control">
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
                    <input type="date" name="birthday"value="{{$details->birthday}}" class="form-control" >
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
                        <select name="gender" class="form-control" > 
                            <option value="{{ $details->gender }}">{{$details->gender}}</option>
                        </select>    
                    </div>
                </div>    

                <div class="form-group">
                        <label> 所属部署</label>
                        <div class="col-md-5">
                            <select name="department_id" class="form-control" >
                                 @foreach($departments as $department)
                                 <option value="{{ $department->department_id}}"{{ $details->department_id == $department->department_id ? "selected" : "" }}> {{$department->department_name}} </option>
                                @endforeach
                            </select>
                        </div>
                </div>

                <div class="form-group">
                    <label>電話番号</label>
                    <div class="col-md-5">
                        <input type="text" name="tel"value="{{$details->tel}}" class="form-control" >
                    </div>
                         @if($errors->has('tel'))
                         <span class="text-danger">
                            {{$errors->first('tel')}}
                        </span>
                        @endif
                </div>

                <div class="form-group">
                     <lavel for="image">写真</lavel>
                     <input type="file" class="form-control-file" name="image" class="form-control" >
                     @if($errors->has('image'))
                    <span class="text-danger">
                    {{$errors->first('image')}}
                    </span>
                    @endif
                </div>
                <p>  <img src="{{'/storage/' .$details->image}}" max-width="300px" max-height="300px"></p>
                    <input type='submit' class="btn btn-primary btn-lg w-25 p-3" value="更新" >
             </form>
           

        <form method='POST' action="{{ route('delete', ['id' => $details->id ] ) }}" id='delete-form'>
                @csrf
                <input type='submit' class="btn btn-danger btn-lg  w-25 p-3 mt-3" value="▽削除">
         </form>
         
</body>
</html>

@endsection

