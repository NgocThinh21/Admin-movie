<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\chinhanh;
use App\Models\theloai;
use App\Models\phim;
use App\Models\daodien;
use App\Models\dienvien;
use App\Models\khungtgchieu;
use App\Models\lichchieu;
use App\Models\nsx;
use App\Models\quocgia;
use App\Models\rap;
use Carbon\Carbon;
use Error;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Unique;


class AdminController extends Controller
{
    //
    public function index()
    {
        return view('admin_layout');
    }
    public function addMovie()
    {
        return view('admin_layout');
    }

    //dang nhap
    public function dangnhap(){
     return view('Pages.dangnhap.dangnhap');
 }
 public function postdangnhap(Request $request ){
     $email=$request->email;
     $matkhau=$request->matkhau;
     if (Auth::attempt(['email'=>$email,'matkhau'=>$matkhau])){
         dd('Đăng nhập Thành Công');
     }
     else{
         dd('Tài Khoản hoặc mật khẩu df chưa đúng');
     }

 }


    //the loai
 public function danhSachTL()
 {
    $dl='';
    $theloai = theloai::all();
    $dl.= '<header class="panel-heading ">
    THỂ LOẠI
    </header>
    <table class="table" id="dstheloai">
    <thead class="thead-dark">
    <tr>
    <th>Thể Loại</th>
    <th>Trạng Thái</th>
    <th>Thao Tác</th>
    </tr>
    </thead>
    <tbody>';
    foreach($theloai as $tl){
        $dl.= '
        <tr>
        <td>'.$tl->tentheloai.'</td>
        <td>';
        if($tl->trangthai == 1)
           $dl.= '<div class="text-success">Hoạt Động</div>';
       else
          $dl.= '<div class="text-danger">Ngừng Hoạt Động</div>';

      $dl.= '
      </td>
      <td>
      <button class="btn btn-primary" data-sua="'.$tl->id.'" id="sua"><i class="fa fa-edit"> Sửa</i></button>
      <button class="btn btn-danger" data-xoa="'.$tl->id.'" id="xoa"><i class="fa fa-times"> Xóa</i></button>
      </td>
      </tr>';
  } 

  $dl.= ' </tbody>
  </table>';
  echo $dl;
}
public function ThemTL()
{
   $theloai = theloai::all();
   return view('Pages.theloai.themTL',['theloai'=>$theloai]);
}
    //them the loai
public function postThemTL(Request $request)
{
    $validator = Validator::make($request->all(),
        ['tentheloai' => 'required|unique:theloais,tentheloai|min:3|max:50'],[
            'tentheloai.required'=>'Chưa Nhập Tên Thể Loại',
            'tentheloai.min'=>'Tên Thể Loại Từ 3 Đến 50 Kí Tự',
            'tentheloai.max'=>'Tên Thể Loại Từ 3 Đến 50 Kí Tự',
            'tentheloai.unique'=>'Tên Thể Loại Đã Tồn Tại',


        ]);
    if ($validator->fails()){
     $errors = $validator->errors()->all();
     return Response()->json(['errors'=>$errors]);
 } else{
    $theloai = new theloai;
    $theloai->tentheloai = $request->tentheloai;
    $theloai->save();
    return  Response()->json(theloai::all()->last());
}
}
    //sua the loai
public function SuaTL(Request $request)
{
    $id = $request->id;
    $theloai = theloai::find($id);
    return response()->json($theloai);
}
public function postSuaTL(Request $request)
{
    $validator = Validator::make($request->all(),
        ['tentheloai' => 'required|min:3|max:50'],[
            'tentheloai.required'=>'Chưa Nhập Tên Thể Loại',
            'tentheloai.min'=>'Tên Thể Loại Từ 3 Đến 50 Kí Tự',
            'tentheloai.max'=>'Tên Thể Loại Từ 3 Đến 50 Kí Tự',

        ]);
    if ($validator->fails()){
     $errors = $validator->errors()->all();
     return Response()->json(['errors'=>$errors]);
 } 
 else{
    $id = $request->id;
    $theloai = theloai::find($id);
    $theloai->tentheloai = $request->tentheloai;
    $theloai->trangthai = $request->trangthai;
    $theloai->save();}
}

