<x-cay-canh-layout>
    <x-slot name="title">
        Thêm sản phẩm
    </x-slot>

    <div style="margin-top: 20px; max-width: 900px; margin-left: auto; margin-right: auto;">
        <div style="text-align: center; color: #0033cc; font-weight: bold; font-size: 24px; margin-bottom: 20px;">
            THÊM SẢN PHẨM
        </div>

        @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <a href="{{ url('quan-ly-san-pham') }}" class="btn btn-secondary mb-4">Quay lại</a>

        <form method="POST" action="{{ route('sanpham.luu') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Tên sản phẩm</label>
                <input type="text" name="ten_san_pham" class="form-control" value="{{ old('ten_san_pham') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tên khoa học</label>
                <input type="text" name="ten_khoa_hoc" class="form-control" value="{{ old('ten_khoa_hoc') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tên thông thường</label>
                <input type="text" name="ten_thong_thuong" class="form-control" value="{{ old('ten_thong_thuong') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Mô tả</label>
                <textarea name="mo_ta" class="form-control" rows="4" required>{{ old('mo_ta') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Độ khó</label>
                <input type="text" name="do_kho" class="form-control" value="{{ old('do_kho') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Yêu cầu ánh sáng</label>
                <input type="text" name="yeu_cau_anh_sang" class="form-control" value="{{ old('yeu_cau_anh_sang') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nhu cầu nước</label>
                <input type="text" name="nhu_cau_nuoc" class="form-control" value="{{ old('nhu_cau_nuoc') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Giá bán</label>
                <input type="number" name="gia_ban" class="form-control" value="{{ old('gia_ban') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Ảnh</label>
                <input type="file" name="hinh_anh" class="form-control" accept="image/*" required>
            </div>

            <button type="submit" class="btn btn-primary">Lưu</button>
        </form>
    </div>
</x-cay-canh-layout>