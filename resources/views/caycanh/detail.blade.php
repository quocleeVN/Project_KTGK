<x-caycanh-layout>
    <x-slot name="title">
        {{ $caycanh->ten_san_pham }}
    </x-slot>

    <div class="container mt-4">
        <div class="row">

            <!-- ẢNH -->
            <div class="col-md-4">
                <img src="{{ asset('storage/image/'.$caycanh->hinh_anh) }}" 
                     style="width:100%; border-radius:5px;">
            </div>

            <!-- THÔNG TIN -->
            <div class="col-md-8">
                <h4>{{ $caycanh->ten_san_pham }}</h4>

                <p><b>Tên khoa học:</b> {{ $caycanh->ten_khoa_hoc }}</p>
                <p><b>Tên thông thường:</b> {{ $caycanh->ten_thong_thuong }}</p>

                <p><b>Mô tả:</b> {{ $caycanh->mo_ta }}</p>

                <p><b>Quy cách sản phẩm:</b> {{ $caycanh->quy_cach_san_pham }}</p>
                <p><b>Độ khó:</b> {{ $caycanh->do_kho }}</p>
                <p><b>Yêu cầu ánh sáng:</b> {{ $caycanh->yeu_cau_anh_sang }}</p>
                <p><b>Nhu cầu nước:</b> {{ $caycanh->nhu_cau_nuoc }}</p>

                <p style="color:red; font-weight:bold;">
                    Giá: {{ number_format($caycanh->gia_ban) }} VNĐ
                </p>

                <form action="{{ route('caycanh.addCart') }}" method="POST" 
                    class="d-flex align-items-center mt-3 gap-3">
                    @csrf

                    <input type="hidden" name="id" value="{{ $caycanh->id }}">
                    <input type="hidden" name="name" value="{{ $caycanh->ten_san_pham }}">
                    <input type="hidden" name="price" value="{{ $caycanh->gia_ban }}">

                    <label class="me-2 mb-0">Số lượng mua:</label>                    
                    <input type="number" name="qty" value="1" min="1"
                           style="width:60px; height:35px; margin-right:15px;"
                           class="me-2">

                    <button class="btn btn-primary">
                        Thêm vào giỏ hàng
                    </button>
                </form>
        </div>
    </div>
</x-caycanh-layout>