    //xoa the loai
public function XoaTL(Request $request)
{
    $id = $request->id;
    $theloai = theloai::find($id);
        //$theloai->delete();
    $theloai->trangthai=0;
    $theloai->save();
}



    //dao dien
public function danhSachDD()
{
   $dl='';
   $daodien = daodien::all();
   $dl.= '<header class="panel-heading ">
   ĐẠO DIỄN
   </header>
   <table class="table" id="dsdaoddien">
   <thead class="thead-dark">
   <tr>
   <th>Đạo Diễn</th>
   <th>Trạng Thái</th>
   <th>Thao Tác</th>
   </tr>
   </thead>
   <tbody>';
   foreach($daodien as $tl){
    $dl.= '
    <tr>
    <td>'.$tl->tendaodien.'</td>
    <td>';
    if($tl->trangthai == 1)
       $dl.= '<div class="text-success">Hoạt Động</div>';
   else
      $dl.= '<div class="text-danger">Ngừng Hoạt Động</div>';

  $dl.= '
  </td>
  <td>
  <button class="btn btn-primary" data-sua="'.$tl->id.'" id="sua"><i class="fa fa-edit"> Sửa</i></button>
  <button class="btn btn-danger" data-xoa="'.$tl->id.'" id="xoa"><i class="fa fa-times"> Xóa</i></button>
  </td>
  </tr>';
} 

$dl.= ' </tbody>
</table>';
echo $dl;
}
public function ThemDD()
{
 $daodien = daodien::all();
 return view('Pages.daodien.themDD',['daodien'=>$daodien]);
}
public function postThemDD(Request $request)
{
 $validator = Validator::make($request->all(),
    ['tendaodien' => 'required|unique:daodiens,tendaodien|min:3|max:50'],[
        'tendaodien.required'=>'Chưa Nhập Tên Đạo Diễn',
        'tendaodien.min'=>'Tên Đạo Diễn Từ 3 Đến 50 Kí Tự',
        'tendaodien.max'=>'Tên Đạo Diễn Từ 3 Đến 50 Kí Tự',
        'tendaodien.unique'=>'Tên Đạo Diễn Đã Tồn Tại',

    ]);
 if ($validator->fails()){
     $errors = $validator->errors()->all();
     return Response()->json(['errors'=>$errors]);
 } else{
    $daodien = new daodien;
    $daodien->tendaodien = $request->tendaodien;
    $daodien->save();
    return  Response()->json(daodien::all()->last());
}
}

    //sua dao dien
public function SuaDD(Request $request)
{
    $id = $request->id;
    $daodien = daodien::find($id);
    return response()->json($daodien);
}
public function postSuaDD(Request $request)
{
 $validator = Validator::make($request->all(),
    ['tendaodien' => 'required|min:3|max:50'],[
        'tendaodien.required'=>'Chưa Nhập Tên Đạo Diễn',
        'tendaodien.min'=>'Tên Đạo Điẽn Từ 3 Đến 50 Kí Tự',
        'tendaodien.max'=>'Tên Đạo Diễn Từ 3 Đến 50 Kí Tự',

    ]);
 if ($validator->fails()){
     $errors = $validator->errors()->all();
     return Response()->json(['errors'=>$errors]);
 } 
 else{
    $id = $request->id;
    $daodien = daodien::find($id);
    $daodien->tendaodien = $daodien->tendaodien;
    $daodien->trangthai = $request->trangthai;
    $daodien->save();
}
}
    //xoa dao dien
public function XoaDD(Request $request)
{
    $id = $request->id;
    $daodien = daodien::find($id);
        //$daodien->delete();
    $daodien->trangthai = 0;
    $daodien->save();
}



public function danhSachNSX()
{
   $dl='';
   $nsx = nsx::all();
   $dl.= '<header class="panel-heading ">
   NHÀ SẢN XUẤT
   </header>
   <table class="table" id="dsnsx">
   <thead class="thead-dark">
   <tr>
   <th>NSX</th>
   <th>Trạng Thái</th>
   <th>Thao Tác</th>
   </tr>
   </thead>
   <tbody>';
   foreach($nsx as $tl){
    $dl.= '
    <tr>
    <td>'.$tl->tennsx.'</td>
    <td>';
    if($tl->trangthai == 1)
       $dl.= '<div class="text-success">Hoạt Động</div>';
   else
      $dl.= '<div class="text-danger">Ngừng Hoạt Động</div>';

  $dl.= '
  </td>
  <td>
  <button class="btn btn-primary" data-sua="'.$tl->id.'" id="sua"><i class="fa fa-edit"> Sửa</i></button>
  <button class="btn btn-danger" data-xoa="'.$tl->id.'" id="xoa"><i class="fa fa-times"> Xóa</i></button>
  </td>
  </tr>';
} 

$dl.= ' </tbody>
</table>';
echo $dl;
}
public function ThemNSX()
{
 $nsx = nsx::all();
 return view('Pages.nsx.themNSX',['nsx'=>$nsx]);
}
public function postThemNSX(Request $request)
{
 $validator = Validator::make($request->all(),
    ['tennsx' => 'required|unique:nsxes,tennsx|min:3|max:50'],[
        'tennsx.required'=>'Chưa Nhập Tên NSX',
        'tennsx.min'=>'Tên NSX Từ 3 Đến 50 Kí Tự',
        'tennsx.max'=>'Tên NSX Từ 3 Đến 50 Kí Tự',
        'tennsx.unique'=>'Tên NSX Đã Tồn Tại',
    ]);
 if ($validator->fails()){
     $errors = $validator->errors()->all();
     return Response()->json(['errors'=>$errors]);
 } else{
    $nsx = new nsx;
    $nsx->tennsx = $request->tennsx;
    $nsx->save();
    return  Response()->json(dienvien::all()->last());
}
}

