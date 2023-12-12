<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use Illuminate\Http\Request;
use Storage;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $limit = 10; //tùy chọn, số dòng/ trang
        $page = $req->page > 0 ? $req->page : 1; // trang hiện tại đang truy cập
        //values:id, tit, desc, thum, release_date, vote, like
        // dd($query->toSql());
        $ads = Advertisement::search($req)->paginate($limit, ['*'], 'page', $page);
        $count = $ads->count();
        // key => 
        //          form type
        //          show text
        $types = [
            'id' => ['int', 'ID'],
            'title' => ['string', 'Tiêu đề'],
            'description' => ['text', 'Mô tả'],
            'image_url' => ['image', 'Hình ảnh'],
            'target_url' => ['link','Mục tiêu'],
        ];
        $values = $ads;
        $title = 'Quảng cáo';
        $for = 'advertisements';
        $searchBy = 'Tìm theo tiêu đề...';
        return view("data_manage.index", compact(
            "page",
            'types',
            'values',
            'title',
            'count',
            'for',
            'searchBy','req'
        )
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create.advertisement');
    }   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        // dd(1);
        // dd($req->hasFile('image_file'));
        $validated = $req->validate([
            'title'=>'string|required|max:255',
            // 'description'=>'string',
            // 'image_url'=>'string',
            'target_url'=>'url|required',
            'image_file'=>'image|mimes:jpg,jpeg,png,gif|max:10000'
        ],[
            'title.required'=> 'Vui lòng nhập tên',
            'email.required'=> 'Vui lòng Email',
            'password.required'=> 'Vui lòng mật khẩu',
            'password.min'=> 'Mật khẩu tối thiểu 8 kí tự',
        ]);
        // dd(1);
        // tải file thế link
        if ($req->hasFile('image_file')) {
            $avatar = $req->file('image_file');
            // dd('ok');
            // $path = $avatar->store('public/imgs/avatars');
            $path = $avatar->store('public/imgs/images');
            
            // Lưu đường dẫn vào database hoặc thực hiện các thao tác khác tùy ý
            $validated['image_url'] = Storage::url($path);
        }
        Advertisement::create($validated);
        return redirect()->route('admin.advertisements.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function show(Advertisement $advertisement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function edit(Advertisement $advertisement)
    {
        $v = $advertisement;
        return view('admin.create.advertisement',compact(
            'v'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Advertisement $advertisement)
    {
        // dd($req->all());
        $validated = $req->validate([
            'title'=>'string|required|max:255',
            'description'=>'string',
            'image_url'=>'string',
            'target_url'=>'url|required',
            'image_file'=>'image|mimes:jpg,jpeg,png,gif|max:10000'
        ],[
            'title.required'=> 'Vui lòng nhập tên',
            'email.required'=> 'Vui lòng Email',
            'password.required'=> 'Vui lòng mật khẩu',
            'password.min'=> 'Mật khẩu tối thiểu 8 kí tự',
        ]);
        // dd(1);
        
        // tải file thế link
        if ($req->hasFile('image_file')) {
            $avatar = $req->file('image_file');
            // dd('ok');
            // $path = $avatar->store('public/imgs/avatars');
            $path = $avatar->store('public/imgs/images');
            
            // Lưu đường dẫn vào database hoặc thực hiện các thao tác khác tùy ý
            
            $validated['image_url'] = Storage::url($path);
        }
        // dd($validated);
        $advertisement->update($validated);
        return redirect()->route('admin.advertisements.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advertisement $advertisement)
    {
        $advertisement->delete();
    }
}
