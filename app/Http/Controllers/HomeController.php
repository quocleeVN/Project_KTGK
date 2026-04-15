<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function index()
    {
        $sanphams = DB::table('san_pham')
            ->orderBy('id')
            ->limit(20)
            ->get();

        return view('caycanh.index', compact('sanphams'));
    }

    public function theloai($id)
    {
        $query = DB::table('san_pham')
            ->join('sanpham_danhmuc', 'san_pham.id', '=', 'sanpham_danhmuc.id_san_pham')
            ->where('sanpham_danhmuc.id_danh_muc', $id)
            ->select('san_pham.*');

        // Xử lý filter
        $filter = request()->get('filter');
        if ($filter == 'easy_care') {
            $query->where('do_kho', 'Dễ chăm sóc');
        } elseif ($filter == 'shade_tolerant') {
            $query->where('yeu_cau_anh_sang', 'like', '%bóng râm%');
        }

        // Xử lý sort
        $sort = request()->get('sort');
        if ($sort == 'price_asc') {
            $query->orderBy('gia_ban', 'asc');
        } elseif ($sort == 'price_desc') {
            $query->orderBy('gia_ban', 'desc');
        } else {
            $query->orderBy('id');
        }

        $sanphams = $query->get();

        $danhmuc = DB::table('danh_muc')->where('id', $id)->first();

        return view('caycanh.theloai', compact('sanphams', 'danhmuc'));
    }

    public function timkiem(Request $request)
    {
        $keyword = $request->input('keyword');

        if (!$keyword) {
            return redirect()->back()->with('error', 'Vui lòng nhập từ khóa tìm kiếm.');
        }

        $sanphams = DB::table('san_pham')
            ->where('ten_san_pham', 'like', '%' . $keyword . '%')
            ->orWhere('ten_khoa_hoc', 'like', '%' . $keyword . '%')
            ->orWhere('ten_thong_thuong', 'like', '%' . $keyword . '%')
            ->orWhere('mo_ta', 'like', '%' . $keyword . '%')
            ->get();

        return view('caycanh.timkiem', compact('sanphams', 'keyword'));
    }
}