    //sua dao dien
public function SuaNSX(Request $request)
{
    $id = $request->id;
    $nsx = nsx::find($id);
    return response()->json($nsx);
}
public function postSuaNSX(Request $request)
{
  $validator = Validator::make($request->all(),
    ['tennsx' => 'required|min:3|max:50'],[
        'tennsx.required'=>'Chưa Nhập Tên NSX',
        'tennsx.min'=>'Tên NSX Từ 3 Đến 50 Kí Tự',
        'tennsx.max'=>'Tên NSX Từ 3 Đến 50 Kí Tự',
    ]);
 if ($validator->fails()){
     $errors = $validator->errors()->all();
     return Response()->json(['errors'=>$errors]);
 } else{
    $id = $request->id;
    $nsx = nsx::find($id);
    $nsx->tennsx = $request->tennsx;
    $nsx->trangthai = $request->trangthai;
    $nsx->save();
}
}
    //xoa dao dien
public function XoaNSX(Request $request)
{
    $id = $request->id;
    $nsx = nsx::find($id);
        //$daodien->delete();
    $nsx->trangthai = 0;
    $nsx->save();
}



    //nha san xuat
public function danhSachDV()
{
   $dl='';
   $dienvien = dienvien::all();
   $dl.= '<header class="panel-heading ">
   DIỄN VIÊN
   </header>
   <table class="table" id="dsdaoddien">
   <thead class="thead-dark">
   <tr>
   <th>Diễn Viên</th>
   <th>Trạng Thái</th>
   <th>Thao Tác</th>
   </tr>
   </thead>
   <tbody>';
   foreach($dienvien as $tl){
    $dl.= '
    <tr>
    <td>'.$tl->tendienvien.'</td>
    <td>';
    if($tl->trangthai == 1)
       $dl.= '<div class="text-success">Hoạt Động</div>';
   else
      $dl.= '<div class="text-danger">Ngừng Hoạt Động</div>';

  $dl.= '
  </td>
  <td>
  <button class="btn btn-primary" data-sua="'.$tl->id.'" id="sua"><i class="fa fa-edit"> Sửa</i></button>
  <button class="btn btn-danger" data-xoa="'.$tl->id.'" id="xoa"><i class="fa fa-times"> Xóa</i></button>
  </td>
  </tr>';
} 

$dl.= ' </tbody>
</table>';
echo $dl;
}
public function ThemDV()
{
 $dienvien = dienvien::all();
 return view('Pages.dienvien.themDV',['dienvien'=>$dienvien]);
}
public function postThemDV(Request $request)
{
 $validator = Validator::make($request->all(),
    ['tendienvien' => 'required|min:3|max:50'],[
        'tendienvien.required'=>'Chưa Nhập Tên Diễn Viên',
        'tendienvien.min'=>'Tên Diễn Viên Từ 3 Đến 50 Kí Tự',
        'tendienvien.max'=>'Tên Diễn Viên Từ 3 Đến 50 Kí Tự',
    ]);
 if ($validator->fails()){
     $errors = $validator->errors()->all();
     return Response()->json(['errors'=>$errors]);
 } else{
    $dienvien = new dienvien;
    $dienvien->tendienvien = $request->tendienvien;
    $dienvien->save();
    return  Response()->json(dienvien::all()->last());
}
}

