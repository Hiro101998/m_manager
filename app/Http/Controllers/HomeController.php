<?php

namespace App\Http\Controllers;
use App\Models\Detail;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Requests\AddRequest;
use App\Http\Requests\UpdateRequest;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $details = Detail::where('status',1)->orderBy('created','DESC')->get();
        $departments = Department::get();
        $all =\DB::table('details')->join('departments','details.department_id','=','departments.department_id')->where('status',1)->get();

        // 名前検索ver
        $keyword = $request->input('keyword');
        $query = Detail::query();
        if(!empty($keyword))
        {
            $query->join('departments','details.department_id','=','departments.department_id')->where('name','like','%'.$keyword.'%');
            $name = $query->where('status',1)->get();
        }else{
            $name =null;
        }
        

        // 部署検索ver
        $dept = $request->input('dept');
        $query = Department::query();
        if(!empty($dept))
        {
            $query->where('department_name',$dept);
            $DeptResult = $query->join('details','departments.department_id','=','details.department_id')->where('status',1)->get();
        }else{
            $DeptResult=null;
        }

        // 一括検索ver
        if($name !== null && $DeptResult !==null){
            #クエリ生成
            $query = Detail::query();
            #もしダブルであれば走る
             $query->join('departments','details.department_id','=','departments.department_id')->where('name','like','%'.$keyword.'%')->Where('department_name',$dept);
             $MatchResult = $query->where('status',1)->get();
        }else{
            $MatchResult =null;
        }
        return view('home', compact('details','all','departments','keyword','name','dept','DeptResult','MatchResult'));
            
        }

    public function add()
    {
        $department= Department::get();
        
        return view('/add',compact('department'));
    }

    public function store(AddRequest $request)
    {
        $data = $request->all();
        $image = $request->file('image');
        if($request->hasFile('image')){
            $path = \Storage::put('/public',$image);
            $path = explode ('/',$path);
        }else{
                $path = null;
            }

        $detail_id= Detail::insertGetId([
            'name' => $data['name'],
            'birthday' => $data['birthday'],
            'gender' => $data['gender'],
            'department_id' => $data['department_id'],
            'tel' => $data['tel'],
            'image' => $path['1'],
            'status' => 1,
        ]);
        
            return redirect()->route('home');
        }

        public function edit($id){
                $departments = Department::get();
                $details =\DB::table('details')->join('departments','details.department_id','=','departments.department_id')->where('status', 1)->where('id', $id)->first();
                return view('edit', compact('details','departments'));
            }

            public function update(UpdateRequest $request, $id)
            {
                //既存の画像
                $image = Detail::where('id', $id)->get('image');
                $inputs= $request->all();

                if(!empty($inputs['image'])){
                    $path = \Storage::put('/public',$inputs['image']);
                    $path = explode ('/',$path);
                }
                Detail::where('id',$id)->update([
                    'name' =>$inputs['name'],
                    'birthday' => $inputs['birthday'],
                    'gender' => $inputs['gender'],
                    'department_id' => $inputs['department_id'],
                    'tel' => $inputs['tel'],
                    ]);
                if(!empty($path)){
                    Detail::where('id',$id)->update([
                        'image' => $path['1'],
                        ]);
                }
                return redirect()->route('home');
            }
    
            public function delete(Request $request, $id)
            {
                $inputs= $request->all();
                //論理削除なのでstatusを２に変えてあげる
                Detail::where('id',$id)->update(['status' => 2]);
                return redirect()->route('home')->with('success','データの削除が完成しました');
            }

            

}
