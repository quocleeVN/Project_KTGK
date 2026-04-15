<x-cay-canh-layout>
    <x-slot name="title">
        {{ $danhmuc->ten_danh_muc ?? 'Danh mục' }}
    </x-slot>

    <div style="margin-top: 20px;">
        <div style="margin-bottom: 20px;">
            <strong>Sắp xếp và lọc:</strong>
            <a href="{{ url()->current() }}?sort=price_asc" class="btn btn-sm btn-outline-primary">Giá tăng dần</a>
            <a href="{{ url()->current() }}?sort=price_desc" class="btn btn-sm btn-outline-primary">Giá giảm dần</a>
            <a href="{{ url()->current() }}?filter=easy_care" class="btn btn-sm btn-outline-success">Dễ chăm sóc</a>
            <a href="{{ url()->current() }}?filter=shade_tolerant" class="btn btn-sm btn-outline-info">Chịu được bóng râm</a>
            <a href="{{ url()->current() }}" class="btn btn-sm btn-outline-secondary">Xóa bộ lọc</a>
        </div>
        <div class="list-cay-canh">
            @forelse($sanphams as $caycanh)
            <div class="cay-canh">
                <a href="{{ url('caycanh/'.$caycanh->id) }}">
                    <img src="{{ asset('storage/image/' . $caycanh->hinh_anh) }}" alt="{{ $caycanh->ten_san_pham }}" style="width:100%; height:180px; object-fit:cover;">
                    <div style="padding: 10px; text-align:left;">
                        <div style="font-weight:700; min-height:44px;">{{ $caycanh->ten_san_pham }}</div>
                        <div style="margin-top:8px; color:#d9534f; font-weight:700;">{{ number_format($caycanh->gia_ban,0,',','.') }}đ</div>
                    </div>
                </a>
            </div>
            @empty
            <p>Không có sản phẩm nào trong danh mục này.</p>
            @endforelse
        </div>
    </div>
</x-cay-canh-layout>