    //sua dao dien
public function SuaDV(Request $request)
{
    $id = $request->id;
    $dienvien = dienvien::find($id);
    return response()->json($dienvien);
}
public function postSuaDV(Request $request)
{
  $validator = Validator::make($request->all(),
    ['tendienvien' => 'required|min:3|max:50'],[
        'tendienvien.required'=>'Chưa Nhập Tên Diễn Viên',
        'tendienvien.min'=>'Tên Diễn Viên Từ 3 Đến 50 Kí Tự',
        'tendienvien.max'=>'Tên Diễn Viên Từ 3 Đến 50 Kí Tự',
    ]);
 if ($validator->fails()){
     $errors = $validator->errors()->all();
     return Response()->json(['errors'=>$errors]);
 } else{
    $id = $request->id;
    $dienvien = dienvien::find($id);
    $dienvien->tendienvien = $request->tendienvien;
    $dienvien->trangthai = $request->trangthai;
    $dienvien->save();
}
}
    //xoa dao dien
public function XoaDV(Request $request)
{
    $id = $request->id;
    $dienvien = dienvien::find($id);
        //$daodien->delete();
    $dienvien->trangthai = 0;
    $dienvien->save();
}




    //quoc gia
public function danhSachQG()
{
   $dl='';
   $quocgia = quocgia::all();
   $dl.= '<header class="panel-heading ">
   QUỐC GIA
   </header>
   <table class="table" id="dsquocgia">
   <thead class="thead-dark">
   <tr>
   <th>Quốc Gia</th>
   <th>Trạng Thái</th>
   <th>Thao Tác</th>
   </tr>
   </thead>
   <tbody>';
   foreach($quocgia as $tl){
    $dl.= '
    <tr>
    <td>'.$tl->tenquocgia.'</td>
    <td>';
    if($tl->trangthai == 1)
       $dl.= '<div class="text-success">Hoạt Động</div>';
   else
      $dl.= '<div class="text-danger">Ngừng Hoạt Động</div>';

  $dl.= '
  </td>
  <td>
  <button class="btn btn-primary" data-sua="'.$tl->id.'" id="sua"><i class="fa fa-edit"> Sửa</i></button>
  <button class="btn btn-danger" data-xoa="'.$tl->id.'" id="xoa"><i class="fa fa-times"> Xóa</i></button>
  </td>
  </tr>';
} 

$dl.= ' </tbody>
</table>';
echo $dl;
}
public function ThemQG()
{
 $quocgia = quocgia::all();
 return view('Pages.quocgia.themQG',['quocgia'=>$quocgia]);
}
public function postThemQG(Request $request)
{
 $validator = Validator::make($request->all(),
    ['tenquocgia' => 'required|unique:quocgias,tenquocgia|max:50'],[
        'tenquocgia.required'=>'Chưa Nhập Tên Quốc Gia',
        'tenquocgia.max'=>'Tên Quốc Gia Tối Đa 50 Kí Tự',
        'tenquocgia.unique'=>'Tên Quốc Gia Đã Tồn Tại',
    ]);
 if ($validator->fails()){
     $errors = $validator->errors()->all();
     return Response()->json(['errors'=>$errors]);
 } else{
    $quocgia = new quocgia;
    $quocgia->tenquocgia = $request->tenquocgia;
    $quocgia->save();
    return  Response()->json(quocgia::all()->last());
}
}

