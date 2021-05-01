@extends('layouts.app')

@section('content')


<div class="row" style='height: 92vh;'>
    <div class="col-md-4 p-0">
        <div class="card h-100">
                    <div class="card-header">データ追加：検索機能</div>
              <div class="card-body py-2 px-4">
                <div class="col-sm-4" style="padding:20px 0; padding-left:0px;">

                        <div class="mt-3">
                            <label>★社員データの追加</label>
                            <a href='/add'><button type="button" class="btn btn-warning btn-lg">データ追加</button></a>  
                        </div>

                        <!-- //名前検索機能 -->
                         <label class="mt-3">★氏名検索</label>
                         <form class="form-inline" action="" method="GET">
                        <div class="form-group">
                                <input type="text" name="keyword" value="{{$keyword}}" class="form-control" placeholder="氏名を入力してください">
                                 <input type="submit" value="氏名検索" class="btn btn-info">   
                        </div>
                        </form>  
                        <!-- 名前検索機能ここまで -->
                  
                         <!-- 部署検索機能 -->
                         <label class="mt-5">★部署検索</label>
                         <form class="form-inline" action="" method="GET">
                         <div class="form-group">
                             <select class="form-control" name="dept">
                             @foreach($departments as $department)
                                 <option value="{{$department->department_name}}">{{$department->department_name}}</option>
                            @endforeach
                            </select>
                            <input type="submit" value="部署検索" class="btn btn-info">
                        </div>
                        </form>
                         <!-- 部署検索ここまで -->

                        <!-- 一括検索機能 -->
                        <label class="mt-5">★氏名×部署検索</label>
                          <form class="form-inline" action="" method="GET">
                            <div class="form-group">
                             <input type="text" name="keyword" value="{{$keyword}}" class="form-control" placeholder="名前を入力してください" >
                             <select class="form-control" name="dept">
                                @foreach($departments as $department)
                                 <option value="{{$department->department_name}}">{{$department->department_name}}</option>
                                @endforeach
                             </select>
                                <input type="submit" value="氏名×部署検索" class="btn btn-info">
                         </div>
                        </form>
                <!-- 一括検索機能ここまで -->
                <div class="mt-5">
                     <a href='/' ><button type="button" class="btn btn-success btn-lg">検索リセット</button></a>
                </div>
               
            </div>
        </div>
    </div>
</div>
      
        <div class="col-md-8 p-0">
              <div class="card h-100">
                <div class="card-header d-flex">社員一覧<a href='/add'><i class="fas fa-plus-circle ml-1" ></i></a></div>
                <div class="card-body p-2">
                <!-- 検索がない時は全表示 -->
                @if($name==null && $DeptResult==null && $MatchResult==null)
                @foreach($all as $result)
                    ●id:{{($result->id)}}氏名：{{$result->name}} 部署：{{$result->department_name}}　TEL:{{$result->tel}} 
                     <img src="{{'/storage/' .$result->image}}" width=50px height=50px >
                     <a href="/edit/{{$result->id}}" class='d-block'>編集</a>
                     @endforeach
                @endif

                <!-- 名前検索時の処理 -->
                @if(!empty($name) && $DeptResult==null && $MatchResult==null)
                @foreach($name as $result)
                    ●id:{{($result->id)}}氏名：{{$result->name}} 部署：{{$result->department_name}}　TEL:{{$result->tel}} 
                     <img src="{{'/storage/' .$result->image}}" width=50px height=50px >
                     <a href="/edit/{{$result->id}}" class='d-block'>編集</a>
                     @endforeach
                @endif

                <!-- 部署検索時の処理 -->
                @if(!empty($DeptResult) && $name==null && $MatchResult==null)
                @foreach($DeptResult as $result)
                    ●id:{{($result->id)}}氏名：{{$result->name}} 部署：{{$result->department_name}}　TEL:{{$result->tel}} 
                     <img src="{{'/storage/' .$result->image}}" width=50px height=50px >
                     <a href="/edit/{{$result->id}}" class='d-block'>編集</a>
                     @endforeach
                @endif

                    <!-- 一括検索時 -->
                     @if($MatchResult !== null)
                         @foreach($MatchResult as $result)
                             ●id:{{($result->id)}}氏名：{{$result->name}} 部署：{{$result->department_name}}　TEL:{{$result->tel}} 
                             <img src="{{'/storage/' .$result->image}}" width=50px height=50px >
                             <a href="/edit/{{$result->id}}" class='d-block'>編集</a>
                        @endforeach
                    @endif
                  

                </div>
              </div>    
            </div>                 
</div>



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


