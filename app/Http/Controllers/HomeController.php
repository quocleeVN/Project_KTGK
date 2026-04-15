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
            ->where('status', 1)
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
            ->where('san_pham.status', 1)
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

    public function quanLySanPham(Request $request)
    {
        if ($request->ajax()) {
            $query = DB::table('san_pham')->where('status', 1);

            // Handle search
            if ($request->has('search') && !empty($request->input('search.value'))) {
                $search = $request->input('search.value');
                $query->where(function ($q) use ($search) {
                    $q->where('ten_san_pham', 'like', '%' . $search . '%')
                        ->orWhere('ten_khoa_hoc', 'like', '%' . $search . '%')
                        ->orWhere('ten_thong_thuong', 'like', '%' . $search . '%')
                        ->orWhere('mo_ta', 'like', '%' . $search . '%');
                });
            }

            $totalRecords = DB::table('san_pham')->where('status', 1)->count();
            $filteredRecords = $query->count();

            // Handle ordering
            $columns = ['ten_san_pham', 'ten_khoa_hoc', 'ten_thong_thuong', 'do_kho', 'yeu_cau_anh_sang', 'nhu_cau_nuoc', 'gia_ban', 'hinh_anh', 'id'];
            if ($request->has('order')) {
                $orderColumn = $request->input('order.0.column');
                $orderDir = $request->input('order.0.dir');
                if (isset($columns[$orderColumn])) {
                    $query->orderBy($columns[$orderColumn], $orderDir);
                }
            } else {
                $query->orderBy('id');
            }

            // Handle pagination
            $start = $request->input('start', 0);
            $length = $request->input('length', 10);
            $sanphams = $query->skip($start)->take($length)->get();

            $data = [];
            foreach ($sanphams as $caycanh) {
                $data[] = [
                    $caycanh->ten_san_pham,
                    $caycanh->ten_khoa_hoc,
                    $caycanh->ten_thong_thuong,
                    $caycanh->do_kho,
                    $caycanh->yeu_cau_anh_sang,
                    $caycanh->nhu_cau_nuoc,
                    number_format($caycanh->gia_ban, 0, ',', '.'),
                    '<img src="' . asset('storage/image/' . $caycanh->hinh_anh) . '" alt="' . $caycanh->ten_san_pham . '" style="width:60px; height:auto;">',
                    '<a class="btn btn-sm btn-info" href="' . url('caycanh/' . $caycanh->id) . '">Xem</a> ' .
                        '<form action="' . route('sanpham.xoa', $caycanh->id) . '" method="POST" style="display:inline;">' .
                        '<input type="hidden" name="_token" value="' . csrf_token() . '">' .
                        '<button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Bạn có chắc muốn xóa sản phẩm này không?\')">Xóa</button>' .
                        '</form>'
                ];
            }

            return response()->json([
                'draw' => intval($request->input('draw')),
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $filteredRecords,
                'data' => $data
            ]);
        }

        return view('caycanh.quanly');
    }

    public function xoaSanPham(Request $request, $id)
    {
        DB::table('san_pham')
            ->where('id', $id)
            ->update(['status' => 0]);

        return redirect()->back()->with('success', 'Xóa sản phẩm thành công.');
    }

    public function timkiem(Request $request)
    {
        $keyword = $request->input('keyword');

        if (!$keyword) {
            return redirect()->back()->with('error', 'Vui lòng nhập từ khóa tìm kiếm.');
        }

        $sanphams = DB::table('san_pham')
            ->where('status', 1)
            ->where(function ($query) use ($keyword) {
                $query->where('ten_san_pham', 'like', '%' . $keyword . '%')
                    ->orWhere('ten_khoa_hoc', 'like', '%' . $keyword . '%')
                    ->orWhere('ten_thong_thuong', 'like', '%' . $keyword . '%')
                    ->orWhere('mo_ta', 'like', '%' . $keyword . '%');
            })
            ->get();

        return view('caycanh.timkiem', compact('sanphams', 'keyword'));
    }
}