    //sua dao dien
public function SuaQG(Request $request)
{
    $id = $request->id;
    $quocgia = quocgia::find($id);
    return response()->json($quocgia);
}
public function postSuaQG(Request $request)
{
  $validator = Validator::make($request->all(),
    ['tenquocgia' => 'required|unique:quocgias,tenquocgia|max:50'],[
        'tenquocgia.required'=>'Chưa Nhập Tên Quốc Gia',
        'tenquocgia.max'=>'Tên Quốc Gia Tối Đa 50 Kí Tự',
        'tenquocgia.unique'=>'Tên Quốc Gia Đã Tồn Tại',
    ]);
 if ($validator->fails()){
     $errors = $validator->errors()->all();
     return Response()->json(['errors'=>$errors]);
 } else{
    $id = $request->id;
    $quocgia = quocgia::find($id);
    $quocgia->tenquocgia = $request->tenquocgia;
    $quocgia->trangthai = $request->trangthai;
    $quocgia->save();
}
}
    //xoa dao dien
public function XoaQG(Request $request)
{
    $id = $request->id;
    $quocgia = quocgia::find($id);
        //$daodien->delete();
    $quocgia->trangthai = 0;
    $quocgia->save();
}



    // chi nhanh
public function danhSachCN()
 {
    $dl='';
    $chinhanh = chinhanh::all();
    $dl.= '<header class="panel-heading ">
    CHI NHÁNH
    </header>
    <table class="table" id="dschinhanh">
    <thead class="thead-dark">
    <tr>
    <th>Chi Nhánh</th>
    <th>Địa Chỉ</th>
    <th>Trạng Thái</th>
    <th>Thao Tác</th>
    </tr>
    </thead>
    <tbody>';
    foreach($chinhanh as $tl){
        $dl.= '
        <tr>
        <td>'.$tl->tenchinhanh.'</td>
        <td>'.$tl->diachi.'</td>
        <td>';
        if($tl->trangthai == 1)
           $dl.= '<div class="text-success">Hoạt Động</div>';
       else
          $dl.= '<div class="text-danger">Ngừng Hoạt Động</div>';

      $dl.= '
      </td>
      <td>
      <button class="btn btn-primary" data-sua="'.$tl->id.'" id="sua"><i class="fa fa-edit"> Sửa</i></button>
      <button class="btn btn-danger" data-xoa="'.$tl->id.'" id="xoa"><i class="fa fa-times"> Xóa</i></button>
      </td>
      </tr>';
  } 

  $dl.= ' </tbody>
  </table>';
  echo $dl;
}
public function ThemCN()
{
   $chinhanh = chinhanh::all();
   return view('Pages.chinhanh.themCN',['chinhanh'=>$chinhanh]);
}
    //them the loai
public function postThemCN(Request $request)
{
    $validator = Validator::make($request->all(),
        ['tenchinhanh' => 'required|unique:chinhanhs,tenchinhanh|min:3|max:50',
         'diachi'=>'required|min:3'],[
            'tenchinhanh.required'=>'Chưa Nhập Tên Chi Nhánh',
            'tenchinhanh.min'=>'Tên Chi Nhánh Từ 3 Đến 50 Kí Tự',
            'tenchinhanh.max'=>'Tên Chi Nhánh Từ 3 Đến 50 Kí Tự',
            'tenchinhanh.unique'=>'Tên Chi Nhánh Đã Tồn Tại',
            'diachi.required'=>'Chưa Nhập Địa Chỉ',
            'diachi.min'=>'Địa Chỉ Ít Nhất 3 Kí Tự'
        ]);
    if ($validator->fails()){
     $errors = $validator->errors()->all();
     return Response()->json(['errors'=>$errors]);
 } else{
    $chinhanh = new chinhanh;
    $chinhanh->tenchinhanh = $request->tenchinhanh;
    $chinhanh->diachi = $request->diachi;
    $chinhanh->save();
    return  Response()->json(chinhanh::all()->last());
}
}
    //sua the loai
public function SuaCN(Request $request)
{
    $id = $request->id;
    $chinhanh = chinhanh::find($id);
    return response()->json($chinhanh);
}
public function postSuaCN(Request $request)
{
        $validator = Validator::make($request->all(),
        ['tenchinhanh' => 'required|min:3|max:50',
         'diachi'=>'required|min:3'],[
            'tenchinhanh.required'=>'Chưa Nhập Tên Chi Nhánh',
            'tenchinhanh.min'=>'Tên Chi Nhánh Từ 3 Đến 50 Kí Tự',
            'tenchinhanh.max'=>'Tên Chi Nhánh Từ 3 Đến 50 Kí Tự',
            'diachi.required'=>'Chưa Nhập Địa Chỉ',
            'diachi.min'=>'Địa Chỉ Ít Nhất 3 Kí Tự'
        ]);
    if ($validator->fails()){
     $errors = $validator->errors()->all();
     return Response()->json(['errors'=>$errors]);
 } else{
    $id = $request->id;
    $chinhanh = chinhanh::find($id);
    $chinhanh->tenchinhanh = $request->tenchinhanh;
    $chinhanh->diachi = $request->diachi;
    $chinhanh->trangthai = $request->trangthai;
    $chinhanh->save();
}
}

    //xoa the loai
public function XoaCN(Request $request)
{
    $id = $request->id;
    $chinhanh = chinhanh::find($id);
    $chinhanh->trangthai=0;
    $chinhanh->save();
}
     // rap
public function danhSachR()
{
 $rap = rap::where('trangthai',1)->get();
 return view('Pages.rap.danhsachR', ['rap' => $rap]);
}
public function ThemR()
{
 $chinhanh = chinhanh::all();
 return view('Pages.rap.themR',['chinhanh'=>$chinhanh]);
}
     //them rap
public function postThemR(Request $request)
{
 $this->validate($request, [
     'tenrap' => 'required|unique:chinhanhs,tenchinhanh|min:3|max:50',
 ], [
     'tenrap.required' => 'Bạn Chưa Nhập Tên Rạp',
     'tenrap.unique' => 'Rạp Đã Tồn Tại',
     'tenrap.min' => 'Tên Rạp Có Độ Dài Từ 3 Đến 50 Kí Tự',
     'tenrap.max' => 'Tên Rạp Có Độ Dài Từ 3 Đến 50 Kí Tự',
 ]);
 $rap = new rap();
 $rap->tenrap = $request->tenrap;
 $rap->chinhanh = $request->chinhanh;
 $rap->save();
 return redirect()->route('themR')->with('thongbao', 'Thêm Rạp Thành Công');
}
     //sua rạp
public function SuaR($id)
{
 $rap = rap::find($id);
 $chinhanh = chinhanh::all();
 return view('Pages.rap.suaR', ['rap' => $rap], ['chinhanh' => $chinhanh]);
}
public function postSuaR(Request $request, $id)
{
 $rap = rap::find($id);
 $this->validate($request, [
    'tenrap' => 'required|unique:raps,tenrap|min:3|max:50',
], [
    'tenrap.required' => 'Bạn Chưa Nhập Tên Rạp',
    'tenrap.unique' => 'Rạp Đã Tồn Tại',
    'tenrap.min' => 'Tên Rạp Có Độ Dài Từ 3 Đến 50 Kí Tự',
    'tenrap.max' => 'Tên Rạp Có Độ Dài Từ 3 Đến 50 Kí Tự',
]);
 $rap->tenrap = $request->tenrap;
 $rap->chinhanh = $request->chinhanh;
 $rap->save();
 return redirect()->route('themR')->with('thongbao', 'Đã Sửa Rạp Thành Công');
}
     //xoa rap
public function XoaR($id)
{
 $rap = rap::find($id);
         //$rap->delete();
 $rap->trangthai = 0;
 $rap->save();
 return redirect()->route('ds')->with('thongbao', 'Đã Xóa Rạp Thành Công');
}


         // phim
public function danhSachP()
{
    $phim = phim::where('trangthai',1)->get();
    return view('Pages.phim.danhsachP', ['phim' => $phim]);
}
public function ThemP()
{
    $theloai = theloai::all();
    $daodien = daodien::all();
    $dienvien = dienvien::all();
    $quocgia = quocgia::all();
    $nsx = nsx::all();
    return view('Pages.phim.themP',['theloai'=>$theloai,'daodien'=>$daodien, 'dienvien'=>$dienvien,'quocgia'=>$quocgia,'nsx'=>$nsx]);
}
    //them the loai
public function postThemP(Request $request)
{
    $this->validate($request, [
        'tenphim' => 'required|unique:phims,tenphim|min:3|max:50',
        'trailer' => 'required',//chỗ này xóa min
        'thoiluong' => 'required',
   

    ], [
        'tenphim.required' => 'Bạn Chưa Nhập Tên Phim',
        'tenphim.unique' => 'Phim Đã Tồn Tại',
        'tenphim.min' => 'Tên Thể Loại Có Độ Dài Từ 3 Đến 50 Kí Tự',
        'tenphim.max' => 'Tên Thể Loại Có Độ Dài Từ 3 Đến 50 Kí Tự',
        'trailer.required' => 'Bạn Chưa Nhập Tên Phim',
        'thoiluong.required' => 'Bạn Chưa Nhập Tên Phim',
        'diem.required' => 'Bạn Chưa Nhập Tên Phim',
        'trailer.min' => 'Trailer Có Độ Dài Ít Nhất 3 Kí Tự',
        'thoiluong.min' => 'Trailer Có Độ Dài Ít Nhất 5 Kí Tự',
        'diem.min' => 'Trailer Có Độ Dài Ít Nhất 3 Kí Tự',
    ]);
    $phim = new phim();
    $phim->tenphim = $request->tenphim;
    $phim->theloai = $request->theloai;
    //				
    $phim->daodien = $request->daodien;
    $phim->dienvien = $request->dienvien;
    $phim->quocgia = $request->quocgia;
    $phim->nsx = $request->nsx;


    $phim->thoiluong = $request->thoiluong;
    $phim->trailer = $request->trailer;
    if($request->hasFile('hinhanh')){
        $file = $request->file('hinhanh');
        $name = $file->getClientOriginalName();
        $hinhanh = Str::random(5)."".$name; 
        $file->move("upload/",$hinhanh);
        $phim->hinhanh= $hinhanh;

    }else{
      $phim->hinhanh = "";
  }
  $phim->save();
  return redirect()->route('themP')->with('thongbao', 'Thêm Phim Thành Công');
}
    //sua phim
public function SuaP($id)
{
    $phim = phim::find($id);
    return view('Pages.phim.suaP', ['phim' => $phim]);
}
public function postSuaP(Request $request, $id)
{
    $phim = phim::find($id);
    $this->validate($request, [
        'tenphim' => 'required|unique:theloais,tentheloai|min:3|max:50'
    ], [
        'tenphim.required' => 'Bạn Chưa Nhập Tên Thê Loại',
        'tenphim.unique' => 'Thể Loại Đã Tồn Tại',
        'tenphim.min' => 'Tên Thể Loại Có Độ Dài Từ 3 Đến 50 Kí Tự',
        'tenphim.max' => 'Tên Thể Loại Có Độ Dài Từ 3 Đến 50 Kí Tự',
    ]);
    $phim->tenphim = $request->tenphim;
    $phim->save();
    return redirect()->route('themTL')->with('thongbao', 'Đã Sửa Thể Loại Thành Công');
}
    //xoa phim
public function XoaP($id)
{
    $phim = phim::find($id);
        //$theloai->delete();
    $phim->trangthai = 0;
    $phim->save();
    return redirect()->route('ds')->with('thongbao', 'Đã Xóa Thể Loại Thành Công');
}


 //lich chieu
public function danhSachLC()
{
    $dl="";
    $lichchieu = lichchieu::all();
    $dl.= '
    <table class="table" id="dslichchieu">
    <thead class="thead-dark">
    <tr>
    <th>Phim</th>
    <th>Rạp</th>
    <th>Thời Gian</th>
    <th>Ngày</th>
    <th>Thao Tác</th>
    </tr>
    </thead>
    <tbody>';
    foreach($lichchieu as $lc){
        $dl.= '
        <tr>
        <td>'.$lc->p->tenphim.'</td>
        <td>'.$lc->r->tenrap.'</td>
        <td>'.$lc->tg->giochieu.'</td>
        <td>'.$lc->ngay.'</td>';
        $dl.= '
        <td>
        <button class="btn btn-primary" data-sua="'.$lc->id.'" id="sua"><i class="fa fa-edit"> Sửa</i></button>
        <button class="btn btn-danger" data-xoa="'.$lc->id.'" id="xoa"><i class="fa fa-times"> Xóa</i></button>
        </td>
        </tr>';
    } 

    $dl.= ' </tbody>
    </table>';
    echo $dl;
}
public function ThemLC()
{
    $lichchieu = lichchieu::all();
    $phim = phim::all();
    $rap = rap::all();
    $khungtgchieu = khungtgchieu::all();
    return view('Pages.lichchieu.themLC',['phim'=>$phim,'rap'=>$rap,'khungtgchieu'=>$khungtgchieu,'lichchieu'=>$lichchieu]);
}
    //them lich chieu
public function postThemLC(Request $request)
{


   if ($request->rap == null || $request->phim == null) {
    return Response()->json(['errors'=>'Phải Chọn Phim Và Rạp']);
}else{
    $khungtgchieu = khungtgchieu::all();
    $k = 0;
    $phim = $request->phim;
    $r = $request->rap;
    $dt = (Carbon::create($request->ngaybd))->toDateString();
    $kt = (Carbon::create($request->ngaykt))->toDateString();
    $kt = Carbon::parse($kt)->addDays();
    while($dt < $kt){
        foreach ($r as $rap) {
            foreach ($khungtgchieu as $thoigian) {
                if (lichchieu::where('thoigian','=',$thoigian)->count() == 0) {
                    foreach ($phim as $p) {
                        foreach ($khungtgchieu as $value) {
                            if ($k < 1) {
                              if (kiemTra($p, $value->id, $rap, $dt)){
                                  $lichchieu = new lichchieu();
                                  $lichchieu->phim = $p;
                                  $lichchieu->rap = $rap;
                                  $lichchieu->thoigian = $value->id;
                                  $lichchieu->ngay = $dt;
                                  $lichchieu->save();
                                  $k = $k + 2;

                              }
                          }    
                      }
                      $k = 0;

                  }
              }
          }
      }
      $dt = Carbon::parse($dt)->addDays();
  }
}
}

public function ac(Request $request)
{
 $a = $request->all();

}
    //sua lich chieu
public function SuaLC($id)
{
    $lichchieu = lichchieu::find($id);
    $phim = phim::all();
    $rap = rap::all();
    $khungtgchieu = khungtgchieu::all();
    return view('Pages.lichchieu.suaLC',['lichchieu'=>$lichchieu,'phim'=>$phim,'rap'=>$rap,'khungtgchieu'=>$khungtgchieu]);
}
public function postSuaLC(Request $request, $id)
{
    $lichchieu = lichchieu::find($id);

    return $lichchieu;    
}
    //xoa lich chieu
public function XoaLC($id)
{
    $rap = rap::find($id);
        //$rap->delete();
    $rap->trangthai = 0;
    $rap->save();
    return redirect()->route('ds')->with('thongbao', 'Đã Xóa Rạp Thành Công');
}

     //gio chieu
public function danhSachGC()
{
 $khungtgchieu = khungtgchieu::where('trangthai',1)->get();
 return view('Pages.khungtgchieu.danhsachGC', ['khungtgchieu' => $khungtgchieu]);
}
public function ThemGC()
{
}
     //them rap
public function postThemGC(Request $request)
{
 $this->validate($request, [
     'gio' => 'required|unique:khungtgchieus,giochieu',
 ], [
     'gio.required' => 'Bạn Chưa Chọn Giờ',
     'gio.unique' => 'Thời Gian Đã Tồn Tại',
 ]);
 $khungtgchieu = new khungtgchieu();
 $gio = Carbon::parse($request->gio);
 $gio = $gio->format('H:i');
 $khungtgchieu->giochieu = $gio;
 $khungtgchieu->save();
 return redirect()->route('dsGC')->with('thongbao', 'Thêm Thời Gian Thành Công');
}
     //sua gio chieu
public function SuaGC($id)
{
 $khungtgchieu = khungtgchieu::find($id);
 return view('Pages.khungtgchieu.suaGC', ['khungtgchieu' => $khungtgchieu]);
}
public function postSuaGC(Request $request, $id)
{
 $khungtgchieu = khungtgchieu::find($id);
 $this->validate($request, [
    'gio' => 'required|unique:khungtgchieus,giochieu',
], [
    'gio.required' => 'Bạn Chưa Chọn Giờ',
    'gio.unique' => 'Thời Gian Đã Tồn Tại',
]);
 $khungtgchieu->giochieu = $request->gio;
 $khungtgchieu->save();
 return redirect()->route('dsGC')->with('thongbao', 'Đã Sửa Thời Gian Thành Công');
}
     //xoa the loai
public function XoaGC($id)
{
 $khungtgchieu = khungtgchieu::find($id);
         //$rap->delete();
 $khungtgchieu->trangthai = 0;
 $khungtgchieu->save();
 return redirect()->route('dsGC')->with('thongbao', 'Đã Xóa Thòi Gian Thành Công');
}






}